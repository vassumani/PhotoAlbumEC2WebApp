<?php
include("header.php")
?>
<h1>SUCCESS!</h1>
<div style="visibility: hidden;">Photo URL: <input type="file" name="image" value="<?php echo $_GET["photo"];?>"></div>
<?php
header( "refresh:2;url=addphoto.php" );
//UPLOAD CODE BEGINS HERE
	if(isset($_FILES['image'])){
		$file_name = $_FILES['image']['name'];   
		$temp_file_location = $_FILES['image']['tmp_name']; 

		require 'aws/aws-autoloader.php';

		$s3 = new Aws\S3\S3Client([
			'region'  => 'ap-southeast-2',
			'version' => 'latest',
			'credentials' => [
				'key'    => "AKIA2AOVMAYQ6HT5ZMVR",
				'secret' => "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",
			]
		]);		

		$result = $s3->putObject([
			'Bucket' => 'photoalbum101092985',
			'Key'    => $file_name,
			'SourceFile' => $temp_file_location,
            'ContentType' => 'image/jpeg',
            'ContentDisposition' => 'inline; filename=filename.jpg', //<-- and this !
		]);

        //echo $result;
		//echo $result['ObjectURL'];
        //$presignedUrl = (string)$request->getUri();
        //$url = $s3->getObjectUrl('photoalbum101092985', 'lab-application.yaml');
        //echo $presignedUrl;
        //echo $url;
        
        //Creating a presigned URL
        $cmd = $s3->getCommand('GetObject', ['Bucket' => 'photoalbum101092985', 'Key' => $_FILES['image']['name']]);
        
        $request = $s3->createPresignedRequest($cmd, '+7 days');
        
        // Get the actual presigned-url
        $presignedUrl = (string)$request->getUri();
        
        //echo $presignedUrl;
        
	}

$title = $_POST["title"];
$description = $_POST["description"];
$dateofphoto = date('Y-m-d');
$keywords = $_POST["keywords"];
$reference = $presignedUrl;

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO photos (id, title, description, dateofphoto, keywords, reference) VALUES (NULL, '$title', '$description', '$dateofphoto', '$keywords', '$reference')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>