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

            $sql = " SELECT h.PID, h.Name, mk.TimeDate,mk.AdverseReaction,d.Type, ve.Name, ve.Department
            FROM haspet h, makes mk, doesexamination d,veterinarian ve
           WHERE PhoneNumber = ? AND h.PID = ? AND h.PID = mk.PID 
           AND mk.TimeDate = d.TimeDate AND mk.VetID = d.VetID AND  d.VetID = ve.VetID ;";

            $mysqli_stmt = $mysqli->prepare($sql);
            $PhoneNumber = $_SESSION['PhoneNumber'];
            $PID = $_POST['PID'];
        
        
            $mysqli_stmt->bind_param('ss', $PhoneNumber,$PID);

            if ($mysqli_stmt->execute()) {
                $PID= null;
                $Name = null;
                $TimeDate = null;
                $AdverseReaction = null;
                $Type = null;
                $Namev= null;
                $Department= null;


                $mysqli_stmt->bind_result($PID, $Name,$TimeDate,$AdverseReaction,$Type,$Namev,$Department);

                echo "<table><tr><th class='border-class'>Name of Pet </th
                ><th class='border-class'>Pet ID</th><th class='border-
                class'>Time of Exam</th><th class='border-class'>Exam Type</th
                ><th class='border-class'>AdverseReaction</th
                ><th class='border-class'>Veterinarian</th
                ><th class='border-class'>Department of Veterinarian</th
                ></tr>";

                while ($mysqli_stmt->fetch()) {
                    echo "<tr><td class='border-class'>".$Name."</td><td 
                class='border-class'>".$PID."</td><td 
                class='border-class'>".$TimeDate."</td><td class='border-class'>".$Department."</td>
                <td class='border-class'>".$AdverseReaction."</td>
                <td class='border-class'>".$Type."</td>
                <td class='border-class'>".$Namev."</tr>";
                }
                echo "</table>";
            }
            
    $mysqli_stmt->free_result();
    $mysqli_stmt->close();
}

$mysqli->close();
?>