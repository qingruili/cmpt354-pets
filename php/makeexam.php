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
$sql = "SELECT v.vetid, v.department, v.name, d.timedate, d.type, m.pid, m.adversereaction
 FROM veterinarian v, doesexamination d, makes m WHERE v.vetid = d.vetid AND m.timedate=d.timedate AND v.vetid='$vetid'" ;
 $result = $conn->query($sql);
if ($result->num_rows > 0) {
echo "<table border='1'><tr><th class='border class'>vetid</th>
<th class='border class'>department</th>
<th class='border class'>name</th>
<th class='border class'>Time and date</th>
<th class='border class'>Examination type</th>
<th class='border class'>pid</th>
<th class='border class'>Adverse reaction</th>
</tr>";

while($row = mysqli_fetch_array($result)) { 
    echo '<tr>';
    echo "<td class='border class'>$row[0]</td>
    <td class='border class'>$row[1]</td>
    <td class='border class'>$row[2]</td>
    <td class='border class'>$row[3]</td>
    <td class='border class'>$row[4]</td>
    <td class='border class'>$row[5]</td>
    <td class='border class'>$row[6]</td>";
    
    echo '</tr>';
}
echo "</table>";
} 
else {
echo "0 results";
}

CloseCon($conn);

?>

</form>

<form action="Add-exam.php" method="post"> 

</br>
</br>
<label>Examination Type</label>
<input type="text" name="et">
<label>Time and Date</label>
<input type="text" name="etd">
<label>Adverse Reaction</label>
<input type="text" name="ear">
<label>PID of the Patient</label>
<input type="text" name="pid">
<br>
</br>
<input type="submit" value="Add">
</form>


<form action="" method="post">
<a href="../../pets/html/vet.html">BACK TO HOME</a>
</form>
</div>
</body>