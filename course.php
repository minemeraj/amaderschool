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
	$show = $_GET['show'];
	$category = $show;
} else {
	$show = 'all';
	$category = 'all';
}

switch ($category) {
	case 'all' :
		$result = get_all_courses();
		break;
	case 'taken' :
		$result = get_taken_courses_by_id($_SESSION['id']);
		break;
	default :
		$result = get_all_courses();
		break;
}
?>

<div class="row transperent-background">

	<div class="col-lg-12">
		<h2 class="page-header">Courses</h2>
	</div>
</div>

<div class="row-fluid">

	<?php
	if (($_SESSION['role'] == 'admin')) {
		create_new_button('Create Course', 'create_course.php');
	}
	?>

	<?php
	category_button('All Courses', 'course.php?show=all', mysql_num_rows(get_all_courses()));
	?>

	<?php
	if (!($_SESSION['role'] == 'admin')) {
		category_button('Taken Course', 'course.php?show=taken', mysql_num_rows(get_taken_courses_by_id($_SESSION['id'])));
	}
?>
</div>
<?php

$counter = 0;
while ($row = mysql_fetch_array($result)) {

	if (isset($row['ID'])) {
		$course_id = $row['ID'];
	}
	if (isset($row['id'])) {
		$course_id = $row['id'];
	}

	if ($counter == 3) {
		$counter = 0;
	}

	if ($counter == 0) {
		echo '<div class="row transperent-background">';
	}
	echo "<div class=\"col-md-4\">";
	echo '<i class="fa fa-book fa-5x"></i>';
	echo "<h3>{$row["Name"]} <small class = \"text-danger\">{$row["Code"]}</small></h3>";
	echo '<p></p>';
	echo '<p><h3>';
	echo '<div class="btn-group">
          		<a class="btn btn-primary" href="view_course.php?id=';
	echo $course_id;
	echo '"><i class="fa fa-hand-o-right fa-fw"></i> Details</a>
          		<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
            	<span class="fa fa-caret-down"></span></a>
          	<ul class="dropdown-menu">';

	if ($_SESSION['role'] == 'admin') {
		// echo '<li><a href="edit.php?email=';
		// echo urlencode($row["Email"]);
		// echo '"><i class="fa fa-pencil fa-fw"></i> Edit</a></li>
		echo '<li><a href="delete_course.php?id=';
		echo urlencode($row["ID"]);
		echo '"><i class="fa fa-trash-o fa-fw"></i> Delete</a></li>';
	}

	if (!($_SESSION['role'] == 'admin') && !($show == "taken") && !(chk_taken_course_by_id($_SESSION['id'], $row['ID']))) {
		echo '<li><a href="add_course.php?id=';
		echo $course_id;
		echo '"><i class="fa fa-plus fa-fw"></i> Add</a></li>';
	}

	if (!($_SESSION['role'] == 'admin') && ($show == "taken")) {
		echo '<li><a href="drop_course.php?id=';
		echo $course_id;
		echo '"><i class="fa fa-minus fa-fw"></i> Drop</a></li>';
	}

	echo '</ul>
        </div>';

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