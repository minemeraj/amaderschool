<?php
include 'includes/functions.php';
 ?>
<?php
include 'includes/session.php';
?>
<?php confirm_logged_in(); ?>
<?php
if (isset($_GET['msg'])) {
	$msg = $_GET['msg'];
}
?>
<?php
include 'includes/connection.php';
?>

<?php
if (isset($_POST["submit"])) {

	$name = mysql_prep($_POST["name"]);
	$email = mysql_prep($_POST["email"]);

	$password = mysql_prep($_POST["password"]);
	$gender = $_POST["gender"];
	$contact = mysql_prep($_POST["contact"]);
	$date_of_birth = mysql_prep($_POST["date_of_birth"]);
	$address = mysql_prep($_POST["address"]);
	$role = $_POST["role"];

	$user_id = genarate_user_id($role);

	$id = get_id_by_email($_GET['email']);
	$query = "UPDATE user 
		SET Name = '{$name}', User_Id = '{$user_id}', Email = '{$email}', Password = '{$password}', 
		Gender = '{$gender}', ContactNo = '{$contact}', DateOfBirth = '{$date_of_birth}', 
		Address = '{$address}', Role = '{$role}' 
		WHERE ID = '{$id}';";

	global $connection;

	$rs = mysql_query($query, $connection);

	confirm_query($rs);

	if (isset($rs)) {
		redirect_to("profile.php?email=" . urlencode($email));
	}

}
?>

<?php
require_once 'includes/header.php';
?>

<?php
if (isset($_GET['email'])) {
	$result = get_user_by_email($_GET['email']);
	$row = mysql_fetch_array($result);
}
?>

<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<div class="login-panel panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Update Info</h3>
			</div>
			<div class="panel-body">
				<form action="edit.php?email=<?php echo urlencode($row["Email"]); ?>" method="post" role="form" autocomplete="on" accept-charset="utf-8">
					<fieldset>
						<div class="form-group">
							<input class="form-control" placeholder="Name" value="<?php echo $row["Name"]; ?>" name="name" type="text" autofocus required>
						</div>
						<div class="form-group">
							<input class="form-control" placeholder="E-mail" value="<?php echo $row["Email"]; ?>" name="email" type="email" required>
						</div>
						<div class="form-group">
							<input class="form-control" placeholder="Password" value="<?php echo $row["Password"]; ?>" name="password" type="password" pattern=".{6,20}" title="Password Shuld Be atleast Six Characters Long" required>
						</div>
						<div class="form-group">
							<select name="gender" required class="form-control">
								<option <?php
								if ($row["Gender"] == 'M') {
									echo ' selected ';
								};
								?> value="M">Male</option>
								<option <?php
								if ($row["Gender"] == 'F') {
									echo ' selected ';
								};
								?> value="F">Female</option>
							</select>
						</div>
						<div class="form-group">
							<input class="form-control" placeholder="Contact No." value="<?php
							if (isset($row["ContactNo"])) {
								echo $row["ContactNo"];
							};
							?>" name="contact" type="tel">
						</div>
						<div class="form-group">
							<input class="form-control" id="datepicker2"  placeholder="Date of Birth" value="<?php echo $row["DateOfBirth"]; ?>" name="date_of_birth" type="text" required>
						</div>
						<div class="form-group">
							<input class="form-control" placeholder="Address" value="<?php
							if (isset($row["Address"])) {
								echo $row["Address"];
							};
							?>" name="address" type="text">
						</div>
						<div class="form-group">
							<select name="role" required class="form-control">
								<option value="teacher" <?php
								if ($row["Role"] == 'teacher') {
									echo ' selected ';
								};
								?> >Teacher</option>
								<option value="student" <?php
								if ($row["Role"] == 'student') {
									echo ' selected ';
								};
								?> >Student</option>
							</select>
						</div>

						<input class="btn btn-lg btn-success btn-block" type="submit" name="submit" value="Update" id="submit"/>
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
