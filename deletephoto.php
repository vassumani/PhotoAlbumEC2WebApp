<?php
include("header.php")
?>

<form action="deletephoto.php" method="post">
<h2>Delete Photo Record</h2>
</form>
<?php
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM photos"; // just an example
$title= $_POST['id'];
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "There are ", $result->num_rows, " results in the photo metadata database.";
    echo "<table border='1'>"; // start a table tag in the HTML
    while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
?>
        <tr><th>Picture</th><th>Title</th><th>Description</th><th>Date of Photo</th><th>Keywords</th><th>Delete?</th></tr><tr><td><img src="<?php echo $row['reference']; ?>" width='150' height='100'  /></td>
<?php
        echo "<td>" . $row['title'] . "</td><td>" . $row['description'] . "</td>";  //$row['index'] the index here is a field name
        echo "<td>" . $row['dateofphoto'] . "</td><td>" . $row['keywords'] . "</td>";  //$row['index'] the index here is a field name
        //echo "<td><input type='button' value='Delete' onclick=''location.href = 'www.yoursite.com';'></td>";
        $record = $row['id'];
        echo "<td><form action='processdelete.php' method='post'><input type='hidden' name='record' value='$record'><input type='submit' value='Delete' /></form></td>";

    }
    echo "</table>"; //Close the table in HTML
}
else {
    echo "0 results";
}

function delete()
{
    $sql = "DELETE FROM photos WHERE title='pug1'"; // just an example
    $result = $conn->query($sql);
    echo "<script type='text/javascript'>alert('Hello World');</script>";
}

mysql_close(); //Make sure to close out the database connection

?>