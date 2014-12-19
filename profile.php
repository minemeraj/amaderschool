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
require_once 'includes/header.php';
?>
<?php
if (isset($_GET['email'])) {

	$email = $_GET['email'];
} else {
	$email = $_SESSION['email'];
}

$result = get_user_by_email($email);
$row = mysql_fetch_array($result);

if (!$result) {
	redirect_to("index.php");
}
?>
<div class="row transperent-background">
	<div class="col-md-4">
		<br />
		<img src="<?php echo $row["Picture"]; ?>" class="img-thumbnail img-responsive">
		<br />
		<br />
		<?php
		if (isset($_GET['error'])) {
			display_errors($_GET['error']);
		}
		 ?>
		<form action="upload.php?email=<?php echo $row["Email"] ?>" method="post" enctype="multipart/form-data">
			<p>
				<input id="input-1a" name="picture" type="file" class="file" data-show-preview="true">
			</p>
		</form>
	</div>
	<div class="col-md-8">
		<br />

		<div class="panel panel-success">
			<div class="panel-heading">
				Welcome, <?php echo $row["Name"]; ?>!
			</div>
			<div class="panel-body">

				<table class="table table-user-information">
					<tbody>
						<tr>
							<td>Name:</td>
							<td><?php echo $row["Name"]; ?></td>
						</tr>
						<tr>
							<td>ID:</td>
							<td><?php echo $row["User_Id"]; ?></td>
						</tr>
						<tr>
							<td>Date of Birth</td>
							<td><?php echo $row["DateOfBirth"]; ?></td>
						</tr>
						<tr>
							<td>Email</td>
							<td><a href="<?php echo $row["Email"]; ?>"><?php echo $row["Email"]; ?></a></td>
						</tr>
						<tr>
						<tr>
							<td>Address:</td>
							<td><?php echo $row["Address"]; ?></td>
						</tr>
						<tr>
							<td>Role:</td>
							<td><?php echo $row["Role"]; ?></td>
						</tr>
						<tr>
							<td>Contact No:</td>
							<td><?php echo $row["ContactNo"]; ?></td>
						</tr>
					</tbody>
				</table>

			</div>
			<div class="panel-footer">
				&copy; Amader School
			</div>
		</div>
		<br />

			<?php

			if ($row['Role'] == 'student' || $row['Role'] == 'teacher') {
				echo '<div class="panel panel-success">';
				echo '<div class="panel-heading">Courses</div>';
				echo '<div class="panel-body">';
				echo '<table class="table table-user-information">
					<tbody><tr>
							<td>Course Code</td>
							<td>Course Name</td>
							<td>Status</td>
							<td>Take/Drop</td>
						</tr>';
				$courses = get_all_courses();
				while (($course_row = mysql_fetch_array($courses))) {
					echo '<tr>';

					echo '<td>';
					echo $course_row['Code'];
					echo '</td>';

					echo '<td>';
					echo $course_row['Name'];
					echo '</td>';

					if (chk_taken_course_by_id($row["ID"], $course_row['ID'])) {
						echo '<td>Taken</td>';
						echo '<td>';
						echo '<a class="btn btn-danger" href="drop_course.php?id=';
						echo $course_row['ID'];
						echo '&';
						echo "user_id=";
						echo $row["ID"];
						echo '">';
						echo '<i class="fa fa-times"> Drop</i>';
						echo '</a>';
						echo '</td>';
					} else {
						echo '<td>Available</td>';
						echo '<td>';
						echo '<a class="btn btn-success" href="add_course.php?id=';
						echo $course_row['ID'];
						echo '&';
						echo "user_id=";
						echo $row["ID"];
						echo '">';
						echo '<i class="fa fa-plus"> Add&nbsp;&nbsp;</i>';
						echo '</a>';
						echo '</td>';
					}

					echo '</tr>';
				}
				echo '</tbody>
				</table>
			</div>
			<div class="panel-footer">
				&copy; Amader School
			</div>';
				echo '</div>';
			}
			?>
		
	</div>
</div>
<?php
include 'includes/footer.php';
?>
<?php
include 'includes/closeconnection.php';
?>