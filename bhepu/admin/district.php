<?php require_once('header.php'); ?>

<section class="content-header">
	<div class="content-header-left">
		<h1>View District</h1>
	</div>
	<div class="content-header-right">
		<a href="district-add.php" class="btn btn-primary btn-sm">Add New</a>
	</div>
</section>


<section class="content">

  <div class="row">
    <div class="col-md-12">

      <div class="box box-info">
        
        <div class="box-body table-responsive">

            <?php
            if(isset($_REQUEST['msg'])) {
                if($_REQUEST['msg'] == 1) {
                    echo '<div class="error">You can not delete this district because this is used in the car table</div>';
                }
            }
            ?>
            <table id="example1" class="table table-bordered table-striped">
    			<thead>
    			    <tr>
    			        <th>SL</th>
    			        <th>District Name</th>
                        <th>Division Name</th>
    			        <th>Action</th>
    			    </tr>
    			</thead>
                <tbody>
                	<?php
                	$i=0;
                	$statement = $pdo->prepare("SELECT 
                                                    t1.district_id,
                                                    t1.district_name,
                                                    t1.division_id,

                                                    t2.division_id,
                                                    t2.division_name

                                                    FROM tbl_district t1
                                                    JOIN tbl_division t2
                                                    ON t1.division_id = t2.division_id");
                	$statement->execute();
                	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
                	foreach ($result as $row) {
                		$i++;
    	            	?>
    	                <tr>
    	                    <td><?php echo $i; ?></td>
    	                    <td><?php echo $row['district_name']; ?></td>
                            <td><?php echo $row['division_name']; ?></td>
    	                    <td>
    	                        <a href="district-edit.php?id=<?php echo $row['district_id']; ?>" class="btn btn-primary btn-xs">Edit</a>
    	                        <a href="#" class="btn btn-danger btn-xs" data-href="district-delete.php?id=<?php echo $row['district_id']; ?>" data-toggle="district" data-target="#confirm-delete">Delete</a>
    	                    </td>
    	                </tr>
    	                <?php
                	}
                	?>
                </tbody>
            </table>
        </div>
      </div>
  
</section>


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="district" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
                Are you sure want to delete this item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>


<?php require_once('footer.php'); ?>