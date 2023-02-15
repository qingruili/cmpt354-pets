<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <title>Report</title>
    <link rel="stylesheet" href="../../pets/css/vet.css"type="text/css" />
</head>

<body>
    <div class='exam'>
        <div class="logo">
            <img src="../../pets/img/vet.jpg" alt="" srcset="">
        </div>


<form action="" method="post">
<?php
include 'connect.php';
$conn = OpenCon();
session_start();



$vetid = $_SESSION['vetid'];
echo "<table  border='1'><tr>
    <td class='border class'>Enter old password</td>
    <td><input type='text' name='opw' ></td>
    <td class='border class'>Enter new password</td>
    <td><input type='text' name='npw' ></td>
    <td> <input type='submit' name='change' value='Change'/></td>
    </tr>";
if (!empty($_POST["change"])){
$sql = "SELECT vetid, password FROM veterinarian WHERE vetid= '$vetid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = mysqli_fetch_array($result)) { 
        $passw = $row[1];
    }
    $opw = $_POST['opw'];
    $npw = $_POST['npw'];
    if($opw == $passw){
        mysqli_query($conn,"update veterinarian set password = '$npw' where password = '$opw'");
        echo "<script> alert('Successfully');parent.location.href='veteditpsswd.php'; </script>";
    
    }
    else{
        echo "<script> alert('Incorrect Password!');parent.location.href='veteditpsswd.php'; </script>";
    }
    

echo "</table>";
}
else {
echo "0 results";
}
}


CloseCon($conn);
?>
</form>


<form action="" method="post">
<a href="../../pets/html/vet.html">BACK TO HOME</a>
</form>
</div>
</body>