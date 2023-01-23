<?php 
    if (isset($_POST['addcart'])) {
        header("location:add_to_cart.php?id=" . $row['[product_id]'] . "");
    } 
?>

<html>
<head>
<style>
    #prod {
        margin-top: 25%;
    }
    #prod ul li {
        box-shadow: 5px 5px 5px #400040;
        width: 300px;
        height: 350px;
        background: #fff;
        float: left;
        margin-top: 30px;
        margin-left: 20px;
        list-style-type: none;
        border: 1px solid #000;
        border-radius: 4px;
    }
    #prod ul li a {
        text-decoration: none;
        color: #000;
    }
    #prod1 ul li {
        width: 300px;
        height: 335px;
        float: left;
        margin-top: 20px;
        margin-right: 20px;
        list-style-type: none;
        border-radius: 4px;
        text-shadow: 5px 5px 5px #000;
        box-shadow: 3px 3px 3px #000;
        margin-left:20px;
    }
    #prod1 ul li img {
        width: 300px;
        height: 335px;
        border-radius: 4px;
        text-shadow: 5px 5px 5px #000;
        box-shadow: 3px 3px 3px #000;
    }
    #prod2 ul li {
        background: #fff;
        color: #400040;
        float: left;
        margin-top: 10px;
        margin-right: 50px;
        list-style-type: circle;
        font-size: 25px;
        border: 1px solid white;
        margin-left: 20px;
    }
    #img_container {
        width: 800px;
        height: 270px;
        background: #fff;
        margin-left: 38%;
        margin-top: -270px;
        border: 2px solid #425298;
        border-radius: 4px;
        text-shadow: 5px 5px 5px #000;
        box-shadow: 3px 3px 3px #000;
    }
    #img_container ul li {
        float: left;
        list-style-type: none;
        margin-right: 50px;
        margin-top: 10px;
    }
</style>
</head>

<body>
    <?php include("header_index.php"); ?>

    <?php 
        if (isset($_GET['id'])) {
            include("db.php");
            $id = $_GET['id'];
            $query = $con->prepare("SELECT * FROM product_details WHERE product_id='$id'");
            $query->execute();
            $row23 = $query->rowCount();
            $row = $query->fetch();
        } 
    ?>

    <form method="post">
        <h1 style='text-shadow: 5px 5px 5px #000;box-shadow: 3px 3px 3px #000;padding-left:10px;margin-left:60px;
        margin-top:20px;width:92%;background:black;color:#fff;text-align:center;height:40px;
        line-height:40px;font-size:30px;border-radius:4px;'><?php echo "" . $row['title'] . ""; ?></h1>
        <div id="prod1">
            <ul>
                <li><a href="img/<?php echo "" . $row['product_image'] . ""; ?>"><img src="img/<?php echo "" . $row['product_image'] . ""; ?>"></a></li>
            </ul>
        </div>
        <br>
        <div id="prod2">
            <ul>
                <li style="margin-left:100px;">Collection: <?php echo "" . $row['collection'] . ""; ?></li><br><br><br><br>
                <li style="margin-left:100px;">Price: <?php echo "" . $row['price'] . " RON"; ?></li><br><br><br><br>
                <li style="margin-left:100px;margin-top:50px;"><a href="add_to_cart.php?id=<?php echo "" . $row['product_id'] . ""; ?>" style="width:300px;height:50px;
                background:#fff;color:#400040;border:2px solid #400040;text-decoration:none;padding:10px;">BUY</a></li>
                <li style="margin-left:100px;">Description: <?php echo "" . $row['description'] . ""; ?></li>
            </ul>
        </div>
    </form>
    
    <?php
        $query = $con->prepare("SELECT * FROM product_details WHERE collection='" . $row['collection'] . "' and product_id!='" . $row['product_id'] . "' ORDER BY 1 DESC LIMIT 0,3");
        $query->execute();
        echo "<div id='prod'>
            <h1 style='text-shadow: 5px 5px 5px #000;box-shadow: 3px 3px 3px #000;padding-left:10px;margin-left:60px;
            margin-top:20px;width:92%;background:black;color:#fff;text-align:center;height:40px;
            line-height:40px;font-size:30px;border-radius:4px;'>From the same collection</h1>";

        while ($row1 = $query->fetch()) :
            echo "<ul>
                <li><a href='viewdetails.php?id=" . $row1['product_id'] . "'>
                    <h1 style='text-align:center;'>" . $row1['title'] . "</h1>
                    <img src='img/" . $row1['product_image'] . "' style='width:260px;height:250px;margin-left:20px;border-radius:4px;'>
                    <h1 style='text-align:center;font-size:20px;font-weight:normal;margin-top:10px;'>Price: " . $row1['price'] . " RON</h1>
                </a></li>
            </ul>";
        endwhile;
        echo "</div> <br>";
    ?>
</body>
</html>