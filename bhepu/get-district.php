<?php
include 'admin/config.php';
if($_POST['id'])
{
	$id=$_POST['id'];

	$statement = $pdo->prepare("SELECT * FROM tbl_district WHERE division_id=?");
	$statement->execute(array($id));
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	?><option value="">--Select District--</option><?php						
	foreach ($result as $row) {
		?>
        <option value="<?php echo $row['district_id']; ?>"><?php echo $row['district_name']; ?></option>
        <?php
	}
}