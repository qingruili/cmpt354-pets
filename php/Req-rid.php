<form action="" method="post">
<?php
include 'connect.php';
$conn = OpenCon();
session_start();

$sql = "SELECT rid FROM ridpid";
$result = $conn->query($sql);
echo "Please enter the RID";
echo "<table><tr>
<td> <input type='text' name='rid'/></td>
<td> <input type='submit' name='subadd' value='Confirm'/></td>
</tr>";
if (!empty($_POST['subadd'])){
$_SESSION['rid'] = $_POST['rid'];
$lastpage = $_SESSION['lastpage3'];
header("location:$lastpage");
}
echo "</table>"
?>


</form>