<?php
include("header.php")
?>
<?php
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to create table
$sql = "DROP TABLE photos;";

if ($conn->query($sql) === TRUE) {
    echo "Table MyGuests deleted successfully";
} else {
    echo "Error deleting table: " . $conn->error;
}

$conn->close();
?>