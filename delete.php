<?php
include 'includes/functions.php';
 ?>
<?php
include 'includes/session.php';
?>
<?php confirm_logged_in(); ?>
<?php
if (!$_GET['email']) {
	redirect_to("index.php");
}
?>
<?php
include 'includes/connection.php';
?>

<?php
global $connection;
$query = "DELETE FROM user WHERE Email = '{$_GET['email']}'";

$result = mysql_query($query, $connection);

if (mysql_affected_rows($connection) == 1) {
	redirect_to("list.php");
} else {
	redirect_to("list.php");
}
?>

<?php
include 'includes/closeconnection.php';
?>