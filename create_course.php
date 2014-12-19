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
if (isset($_POST['submit'])) {
	if ($_POST['submit']) {
		$name = mysql_prep($_POST['name']);
		$code = mysql_prep($_POST['code']);
		$startdate = mysql_prep($_POST['startdate']);
		$enddate = mysql_prep($_POST['enddate']);
		$details = mysql_prep($_POST['details']);
		if (course_code_isExists($code)) {
			$msg = "Course Code Already Exists";
			goto error;
		}
		$query = "INSERT INTO course 
					(Name, Code, StartDate, EndDate, Details) 
					VALUES ('{$name}','{$code}','{$startdate}','{$enddate}','{$details}');";
		global $connection;
		$rs = mysql_query($query, $connection);

		confirm_query($rs);

		$course_row = mysql_fetch_array(get_course_by_code($code));

		redirect_to("view_course.php?id=" . $course_row['ID']);
	}
}
?>

<?php
error:
require_once 'includes/header.php';
?>

<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<div class="login-panel panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Add A Course</h3>
			</div>
			<div class="panel-body">

				<?php
				if (isset($msg)) {
					display_error($msg);
				}
				?>

				<form action="create_course.php" method="post" role="form" autocomplete="on" accept-charset="utf-8">
					<fieldset>
						<div class="form-group">
							<input class="form-control" placeholder="Course Name" value="" name="name" type="text" autofocus required>
						</div>
						<div class="form-group">
							<input class="form-control" placeholder="Course Code" value="" name="code" type="text" required>
						</div>
						<div class="form-group">
							<input class="form-control" placeholder="Start Date" name="startdate" type="text" id="datepicker3" required>
						</div>

						<div class="form-group">
							<input class="form-control" id="datepicker4"  placeholder="End Date" name="enddate" type="text" required>
						</div>
						<div class="form-group">
							<textarea class="form-control" name="details" rows="5" placeholder="Course Details" id="details" required></textarea>
						</div>
						<input class="btn btn-lg btn-success btn-block"  type="submit" name="submit" value="Add" id="submit"/>
					</fieldset>
				</form>
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