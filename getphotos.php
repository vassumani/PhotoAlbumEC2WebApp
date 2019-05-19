<?php
include("header.php")
?>

<form action="getphotos.php" method="post">
<h2>Lookup Photo Record</h2>
Title: <input type="text" name="title" id="title" value="">
Keywords: <input type="text" name="keywords" id="keywords" value="">
From Date: <input type="date" name="fromDate" id="fromDate" value="">
To Date: <input type="date" name="toDate" id="toDate" value="">
<input type="submit" value="Submit" id="btnSubmit" name="btnSubmit" />
</form>
<?php
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$array = array();
    $title = $_POST['title'];
    $keywords = $_POST['keywords'];
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];

    $sql = "SELECT * FROM photos WHERE title='$title' OR keywords LIKE '%$keywords%'"; // just an example

if (($_POST['title'] == null) && ($_POST['keywords'] == null))
{
    if (($fromDate == null) || ($toDate == null))
         {
            echo "Showing all results (no search critera provided)</br>";
             $sql = "SELECT * FROM photos"; // just an example
         }
    else
        {
            echo "Results with dates between ";
            echo $fromDate, " and ", $toDate, "</br>";
            $sql = "SELECT * FROM photos WHERE dateofphoto BETWEEN '" . $fromDate . "' AND  '" . $toDate . "'";
        }
}
else if (($fromDate == null) || ($toDate == null))
{
    if ($title == null)
    {
     echo "Showing results with keywords similar to ", $keywords, "</br>";
    }
    else if ($keywords == null) {
     echo "Showing results with photo title ", $title, "</br>";
    }
    else
    {
     echo "Showing results with photo title ", $title, " and keywords similar to ", $keywords, "</br>";
    }
    $sql = "SELECT * FROM photos WHERE (title='$title' OR keywords LIKE '%$keywords%')";
}

else {
    echo "Last else";
    $sql = "SELECT * FROM photos WHERE (title='$title' OR keywords LIKE '%$keywords%') AND (dateofphoto BETWEEN '" . $fromDate . "' AND  '" . $toDate . "')"; // just an example
}

$title= $_POST['id'];

$result = $conn->query($sql);

?>
<table border='1'>
<tr><th>Picture</th><th>Title</th><th>Description</th><th>Date of Photo</th><th>Keywords</th></tr>
<?php
if ($result->num_rows > 0) {
    echo "Matching results found: ", $result->num_rows;
    while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
?>
        <tr><td><img src="<?php echo $row['reference']; ?>" width='150' height='100'  /></td>
<?php
        echo "<td>" . $row['title'] . "</td><td>" . $row['description'] . "</td>";  //$row['index'] the index here is a field name
        echo "<td>" . $row['dateofphoto'] . "</td><td>" . $row['keywords'] . "</td></tr>";  //$row['index'] the index here is a field name
    }
    echo "</table>"; //Close the table in HTML
}
else {
    echo "0 results";
}

mysql_close(); //Make sure to close out the database connection

?>