<?php 
include 'connect.php'; 
$conn = OpenCon();
session_start();
$rp = $_POST['rp'];
$rc = $_POST['rc'];
$rr = $_POST['rr'];
$rm = $_POST['rm'];
$rvid = $_SESSION['vid'];
$rid = $_SESSION['rid'];
date_default_timezone_set('America/Vancouver');
$rtime = date('Y-m-d H:i');
$rid = 'R'.$rid.'';
mysqli_query($conn,"insert providedreport (rid,vetid,time,contentoftreatment,reasonforcoming,comment) values ('$rid', '$rvid', '$rtime', '$rc','$rr','$rm')"); 
mysqli_query($conn,"insert ridpid (rid,pid) values ('$rid', '$rp')"); 
echo "<script> alert('Successfully');parent.location.href='makereport.php'; </script>"; 
    
?> 