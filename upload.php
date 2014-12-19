<?php
include 'includes/session.php';
?>
<?php
if (!logged_in()) {
	redirect_to("index.php");
}
?>
<?php
include 'includes/functions.php';
?>
<?php
include 'includes/connection.php';
?>
<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["picture"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
	$check = getimagesize($_FILES["picture"]["tmp_name"]);
	if ($check !== false) {
		$uploadOk = 1;
	} else {
		if (!isset($msg)) {
			$msg = array();
		}
		$msg[] = "File is not an image.";
		$uploadOk = 0;
	}
}
// Check if file already exists
$counter = 0;
while (file_exists($target_file)) {
	$counter++;
	$exploded_str = explode('.', $target_file);
	$exploded_str[0] .= $counter;
	$target_file = implode('.', $exploded_str);
}
// Check file size
if ($_FILES["picture"]["size"] > 500000) {
	if (!isset($msg)) {
		$msg = array();
	}
	$msg[] = "Sorry, your file is too large.";
	$uploadOk = 0;
}
// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
	$msg[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	$uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	$msg[] = "Sorry, your file was not uploaded.";
	goto error;
	// if everything is ok, try to upload file
} else {
	if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {

		$picture = $target_dir . basename($_FILES["picture"]["name"]);
		update_image_by_id($_GET['email'], $picture);
		redirect_to("profile.php?email=" . urlencode($_GET['email']));
	} else {

		error:
		$msg[] = "Sorry, there was an error uploading your file.";

		foreach ($msg as $key => $value) {
			$error .= $value;
		}
		redirect_to('profile.php?email=' . $_GET['email'] . '&error=' . $error);
	}
}
?>
<?php
include 'includes/closeconnection.php';
?>