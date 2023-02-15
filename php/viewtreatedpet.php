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

$sql = "SELECT v.vetid, r.rid, rp.pid, p.color, p.name, p.birth, p.type, p.weight, p.sex, p.pid, p.phonenumber, pm.pid, pm.Sterilization, pbir.birth, pbir.age
 FROM veterinarian v, providedreport r, ridpid rp, haspet p, mammalia pm, petbirth pbir
 WHERE v.vetid = r.vetid AND r.rid=rp.rid AND rp.pid=p.pid AND p.pid=pm.pid AND pbir.birth=p.birth AND v.vetid='$vetid'" ;
$result = $conn->query($sql);

echo "<table border='1'><tr><th class='border class'>color</th>
<th class='border class'>name</th>
<th class='border class'>birth</th>
<th class='border class'>type</th>
<th class='border class'>weight</th>
<th class='border class'>sex</th>
<th class='border class'>pid</th>
<th class='border class'>phonenumber</th>
<th class='border class'>Sterilization</th>
<th class='border class'>Number Of ReplaceFeathers</th>
<th class='border class'>Number Of Molts</th>
<th class='border class'>age</th>
</tr>";

$uniq = array();
$pm=$pb=$pr=TRUE;
if ($result->num_rows > 0) {
    
    //check if there are different rids with same pids
    while($row = mysqli_fetch_array($result)) { 
        $uniq[count($uniq)] = $row[2];
        if (count($uniq)!=count(array_unique($uniq))){
            array_pop($uniq);
            continue;
        }
    echo '<tr>';
    echo "<td class='border class'>$row[3]</td>
    <td class='border class'>$row[4]</td>
    <td class='border class'>$row[5]</td>
    <td class='border class'>$row[6]</td>
    <td class='border class'>$row[7]</td>
    <td class='border class'>$row[8]</td>
    <td class='border class'>$row[9]</td>
    <td class='border class'>$row[10]</td>
    <td class='border class'>$row[12]</td>
    <td class='border class'>N/A</td>
    <td class='border class'>N/A</td>
    <td class='border class'>$row[14]</td>";
    echo '</tr>';
    
}
}
else $pm=FALSE;

 $sql = "SELECT v.vetid, r.rid, rp.pid, p.color, p.name, p.birth, p.type, p.weight, p.sex, p.pid, p.phonenumber, pb.pid, pb.NumberOfReplaceFeathers, pbir.birth, pbir.age
 FROM veterinarian v, providedreport r, ridpid rp, haspet p, birds pb, petbirth pbir
 WHERE v.vetid = r.vetid AND r.rid=rp.rid AND rp.pid=p.pid AND p.pid=pb.pid AND pbir.birth=p.birth AND v.vetid='$vetid'" ;
 $result = $conn->query($sql);


 if ($result->num_rows > 0) {

    while($row = mysqli_fetch_array($result)) { 
        $uniq[count($uniq)] = $row[2];
        if (count($uniq)!=count(array_unique($uniq))){
            array_pop($uniq);
            continue;
        }
    echo '<tr>';
    echo "<td class='border class'>$row[3]</td>
    <td class='border class'>$row[4]</td>
    <td class='border class'>$row[5]</td>
    <td class='border class'>$row[6]</td>
    <td class='border class'>$row[7]</td>
    <td class='border class'>$row[8]</td>
    <td class='border class'>$row[9]</td>
    <td class='border class'>$row[10]</td>
    <td class='border class'>N/A</td>
    <td class='border class'>$row[12]</td>
    <td class='border class'>N/A</td>
    <td class='border class'>$row[14]</td>";
    
    echo '</tr>';

    
}
}
else $pb=FALSE;

 $sql = "SELECT v.vetid, r.rid, rp.pid, p.color, p.name, p.birth, p.type, p.weight, p.sex, p.pid, p.phonenumber, pr.pid, pr.NumberOfMolts, pbir.birth, pbir.age
 FROM veterinarian v, providedreport r, ridpid rp, haspet p, reptiles pr, petbirth pbir
 WHERE v.vetid = r.vetid AND r.rid=rp.rid AND rp.pid=p.pid AND p.pid=pr.pid AND pbir.birth=p.birth AND v.vetid='$vetid'" ;
 $result = $conn->query($sql);

 if ($result->num_rows > 0) {

    while($row = mysqli_fetch_array($result)) { 
        $uniq[count($uniq)] = $row[2];
        if (count($uniq)!=count(array_unique($uniq))){
            array_pop($uniq);
            continue;
        }
    echo '<tr>';
    echo "<td class='border class'>$row[3]</td>
    <td class='border class'>$row[4]</td>
    <td class='border class'>$row[5]</td>
    <td class='border class'>$row[6]</td>
    <td class='border class'>$row[7]</td>
    <td class='border class'>$row[8]</td>
    <td class='border class'>$row[9]</td>
    <td class='border class'>$row[10]</td>
    <td class='border class'>N/A</td>
    <td class='border class'>N/A</td>
    <td class='border class'>$row[12]</td>
    <td class='border class'>$row[14]</td>";
    
    echo '</tr>';

    
    }
 }
 else $pr=FALSE;

 if($pm==FALSE && $pb==FALSE && $pr==FALSE){
    echo "0 results";

 }


echo "</table>";

CloseCon($conn);

?>

</form>

<form action="" method="post">
<a href="../../pets/html/vet.html">BACK TO HOME</a>
</form>
</div>
</body>