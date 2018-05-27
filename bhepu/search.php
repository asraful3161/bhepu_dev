<?php require_once('header.php'); ?>

<?php
	$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
	foreach ($result as $row) 
	{
		$banner_search = $row['banner_search'];
	}
?>

<?php
// Stopping direct access of the search
if( $_SERVER['REQUEST_METHOD'] !== 'POST' && $_SERVER['REQUEST_METHOD'] !== 'GET' ) {
	header('location: '.BASE_URL);
	exit;
}
?>

<div class="banner-slider" style="background-image: url(<?php echo BASE_URL.'assets/uploads/'.$banner_search; ?>)">
	<div class="bg"></div>
	<div class="bannder-table">
		<div class="banner-text">
			<h1>Search Result</h1>
		</div>
	</div>
</div>


<div class="lesting-area bg-area">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-sm-12">
				
				<?php
				// Checking Brand
				if(!empty($_GET['brand_id'])) {
					if($_GET['brand_id'] == 'All Brands') {
						$c_brand = '';
					} else {
						$c_brand = ' AND brand_id='.$_GET['brand_id'];
					}
				} else {
					$c_brand = '';
				}

				// Checking Model
				if(!empty($_GET['model_id'])) {
					if($_GET['model_id'] == 'All Models') {
						$c_model = '';
					} else {
						if($_GET['brand_id'] == 'All Brands') {
							$c_model = '';
						} else {
							$c_model = ' AND model_id='.$_GET['model_id'];
						}
					}
				} else {
					$c_model = '';
				}


				// Checking Car Condition
				if(!empty($_GET['car_condition'])) {
					if($_GET['car_condition'] == 'All Cars') {
						$c_car_condition = '';
					} else {
						$c_car_condition = ' AND car_condition=\''.$_GET['car_condition'].'\'';
					}	
				} else {
					$c_car_condition = '';
				}

				// Checking Price Range
				if(!empty($_GET['price_range'])) {
					if($_GET['price_range'] == 'All Prices') {
						$c_price_range = '';
					} else {

						if($_GET['price_range'] == '1') {
							$start_price = '1';
							$end_price = '399920';
						} elseif($_GET['price_range'] == '2') {
							$start_price = '400000';
							$end_price = '799920';
						} elseif($_GET['price_range'] == '3') {
							$start_price = '800000';
							$end_price = '1199920';
						} elseif($_GET['price_range'] == '4') {
							$start_price = '1200000';
							$end_price = '1599920';
						} elseif($_GET['price_range'] == '5') {
							$start_price = '1600000';
							$end_price = '1999920';
						} elseif($_GET['price_range'] == '6') {
							$start_price = '2000000';
							$end_price = '2399920';
						} elseif($_GET['price_range'] == '7') {
							$start_price = '2400000';
							$end_price = '3999920';
						} elseif($_GET['price_range'] == '8') {
							$start_price = '4000000';
							$end_price = '0';
						}

						if($_GET['price_range'] != '8'):
							$c_price_range = ' AND (sale_price>='.$start_price.' AND sale_price<='.$end_price.')';
						else:
							$c_price_range = ' AND sale_price>='.$start_price;
						endif;						
					}
				} else {
					$c_price_range = '';
				}

				// Checking Car Category
				if(!empty($_GET['car_category_id'])) {
					if($_GET['car_category_id'] == 'All Categories') {
						$c_car_category_id = '';
					} else {
						$c_car_category_id = 'AND car_category_id='.$_GET['car_category_id'];
					}
				} else {
					$c_car_category_id = '';
				}

				// Checking Body Type
				if(!empty($_GET['body_type_id'])) {
					if($_GET['body_type_id'] == 'Not Specified') {
						$c_body_type_id = '';
					} else {
						$c_body_type_id = ' AND body_type_id='.$_GET['body_type_id'];
					}
				} else {
					$c_body_type_id = '';
				}

				// Checking Fuel Type
				if(!empty($_GET['fuel_type_id'])) {
					if($_GET['fuel_type_id'] == 'Not Specified') {
						$c_fuel_type_id = '';
					} else {
						$c_fuel_type_id = ' AND fuel_type_id='.$_GET['fuel_type_id'];
					}
				} else {
					$c_fuel_type_id = '';
				}

				// Checking Transmission Type
				if(!empty($_GET['transmission_type_id'])) {
					if($_GET['transmission_type_id'] == 'Not Specified') {
						$c_transmission_type_id = '';
					} else {
						$c_transmission_type_id = ' AND transmission_type_id='.$_GET['transmission_type_id'];
					}
				} else {
					$c_transmission_type_id = '';
				}


				// Checking Year
				if(!empty($_GET['year'])) {
					if($_GET['year'] == 'Not Specified') {
						$c_year = '';
					} else {
						$c_year = ' AND year='.$_GET['year'];
					}
				} else {
					$c_year = '';
				}

				// Checking Mileage
				if( !empty($_GET['mileage_start']) && !empty($_GET['mileage_end']) ) {
					$c_mileage = ' AND (mileage>='.$_GET['mileage_start'].' AND mileage<='.$_GET['mileage_end'].')';
				} else {
					$c_mileage = '';
				}

				// Checking Country
				if(!empty($_GET['country'])) $c_country = ' AND country LIKE \'%'.$_GET['country'].'%\'';
				else $c_country = '';


				// Checking Division

				if(!empty($_GET['division_id'])){

					if($_GET['division_id'] == 'All Divisions') $c_division = '';
					else $c_division = " AND division_id='".$_GET['division_id']."'";

				}else $c_division = '';

				// Checking District

				if(!empty($_GET['district_id'])){

					if($_GET['district_id'] == 'All District') $c_district = '';
					else $c_district = " AND district_id='".$_GET['district_id']."'";

				}else $c_district = '';

				// Checking State
				// if(!empty($_GET['state'])) {
				// 	$c_state = ' AND state LIKE \'%'.$_GET['state'].'%\'';
				// } else {
				// 	$c_state = '';
				// }

				// // Checking City
				// if(!empty($_GET['city'])) {
				// 	$c_city = ' AND city LIKE \'%'.$_GET['city'].'%\'';
				// } else {
				// 	$c_city = '';
				// }

				

				// Creating conditions for query with each single select of dropdown
				$query_condition = '';
				$query_condition = $c_brand.$c_model.$c_division.$c_district.$c_car_condition.$c_price_range.$c_car_category_id.$c_body_type_id.$c_fuel_type_id.$c_transmission_type_id.$c_year.$c_mileage.$c_country;

				// Creating final query from condition check
				if($query_condition != ''){

					$sql = "SELECT * FROM tbl_car WHERE".$query_condition." AND status='1'";
					$arr = explode("WHERE",$sql);
					$part1 = $arr[0];
					$part2 = substr($arr[1],4,(strlen($arr[1])-1));
					$final_sql = $part1.' WHERE'.$part2;

				}else $final_sql = "SELECT * FROM tbl_car WHERE status='1'";

				//echo $final_sql;

				// Getting the search result
				$statement = $pdo->prepare($final_sql);
				$statement->execute();
				$total_res = $statement->rowCount();
				$result = $statement->fetchAll(PDO::FETCH_ASSOC);
				
				if($total_res==''):
					echo '<div class="error" style="font-size:24px;margin-top:20px;">Sorry! No Car is Found.</div>';
				else:
					$count_child=0;
					?><div class="parent"><?php
					foreach ($result as $row) {
						$count_child++;
						// Getting category name from category id
						$statement1 = $pdo->prepare("SELECT * FROM tbl_car_category WHERE car_category_id=?");
						$statement1->execute(array($row['car_category_id']));
						$result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
						$tot = $statement1->rowCount();
						foreach ($result1 as $row1) {
							$car_category_name = $row1['car_category_name'];
						}
						?>
						<div class="row listing-item child">
							<div class="col-md-4 col-sm-4 col-xs-12 listing-photo" style="background-image: url(<?php echo BASE_URL.'assets/uploads/cars/'.$row['featured_photo']; ?>)"></div>							
							<div class="col-md-4 col-sm-4 col-xs-6 listing-text">
								<h2><?php echo $row['title']; ?></h2>
								<ul>
									<li>Type: <span><?php if($tot!=''){echo $car_category_name;} else{echo 'Not Specified';} ?></span></li>
									<li>Mileage: <span><?php if($row['mileage']!=''){echo $row['mileage'];} else{echo 'Not Specified';} ?></span></li>
									<li>Year: <span><?php if($row['year']!=0){echo $row['year'];} else{echo 'Not Specified';} ?></span></li>
								</ul>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-6 listing-price">
								<h2>
									<?php if($row['regular_price']!=$row['sale_price']): ?>
										<del><?php echo $row['regular_price']; ?></del>
										<?php echo $row['sale_price']; ?> Taka
									<?php else: ?>
										<?php echo $row['sale_price']; ?> 
									 Taka<?php endif; ?>
								</h2>
								<a href="<?php echo BASE_URL.URL_CAR.$row['car_id']; ?>">View Detail</a>
							</div>								
						</div>
						<?php
					}
					?>
					</div>

					<!-- Load More button -->
					<?php if($count_child>6): ?>
					<div class="load-more">
						<a class="load">Load More</a>
					</div>
					<?php endif; ?>
										
					<?php
				endif;									
				?>
				
			</div>

			<div class="col-md-4 col-sm-12">
				<div class="sidebar">
					<?php require_once('search-sidebar.php'); ?>
				</div>
			</div>

		</div>
	</div>
</div>

<?php require_once('footer.php'); ?>