<?php require_once('header.php'); ?>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	$total_recent_news_home_page = $row['total_recent_news_home_page'];
	$search_title = $row['search_title'];
	$search_photo = $row['search_photo'];
	$testimonial_photo = $row['testimonial_photo'];
}
?>

	<!--Slider-Area Start-->
	<div class="slider-area">


<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
    <li data-target="#carousel-example-generic" data-slide-to="4"></li>
  </ol>

  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="<?php echo BASE_URL.'assets/slider/' ?>3.jpg" alt="...">
    </div>
    <div class="item">
      <img src="<?php echo BASE_URL.'assets/slider/' ?>2.jpg" alt="...">
    </div>
    <div class="item">
      <img src="<?php echo BASE_URL.'assets/slider/' ?>1.jpg" alt="...">
    </div>
    <div class="item">
      <img src="<?php echo BASE_URL.'assets/slider/' ?>4.jpg" alt="...">
    </div>
    <div class="item">
      <img src="<?php echo BASE_URL.'assets/slider/' ?>5.jpg" alt="...">
    </div>
  </div>

</div>
		<div class="slider-item-sec">
		<!--<div class="slider-item" style="background-image: url(<?php echo BASE_URL.'assets/uploads/'.$search_photo; ?>)">-->
			<div class="bg-3"></div>
			<div class="container">
				<div class="row">
                    <div class="col-lg-5">
                        <div class="searchbox">
                            <form action="<?php echo BASE_URL.'check-get.php'; ?>" method="get">
                                <!-- <div class="row">
                                    <div class="col-lg-12">
                                        <h2>New & used cars</h2>
                                    </div>
                                    <div class="col-lg-6 option-item">
                                        <select data-placeholder="Choose Division" class="form-control brand" name="division" id="division_slug_venue" required="">
                                            
                                        <option value="barishal">Choose Division</option>
                                            <option value="barishal">Barishal</option>
                                            <option value="chattogram">Chattogram</option>
                                            <option value="dhaka">Dhaka</option>
                                            <option value="khulna">Khulna</option>
                                            <option value="mymensingh">Mymensingh</option>
                                            <option value="rajshahi">Rajshahi</option>
                                            <option value="rangpur">Rangpur</option>
                                            <option value="sylhet">Sylhet</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 option-item">
                                        <select data-placeholder="Choose District" class="form-control brand" name="division" id="division_slug_venue" required="">
                                            
                                            <option value="barishal">Choose District</option>
                                            <option value="barishal">Barishal</option>
                                            <option value="chattogram">Chattogram</option>
                                            <option value="dhaka">Dhaka</option>
                                            <option value="khulna">Khulna</option>
                                            <option value="mymensingh">Mymensingh</option>
                                            <option value="rajshahi">Rajshahi</option>
                                            <option value="rangpur">Rangpur</option>
                                            <option value="sylhet">Sylhet</option>
                                        </select>
                                    </div>
                                </div> -->

                                <div class="row">
                                    <div class="col-lg-6 option-item">
                                        <select data-placeholder="Choose Division" class="form-control division" name="division_id">
                                        	 <option value="">Choose Division</option>
                                            <?php
                                            $statement = $pdo->prepare("SELECT * FROM tbl_division ORDER BY division_name ASC");
                                            $statement->execute();
                                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result as $row) {
                                                ?>

                                               
                                                <option value="<?php echo $row['division_id']; ?>"><?php echo $row['division_name']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 option-item">
                                        <select data-placeholder="Choose District" class="form-control district" name="district_id" style="height: 38px;">
                                            <option value="">Choose District</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 option-item">
                                        <select data-placeholder="Choose Brand" class="form-control brand" name="brand_id">
                                            <?php
                                            $statement = $pdo->prepare("SELECT * FROM tbl_brand ORDER BY brand_name ASC");
                                            $statement->execute();
                                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result as $row) {
                                                ?>
                                                <option></option>
                                                <option value="<?php echo $row['brand_id']; ?>"><?php echo $row['brand_name']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 option-item">
                                        <select data-placeholder="Choose Model" class="form-control model" name="model_id" style="height: 38px;">
                                            <option value="">Choose Model</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-6 option-item">
                                        <select data-placeholder="Choose Condition" class="form-control chosen-select" name="car_condition">
                                            <option></option>
                                            <option value="New Car">New Car</option>
                                            <option value="Used Car">Used Car</option>
                                            
                                        </select>
                                    </div>

                                    <div class="col-lg-6 option-item">

                                        <select data-placeholder="Choose Condition" class="form-control chosen-select" name="car_transmission_id">
                                         <option></option>
                                           <option value="2">Automatic</option>
                                            <option value="1">Manual</option>
                                            
                                            
                                        </select>
                                    </div>

                                </div>
                                <div class="row">
                                    
                                    <div class="col-lg-6 option-item">
                                        <select data-placeholder="Choose Price Range (in Taka)" class="form-control chosen-select" name="price_range">
                                            <option></option>
                                            <option value="1">1-399920</option>
                                            <option value="2">400000-799920</option>
                                            <option value="3">800000-1199920</option>
                                            <option value="4">1200000-1599920</option>
                                            <option value="5">1600000-1999920</option>
                                            <option value="6">2000000-2399920</option>
                                            <option value="7">2400000-3999920</option>
                                            <option value="8">4000000+</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="submit" value="Search" name="form_search">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="slider-text">
                            <h1><?php echo $search_title; ?></h1>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
	<!--Slider-Area End-->

	

	<!--Featured Old Car Start-->
	<div class="featured-area">
		<div class="container">
			<div class="row">
				<div class="headline">
					<h2><span>Latest</span> Used Cars</h2>
				</div>
				<div class="featured-gallery owl-carousel">
					
					<?php
					$statement = $pdo->prepare("SELECT * 
											FROM tbl_car
											WHERE car_condition=? and status=?
											ORDER BY car_id DESC");
					$statement->execute(array('Used Car',1));
					$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
					foreach ($result as $row) {

						$seller_id = $row['seller_id'];

						// Check if this seller is active or inactive
						$statement1 = $pdo->prepare("SELECT * FROM tbl_seller WHERE seller_id=? AND seller_access=?");
						$statement1->execute(array($seller_id,1));
						$seller_status = $statement1->rowCount();
						if(!$seller_status) {continue;}

						$today = date('Y-m-d');

						$valid = 0;
						$statement1 = $pdo->prepare("SELECT * FROM tbl_payment WHERE seller_id=? AND payment_status=?");
						$statement1->execute(array($seller_id,'Completed'));
						$result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);							
						foreach ($result1 as $row1) {
							if(($today>=$row1['payment_date'])&&($today<=$row1['expire_date'])) {
								$valid = 1;
								break;
							}
						}
						if($valid == 1):
						?>
						<div class="featured-item">
							<div class="featured-car-name">
								<h2><?php echo $row['title']; ?></h2>
							</div>
							<div class="featured-photo" style="background-image: url(<?php echo BASE_URL.'assets/uploads/cars/'.$row['featured_photo']; ?>)"></div>
							<div class="featured-price">
								<h2>
									<?php if($row['regular_price']!=$row['sale_price']): ?>
										<del><?php echo $row['regular_price']; ?></del>
										<?php echo $row['sale_price']; ?> Taka
									<?php else: ?>
										<?php echo $row['sale_price']; ?> Taka
									<?php endif; ?>
								</h2>
							</div>
							<div class="car-type">
								<ul>
									<?php
									$statement1 = $pdo->prepare("SELECT * FROM tbl_car_category WHERE car_category_id=?");
									$statement1->execute(array($row['car_category_id']));
									$tot = $statement1->rowCount();
									$result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);			
									foreach ($result1 as $row1) {
										$car_category_name = $row1['car_category_name'];
									}
									?>
									<li>Category: <span><?php if($tot){echo $car_category_name;} else{echo 'Not Specified';} ?></span></li>
									<li>Mileage: <span><?php if($row['mileage']!=''){echo $row['mileage'];} else{echo 'Not Specified';} ?></span></li>
									<li>Year: <span><?php if($row['year']!=0){echo $row['year'];} else{echo 'Not Specified';} ?></span></li>
								</ul>
							</div>
							<div class="featured-link">
								<a href="<?php echo BASE_URL.URL_CAR.$row['car_id']; ?>">View Details</a>
							</div>
						</div>
						<?php endif; ?>
						<?php
					}
					?>
					
				</div>
			</div>
		</div>
	</div>



	<!--Featured New Car Start-->
	<div class="featured-area featured-new bg-area">
		<div class="container">
			<div class="row">
				<div class="headline">
					<h2><span>Latest</span> New Cars</h2>
				</div>
				<div class="featured-gallery owl-carousel">
					
					<?php
					$statement = $pdo->prepare("SELECT * 
											FROM tbl_car
											WHERE car_condition=? and status=?
											ORDER BY car_id DESC");
					$statement->execute(array('New Car',1));
					$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
					foreach ($result as $row) {

						$seller_id = $row['seller_id'];

						// Check if this seller is active or inactive
						$statement1 = $pdo->prepare("SELECT * FROM tbl_seller WHERE seller_id=? AND seller_access=?");
						$statement1->execute(array($seller_id,1));
						$seller_status = $statement1->rowCount();
						if(!$seller_status) {continue;}

						$today = date('Y-m-d');

						$valid = 0;
						$statement1 = $pdo->prepare("SELECT * FROM tbl_payment WHERE seller_id=? AND payment_status=?");
						$statement1->execute(array($seller_id,'Completed'));
						$result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);							
						foreach ($result1 as $row1) {
							if(($today>=$row1['payment_date'])&&($today<=$row1['expire_date'])) {
								$valid = 1;
								break;
							}
						}
						if($valid == 1):
						?>
						<div class="featured-item">
							<div class="featured-car-name">
								<h2><?php echo $row['title']; ?></h2>
							</div>
							<div class="featured-photo" style="background-image: url(<?php echo BASE_URL.'assets/uploads/cars/'.$row['featured_photo']; ?>)"></div>
							<div class="featured-price">
								<h2>
									<?php if($row['regular_price']!=$row['sale_price']): ?>
										<del><?php echo $row['regular_price']; ?></del>
										<?php echo $row['sale_price']; ?> Taka
									<?php else: ?>
										<?php echo $row['sale_price']; ?> Taka
									<?php endif; ?>
								</h2>
							</div>
							<div class="car-type">
								<ul>
									<?php
									$statement1 = $pdo->prepare("SELECT * FROM tbl_car_category WHERE car_category_id=?");
									$statement1->execute(array($row['car_category_id']));
									$tot = $statement1->rowCount();
									$result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);			
									foreach ($result1 as $row1) {
										$car_category_name = $row1['car_category_name'];
									}
									?>
									<li>Category: <span><?php if($tot){echo $car_category_name;} else{echo 'Not Specified';} ?></span></li>
									<li>Mileage: <span><?php if($row['mileage']!=''){echo $row['mileage'];} else{echo 'Not Specified';} ?></span></li>
									<li>Year: <span><?php if($row['year']!=0){echo $row['year'];} else{echo 'Not Specified';} ?></span></li>
								</ul>
							</div>
							<div class="featured-link">
								<a href="<?php echo BASE_URL.URL_CAR.$row['car_id']; ?>">View Details</a>
							</div>
						</div>
						<?php endif; ?>
						<?php
					}
					?>
					
				</div>
			</div>
		</div>
	</div>


	<!--Testimonial Area Start
	<div class="testimonial-area" style="background-image: url(<?php echo BASE_URL.'assets/uploads/'.$testimonial_photo; ?>)">
		<div class="bg-2" style="background-color: #333;"></div>
		<div class="container">
			<div class="row">
				<div class="headline headline-white">
					<h2>Happy Customers</h2>
				</div>
				<div class="testimonial-gallery owl-carousel">
					<?php
					$statement = $pdo->prepare("SELECT * FROM tbl_testimonial");
					$statement->execute();
					$result = $statement->fetchAll(PDO::FETCH_ASSOC);						
					foreach ($result as $row) {
						?>
						<div class="testimonial-item">
							<div class="testimonial-photo" style="background-image: url(<?php echo BASE_URL; ?>assets/uploads/<?php echo $row['photo']; ?>)"></div>
							<div class="testimonial-text">
								<h2><?php echo $row['name']; ?></h2>
								<h3><?php echo $row['designation'].'('.$row['company'].')'; ?></h3>
								<div class="testimonial-pra">
									<p>
										<?php echo $row['comment']; ?>
									</p>
								</div>
							</div>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
	Testimonial Area End-->

	<!--Latest News Start
	<div class="latest-news">
		<div class="container">
			<div class="row">
				<div class="headline">
					<h2><span>Latest</span> News</h2>
				</div>
				<div class="latest-gallery owl-carousel">
					<?php
					$i=0;
					$statement = $pdo->prepare("SELECT
									   t1.news_title,
			                           t1.news_slug,
			                           t1.news_content,
			                           t1.news_date,
			                           t1.photo,
			                           t1.category_id,

			                           t2.category_id,
			                           t2.category_name,
			                           t2.category_slug
			                           FROM tbl_news t1
			                           JOIN tbl_category t2
			                           ON t1.category_id = t2.category_id 		                           
			                           ORDER BY t1.news_id DESC");
					$statement->execute();
					$result = $statement->fetchAll(PDO::FETCH_ASSOC);					
					foreach ($result as $row) {
						$i++;
						if($i>$total_recent_news_home_page) {break;}
						?>
						<div class="latest-item">
							<div class="latest-photo" style="background-image: url(<?php echo BASE_URL; ?>assets/uploads/<?php echo $row['photo']; ?>)"></div>
							<div class="latest-text">
								<h2><?php echo $row['news_title']; ?></h2>
								<ul>
									<li>Category: <a href="<?php echo BASE_URL.URL_CATEGORY.$row['category_slug']; ?>"><?php echo $row['category_name']; ?></a></li>
									<li>Date: <?php echo $row['news_date']; ?></li>
								</ul>
								<div class="latest-pra">
									<p>
										<?php echo substr($row['news_content'],0,120).' ...'; ?>
									</p>
									<a href="<?php echo BASE_URL.URL_NEWS.$row['news_slug']; ?>">Read more</a>
								</div>
							</div>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>
    </div>
                -->

<?php require_once('footer.php'); ?>
	