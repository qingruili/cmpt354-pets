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
    $sql = "SELECT PhoneNumber, Password FROM owner WHERE PhoneNumber = ? AND Password = ?";
    $mysqli_stmt = $mysqli->prepare($sql);


    $PhoneNumber = $_SESSION['PhoneNumber'];
    $Password = $_POST['password'];


    $mysqli_stmt->bind_param('ss', $PhoneNumber,$Password);

    if ($mysqli_stmt->execute()) {

        $PhoneNumber = null;
        $Password = null;

        $mysqli_stmt->bind_result($PhoneNumber,$Password);
        if ($mysqli_stmt->fetch()) {
            $mysqli_stmt->free_result();
            $mysqli_stmt->close();
            
            $sql = "UPDATE owner set Password = ? WHERE PhoneNumber = ?";
            $mysqli_stmt = $mysqli->prepare($sql);
            
            $PhoneNumber = $_SESSION['PhoneNumber'];
            $Password = $_POST['NEWONE'];
    
            $mysqli_stmt->bind_param('ss', $Password, $PhoneNumber);
    
            if ($mysqli_stmt->execute()) {
                echo PHP_EOL;
                echo "<script>alert('Successful!');window.location.href='../../pets/html/account.html'</script>";
            } else {
                echo $mysqli_stmt->error; 
            }
        }
        else{
            echo "<script>alert('WRONG OLD PASSWARS!');window.location.href='../../pets/html/changepass.html'</script>";
        }

    }

    $mysqli_stmt->free_result();
    $mysqli_stmt->close();
}

$mysqli->close();
?>