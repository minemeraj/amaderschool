<?php
include 'includes/functions.php';
?>
<?php
include 'includes/session.php';
?>
<?php
confirm_logged_in();
?>
<?php
include 'includes/connection.php';
?>

<?php
if (isset($_GET['id'])) {

	if (isset($_GET['user_id'])) {
		$user_id = $_GET['user_id'];
	} else {
		$user_id = $_SESSION['id'];
	}

	$course_id = $_GET['id'];

	$id_of_taken_course = get_id_of_taken_course_table_by_id($user_id, $course_id);

	$query = "DELETE FROM taken_course 
	WHERE user_id = '{$user_id}' AND course_id = '{$course_id}';";
	$rs = mysql_query($query);
	if ($rs) {
		
		$rs = get_user_email_by_id($user_id);
		$row = mysql_fetch_array($rs);
		redirect_to("profile.php?email=".urlencode($row['Email']));
	}
} else {
	redirect_to("index.php");
}
?>
<?php
include 'includes/closeconnection.php';
?>