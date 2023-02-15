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
    $sql = "SELECT PhoneNumber, Address , Name, Email FROM owner WHERE PhoneNumber = ?";
    $mysqli_stmt = $mysqli->prepare($sql);


    $PhoneNumber = $_SESSION['PhoneNumber'];


    $mysqli_stmt->bind_param('s', $PhoneNumber);

    if ($mysqli_stmt->execute()) {
        $PhoneNumber = null;
        $Address = null;
        $Name = null;
        $Email = null;


        $mysqli_stmt->bind_result($PhoneNumber, $Address,$Name,$Email);

        while ($mysqli_stmt->fetch()) {
            echo 'Your Name: ' . $Name;
            echo '<br/>Your address:' . $Address;
            echo '<br/>Your PhoneNumber:' . $PhoneNumber;
            echo "<br/>Your Email:" . $Email;
        }
    }

    $mysqli_stmt->free_result();
    $mysqli_stmt->close();
}

$mysqli->close();
?>