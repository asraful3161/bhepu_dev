<?php require_once('header.php'); ?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_transmission_type WHERE transmission_type_id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>

<?php
	$statement = $pdo->prepare("SELECT * FROM tbl_car WHERE transmission_type_id=?");
	$statement->execute(array($_REQUEST['id']));
	$tot = $statement->rowCount();
	if($tot) {
		header('location: transmission-type.php?msg=1');
	} else {
		// Delete from tbl_transmission_type
		$statement = $pdo->prepare("DELETE FROM tbl_transmission_type WHERE transmission_type_id=?");
		$statement->execute(array($_REQUEST['id']));

		header('location: transmission-type.php');	
	}
?>