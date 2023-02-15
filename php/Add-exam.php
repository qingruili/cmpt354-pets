<?php 
include 'connect.php'; 
$conn = OpenCon();
session_start();
$et = $_POST['et'];
$etd = $_POST['etd'];
$ear = $_POST['ear'];
$pid = $_POST['pid'];
$vid = $_SESSION['vid'];
date_default_timezone_set('America/Vancouver');

mysqli_query($conn,"insert doesexamination (timedate,vetid,type) values ('$etd', '$vid', '$et')"); 
mysqli_query($conn,"insert makes (pid,timedate,vetid,adversereaction) values ('$pid', '$etd','$vid', '$ear')");
echo "<script> alert('Successfully');parent.location.href='makeexam.php'; </script>";
   
?> 