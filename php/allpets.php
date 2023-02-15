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
            
            $sql = "SELECT COLOR, Name, h.Birth, Type, Weight, Sex, PID,  
            Age FROM haspet h, petbirth p WHERE PhoneNumber = ? AND h.Birth = p.Birth";
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
                $Age = null;

                $mysqli_stmt->bind_result($COLOR, $Name,$Birth,$Type,$Weight,$Sex, $PID,$Age);

                echo "<table><tr><th class='border-class'>Name</th
                ><th class='border-class'>Color</th><th class='border-
                class'>Birth</th><th class='border-class'>Type</th
                ><th class='border-class'>Weight</th
                ><th class='border-class'>Sex</th
                ><th class='border-class'>PID</th
                ><th class='border-class'>Age</th
                ></tr>";

                while ($mysqli_stmt->fetch()) {
                    echo "<tr><td class='border-class'>".$Name."</td><td 
                class='border-class'>".$COLOR."</td><td 
                class='border-class'>".$Birth."</td><td class='border-class'>".$Type."</td>
                <td class='border-class'>".$Weight."</td>
                <td class='border-class'>".$Sex."</td>
                <td class='border-class'>".$PID."</td>
                <td class='border-class'>".$Age."</td></tr>";
                }
                echo "</table>";
            }
            
    $mysqli_stmt->free_result();
    $mysqli_stmt->close();
}

$mysqli->close();
?>