<?php
	if(isset($_GET['id']))
	{
        include("db.php");
        $prodid=$_GET['id'];
        $query=$con->prepare("DELETE FROM product_details WHERE product_id='$prodid'");
        if($query->execute()){
            echo"<script>alert('Deleted Succefully')</script>";
            echo"<script>window.open('adminshop.php','_self')</script>";
        }
        else{
            echo"<script>alert('Delete Not Succefully')</script>";
        }
	}
?>