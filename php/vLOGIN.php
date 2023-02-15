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

getUser($mysqli);
$mysqli->close();

function getUser($mysqli){
    $sql = "SELECT VetID FROM veterinarian WHERE VetID = ? and password = ? ";
    $mysqli_stmt = $mysqli->prepare($sql);

    $VetID = $_POST['VetID'];
    
    $password = $_POST['password'];

    $mysqli_stmt->bind_param('ss', $VetID, $password);

    if ($mysqli_stmt->execute()) {
        $lastpage ='';
        $_SESSION['vetid']=$VetID;
        $_SESSION['lastpage2']=$lastpage;
        $_SESSION['lastpage3']=$lastpage;
        echo "<script>alert('Successful!');window.location.href='../../pets/html/vet.html'</script>";
    }

    $mysqli_stmt->free_result();
    $mysqli_stmt->close();
}
?>


