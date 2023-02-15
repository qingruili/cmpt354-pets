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
            
            $sql = "SELECT h.PID, h.Name, pr.Time, pr.ContentOfTreatment, pr.ReasonForComing, 
            pr.Comment, ve.Name, ve.Department
            FROM haspet h, ridpid rp, providedreport pr, veterinarian ve
           WHERE PhoneNumber = ? AND h.PID = ? AND h.PID = rp.PID AND rp.RID = pr.RID
           AND ve.VetID = pr.VetID;";

            $mysqli_stmt = $mysqli->prepare($sql);
            $PhoneNumber = $_SESSION['PhoneNumber'];
            $PID = $_POST['PID'];
        
        
            $mysqli_stmt->bind_param('ss', $PhoneNumber,$PID);

            if ($mysqli_stmt->execute()) {
                $PID= null;
                $Name = null;
                $Time = null;
                $ContentOfTreatment = null;
                $ReasonForComing = null;
                $Comment= null;
                $Department= null;
                $NameV= null;
   



                $mysqli_stmt->bind_result($PID, $Name,$Time,$ContentOfTreatment, $ReasonForComing,$Comment,$Department, $NameV);

                echo "<table><tr><th class='border-class'>Name of Pet </th>
                <th class='border-class'>Pet ID</th>
                <th class='border-class'>Time of Report</th>
                <th class='border-class'>Content Of Treatment</th>
                <th class='border-class'>Reason For Coming</th>
                <th class='border-class'>Comment</th>
                <th class='border-class'>Name of Veterinarian</th>
                <th class='border-class'>Department of Veterinarian</th>
                </tr>";

                while ($mysqli_stmt->fetch()) {
                    echo "<tr><td class='border-class'>".$Name."</td><td 
                class='border-class'>".$PID."</td><td 
                class='border-class'>".$Time."</td>
                <td class='border-class'>".$ContentOfTreatment."</td>
                <td class='border-class'>". $ReasonForComing."</td>
                <td class='border-class'>".$Comment."</td>
                <td class='border-class'>".$Department."</td>
                <td class='border-class'>".$NameV."</td>
            </tr>";
                }
                echo "</table>";
            }
            
    $mysqli_stmt->free_result();
    $mysqli_stmt->close();
}

$mysqli->close();
?>