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

            $PID = $_POST['PID'];
            $PhoneNumber = $_SESSION['PhoneNumber'];
            $sql = "DELETE FROM haspet WHERE PID = ? AND PhoneNumber = ?";
            $mysqli_stmt = $mysqli->prepare($sql);

            $mysqli_stmt->bind_param('ss', $PID,$PhoneNumber);

            if ($mysqli_stmt->execute()) {
                echo "<script>alert('DELETE SUCCESSFUL');window.location.href='../../pets/html/pets.html'</script>";
            }
            else{
                echo "<script>alert('DELETE FAILED');window.location.href='../../pets/html/pets.html'</script>";
            }
           
    $mysqli_stmt->free_result();
    $mysqli_stmt->close();
}

$mysqli->close();
?>