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
            
    $sql = "SELECT City, COUNT(h.City)
    FROM hospital h
    GROUP BY h.City";

    $result = $conn->query($sql);


    if($result->num_rows > 0)
    {
        echo "<table><tr><th class='border-class'>Name </th>
        <th class='border-class'>Number of City</th>
        </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td class='border-class'>".$row["City"]."</td><td 
                <td class='border-class'>".$row["COUNT(h.City)"]."</td>
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