<?php

include 'includes/db_connx.php';
include 'includes/errors.php';


//set up variables
// comments go here
$target_dir = "images/"; //target directory for images
// comments go here
$target_file = $target_dir . basename($_FILES["uploaded"]["name"]);
// comments go here
$uploadOk = 1;
// comments go here
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if(isset($_POST["submit"])) {
// comments go here - fully document this conditional statement
    $check = getimagesize($_FILES["uploaded"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } 
// comments go here - fully document this conditional statement
	else {
        echo "File is not an image.";
        $uploadOk = 0;
        exit();
    }
}
// comments go here - fully document this conditional statement
if (file_exists($target_file)) {
    echo "File already exists.";
    $uploadOk = 0;
    exit();
}
// comments go here - fully document this conditional statement
if ($_FILES["uploaded"]["size"] > 100000) {
    echo "The file exceeds 100Kb. Please upload a smaller filesize.";
    $uploadOk = 0;
    exit();
}
// comments go here - fully document this conditional statement
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
    exit();
}
// comments go here - fully document this conditional statement
if ($uploadOk == 0) {
    echo " <p>Your file was not uploaded.</p>";
    exit();
// comments go here - fully document this conditional statement
} else {
    if (move_uploaded_file($_FILES["uploaded"]["tmp_name"], $target_file)) {

        $imagePathName = "images/ ". basename( $_FILES["uploaded"]["name"]);
        echo $imagePathName; //you can use $imagePathName var to store path name in the database
       
          
    } 
// comments go here - fully document this conditional statement
	else {
        echo "There was an error uploading your file.";
        exit();
    }
}

$sql = "INSERT INTO users (username, pwd, profile_image)VALUES ('a new user','1234', '$imagePathName')";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
?>

