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
$sql = "SELECT v.vetid, v.department, v.name, w.address, w.seniority FROM veterinarian v, worksin w 
WHERE v.vetid = w.vetid AND w.address='$hosaddr'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
echo "<table border='1'><tr><th class='border class'>vetid</th>
<th class='border class'>department</th>
<th class='border class'>name</th>
<th class='border class'>working hospital</th>
<th class='border class'>seniority</th>
</tr>";

while($row = mysqli_fetch_array($result)) { 
    echo '<tr>';
    echo "<td class='border class'>$row[0]</td>
    <td class='border class'>$row[1]</td>
    <td class='border class'>$row[2]</td>
    <td class='border class'>$row[3]</td>
    <td class='border class'>$row[4]</td>
    <td> <input type='submit' name='edi$row[0]' value='Edit'/></td>
    <td> <input type='submit' name='del$row[0]' value='Delete'/></td>";
    
    echo '</tr>';

    if (!empty($_POST["edi$row[0]"])){
        echo "<tr><td>$row[0]</td>
        <td><input type='text' name='edivd' value='$row[1]'/></td>
        <td>$row[2]</td>
        <td>$row[3]</td>
        <td><input type='text' name='edivs' value='$row[4]'/></td>
        <td> <input type='submit' name='subedi$row[0]' value='Confirm editing'/></td>
        </tr>";
    }
    if (!empty($_POST["subedi$row[0]"])){
        $edivd = $_POST['edivd'];
        $edivs = $_POST['edivs'];
        mysqli_query($conn,"update veterinarian set department='$edivd' where vetid='$row[0]'");
        mysqli_query($conn,"update worksin set seniority = '$edivs' where vetid='$row[0]'");
        header('location:#');
    }

    if (!empty($_POST["del$row[0]"])){
        echo "<tr>
        <td> <input type='submit' name='subdel$row[0]' value='Confirm deletion'/></td>
        </tr>";
    }
    if (!empty($_POST["subdel$row[0]"])){
        mysqli_query($conn,"delete from worksin where vetid='$row[0]' AND address ='$hosaddr'");
        mysqli_query($conn,"delete from veterinarian where vetid='$row[0]'");
        header('location:#');
    }
}
echo "</table>";


    //  aggregate, count veterinarians
$sql2 = "SELECT COUNT(v.vetid) FROM veterinarian v, worksin w 
WHERE v.vetid = w.vetid AND w.address='$hosaddr'";
$result2 = $conn->query($sql2);
echo "<table border='1'><tr>
<th class='border class'>number of veterianrians</th>
</tr>";
while($row2 = mysqli_fetch_array($result2)) { 
    echo '<tr>';
    echo "<td class='border class'>$row2[0]</td>";
    echo '</tr>';
}
echo "</table>";

echo "<tr><td> <input type='submit' name='add' value='Add'/></td></tr>";
if (!empty($_POST["add"])){
    echo "<tr>
    <td class='border class'>Veterinarian id</td>
    <td><input type='text' name='vi' ></td>
    <td class='border class'>Veterinarian department</td>
    <td><input type='text' name='vd' ></td>
    <td class='border class'>Veterinarian name</td>
    <td><input type='text' name='vn' ></td>
    <td> <input type='submit' name='addcfm' value='Confirm'/></td>
    </tr>";
    
}


if (!empty($_POST["addcfm"])){
    $vi = $_POST['vi'];
    $vd = $_POST['vd'];
    $vn = $_POST['vn'];
    
    if ($vi == "") {
        echo '<script>
        alert("Please enter a valid VetId.")
        </script>';
        }
    else{
        mysqli_query($conn,"insert veterinarian (vetid,department,name,password) values ('$vi', '$vd', '$vn', 88888888)");
        mysqli_query($conn,"insert worksin (address,vetid,seniority) values ('$hosaddr', '$vi', 0)");
        echo "<script> alert('Adding successfully, default password: 88888888');parent.location.href='viewvet.php'; </script>"; 
        }
        
}




}
else {
    echo "<script>alert('0 result')</script>";
}




CloseCon($conn);
?>
</form>

<form action="" method="post">
<a href="../../pets/html/hospital.html">BACK TO HOME</a>
</form>
</div>
</body>
