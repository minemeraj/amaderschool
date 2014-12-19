<?php
include 'includes/functions.php';
?>
<?php
if (!$_POST) {
	redirect_to("index.php");
}
?>
<?php
include 'includes/connection.php';
?>
<?php
$name = mysql_prep($_POST["name"]);
$email = mysql_prep($_POST["email"]);

$password = mysql_prep($_POST["password"]);
$gender = $_POST["gender"];
$contact = mysql_prep($_POST["contact"]);
$date_of_birth = mysql_prep($_POST["date_of_birth"]);
$address = mysql_prep($_POST["address"]);
$role = $_POST["role"];

$user_id = genarate_user_id($role);

if (email_isExists($email)) {
	$msg = "Email Address Already Exists";
	goto error;
}

if (!isset($_POST["picture"])) {
	$picture = mysql_prep(get_profile_picture($gender, $role));
}

$query = "INSERT INTO user 
		(Name, User_Id, Email, Password, Gender, ContactNo, DateOfBirth, Address, Salary, tutionfee, Role, isActive, Picture) 
		VALUES ('{$name}', '{$user_id}', '{$email}', '{$password}', '{$gender}', '{$contact}', '{$date_of_birth}', '{$address}', NULL, NULL, '{$role}', '0', '{$picture}');";
global $connection;
$rs = mysql_query($query, $connection);

confirm_query($rs);
?>

<?php
error:
?>
<?php
require_once 'includes/header.php';
?>

<?php
if (isset($rs)) {
	goto yes;
}
?>

<div class="row">
<div class="col-md-4 col-md-offset-4">
<div class="login-panel panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Register Now</h3>
</div>
<div class="panel-body">

<?php
if (isset($msg)) {
display_error($msg);
}
?>

<form action="register.php" method="post" role="form" autocomplete="on" accept-charset="utf-8">
<fieldset>
<div class="form-group">
<input class="form-control" placeholder="Name" value="<?php echo $name; ?>" name="name" type="text" autofocus required>
</div>
<div class="form-group">
<input class="form-control" placeholder="E-mail" value="<?php echo $email; ?>" name="email" type="email" required>
</div>
<div class="form-group">
<input class="form-control" placeholder="Password" value="<?php echo $password; ?>" name="password" type="password" pattern=".{6,20}" title="Password Shuld Be atleast Six Characters Long" required>
</div>
<div class="form-group">
<select name="gender" required class="form-control">
<option <?php
if ($gender == 'M') {
	echo ' selected ';
};
?> value="M">Male</option>
<option <?php
if ($gender == 'F') {
	echo ' selected ';
};
?> value="F">Female</option>
</select>
</div>
<div class="form-group">
<input class="form-control" placeholder="Contact No." value="<?php
if (isset($contact)) {
	echo $contact;
};
?>" name="contact" type="tel">
</div>
<div class="form-group">
<input class="form-control" id="datepicker2"  placeholder="Date of Birth" value="<?php echo $date_of_birth; ?>" name="date_of_birth" type="text" required>
</div>
<div class="form-group">
<input class="form-control" placeholder="Address" value="<?php
if (isset($address)) {
	echo $address;
};
?>" name="address" type="text">
</div>
<div class="form-group">
<select name="role" required class="form-control">
<option value="teacher" <?php
if ($role == 'teacher') {
	echo ' selected ';
};
?> >Teacher</option>
<option value="student" <?php
if ($role == 'student') {
	echo ' selected ';
};
?> >Student</option>
</select>
</div>
<input class="btn btn-lg btn-success btn-block" type="submit" name="submit" value="Register" id="submit"/>
</fieldset>
</form>
</div>

</div>
</div>
</div>
<?php
goto end;
?>

<?php
yes:
$result = get_user_by_email($email);
$row = mysql_fetch_array($result);
?>

<div class="row transperent-background">
<div class="col-md-4">
<br />
<img src="<?php echo $row["Picture"]; ?>" class="img-thumbnail img-responsive">
</div>
<div class="col-md-8">
<br />

<div class="panel panel-success">
<div class="panel-heading">
Successfully Registered!
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
</div>
</div>

<?php
end:
include 'includes/footer.php';
?>
<?php
include 'includes/closeconnection.php';
?>