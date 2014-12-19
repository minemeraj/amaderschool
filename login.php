<?php
include 'includes/functions.php';
?>
<?php
if (!$_POST) {
	redirect_to("index.php");
}
?>
<?php
require_once 'includes/session.php';
?>
<?php
include 'includes/connection.php';
?>
<?php

$email = $_POST["email"];

$password = $_POST["password"];

$query = "SELECT * FROM user where Email = '{$email}' AND Password='{$password}';";

$result = mysql_query($query);

if (mysql_num_rows($result) == 1) {

	$row = mysql_fetch_array($result);
	print_r($row);

	$_SESSION['id'] = $row['ID'];
	$_SESSION['email'] = $row['Email'];
	$_SESSION['role'] = $row['Role'];

	redirect_to("profile.php?email=" . urlencode($_SESSION['email']));

} else {
	$msg = "Email or Password Does not match";
}
?>
<?php
include 'includes/closeconnection.php';
?>
<?php
require_once 'includes/header.php';
?>
<div class="row">

	<div class="col-md-4 col-md-offset-4">
		<div class="login-panel panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Sign In</h3>
			</div>
			<div class="panel-body">

				<?php
				if (isset($msg)) {
				echo "<div class=\"alert alert-danger\" role=\"alert\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
				<span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>
				<span class=\"sr-only\">Error:</span>
				{$msg}
				</div>";
				}
				?>
				<form action="login.php" method="post" role="form" autocomplete="on" accept-charset="utf-8">
					<fieldset>
						<div class="form-group">
							<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus required>
						</div>
						<div class="form-group">
							<input class="form-control" placeholder="Password" name="password" type="password" value="" pattern=".{6,20}" title="Password Shuld Be atleast Six Characters Long" required>
						</div>
						<input class="btn btn-lg btn-success btn-block" type="submit" name="submit" value="Login" id="submit"/>
					</fieldset>
				</form>
			</div>

		</div>
	</div>

</div>

<?php
include 'includes/footer.php';
?>