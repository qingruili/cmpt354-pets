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

            $sql = "DELETE FROM bookedappointment WHERE TimeDate = ? AND PhoneNumber = ? ";
            $PhoneNumber = $_SESSION['PhoneNumber'];
            $TimeDate = $_POST['TimeDate'];
            $mysqli_stmt = $mysqli->prepare($sql);

            $mysqli_stmt->bind_param('ss',$TimeDate, $PhoneNumber);

            if ($mysqli_stmt->execute()) {
                echo "<script>alert('DELETE SUCCESSFUL');window.location.href='../../pets/html/appointment.html'</script>";
            }
            else{
                echo "<script>alert('DELETE FAILED');window.location.href='../../pets/html/appointment.html'</script>";
            }
           

    $mysqli_stmt->free_result();
    $mysqli_stmt->close();
}

$mysqli->close();
?>