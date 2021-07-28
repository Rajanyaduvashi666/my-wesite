<?php  
include('../config.php');
$mode=$_REQUEST['mode'];

switch($mode)
{
	case "user":
		$id=$_REQUEST['row_id'];

		mysqli_query($db,"DELETE FROM `my_user` WHERE `id`='$id'");
		echo "Delete Successfully";
	break;

	case "product":
		$id=$_REQUEST['row_id'];

		mysqli_query($db,"DELETE FROM `my_products` WHERE `id`='$id'");
		echo "Delete Successfully";
	break;

	case "activate":
        $id=$_REQUEST['row_id'];
		mysqli_query($db,"UPDATE `my_products` SET `status`='1' WHERE `id`='$id'");
		?>
            <span onclick="changeStatus(<?php echo $id; ?>,'deactivate')" class="btn btn-success btn-sm">Active</span>
		<?php
	break;

	case "deactivate":
       $id=$_REQUEST['row_id'];
		mysqli_query($db,"UPDATE `my_products` SET `status`='2' WHERE `id`='$id'");
	?>
            <span onclick="changeStatus(<?php echo $id; ?>,'activate')" class="btn btn-danger btn-sm">Deactive</span>
		<?php
	break;
}

?>