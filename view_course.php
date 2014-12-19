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
	if (!$_GET['id']) {
		redirect_to("course.php");
	}
?>
<?php
	$result = get_course_by_id($_GET['id']);
	$row = mysql_fetch_array($result);
?>

<div class="row transperent-background">
	<div class="col-md-4">
		<br />
		<i class="fa fa-book fa-5x"></i>
	</div>
	<div class="col-md-8">
		<br />
		<div class="panel panel-success">
			<div class="panel-heading">
				Course, <?php echo $row["Name"]; ?>!
			</div>
			<div class="panel-body">

				<table class="table table-user-information">
					<tbody>
						<tr>
							<td>Name:</td>
							<td><?php echo $row["Name"]; ?></td>
						</tr>
						<tr>
							<td>Course Code:</td>
							<td><?php echo $row["Code"]; ?></td>
						</tr>
						<tr>
							<td>End Date:</td>
							<td><?php echo $row["StartDate"]; ?></td>
						</tr>
						<tr>
						<tr>
							<td>End Date:</td>
							<td><?php echo $row["EndDate"]; ?></td>
						</tr>
						<tr>
							<td>Details:</td>
							<td><?php echo $row["Details"]; ?></td>
						</tr>
					</tbody>
				</table>

			</div>
			<div class="panel-footer">
				&copy; Amader School
			</div>
		</div>
	</div>
</div>


<?php
include 'includes/footer.php';
?>
<?php
include 'includes/closeconnection.php';
?>