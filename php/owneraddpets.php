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

$sql = "SELECT PID FROM haspet WHERE PID = ?";
$mysqli_stmt = $mysqli->prepare($sql);
$PID = $_POST['PID'];
$mysqli_stmt->bind_param('s', $PID);
if($mysqli_stmt->execute()){
    $PID = null;
    $mysqli_stmt->bind_result($PID);

   if($mysqli_stmt->fetch()) {
        echo "<script>alert('Repeated PID, Please re-type!');window.location.href='../../pets/html/owneraddpets.html'</script>";
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

    $sql = "insert into haspet(PID,Name,Color,Birth,Type,Weight,PhoneNumber,Sex) values(?,?,?,?,?,?,?,?) ";
    $mysqli_stmt = $mysqli->prepare($sql);

    $PID = $_POST['PID'];
    $Name = $_POST['Name'];
    $Color = $_POST['Color'];
    $Birth = $_POST['Birth'];
    $Type = $_POST['Type'];
    $Weight = $_POST['Weight'];
    $PhoneNumber = $_SESSION['PhoneNumber'];
    $Sex = $_POST['Sex'];
    $Sex= $Sex == 0 ? 'Male' : 'Female';


    $mysqli_stmt->bind_param('ssssssss', $PID,$Name,$Color,$Birth,$Type,$Weight,$PhoneNumber,$Sex);


    if ($mysqli_stmt->execute()) {
        echo $mysqli_stmt->insert_id; 
        echo PHP_EOL;
    }
    else {
        echo $mysqli_stmt->error;
    }

    
    $mysqli_stmt->free_result();
    $mysqli_stmt->close();



    $sql = "SELECT Birth FROM petbirth WHERE Birth = ?";
    $mysqli_stmt = $mysqli->prepare($sql);
    $Birth = $_POST['Birth'];
    $mysqli_stmt->bind_param('s', $Birth);
    if($mysqli_stmt->execute()){
        $Birth = null;
        $mysqli_stmt->bind_result($Birth);
    
       if(!$mysqli_stmt->fetch()) {
        $mysqli_stmt->free_result();
        $mysqli_stmt->close();
        
        $sql = "insert into petbirth( Birth,Age) values(?,?) ";
        $mysqli_stmt = $mysqli->prepare($sql);
    
    
        $Age = $_POST['Age'];
        $Birth = $_POST['Birth'];
    
    
        $mysqli_stmt->bind_param('ss',$Birth,$Age);
    
    
        if ($mysqli_stmt->execute()) {
            echo $mysqli_stmt->insert_id; 
            echo PHP_EOL;
        }
        else {
            echo $mysqli_stmt->error;
        }
        }
    }


    $mysqli_stmt->free_result();
    $mysqli_stmt->close();




    $Species = $_POST['species'];
    if($Species == 0){
        $sql = "insert into Mammalia( PID,Sterilization) values(?,?) ";
        $mysqli_stmt = $mysqli->prepare($sql);
        $PID = $_POST['PID'];
        $Sterilization = $_POST['Sterilization'];
        $mysqli_stmt->bind_param('ss',$PID,$Sterilization);
    }
    else if($Species == 1){
        $sql = "insert into Birds(PID,NumberOfReplaceFeathers) values(?,?) ";
        $mysqli_stmt = $mysqli->prepare($sql);
        $PID = $_POST['PID'];
        $Birds = $_POST['NumberOfReplaceFeathers'];
        $mysqli_stmt->bind_param('ss',$PID,$Birds);
    }
    else{
        $sql = "insert into Reptiles( PID,NumberOfMolts) values(?,?) ";
        $mysqli_stmt = $mysqli->prepare($sql);
        $PID = $_POST['PID'];
        $Reptiles = $_POST['NumberOfMolts'];
        $mysqli_stmt->bind_param('ss',$PID,$Reptiles);
    }



    if ($mysqli_stmt->execute()) {
        echo $mysqli_stmt->insert_id; 
        echo PHP_EOL;
        echo "<script>alert('Successful!');window.location.href='../../pets/html/pets.html'</script>";
    }
    else {
        echo $mysqli_stmt->error;
    }

    $mysqli_stmt->free_result();
    $mysqli_stmt->close();

}
?>