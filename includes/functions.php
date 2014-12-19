<?php
// This file is the place to store all basic functions

function mysql_prep($value) {
	$magic_quotes_active = get_magic_quotes_gpc();
	$new_enough_php = function_exists("mysql_real_escape_string");
	// i.e. PHP >= v4.3.0
	if ($new_enough_php) {// PHP v4.3.0 or higher
		// undo any magic quote effects so mysql_real_escape_string can do the work
		if ($magic_quotes_active) { $value = stripslashes($value);
		}
		$value = mysql_real_escape_string($value);
	} else {// before PHP v4.3.0
		// if magic quotes aren't already on then add slashes manually
		if (!$magic_quotes_active) { $value = addslashes($value);
		}
		// if magic quotes are active, then the slashes already exist
	}
	return $value;
}

function redirect_to($location = NULL) {
	if ($location != NULL) {
		header("Location: {$location}");
		exit ;
	}
}

function confirm_query($result_set) {
	if (!$result_set) {
		die("Database query failed: " . mysql_error());
	}
}

function get_profile_picture($gender, $role) {
	if ($gender == 'M') {
		$dir_name = "male";
	} else {
		$dir_name = "female";
	}
	$picture = "uploads/" . $dir_name . "/" . $role . ".png";
	return $picture;
}

function email_isExists($email) {
	global $connection;
	$query = "SELECT * FROM user where Email = '{$email}'";
	$result_set = mysql_query($query, $connection);
	$num_of_rows = mysql_num_rows($result_set);
	if ($num_of_rows == 1) {
		return TRUE;
	}
	return FALSE;
}

function get_user_by_email($email) {
	global $connection;
	$query = "SELECT * FROM user where Email = '{$email}'";
	$result_set = mysql_query($query, $connection);
	$num_of_rows = mysql_num_rows($result_set);
	if ($num_of_rows == 1) {
		return $result_set;
	}
	return FALSE;
}

function get_user_email_by_id($id) {
	global $connection;
	$query = "SELECT * FROM user where ID = '{$id}'";
	$result_set = mysql_query($query, $connection);
	$num_of_rows = mysql_num_rows($result_set);
	if ($num_of_rows == 1) {
		return $result_set;
	}
	return FALSE;
}

function get_latest_id() {
	global $connection;
	$query = "SELECT ID FROM user ORDER BY id DESC LIMIT 1";
	$result = mysql_query($query, $connection);
	confirm_query($result);
	$row = mysql_fetch_array($result);
	$id = $row['ID'] + 1;
	return $id;
}

function genarate_user_id($role) {
	if ($role == 'student') {
		$user_id = 'std';
		$user_id .= get_latest_id();

	} else {
		$user_id = 't';
		$user_id .= get_latest_id();
	}
	return $user_id;
}

function get_all_users() {
	global $connection;
	$query = "SELECT * FROM user ORDER BY id";
	$result = mysql_query($query, $connection);
	confirm_query($result);
	return $result;
}

function get_all_active_users() {
	global $connection;
	$query = "SELECT * FROM user WHERE Role in ('teacher','student') AND isActive = '1' ORDER BY id";
	$result = mysql_query($query, $connection);
	confirm_query($result);
	return $result;
}

function get_all_active_teachers() {
	global $connection;
	global $connection;
	$query = "SELECT * FROM user WHERE isActive = '1' AND Role = 'teacher' ORDER BY id";
	$result = mysql_query($query, $connection);
	confirm_query($result);
	return $result;
}

function get_all_active_students() {
	global $connection;
	$query = "SELECT * FROM user WHERE isActive = '1' AND Role = 'student' ORDER BY id";
	$result = mysql_query($query, $connection);
	confirm_query($result);
	return $result;
}

function get_all_pending_users() {
	global $connection;
	$query = "SELECT * FROM user WHERE isActive = '0' ORDER BY id";
	$result = mysql_query($query, $connection);
	confirm_query($result);
	return $result;
}

function get_id_by_email($email) {
	global $connection;
	$query = "SELECT * FROM user where Email = '{$email}'";
	$result_set = mysql_query($query, $connection);
	$num_of_rows = mysql_num_rows($result_set);
	if ($num_of_rows == 1) {
		$row = mysql_fetch_array($result_set);
		return $row["ID"];
	}
	return FALSE;
}

function update_image_by_id($email, $picture) {
	$picture = $picture = mysql_prep($picture);
	$query = "UPDATE user 
		SET Picture = '{$picture}'
		WHERE Email = '{$email}';";
	$result = mysql_query($query);
	confirm_query($result);
}

function display_error($error) {

	echo "<div class=\"alert alert-danger\" role=\"alert\">
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
			<span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>
			<span class=\"sr-only\">Error:</span>";
	echo $error;
	echo "</div>";

}

function display_errors($error_array) {
	foreach (explode('.', $error_array) as $key => $value) {
		if (!empty($value)) {
			display_error($value);
		}

	}
}

function get_course_by_id($id) {
	global $connection;
	$query = "SELECT * FROM course WHERE ID = '{$id}';";
	$result = mysql_query($query, $connection);
	confirm_query($result);
	return $result;
}

function get_course_by_code($code) {
	global $connection;
	$query = "SELECT * FROM course WHERE Code = '{$code}';";
	$result = mysql_query($query, $connection);
	confirm_query($result);
	return $result;
}

function get_all_courses() {
	global $connection;
	$query = "SELECT * FROM course ORDER BY id";
	$result = mysql_query($query, $connection);
	confirm_query($result);
	return $result;
}

function get_taken_courses_by_id($id) {
	global $connection;
	$query = "SELECT 
	c.ID AS id, c.Name AS Name, c.Code AS Code,c.Details AS details 
	FROM taken_course AS tc 
	join course as c on c.id = tc.course_id  AND tc.user_id = '{$id}' 
	GROUP BY tc.course_id;";
	$result = mysql_query($query, $connection);
	confirm_query($result);
	return $result;
}

function chk_taken_course_by_id($user_id, $course_id) {
	global $connection;
	$query = "SELECT * FROM taken_course WHERE user_id = '{$user_id}' AND course_id = '{$course_id}';";
	$result = mysql_query($query, $connection);
	confirm_query($result);
	$num_of_rows = mysql_num_rows($result);
	if ($num_of_rows == 1) {
		return TRUE;
	}
	return FALSE;
}

function get_id_of_taken_course_table_by_id($user_id, $course_id) {
	global $connection;
	$query = "SELECT * FROM taken_course WHERE user_id = '{$user_id}' AND course_id = '{$course_id}';";
	$result = mysql_query($query, $connection);
	confirm_query($result);
	$num_of_rows = mysql_num_rows($result);
	$row = mysql_fetch_array($result);
	if ($num_of_rows == 1) {
		return $row['ID'];
	}
	return FALSE;
}

function course_code_isExists($code) {
	global $connection;
	$query = "SELECT * FROM course where Code = '{$code}'";
	$result_set = mysql_query($query, $connection);
	$num_of_rows = mysql_num_rows($result_set);
	if ($num_of_rows == 1) {
		return TRUE;
	}
	return FALSE;
}

function category_button($name, $link, $number) {
	echo '<div class="span3 btn btn-primary">';
	echo "<h3>{$name}</h3>";
	echo '<p>';
	echo "<a href=\"{$link}\" class=\"badge badge-inverse\">";
	echo $number;
	echo '</a>';
	echo '</p>';
	echo '</div>';
}

function create_new_button($name, $link) {
	echo '<div class="span3 btn btn-primary">';
	echo "<h3>{$name}</h3>";
	echo '<p>';
	echo "<a href=\"{$link}\" class=\"badge badge-inverse\">";
	echo '<i class="fa fa-plus"></i>';
	echo '</a>';
	echo '</p>';
	echo '</div>';
}
?>