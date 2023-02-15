<form action="" method="post">
<?php
include 'connect.php';
$conn = OpenCon();
session_start();

$sql = "SELECT address FROM hospital";
$result = $conn->query($sql);
echo "Please enter your hospital address";
echo "<table><tr>
<td> <input type='text' name='hosaddress'/></td>
<td> <input type='submit' name='subadd' value='Confirm'/></td>
</tr>";
if (!empty($_POST['subadd'])){
$_SESSION['hosadd'] = $_POST['hosaddress'];
$lastpage = $_SESSION['lastpage'];
header("location:$lastpage");
}
echo "</table>"
?>


</form>

