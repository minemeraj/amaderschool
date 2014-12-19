<?php
include 'includes/functions.php';
?>
<?php
include 'includes/session.php';
?>
<?php confirm_logged_in(); ?>
<?php
include 'includes/connection.php';
?>
<?php
require_once 'includes/header.php';
?>

<?php

if (isset($_GET['show'])) {
	$category = $_GET['show'];
} else {
	$category = 'all';

}

switch ($category) {
	case 'all' :
		$result = get_all_active_users();
		break;
	case 'teacher' :
		$result = get_all_active_teachers();
		break;
	case 'student' :
		$result = get_all_active_students();
		break;
	case 'pending' :
		$result = get_all_pending_users();
		break;
	default :
		$result = get_all_users();
		break;
}
 ?>

<div class="row transperent-background">

	<div class="col-lg-12">
		<h2 class="page-header">Our Students And Teachers</h2>
	</div>
</div>

<div class="row-fluid">

<?php
	category_button('All Active Users', 'list.php?show=all', mysql_num_rows(get_all_active_users()));
?>

<?php
	category_button('Teachers', 'list.php?show=teacher', mysql_num_rows(get_all_active_teachers()));
?>

<?php
	category_button('Students', 'list.php?show=student', mysql_num_rows(get_all_active_students()));
?>
<?php
	category_button('Pending', 'list.php?show=pending', mysql_num_rows(get_all_pending_users()));
?>

</div>
<?php

$counter = 0;
while ($row = mysql_fetch_array($result)) {
	if ($counter == 3) {
		$counter = 0;
	}

	if ($counter == 0) {
		echo '<div class="row transperent-background">';
	}
	echo "<div class=\"col-md-4\">";
	echo "<img class=\"center-block img-responsive\" src=\"{$row["Picture"]}\" height=\"\" width=\"\" />";
	echo "<h3>{$row["Name"]} <small class = \"text-danger\">{$row["Role"]}</small></h3>";
	echo "<p>Email:<a href=\"{$row["Email"]}\"> {$row["Email"]}</a></p>";
	echo '<p><h3>';

	if ($row["isActive"]) {
		echo '<span class = "label label-success">Active</span>
			<div class="btn-group">
          		<a class="btn btn-primary" href="profile.php?email=';
		echo urlencode($row["Email"]);
		echo '"><i class="fa fa-user fa-fw"></i> Profile</a>
          		<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
            	<span class="fa fa-caret-down"></span></a>
          	<ul class="dropdown-menu">
           	<li><a href="edit.php?email=';
		echo urlencode($row["Email"]);
		echo '"><i class="fa fa-pencil fa-fw"></i> Edit</a></li>
            <li><a href="delete.php?email=';
		echo urlencode($row["Email"]);
		echo '"><i class="fa fa-trash-o fa-fw"></i> Delete</a></li>
          </ul>
        </div>';

	} else {
		echo '<span class = "label label-danger">Requested</span>
			<div class="btn-group">
          		<a class="btn btn-primary" href="';
		echo urlencode($row["Email"]);
		echo '"><i class="fa fa-user fa-fw"></i> Profile</a>
          		<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
            	<span class="fa fa-caret-down"></span></a>
          	<ul class="dropdown-menu">
           	<li><a href="accept.php?email=';
		echo urlencode($row["Email"]);
		echo '"><i class="fa fa-plus fa-fw"></i> Accept</a></li>
           	<li><a href="edit.php?email=';
		echo urlencode($row["Email"]);
		echo '"><i class="fa fa-pencil fa-fw"></i> Edit</a></li>
            <li><a href="delete.php?email=';
		echo urlencode($row["Email"]);
		echo '"><i class="fa fa-trash-o fa-fw"></i> Delete</a></li>
          </ul>
        </div>';
	}

	echo '</h3></p>';

	echo "</div>";
	if ($counter == 2) {
		echo '</div>';
	}
	$counter++;
}
?>
<div class="row-fluid">
	<div class="col-lg-12">
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
	</div>
</div>

<?php
include 'includes/footer.php';
?>
<?php
include 'includes/closeconnection.php';
?>