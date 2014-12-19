<?php
function check_required_fields($required_array) {
	$field_errors = array();
	foreach ($required_array as $fieldname) {
		if (!isset($_POST[$fieldname]) || (empty($_POST[$fieldname]) && $_POST[$fieldname] != 0)) {
			$field_errors[] = $fieldname;
		}
	}
	return $field_errors;
}

function check_max_field_lengths($field_length_array) {
	$field_errors = array();
	foreach ($field_length_array as $fieldname => $maxlength) {
		if (strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength) { $field_errors[] = $fieldname;
		}
	}
	return $field_errors;
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
?>