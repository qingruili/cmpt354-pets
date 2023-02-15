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
            
            $sql = "SELECT  h.PID, h.Name, b.NumberOfReplaceFeathers, bg.NumberOfTimes, V.Name
            FROM haspet h, birds b, bgets bg, vaccine v
            WHERE h.PhoneNumber = ? AND b.PID = h.PID AND bg.PID = b.PID 
            AND  bg.VacID = v.VacID";

            $mysqli_stmt = $mysqli->prepare($sql);
         
        
            $PhoneNumber = $_SESSION['PhoneNumber'];
        
        
            $mysqli_stmt->bind_param('s', $PhoneNumber);
        
            if ($mysqli_stmt->execute()) {
                $PID= null;
                $NumberOfReplaceFeathers = null;
                $Nameh = null;
                $Namev = null;
                $NumberOfTimes = null;
        
                $mysqli_stmt->bind_result( $PID,$Namev,$Nameh,$NumberOfReplaceFeathers,$NumberOfTimes);


                echo "<table><tr><th class='border-class'>PID  </th
                ><th class='border-class'> Name of pet</th><th class='border-class'>Number Of Replace Feathers</th
                ><th class='border-class'>Number Of Times</th
                ><th class='border-class'>Name of vaccine</th
                ></tr>";

                while ($mysqli_stmt->fetch()) {
                    echo "<tr><td class='border-class'>".$PID."</td><td 
                class='border-class'>".$Namev."</td><td 
                class='border-class'>".$Nameh."</td><td class='border-class'>".$NumberOfReplaceFeathers."</td>
                <td class='border-class'>".$NumberOfTimes."</td></tr>";
                }
                echo "</table>";
            }

    $mysqli_stmt->free_result();
    $mysqli_stmt->close();
}

$mysqli->close();
?>