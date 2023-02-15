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
           $sql = "SELECT PhoneNumber, Color, Name, Birth, Type, Weight, Sex
                FROM haspet WHERE PhoneNumber = ? AND PID = ?" ;
            $mysqli_stmt = $mysqli->prepare($sql);


            $PhoneNumber = $_SESSION['PhoneNumber'];
            $PID = $_POST['Pid'];


             $mysqli_stmt->bind_param('ss', $PhoneNumber,$PID);

            if ($mysqli_stmt->execute()) {

                $PhoneNumber = null;
                $Color = null;
                $Name = null;
                $Birth = null;
                $Type = null;
                $Weight = null;
                $Sex = null;
                
                $mysqli_stmt->bind_result($PhoneNumber,$Color,$Name,$Birth,$Type,$Weight,$Sex);

                if ($mysqli_stmt->fetch()) {
                    $mysqli_stmt->free_result();
                    $mysqli_stmt->close();

                    $PID = $_POST['Pid'];

                    $sql = "UPDATE haspet 
                            SET Color= ?, Name = ?, Birth = ?, Type = ?,  Weight = ?, Sex = ? 
                            WHERE PID = ?";
                    
                
                    $COLORC = $_POST['COLORC'];
                    $NAMEC = $_POST['NAMEC'];
                    $BIRTHC = $_POST['BIRTHC'];
                    $TYPEC = $_POST['TYPEC'];
                    $WEIGHTC = $_POST['WEIGHTC'];
                    $SEXC = $_POST['SEXC'];



                    if($COLORC == 0){
                        $COLOR = $Color;
                    }
                    else{
                        $COLOR = $_POST['COLOR'];
                    }

                    if($NAMEC == 0){
                        $NAME = $Name;
                    }
                    else{
                        $NAME = $_POST['NAME'];
                    }

                    if($BIRTHC == 0){
                        $BIRTH = $Birth;
                    }
                    else{
                        $BIRTH = $_POST['BIRTH'];
                    }

                    if($TYPEC == 0){
                        $TYPE = $Type;
                    }
                    else{
                        $TYPE = $_POST['TYPE'];
                    }

                    if($WEIGHTC == 0){
                        $WEIGHT = $Weight;
                    }
                    else{
                        $WEIGHT = $_POST['WEIGHT'];
                    }

                    if($SEXC == 0){
                        $SEX = $Sex;
                    }
                    else{
                        $SEX = $_POST['SEX'];
                    }




                    $mysqli_stmt = $mysqli->prepare($sql); 
                    
                    $mysqli_stmt->bind_param('sssssss',$COLOR, $NAME,$BIRTH,$TYPE,$WEIGHT,$SEX,$PID);
                            
                    if ($mysqli_stmt->execute()) {
                        echo "<script>alert('Successfully Change!');window.location.href='../../pets/html/pets.html'</script>";
                    } 
                    else {
                        echo "<script>alert('FAIL Change!');window.location.href='../../pets/html/editpet.html'</script>";
                    } 
                }
           
            }
            else{
                echo "<script>alert('User and PID not match!');window.location.href='../../pets/html/editpet.html'</script>";
            }

        

    $mysqli_stmt->free_result();
    $mysqli_stmt->close();
}

$mysqli->close();
?>