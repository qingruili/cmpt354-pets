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
$sql = "SELECT name, address, phone,  email, fax FROM hospital WHERE address='$hosaddr'";//需要指定医院address
$result = $conn->query($sql);
if ($result->num_rows > 0) {
echo "<table border='1'><tr><th class='border class'>name</th>
<th class='border class'>address</th>
<th class='border class'>phone</th>
<th class='border class'>email</th>
<th class='border class'>fax</th>
</tr>";

while($row = mysqli_fetch_array($result)) { 
    echo '<tr>';
    echo "<td class='border class'>$row[0]</td>
    <td class='border class'>$row[1]</td>
    <td class='border class'>$row[2]</td>
    <td class='border class'>$row[3]</td>
    <td class='border class'>$row[4]</td>
    <td> <input type='submit' name='edi$row[2]' value='Edit'/></td>";
    
    echo '</tr>';


    if (!empty($_POST["edi$row[2]"])){
        echo "<tr><td><input type='text' name='edihn' value='$row[0]'/></td>
        <td>$row[1]</td>
        <td><input type='text' name='edihp' value='$row[2]'/></td>
        <td><input type='text' name='edihe' value='$row[3]'/></td>
        <td><input type='text' name='edihf' value='$row[4]'/></td>
        <td> <input type='submit' name='subedi$row[2]' value='Confirm editing'/></td>
        </tr>";
    }
    if (!empty($_POST["subedi$row[2]"])){
        $edihp = $_POST['edihp'];
        $edihn = $_POST['edihn'];
        $edihe = $_POST['edihe'];
        $edihf = $_POST['edihf'];
        mysqli_query($conn,"update hospital set name = '$edihn', phone='$edihp', email= '$edihe', fax='$edihf' where address='$row[1]'");
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