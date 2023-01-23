<?php
	if(isset($_GET['cart_id'])){
        include("db.php");
        $prodid=$_GET['cart_id'];
        $query=$con->prepare("DELETE FROM add_to_cart WHERE id='$prodid'");
        
        if($query->execute())
        {
            echo"<script>alert('Deleted Successfully')</script>";
            echo"<script>window.open('place_order.php?method=cod','_self')</script>";
        }
        else
        {
            echo"<script>alert('Deleted Not Successfully')</script>";
        }
	}
?>