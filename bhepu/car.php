<?php require_once('header.php'); ?>

<?php
	$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
	foreach ($result as $row) 
	{
		$banner_car = $row['banner_car'];
	}
?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: index.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_car WHERE car_id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	if( $total == 0 ) {
		header('location: index.php');
		exit;
	}
}
?>
<?php							
foreach ($result as $row) {
	$title = $row['title'];
	$description = $row['description'];
	$address = $row['address'];
	$zip_code = $row['zip_code'];
	$country = $row['country'];
	$map = $row['map'];
	$car_category_id = $row['car_category_id'];
	$brand_id = $row['brand_id'];
	$model_id = $row['model_id'];
	$division_id = $row['division_id'];
	$district_id = $row['district_id'];

	$body_type_id = $row['body_type_id'];
	$fuel_type_id = $row['fuel_type_id'];
	$transmission_type_id = $row['transmission_type_id'];
	$vin = $row['vin'];
	$car_condition = $row['car_condition'];
	$engine = $row['engine'];
	$engine_size = $row['engine_size'];
	$exterior_color = $row['exterior_color'];
	$interior_color = $row['interior_color'];
	$seat = $row['seat'];
	$door = $row['door'];
	$top_speed = $row['top_speed'];
	$kilometer = $row['kilometer'];
	$mileage = $row['mileage'];
	$year = $row['year'];
	$warranty = $row['warranty'];
	$featured_photo = $row['featured_photo'];
	$regular_price = $row['regular_price'];
	$sale_price = $row['sale_price'];
	$seller_id = $row['seller_id'];
}

$statement = $pdo->prepare("SELECT * FROM tbl_car_category WHERE car_category_id=?");
$statement->execute(array($car_category_id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
$total = $statement->rowCount();
if($total) {
	foreach ($result as $row) {
		$car_category_name = $row['car_category_name'];
	}
} else {
	$car_category_name = 'Not Specified';
}						


$statement = $pdo->prepare("SELECT * FROM tbl_brand WHERE brand_id=?");
$statement->execute(array($brand_id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
$total = $statement->rowCount();
if($total) {
	foreach ($result as $row) {
		$brand_name = $row['brand_name'];
	}
} else {
	$brand_name = 'Not Specified';
}

$statement = $pdo->prepare("SELECT * FROM tbl_model WHERE model_id=?");
$statement->execute(array($model_id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
$total = $statement->rowCount();
if($total) {
	foreach ($result as $row) {
		$model_name = $row['model_name'];
	}
} else {
	$model_name = 'Not Specified';
}


//division & district

$statement = $pdo->prepare("SELECT * FROM tbl_division WHERE division_id=?");
$statement->execute(array($division_id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
$total = $statement->rowCount();
if($total) {
	foreach ($result as $row) {
		$division_name = $row['division_name'];
	}
} else {
	$division_name = 'Not Specified';
}

$statement = $pdo->prepare("SELECT * FROM tbl_district WHERE district_id=?");
$statement->execute(array($district_id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
$total = $statement->rowCount();
if($total) {
	foreach ($result as $row) {
		$district_name = $row['district_name'];
	}
} else {
	$district_name = 'Not Specified';
}






$statement = $pdo->prepare("SELECT * FROM tbl_body_type WHERE body_type_id=?");
$statement->execute(array($body_type_id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
$total = $statement->rowCount();
if($total) {
	foreach ($result as $row) {
		$body_type_name = $row['body_type_name'];
	}
} else {
	$body_type_name = 'Not Specified';
}

$statement = $pdo->prepare("SELECT * FROM tbl_fuel_type WHERE fuel_type_id=?");
$statement->execute(array($fuel_type_id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
$total = $statement->rowCount();
if($total) {
	foreach ($result as $row) {
		$fuel_type_name = $row['fuel_type_name'];
	}
} else {
	$fuel_type_name = 'Not Specified';
}

$statement = $pdo->prepare("SELECT * FROM tbl_transmission_type WHERE transmission_type_id=?");
$statement->execute(array($transmission_type_id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
$total = $statement->rowCount();
if($total) {
	foreach ($result as $row) {
		$transmission_type_name = $row['transmission_type_name'];
	}
} else {
	$transmission_type_name = 'Not Specified';
}

$statement = $pdo->prepare("SELECT * FROM tbl_seller WHERE seller_id=?");
$statement->execute(array($seller_id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	$seller_name = $row['seller_name'];
	$seller_email = $row['seller_email'];
	$seller_phone = $row['seller_phone'];
	$seller_address = $row['seller_address'];
	$seller_city = $row['seller_city'];
	$seller_state = $row['seller_state'];
	$seller_country = $row['seller_country'];
	$seller_password = $row['seller_password'];
}
?>

<div class="banner-slider" style="background-image: url(<?php echo BASE_URL.'assets/uploads/'.$banner_car; ?>);">
	<div class="bg"></div>
	<div class="bannder-table">
		<div class="banner-text">
			<h1>Car Detail</h1>
		</div>
	</div>
</div>

<!--Car Detail Start-->
<div class="car-detail bg-area">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-sm-12">
				<div class="car-detail-mainbar">
					<div class="car-detail-name">
						<h2><?php echo $title; ?></h2>
						<div class="car-detail-price">
							<p>
								<?php if($regular_price == $sale_price): ?>
									<?php echo $sale_price; ?>Taka
								<?php else: ?>
									<del><?php echo $regular_price; ?>Taka</del> <?php echo $sale_price; ?>Taka 
								<?php endif; ?>								
							</p>
						</div>
					</div>

					<div class="car-detail-gallery owl-carousel">
						<div class="car-detail-photo" style="background-image: url(<?php echo BASE_URL; ?>assets/uploads/cars/<?php echo $featured_photo; ?>)">
							<div class="lightbox-item">
								<a href="<?php echo BASE_URL; ?>assets/uploads/cars/<?php echo $featured_photo; ?>" data-lightbox="lightbox-item"><i class="fa fa-search-plus"></i></a>
							</div>
						</div>
						<?php
						$statement = $pdo->prepare("SELECT * FROM tbl_car_photo WHERE car_id=?");
						$statement->execute(array($_REQUEST['id']));
						$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
						foreach ($result as $row) {
							?>
							<div class="car-detail-photo" style="background-image: url(<?php echo BASE_URL; ?>assets/uploads/other-cars/<?php echo $row['photo']; ?>)">
								<div class="lightbox-item">
									<a href="<?php echo BASE_URL; ?>assets/uploads/other-cars/<?php echo $row['photo']; ?>" data-lightbox="lightbox-item"><i class="fa fa-search-plus"></i></a>
								</div>
							</div>
							<?php
						}
						?>
						
					</div>

					<div class="car-info-tab">

						<ul class="car-main-tab">
							<li class="active"><a href="#seller_description" data-toggle="tab" aria-expanded="true">Description</a></li>
							<li class=""><a href="#seller_contact" data-toggle="tab" aria-expanded="false">Contact Information</a></li>
						</ul>

						<div class="tab-content car-content">

							<div class="tab-pane active" id="seller_description">
								<div class="car-tab-text">
									<h2>Seller Description</h2>
									<div class="car-tab-pre">
										<p>
											<?php if($description!=''): ?>
												<?php echo nl2br($description); ?>	
											<?php else: ?>
												No Description Found.
											<?php endif; ?>											
										</p>
									</div>
								</div>
							</div>


							<div class="tab-pane" id="seller_contact">
								<div class="car-tab-text">
									<h2>Contact Information</h2>
									<div class="car-tab-pre">
										<p>
											Address: <?php echo $seller_address; ?><br>
											Phone: <?php echo $seller_phone; ?><br>
											Email: <?php echo $seller_email; ?>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Related Cars -->
				<div class="related-ads">
					<div class="related-ads-headline">
						<h2>Related Cars</h2>
					</div>
					<?php
					$statement = $pdo->prepare("SELECT * FROM tbl_car WHERE brand_id=? AND car_id!=?");
					$statement->execute(array($brand_id,$_REQUEST['id']));
					$result = $statement->fetchAll(PDO::FETCH_ASSOC);
					$total = $statement->rowCount();
					if($total):
					foreach ($result as $row) {
						?>
						<div class="row listing-item">
							<div class="col-md-4 col-sm-4 listing-photo" style="background-image: url(<?php echo BASE_URL; ?>assets/uploads/cars/<?php echo $row['featured_photo']; ?>)"></div>
							
							<div class="col-md-4 col-sm-4 listing-text">
								<h2><?php echo $row['title']; ?></h2>
								<?php
								$statement1 = $pdo->prepare("SELECT * FROM tbl_car_category WHERE car_category_id=?");
								$statement1->execute(array($row['car_category_id']));
								$tot = $statement1->rowCount();
								$result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);			
								foreach ($result1 as $row1) {
									$car_category_name = $row1['car_category_name'];
								}
								?>
								<ul>
									<li>Type: <span><?php if($tot!=''){echo $car_category_name;} else{echo 'Not Specified';} ?></span></li>
									<li>Mileage: <span><?php if($row['mileage']!=''){echo $row['mileage'];} else{echo 'Not Specified';} ?></span></li>
									<li>Year: <span><?php if($row['year']!=0){echo $row['year'];} else{echo 'Not Specified';} ?></span></li>
								</ul>
							</div>
							<div class="col-md-4 col-sm-4 listing-price">
								<h2>
									<?php if($row['regular_price']!=$row['sale_price']): ?>
										<del>$<?php echo $row['regular_price']; ?></del>
										$<?php echo $row['sale_price']; ?>
									<?php else: ?>
										$<?php echo $row['sale_price']; ?>
									<?php endif; ?>
								</h2>
								<a href="<?php echo BASE_URL.URL_CAR.$row['car_id']; ?>">View Detail</a>
							</div>
							
						</div>
						<?php
					}
					else:
						echo '<div class="listing-item">No Result Found</div>';
					endif;
					?>
				</div>
			</div>

			<div class="col-md-4 col-sm-12">
				<div class="car-detail-sidebar">
					<div class="detail-item car-detail-list">
						<h3>Car Details</h3>
						<table>
							<tbody>
								<tr>
									<td><span>Category</span></td>
									<td><?php echo $car_category_name; ?></td>
								</tr>
								<tr>
									<td><span>Brand</span></td>
									<td><?php echo $brand_name; ?></td>
								</tr>
								<tr>
									<td><span>Model</span></td>
									<td><?php echo $model_name; ?></td>
								</tr>
								<tr>
									<td><span>Body Type</span></td>
									<td><?php echo $body_type_name; ?></td>
								</tr>
								<tr>
									<td><span>Fuel Type</span></td>
									<td><?php echo $fuel_type_name; ?></td>
								</tr>
								<tr>
									<td><span>Transmission Type</span></td>
									<td><?php echo $transmission_type_name; ?></td>
								</tr>
								<tr>
									<td><span>VIN</span></td>
									<td>
										<?php if($vin!=''): ?>
											<?php echo $vin; ?>
										<?php else: ?>
											Not Specified
										<?php endif; ?>
									</td>
								</tr>
								<tr>
									<td><span>Condition</span></td>
									<td><?php echo $car_condition; ?></td>
								</tr>
								<tr>
									<td><span>Engine</span></td>
									<td>
										<?php if($engine!=''): ?>
											<?php echo $engine; ?>
										<?php else: ?>
											Not Specified
										<?php endif; ?>
									</td>
								</tr>
								<tr>
									<td><span>Engine Size</span></td>
									<td>
										<?php if($engine_size!=''): ?>
											<?php echo $engine_size; ?>
										<?php else: ?>
											Not Specified
										<?php endif; ?>
									</td>
								</tr>
								<tr>
									<td><span>Exterior Color</span></td>
									<td>
										<?php if($exterior_color!=''): ?>
											<?php echo $exterior_color; ?>
										<?php else: ?>
											Not Specified
										<?php endif; ?>
									</td>
								</tr>
								<tr>
									<td><span>Interior Color</span></td>
									<td>
										<?php if($interior_color!=''): ?>
											<?php echo $interior_color; ?>
										<?php else: ?>
											Not Specified
										<?php endif; ?>
									</td>
								</tr>
								<tr>
									<td><span>Number of Seats</span></td>
									<td>
										<?php if($seat!=''): ?>
											<?php echo $seat; ?>
										<?php else: ?>
											Not Specified
										<?php endif; ?>
									</td>
								</tr>
								<tr>
									<td><span>Number of Doors</span></td>
									<td>
										<?php if($door!=''): ?>
											<?php echo $door; ?>
										<?php else: ?>
											Not Specified
										<?php endif; ?>
									</td>
								</tr>
								<tr>
									<td><span>Top Speed</span></td>
									<td>
										<?php if($top_speed!=''): ?>
											<?php echo $top_speed; ?>
										<?php else: ?>
											Not Specified
										<?php endif; ?>
									</td>
								</tr>
								<tr>
									<td><span>Kilometer</span></td>
									<td>
										<?php if($kilometer!=''): ?>
											<?php echo $kilometer; ?>
										<?php else: ?>
											Not Specified
										<?php endif; ?>
									</td>
								</tr>
								<tr>
									<td><span>Mileage</span></td>
									<td>
										<?php if($mileage!=''): ?>
											<?php echo $mileage; ?>
										<?php else: ?>
											Not Specified
										<?php endif; ?>
									</td>
								</tr>
								<tr>
									<td><span>Year</span></td>
									<td>
										<?php if($year!=0): ?>
											<?php echo $year; ?>
										<?php else: ?>
											Not Specified
										<?php endif; ?>
									</td>
								</tr>
								<tr>
									<td><span>Warranty</span></td>
									<td>
										<?php if($warranty!=''): ?>
											<?php echo $warranty; ?>
										<?php else: ?>
											Not Specified
										<?php endif; ?>
									</td>
								</tr>
								<tr>
									<td><span>Division</span></td>
									<td><?php echo $division_name; ?></td>
								</tr>
								<tr>
									<td><span>District</span></td>
									<td><?php echo $district_name; ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--Car Detail End-->

<?php require_once('footer.php'); ?>