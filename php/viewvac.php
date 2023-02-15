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

if ($_SESSION['lastpage2'] ==''){
    $_SESSION['lastpage2']=$_SERVER['PHP_SELF'];
    header('location:Req-pid.php');
}

$pid = $_SESSION['pid'];
$sql = "SELECT bg.vacid, bg.pid, bg.NumberOfTimes, vac.vacid, vac.name
 FROM bgets bg, vaccine vac
 WHERE bg.pid='$pid'AND bg.vacid=vac.vacid" ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
echo "<table border='1'><tr><th class='border class'>PID</th>
<th class='border class'>VacID</th>
<th class='border class'>Number of Times</th>
<th class='border class'>Vaccine name</th>
</tr>";

while($row = mysqli_fetch_array($result)) { 
    echo '<tr>';
    echo "<td class='border class'>$row[1]</td>
    <td class='border class'>$row[3]</td>
    <td class='border class'>$row[2]</td>
    <td class='border class'>$row[4]</td>
    <td> <input type='submit' name='upd$row[0]' value='Add'/></td>";
    echo '</tr>';

    if (!empty($_POST["upd$row[0]"])){
        $vacnum = $row[2];
        $vacnum += 1;
        mysqli_query($conn,"update bgets set numberoftimes='$vacnum' where pid='$pid' AND vacid='$row[3]'");
        header('location:#');
    }


}
echo '<tr>';
        echo "<td class='border class'>VacID</td>
        <td> <input type='text' name='vacid'></td>
        <td> <input type='submit' name='add' value='Add new'/></td>
        ";
        echo '</tr>';
        if (!empty($_POST["add"])){
            $vacid = $_POST['vacid'];
            $vacnum = 1;
            mysqli_query($conn,"insert bgets (vacid, pid, numberoftimes) values ('$vacid','$pid','$vacnum')");  
            header('location:#');
        }
echo "</table>";


} 
else {$sql = "SELECT mg.vacid, mg.pid, mg.NumberOfTimes, vac.vacid, vac.name
    FROM mgets mg, vaccine vac
    WHERE mg.pid='$pid' AND mg.vacid=vac.vacid " ;
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th class='border class'>PID</th>
    <th class='border class'>VacID</th>
    <th class='border class'>Number of Times</th>
    <th class='border class'>Vaccine name</th>
    </tr>";
    
    while($row = mysqli_fetch_array($result)) { 
        echo '<tr>';
        echo "<td class='border class'>$row[1]</td>
        <td class='border class'>$row[3]</td>
        <td class='border class'>$row[2]</td>
        <td class='border class'>$row[4]</td>
        <td> <input type='submit' name='upd$row[0]' value='Add'/></td>";
        echo '</tr>';

        if (!empty($_POST["upd$row[0]"])){
            $vacnum = $row[2] +1;
            mysqli_query($conn,"update mgets set numberoftimes='$vacnum' where pid='$pid' AND vacid='$row[3]'");
            header('location:#');
        }
    
    
    }

    echo '<tr>';
        echo "<td class='border class'>VacID</td>
        <td> <input type='text' name='vacid'></td>
        <td> <input type='submit' name='add' value='Add new'/></td>
        ";
        echo '</tr>';
        if (!empty($_POST["add"])){
            $vacid = $_POST['vacid'];
            $vacnum = 1;
            mysqli_query($conn,"insert mgets (vacid, pid, numberoftimes) values ('$vacid','$pid','$vacnum')");  
            header('location:#');
        }
        
    echo "</table>";
    
    
    } 
    else{
        echo "0 results.";
        echo "<br>
        <b>VacID</b>
        <input type='text' name='vacid'>
        <input type='submit' name='add' value='Add new'/>";
        $sql = "SELECT pid
        FROM mammalia
        WHERE pid='$pid'" ;
        $result = $conn->query($sql);
        if ($result->num_rows == 0) {
            $sql = "SELECT pid
            FROM birds
            WHERE pid='$pid'" ;
            $result = $conn->query($sql);
            if($result->num_rows == 0) echo "<script>alert('Wrong PID')</script>";
            if (!empty($_POST["add"])){
                $vacid = $_POST['vacid'];
                $vacnum = 1;
                mysqli_query($conn,"insert bgets (vacid, pid, numberoftimes) values ('$vacid','$pid','$vacnum')");  
                header('location:#');
            }
        }
        if (!empty($_POST["add"])){
            $vacid = $_POST['vacid'];
            $vacnum = 1;
            mysqli_query($conn,"insert mgets (vacid, pid, numberoftimes) values ('$vacid','$pid','$vacnum')");  
            header('location:#');
        }
        
    }
}

CloseCon($conn);

?>
</form>

<form action="" method="post">
<a href="../../pets/php/inilastpage23.php">BACK TO HOME</a>

</form>
</div>
</body>