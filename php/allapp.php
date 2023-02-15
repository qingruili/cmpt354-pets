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
            
            $sql = " SELECT b.TimeDate, b.PhoneNumber, b.AppmType, a.RoomNumber, h.Name, h.Address, 
            h.Phone AS HOSPITALPHONE, h.Email,h.Fax
            FROM bookedappointment b
            JOIN arranges a on a.PhoneNumber = b.PhoneNumber AND a.TimeDate = b.TimeDate
            JOIN hospital h on h.Address = a.Address
            WHERE b.PhoneNumber = ? ";

            $mysqli_stmt = $mysqli->prepare($sql);
            $PhoneNumber = $_SESSION['PhoneNumber'];
        
        
            $mysqli_stmt->bind_param('s', $PhoneNumber);

            if ($mysqli_stmt->execute()) {
                $TimeDate = null;
                $PhoneNumber = null;
                $AppmType = null;
                $RoomNumber = null;
                $Name = null;
                $Address= null;
                $PH = null;
                $Email = null;
                $Fax = null;
   



                $mysqli_stmt->bind_result($TimeDate, $PhoneNumber,$AppmType,$RoomNumber,$Name,$Address,$PH,$Email,$Fax);

                echo "<table><tr><th class='border-class'>Time of Date </th>
                <th class='border-class'>PhoneNumber of owner</th>
                <th class='border-class'>Type of Clinic</th>
                <th class='border-class'>Room Number</th>
                <th class='border-class'>Name of Hospital</th>
                <th class='border-class'>Address of Hospital</th>
                <th class='border-class'>Number of Hospital</th>
                <th class='border-class'>Email of Hospital</th>
                <th class='border-class'>Fax of Hospital</th>
                </tr>";

                while ($mysqli_stmt->fetch()) {
                    echo "<tr><td class='border-class'>".$TimeDate."</td><td 
                class='border-class'>".$PhoneNumber."</td><td 
                class='border-class'>".$AppmType."</td>
                <td class='border-class'>".$RoomNumber."</td>
                <td class='border-class'>". $Name."</td>
                <td class='border-class'>".$Address."</td>
                <td class='border-class'>".$PH."</td>
                <td class='border-class'>".$Email."</td>
                <td class='border-class'>".$Fax."</td>
            </tr>";
                }
                echo "</table>";
            }
            

    $mysqli_stmt->free_result();
    $mysqli_stmt->close();
}

$mysqli->close();
?>