<?php
include_once("db_connect.php");
$input = filter_input_array(INPUT_POST);
if ($input['action'] == 'edit') {	
	$update_field='';
	if(isset($input['iname'])) {
		$update_field.= "iname='".$input['iname']."'";
	} else if(isset($input['sup'])) {
		$update_field.= "sup='".$input['sup']."'";
	} else if(isset($input['wkhan'])) {
		$update_field.= "wkhan='".$input['wkhan']."'";
	} else if(isset($input['rkhan'])) {
		$update_field.= "rkhan='".$input['rkhan']."'";
	} else if(isset($input['unit'])) {
		$update_field.= "unit='".$input['unit']."'";
	}	
	if($update_field && $input['icode']) {
		$sql_query = "UPDATE stockbest SET $update_field WHERE icode='" . $input['icode'] . "'";	
		mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));		
	}
}


