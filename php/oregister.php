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
register($mysqli);
$mysqli->close();


function register($mysqli)
{
    $sql = "insert into owner(PhoneNumber, Address, Name, Email, Password) values(?,?,?,?,?)";
    $mysqli_stmt = $mysqli->prepare($sql); 

    $PhoneNumber = $_POST["PhoneNumber"];
    $Address = $_POST["Address"];
    $Email = $_POST["Email"];
    $passwd = $_POST["passwd"];
    $Name = $_POST["Name"];


    $mysqli_stmt->bind_param('sssss', $PhoneNumber, $Address, $Name, $Email, $passwd);

    if ($mysqli_stmt->execute()) {
        echo $mysqli_stmt->insert_id;
        echo PHP_EOL;
        echo "<script>alert('Successfully Sign UP !');window.location.href='../../pets/html/ologin.html'</script>";
    } else {
        echo $mysqli_stmt->error;
    }


    $mysqli_stmt->free_result();
    $mysqli_stmt->close();
}

?>