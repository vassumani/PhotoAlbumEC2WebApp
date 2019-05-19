<?php
include("header.php")
?>
<form action="processadd.php" method="POST" enctype="multipart/form-data">
    <h2>Add Photo Record</h2>
    <table>
        <th>Enter the details below:</th>
        <tr>
            <td>Title: </td>
            <td><input type="text" name="title" id="title" value="<?php echo $title;?>"></td>
        </tr>
        <tr>
            <td>Description: </td>
            <td><input type="text" name="description" id="description" value="<?php echo $description;?>"></td>
        </tr>
        <tr>
            <td>Keywords: </td>
            <td><input type="text" name="keywords" id="keywords" value="<?php echo $keywords;?>"></td>
        </tr>
        <tr>
            <td>Photo: </td>
            <td><input type="file" name="image" value="<?php echo $photo;?>"></td>
        </tr>
    </table>
    <input type="submit" value="Submit" id="btnSubmit" name="btnSubmit" />
</form>