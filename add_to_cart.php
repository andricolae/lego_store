<?php
    if(isset($_COOKIE['usernameget'])){

        include("db.php");
        $query=$con->prepare("SELECT * FROM users WHERE username='".$_COOKIE['usernameget']."'");

        $query->execute();
        $row=$query->fetch();
        
        if(isset($_GET['id'])){
            $query22=$con->prepare("SELECT * FROM product_details WHERE product_id='".$_GET['id']."'");

            $query22->execute();
            $row1=$query22->fetch();
            
            $query21=$con->prepare("SELECT * FROM add_to_cart WHERE item_id='".$row1['product_id']."' and user_id='".$row['id']."'");

            $query21->execute();
            $row21=$query21->rowCount();
            
            if($row21==0){
                $query1=$con->prepare("INSERT INTO add_to_cart(item_id,user_id,quantity) VALUES('".$row1['product_id']."','".$row['id']."','1')");

                if($query1->execute()){
                    echo"<script>alert('Product added to your cart')</script>>";
                    echo"<script>window.open('cart.php?id=".$row1['product_id']."','_self')</script>";
                }
            }
            else{
                echo"<script>alert('Product is already in your cart')</script>>";
                echo"<script>window.open('viewdetails.php?id=".$row1['product_id']."','_self')</script>";
            }						
        }
    }
    else{
        if(isset($_GET['id'])){
            include("db.php");
                $query22=$con->prepare("SELECT * FROM product_details WHERE product_id='".$_GET['id']."'");
                $query22->execute();
                $row1=$query22->fetch();
        }
        echo"<script>alert('Please login so you can add to cart')</script>>";
        echo"<script>window.open('viewdetails.php?id=".$row1['product_id']."','_self')</script>";     
    }
?>