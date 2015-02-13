<?php
include 'includes/functions.php';
 ?>
<?php
include 'includes/session.php';
?>
<?php confirm_logged_in(); ?>
<?php
if (!$_GET['id']) {
	redirect_to("index.php");
}
?>
<?php
include 'includes/connection.php';
?>

<?php
global $connection;
$query = "DELETE FROM course WHERE id = '{$_GET['id']}'";

$result = mysql_query($query, $connection);

if (mysql_affected_rows($connection) == 1) {

	$sub_query = "DELETE FROM taken_course WHERE course_id = '{$_GET['id']}'";

	$sub_result = mysql_query($sub_query, $connection);

	if (mysql_affected_rows($connection) == 1) {
	}
	redirect_to("list.php");

} else {
	redirect_to("list.php");
}
?>

<?php
include 'includes/closeconnection.php';
?>