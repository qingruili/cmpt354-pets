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
    $sql = "SELECT PhoneNumber, Address, Name, Email
     FROM owner WHERE PhoneNumber = ? ";
    $mysqli_stmt = $mysqli->prepare($sql);


    $PhoneNumber = $_SESSION['PhoneNumber'];


    $mysqli_stmt->bind_param('s', $PhoneNumber);

    if ($mysqli_stmt->execute()) {

        $PhoneNumber = null;
        $Address = null;
        $Name = null;
        $Email = null;


        $mysqli_stmt->bind_result($PhoneNumber,$Address, $Name, $Email);

        if ($mysqli_stmt->fetch()) {
            $mysqli_stmt->free_result();
            $mysqli_stmt->close();

            $PhoneNumber = $_SESSION['PhoneNumber'];

            $sql = "UPDATE owner set PhoneNumber = ?, Address = ?, Name = ?, Email = ? 
            WHERE PhoneNumber = ?";
            
        
            $PHC = $_POST['PHC'];
            $ADC = $_POST['ADC'];
            $NAMEC = $_POST['NAMEC'];
            $EMAILC = $_POST['EMAILC'];

            if($PHC == 0){
                $PH = $PhoneNumber;
            }
            else{
                $PH = $_POST['PH'];
                $_SESSION['PhoneNumber'] = $PH;
            }

            if($ADC == 0){
                $AD = $Address;
            }
            else{
                $AD = $_POST['AD'];
            }

            if($NAMEC == 0){
                $NAME = $Name;
            }
            else{
                $NAME = $_POST['NAME'];
            }

            if($EMAILC == 0){
                $EMAIL = $Email;
            }
            else{
                $EMAIL = $_POST['EMAIL'];
            }


            $mysqli_stmt = $mysqli->prepare($sql); 
    
            $mysqli_stmt->bind_param('sssss',$PH, $AD,$NAME,$EMAIL,$PhoneNumber);
            
            if ($mysqli_stmt->execute()) {
                echo "<script>alert('Successfully Change!');window.location.href='../../pets/html/account.html'</script>";
            } else {
                echo "<script>alert('FAIL Change!');window.location.href='../../pets/html/editaccount.html'</script>";
            }
           
        }
        else{
                echo "<script>alert('WRONG USER!');window.location.href='../../pets/html/editaccount.html'</script>";
        }
        
    }
    $mysqli_stmt->free_result();
    $mysqli_stmt->close();
}

$mysqli->close();
?>