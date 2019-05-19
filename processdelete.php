<?php
include("header.php")
?>
<form action="deletephoto.php" method="post">
<input type="text" name="title" id="smallgroup" value="pug">
<input type="text" name="description" id="smallgroup" value="cute dog">
<input type="submit" value="Submit" id="btnSubmit" name="btnSubmit" />
</form>
Welcome <?php echo $_POST["record"]; ?>!
<?php
header( "refresh:2;url=deletephoto.php" );

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$record = $_POST['record'];
$sql = "DELETE FROM photos WHERE id='$record'"; // just an example
$result = $conn->query($sql);
?>