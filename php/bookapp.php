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

$sql = "SELECT a.TimeDate, a.Address
FROM arranges a
WHERE a.TimeDate = ? AND a.Address = ? ";
$mysqli_stmt = $mysqli->prepare($sql);
$TimeDate= $_POST['TD'];
$Address = $_POST['AH'];

$mysqli_stmt->bind_param('ss', $TimeDate,$Address);
if($mysqli_stmt->execute()){
    $TimeDate= null;
    $Address = null;
    $RoomNumber = null; 
    $mysqli_stmt->bind_result($TimeDate,$Address);

   if($mysqli_stmt->fetch()) {
        echo "<script>alert('Repeated Booking, Please re-type!');window.location.href='../../pets/html/owneraddpets.html'</script>";
        $mysqli_stmt->free_result();
        $mysqli_stmt->close();
        $mysqli->close();
    }
    else{
        $mysqli_stmt->free_result();
        $mysqli_stmt->close();
        addinfo($mysqli);
        $mysqli->close();
    }
}





function addinfo($mysqli){

    $sql = "insert into bookedappointment(TimeDate,PhoneNumber,AppmType) values(?,?,?) ";
    $mysqli_stmt = $mysqli->prepare($sql);

    $TimeDate= $_POST['TD'];
    $PhoneNumber = $_SESSION['PhoneNumber'];
    $AppmType = $_POST['AT'];


    $mysqli_stmt->bind_param('sss', $TimeDate,$PhoneNumber,$AppmType);


    if ($mysqli_stmt->execute()) {
        echo $mysqli_stmt->insert_id; 
        echo PHP_EOL;
    }
    else {
        echo $mysqli_stmt->error;
    }

    
    $mysqli_stmt->free_result();
    $mysqli_stmt->close();
        
    $sql = "insert into arranges(TimeDate,PhoneNumber,Address) values(?,?,?) ";

    $mysqli_stmt = $mysqli->prepare($sql);
    
    $TimeDate= $_POST['TD'];
    $PhoneNumber = $_SESSION['PhoneNumber'];
    $Address = $_POST['AH'];

    
    $mysqli_stmt->bind_param('sss',$TimeDate,$PhoneNumber,$Address);
    
    
    if ($mysqli_stmt->execute()) {
        echo $mysqli_stmt->insert_id; 
        echo PHP_EOL;
        echo "<script>alert('Successfully Insert!');window.location.href='../../pets/html/makeapp.html'</script>";
    }
    else {
        echo $mysqli_stmt->error;
    }
    $mysqli_stmt->free_result();
    $mysqli_stmt->close();
}
    
?>