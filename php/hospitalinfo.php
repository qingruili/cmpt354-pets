<?php


header('content-type:text/html;charset=utf-8');
$host = "localhost";
$user = "root";
$password = "root";
$db = "pethealthsystem";


$conn = new mysqli($host, $user, $password, $db); 
if ($conn->connect_errno) {
    die($conn->connect_error);
}


getinfo($conn);


function getinfo($conn)
{
            
    $sql = "SELECT h.Name, h.Address, h.Phone, h.Email,h.Fax,h.City
    FROM hospital h";

    $result = $conn->query($sql);


    if($result->num_rows > 0)
    {
        echo "<table><tr><th class='border-class'>Name </th>
        <th class='border-class'>Address</th>
        <th class='border-class'>Phone</th>
        <th class='border-class'>Email</th>
        <th class='border-class'>Fax</th>
        <th class='border-class'>City</th>
        </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td class='border-class'>".$row["Name"]."</td><td 
                class='border-class'>".$row["Address"]."</td><td 
                class='border-class'>".$row["Phone"]."</td>
                <td class='border-class'>".$row["Email"]."</td>
                <td class='border-class'>".$row["Fax"]."</td>
                <td class='border-class'>".$row["City"]."</td>
            </tr>";
                }
                echo "</table>";
            }
            else{
                echo "0 results";
            }
        }
        
$conn->close();
?>