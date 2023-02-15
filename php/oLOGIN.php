<?php
header('content-type:text/html;charset=utf-8');
$host = "localhost";
$user = "root";
$Password = "root";
$db = "pethealthsystem";


$mysqli = new mysqli($host, $user, $Password, $db); 
if ($mysqli->connect_errno) {
    die($mysqli->connect_error);
}
$mysqli->set_charset('utf8'); 
session_start();

getUser($mysqli);
$mysqli->close();

function getUser($mysqli){
    $sql = "SELECT PhoneNumber FROM owner WHERE PhoneNumber = ? and Password = ? ";
    $mysqli_stmt = $mysqli->prepare($sql);

    $PhoneNumber = $_POST['PhoneNumber'];
    
    $Password = $_POST['Password'];

    $mysqli_stmt->bind_param('ss', $PhoneNumber, $Password);

    if ($mysqli_stmt->execute()) {
        $_SESSION['PhoneNumber'] = $PhoneNumber;
        echo "<script>alert('Successful!');window.location.href='../../pets/html/owner.html'</script>";
    }

    $mysqli_stmt->free_result();
    $mysqli_stmt->close();
}
?>


