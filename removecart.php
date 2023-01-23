<?php
if(isset($_GET['id'])){
    include("db.php");
    $prodid=$_GET['id'];
    $query=$con->prepare("DELETE FROM add_to_cart WHERE id='$prodid'");
    if($query->execute()){
        echo"<script>alert('Deleted Succefully')</script>";
        echo"<script>window.open('cart.php','_self')</script>";
    }
    else{
        echo"<script>alert('Deleted Not Succefully')</script>";
    }}
?>