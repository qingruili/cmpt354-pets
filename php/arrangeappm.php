<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <title>Report</title>
    <link rel="stylesheet" href="../../pets/css/hospital.css"type="text/css" />
</head>

<body>
    <div class='vet'>
        <div class="logo">
            <img src="../../pets/img/hospital.jpg" alt="" srcset="">
        </div>

<form action="" method="post">
<?php
include 'connect.php';
$conn = OpenCon();
session_start();

$hosaddr = $_SESSION['hosadd'];
$sql = "SELECT b.timedate, b.phonenumber, b.appmtype, a.address, a.roomnumber FROM bookedappointment b,arranges a 
WHERE b.timedate = a.timedate AND b.phonenumber = a.phonenumber AND a.address='$hosaddr'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
echo "<table border='1'><tr><th class='border class'>timedate</th>
<th class='border class'>phonenumber</th>
<th class='border class'>appmtype</th>
<th class='border class'>address</th>
<th class='border class'>roomnumber</th>
</tr>";

while($row = mysqli_fetch_array($result)) { 
    echo '<tr>';
    echo "<td class='border class'>$row[0]</td>
    <td class='border class'>$row[1]</td>
    <td class='border class'>$row[2]</td>
    <td class='border class'>$row[3]</td>
    <td class='border class'>$row[4]</td>
    <td> <input type='submit' name='arg$row[1]' value='Arrange'/></td>
    <td> <input type='submit' name='adj$row[1]' value='Adjust'/></td>
    <td> <input type='submit' name='can$row[1]' value='Cancel'/></td>
    ";
    
    echo '</tr>';

    if (!empty($_POST["arg$row[1]"])){
        echo "<tr><td>$row[0]</td>
        <td>$row[1]</td>
        <td>$row[2]</td>
        <td>$row[3]</td>
        <td><input type='text' name='arrg' value='$row[4]'/></td>
        <td> <input type='submit' name='subarrg$row[1]' value='Confirm arrange'/></td>
        </tr>";
    }
    if (!empty($_POST["subarrg$row[1]"])){
        $arrg = $_POST['arrg'];
        mysqli_query($conn,"update arranges set roomnumber='$arrg' where timedate='$row[0]' and phonenumber='$row[1]' and address='$row[3]'");
        header('location:#');
    }

    if (!empty($_POST["adj$row[1]"])){
        echo "<tr><td><input type='text' name='adj' value='$row[0]'/></td>
        <td>$row[1]</td>
        <td>$row[2]</td>
        <td>$row[3]</td>
        <td>$row[4]</td>
        <td>$row[5]</td>
        <td> <input type='submit' name='subadj$row[1]' value='Confirm adjustion'/></td>
        </tr>";
    }
    if (!empty($_POST["subadj$row[1]"])){
        $adj = $_POST['adj'];
        $oldtime = $row[0];
        mysqli_query($conn,"update arranges set timedate='$adj' where roomnumber='$row[5]' and phonenumber='$row[1]' and address='$row[3]'");
        mysqli_query($conn,"update bookedappointment set timedate='$adj' where timedate='$oldtime' and phonenumber='$row[1]'"); 
        header('location:#');
    }

    if (!empty($_POST["can$row[1]"])){
        echo "<tr>
        <td> <input type='submit' name='subcan$row[1]' value='Confirm cancel'/></td>
        </tr>";
    }
    if (!empty($_POST["subcan$row[1]"])){
        $can = $_POST['can'];
        mysqli_query($conn,"delete from arranges where timedate='$row[0]' and phonenumber='$row[1]' and address='$row[3]'");
        mysqli_query($conn,"delete from bookedappointment where timedate='$row[0]' and phonenumber='$row[1]'");  //可以指定医院address
        header('location:#');
    }


       
    
}
echo "</table>";
} 
else {
echo "0 results";
}

CloseCon($conn);
?>
</form>

<form action="" method="post">
<a href="../../pets/html/hospital.html">BACK TO HOME</a>
</form>

</div>
</body>
