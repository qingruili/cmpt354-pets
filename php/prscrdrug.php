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

if ($_SESSION['lastpage3'] ==''){
    $_SESSION['lastpage3']=$_SERVER['PHP_SELF'];
    header('location:Req-rid.php');
}

$rid = $_SESSION['rid'];
$vetid = $_SESSION['vetid'];
$sql = "SELECT r.rid, r.vetid, rp.rid, rp.pid
 FROM providedreport r, ridpid rp
 WHERE r.rid=rp.rid AND r.rid='$rid'" ; 
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    
 $row = mysqli_fetch_array($result);
    
 $pid = $row[3];
    
}







$sql = "SELECT d.did, pr.did, pr.frequency, pr.rid, pr.vetid, pr.pid
 FROM prescribe pr, nameeffect n, didname d
 WHERE pr.did=d.did" ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
echo "<table border='1'><tr><th class='border class'>DID</th>
<td> <input type='text' name='did'></td>
<th class='border class'>Frequency</th>
<td> <input type='text' name='freq'></td>
<td> <input type='submit' name='upd' value='Add'/></td>
</tr>";

if (!empty($_POST["upd"])){
    $did = $_POST["did"];
    $freq = $_POST["freq"];
    mysqli_query($conn,"insert prescribe (did, frequency, rid, vetid, pid) values ('$did','$freq','$rid','$vetid','$pid')"); 
    header('location:#');
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
<a href="../../pets/php/inilastpage23.php">BACK TO HOME</a>

</form>
</div>
</body>