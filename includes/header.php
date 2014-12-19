<?php
require_once 'includes/session.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>Amader School</title>

		<!-- Core CSS - Include with every page -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">

		<!-- SB Admin CSS - Include with every page -->
		<link href="css/sb-admin.css" rel="stylesheet">

		<link href="css/bootstrap-responsive.min.css" rel="stylesheet">

		<link href="css/datepicker3.css" rel="stylesheet">
		
		<link href="css/fileinput.min.css" rel="stylesheet">
	</head>
	<body>
		<nav class="navbar navbar-fixed-top navbar-default bg-class" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.php"><i class="fa fa-university"></i> Amader School</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav">
						<?php 
						if (!logged_in()) {
							echo '
							<li>
								<a class="btn btn-lg" data-toggle="modal" data-target="#signup" href="#signup"><i class="fa fa-level-up"></i> Sign Up</a>
							</li>
							<li>
								<a class="btn btn-lg" data-toggle="modal" data-target="#signin" href="#signin"><i class="fa fa-sign-in"></i> Sign In</a>
							</li>';
						}
						 ?>
						<?php
						if (logged_in()) {
							echo '
							<li>
								<a class="btn btn-lg" href="profile.php?email=';
								echo urlencode($_SESSION["email"]);
								echo '"><i class="fa fa-user"></i> Profile</a>
							</li>';
						}
						  ?>
						<?php 
						if (logged_in()&&$_SESSION["role"]=="admin") {							
							echo '
							<li>
								<a class="btn btn-lg" href="list.php"><i class="fa fa-users"></i> List</a>
							</li>';
						}
						 ?>
						  <?php 
						  if (logged_in()) {
						  	
							echo '
							<li>
								<a class="btn btn-lg" href="course.php"><i class="fa fa-book"></i> Course</a>
							</li>';
							
							echo '
							<li>
								<a class="btn btn-lg" href="logout.php"><i class="fa fa-sign-out"></i> Sign Out</a>
							</li>';
						  }
						   ?>
					</ul>
				</div>
				<!-- /.navbar-collapse -->
			</div>
			<!-- /.container -->
		</nav>
		<div class="container">
			<!-- Modal for signup -->
			<div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="signuplable" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">
								<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
							</button>
							<h4 class="modal-title" id="signuplable">Signup!</h4>
						</div>
						<div class="modal-body">
							<form action="register.php" method="post" role="form" autocomplete="on" accept-charset="utf-8">
								<fieldset>
									<div class="form-group">
										<input class="form-control" placeholder="Name" name="name" type="text" autofocus required>
									</div>
									<div class="form-group">
										<input class="form-control" placeholder="E-mail" name="email" type="email" required>
									</div>
									<div class="form-group">
										<input class="form-control" placeholder="Password" name="password" type="password" pattern=".{6,20}" title="Password Shuld Be atleast Six Characters Long" required>
									</div>
									<div class="form-group">
										<select name="gender" required class="form-control">
											<option value="" disabled selected>Select your Gender</option>
											<option value="M">Male</option>
											<option value="F">Female</option>
										</select>
									</div>
									<div class="form-group">
										<input class="form-control" placeholder="Contact No." name="contact" type="tel">
									</div>
									<div class="form-group">
										<input class="form-control" id="datepicker" placeholder="Date of Birth" name="date_of_birth" type="text" required>
									</div>
									<div class="form-group">
										<input class="form-control" placeholder="Address" name="address" type="text">
									</div>
									<div class="form-group">
										<select name="role" required class="form-control">
											<option value="" disabled selected>Select your Role</option>
											<option value="teacher">Teacher</option>
											<option value="student">Student</option>
										</select>
									</div>
									<input class="btn btn-lg btn-success btn-block" type="submit" name="submit" value="Register" id="submit"/>
								</fieldset>
							</form>
						</div>

					</div>
				</div>
			</div>

			<!-- Modal for signin -->
			<div class="modal fade" id="signin" tabindex="-1" role="dialog" aria-labelledby="signinLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">
								<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
							</button>
							<h4 class="modal-title" id="signinLabel">Signin!</h4>
						</div>
						<div class="modal-body">
							<form action="login.php" method="post" role="form" autocomplete="on" accept-charset="utf-8">
								<fieldset>
									<div class="form-group">
										<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus required>
									</div>
									<div class="form-group">
										<input class="form-control" placeholder="Password" name="password" type="password" value="" pattern=".{6,20}" title="Password Should Be atleast Six Characters Long" required>
									</div>
									<input class="btn btn-lg btn-success btn-block" type="submit" name="submit" value="Login" id="submit"/>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
