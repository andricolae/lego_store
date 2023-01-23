<?php
	if(isset($_GET['id']))
	{
        include("db.php");
        $ordid=$_GET['id'];
        $query=$con->prepare("UPDATE orders SET order_pending='0' WHERE id='$ordid'");
        if($query->execute()){
            echo"<script>alert('Order Updated Succefully')</script>";
            echo"<script>window.open('manage_orders.php','_self')</script>";
        }
        else{
            echo"<script>alert('Update Not Done Succefully')</script>";
        }
	}
?>