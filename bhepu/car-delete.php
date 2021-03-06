<?php require_once('header.php'); ?>

<?php
// Preventing the direct access of this page.
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_car WHERE car_id=?");
	$statement->execute(array($_REQUEST['id']));
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	} else {
		// Preventing one user deleting another user's data through url
		foreach ($result as $row) {
			$seller_id = $row['seller_id'];
		}
		if($seller_id != $_SESSION['seller']['seller_id']) {
			header('location: logout.php');
			exit;
		}
	}
}

// If seller is logged in, but admin make him inactive, then force logout this user.
$statement = $pdo->prepare("SELECT * FROM tbl_seller WHERE seller_id=? AND seller_access=?");
$statement->execute(array($_SESSION['seller']['seller_id'],0));
$total = $statement->rowCount();
if($total) {
	header('location: '.BASE_URL.'logout.php');
	exit;
}
?>

<?php

	// Getting car featured photo and unlink
	$statement = $pdo->prepare("SELECT * FROM tbl_car WHERE car_id=?");
	$statement->execute(array($_REQUEST['id']));
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
	foreach ($result as $row) {
		unlink('assets/uploads/cars/'.$row['featured_photo']);
	}

	// Getting car other photos and unlink
	$statement = $pdo->prepare("SELECT * FROM tbl_car_photo WHERE car_id=?");
	$statement->execute(array($_REQUEST['id']));
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
	foreach ($result as $row) {
		unlink('assets/uploads/other-cars/'.$row['photo']);
	}

	// Delete from tbl_car
	$statement = $pdo->prepare("DELETE FROM tbl_car WHERE car_id=?");
	$statement->execute(array($_REQUEST['id']));

	// Delete from tbl_car_photo
	$statement = $pdo->prepare("DELETE FROM tbl_car_photo WHERE car_id=?");
	$statement->execute(array($_REQUEST['id']));

	header('location: car-view.php');
?>