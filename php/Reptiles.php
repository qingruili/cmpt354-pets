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
            $sql = "SELECT COLOR, Name, Birth, Type, Weight, Sex, h.PID,  
            NumberOfMolts FROM haspet h, reptiles r WHERE PhoneNumber = ? AND h.PID = r.PID";
            $mysqli_stmt = $mysqli->prepare($sql);

            $PhoneNumber = $_SESSION['PhoneNumber'];
            $mysqli_stmt->bind_param('s', $PhoneNumber);
            if ($mysqli_stmt->execute()) {
                $COLOR= null;
                $Name = null;
                $Birth = null;
                $Type = null;
                $Weight = null;
                $Sex = null;
                $PID = null;
                $NumberOfMolts = null;

                $mysqli_stmt->bind_result($COLOR, $Name,$Birth,$Type,$Weight,$Sex, $PID,$NumberOfMolts);

                echo "<table><tr><th class='border-class'>Name</th
                ><th class='border-class'>Color</th><th class='border-
                class'>Birth</th><th class='border-class'>Type</th
                ><th class='border-class'>Weight</th
                ><th class='border-class'>Sex</th
                ><th class='border-class'>PID</th
                ><th class='border-class'>Number Of Molts</th
                ></tr>";

                while ($mysqli_stmt->fetch()) {
                    echo "<tr><td class='border-class'>".$Name."</td><td 
                class='border-class'>".$COLOR."</td><td 
                class='border-class'>".$Birth."</td><td class='border-class'>".$Type."</td>
                <td class='border-class'>".$Weight."</td>
                <td class='border-class'>".$Sex."</td>
                <td class='border-class'>".$PID."</td>
                <td class='border-class'>".$NumberOfMolts."</td></tr>";
                }
                echo "</table>";
            }


    $mysqli_stmt->free_result();
    $mysqli_stmt->close();
}

$mysqli->close();
?>