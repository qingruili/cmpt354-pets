<?php


header('content-type:text/html;charset=utf-8');
$host = "localhost";
$user = "root";
$password = "root";
$db = "pethealthsystem";


$mysqli = new mysqli($host, $user, $password, $db); 
if ($mysqli->connect_errno) {
    die($mysqli->connect_error);
}
$mysqli->set_charset('utf8'); 
session_start();
getinfo($mysqli);


function getinfo($mysqli)
{
            
            $sql = " SELECT h.PID, h.Name, pr.Time, pe.Frequency,dd.Name,nf.EffectDescription
            FROM haspet h, ridpid rp, providedreport pr, prescribe pe, didname dd, nameeffect nf
           WHERE PhoneNumber = ? AND h.PID = ? AND dd.Name = nf.Name
           AND dd.DID = pe.DID AND pe.RID = pr.RID AND rp.RID = pr.RID AND h.PID = rp.PID;";

            $mysqli_stmt = $mysqli->prepare($sql);
            $PhoneNumber = $_SESSION['PhoneNumber'];
            $PID = $_POST['PID'];
        
        
            $mysqli_stmt->bind_param('ss', $PhoneNumber,$PID);

            if ($mysqli_stmt->execute()) {
                $PID= null;
                $Name = null;
                $Time = null;
                $Frequency = null;
                $NameD = null;
                $EffectDescription= null;

   



                $mysqli_stmt->bind_result($PID, $Name,$Time,$Frequency, $NameD,$EffectDescription);

                echo "<table><tr><th class='border-class'>Name of Pet </th>
                <th class='border-class'>Pet ID</th>
                <th class='border-class'>Time of Report</th>
                <th class='border-class'>Frequency</th>
                <th class='border-class'>Name of Drug</th>
                <th class='border-class'>EffectDescription</th>
                </tr>";

                while ($mysqli_stmt->fetch()) {
                    echo "<tr><td class='border-class'>".$Name."</td><td 
                class='border-class'>".$PID."</td><td 
                class='border-class'>".$Time."</td>
                <td class='border-class'>".$Frequency."</td>
                <td class='border-class'>". $NameD."</td>
                <td class='border-class'>".$EffectDescription."</td>
            </tr>";
                }
                echo "</table>";
            }
            
    $mysqli_stmt->free_result();
    $mysqli_stmt->close();
}

$mysqli->close();
?>