<form action="" method="post">
<?php
include 'connect.php';
$conn = OpenCon();
session_start();

$sql = "SELECT vetid FROM veterinarian";
$result = $conn->query($sql);
echo "Please enter your VetID";
echo "<table><tr>
<td> <input type='text' name='vetid'/></td>
<td> <input type='submit' name='subadd' value='Confirm'/></td>
</tr>";
if (!empty($_POST['subadd'])){
$_SESSION['vetid'] = $_POST['vetid'];
$lastpage = $_SESSION['lastpage'];
header("location:$lastpage");
}
echo "</table>"
?>


</form>
