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
    <div class='report'>
        <div class="logo">
            <img src="../../pets/img/vet.jpg" alt="" srcset="">
        </div>


<form action="" method="post">
<?php
include 'connect.php';
$conn = OpenCon();
session_start();

$vetid = $_SESSION['vetid'];
$sql = "SELECT v.vetid, v.department, v.name, p.rid, p.time, p.contentoftreatment, p.reasonforcoming, p.comment, rp.pid
 FROM veterinarian v, providedreport p, ridpid rp WHERE v.vetid = p.vetid AND p.rid=rp.rid AND v.vetid='$vetid'" ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
echo "<table border='1'><tr>
<th class='border class'>vetid</th>
<th class='border class'>department</th>
<th class='border class'>name</th>
<th class='border class'>rid</th>
<th class='border class'>time</th>
<th class='border class'>Content of treatment</th>
<th class='border class'>Reason for coming</th>
<th class='border class'>comment</th>
<th class='border class'>pid</th>
</tr>";

while($row = mysqli_fetch_array($result)) { 
    echo '<tr>';
    echo "<td class='border class'>$row[0]</td>
    <td class='border class'>$row[1]</td>
    <td class='border class'>$row[2]</td>
    <td class='border class'>$row[3]</td>
    <td class='border class'>$row[4]</td>
    <td class='border class'>$row[5]</td>
    <td class='border class'>$row[6]</td>
    <td class='border class'>$row[7]</td>
    <td class='border class'>$row[8]</td>
    <td> <input type='submit' name='edi$row[3]' value='Edit'/></td>
    <td> <input type='submit' name='del$row[3]' value='Delete'/></td>";
    $vid = $row[0];
    $pid = $row[8];
    
    echo '</tr>';

    if (!empty($_POST["edi$row[3]"])){
        echo "<tr><td>$row[0]</td>
        <td>$row[1]</td>
        <td>$row[2]</td>
        <td>$row[3]</td>
        <td>$row[4]</td>
        <td><input type='text' name='edict' value='$row[5]'/></td>
        <td><input type='text' name='edirc' value='$row[6]'/></td>
        <td><input type='text' name='edicm' value='$row[7]'/></td>
        <td class='border class'>$row[8]</td>
        <td> <input type='submit' name='subedi$row[3]' value='Confirm editing'/></td>
        </tr>";
    }
    if (!empty($_POST["subedi$row[3]"])){
        $edict = $_POST['edict'];
        $edirc = $_POST['edirc'];
        $edicm = $_POST['edicm'];
        mysqli_query($conn,"update providedreport set contentoftreatment='$edict', reasonforcoming='$edirc',comment='$edicm' where rid='$row[3]'");
        header('location:#');
    }

    if (!empty($_POST["del$row[3]"])){
        echo "<tr>
        <td> <input type='submit' name='subdel$row[3]' value='Confirm deletion'/></td>
        </tr>";
    }
    if (!empty($_POST["subdel$row[3]"])){
        mysqli_query($conn,"delete from providedreport where rid='$row[3]'");
        mysqli_query($conn,"delete from ridpid where rid='$row[3]'");
        header('location:#');
    }
}
echo "</table>";

$rid = rand(999999999,0);
$rid = strval($rid);
$_SESSION['vid'] = $vid;
$_SESSION['rid'] = $rid;
} 
else {
echo "0 results";
}

CloseCon($conn);

?>
</form>

<form action="Add-rpt.php" method="post"> 

</br>
</br>
<label>PID</label>
<input type="text" name="rp" value= >
<label>Content of treatment</label>
<input type="text" name="rc" value= >
<label>Reason for coming</label>
<input type="text" name="rr">
<label>Comment</label>
<input type="text" name="rm">
<br>
</br>
<input type="submit" value="Add">
</form>

<form action="" method="post">
<a href="../../pets/html/vet.html">BACK TO HOME</a>
</form>

</div>
</body>