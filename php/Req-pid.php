<form action="" method="post">
<?php
include 'connect.php';
$conn = OpenCon();
session_start();

$sql = "SELECT pid FROM haspet";
$result = $conn->query($sql);
echo "Please enter the PID";
echo "<table><tr>
<td> <input type='text' name='pid'/></td>
<td> <input type='submit' name='subadd' value='Confirm'/></td>
</tr>";
if (!empty($_POST['subadd'])){
$_SESSION['pid'] = $_POST['pid'];
$lastpage = $_SESSION['lastpage2'];
header("location:$lastpage");
}
echo "</table>"
?>


</form>
