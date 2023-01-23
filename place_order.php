<?php
    if (isset($_POST['place'])) {
        include("db.php");
        $query = $con->prepare("SELECT * FROM users WHERE username='" . $_COOKIE['usernameget'] . "'");
        $query->execute();
        $row = $query->fetch();

        $query21 = $con->prepare("SELECT * FROM add_to_cart WHERE user_id='" . $row['id'] . "' ORDER BY 1 DESC");
        $query21->execute();

        while ($row1 = $query21->fetch()) :
            $query211 = $con->prepare("INSERT INTO orders(product_id,quantity,user_id,date_ord,order_pending) VALUES('" . $row1['item_id'] . "','" . $row1['quantity'] . "','" . $row1['user_id'] . "',Now(), 1)");
            $query211->execute();
        endwhile;

        $query221 = $con->prepare("DELETE FROM add_to_cart WHERE user_id='" . $row['id'] . "'");
        $query221->execute();

        echo "<script>alert('Order Placed!')</script>";
        echo "<script>window.open('myaccount.php','_self')</script>";
    }
?>

<!DOCTYPE html>
<html>
<head>
<style>
    #show {
        width: 90%;
        height: auto;
        background: #fff;
        margin-left: 70px;
        border-radius: 4px;
        box-shadow: 3px 3px 3px #000;
        border-radius: 4px;
        border: 2px solid #425298;
        margin-top: 20px;
    }
    #show table {
        border: 1px solid #000;
        ;
        width: 100%;
        border-collapse: collapse;
    }
    #show table td {
        text-align: center;
        padding: 15px;
    }
    #show table th {
        text-align: center;
        padding: 10px;
        font-size: 20px;
    }
</style>
</head>

<body>
    <?php
    include("header_index.php");
    ?>

    <div id="show">
    <h1 style='text-shadow: 5px 5px 5px #000;box-shadow: 3px 3px 3px #000;padding-left:10px;margin-left:60px;
    margin-top:20px;width:92%;background:black;color:#fff;text-align:center;height:40px;
    line-height:40px;font-size:30px;border-radius:4px;'>Order Details</h1>
        <table>
            <tr>
                <th>Nr. Crt.</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>

            <?php
                include("db.php");
                $query = $con->prepare("SELECT * FROM users WHERE username='" . $_COOKIE['usernameget'] . "'");
                $query->execute();
                $row = $query->fetch();

                $query21 = $con->prepare("SELECT * FROM add_to_cart WHERE user_id='" . $row['id'] . "' ORDER BY 1 DESC");
                $query21->execute();
                $r = 1;
                $b = 0;
                while ($row1 = $query21->fetch()) :
                    $qty = $row1['quantity'];
                    $getprodid = $row1['item_id'];
                    $getcartid = $row1['id'];
                    $query22 = $con->prepare("SELECT * FROM product_details WHERE product_id='$getprodid'");
                    $query22->execute();

                    while ($row2 = $query22->fetch()) :
                        $price = $row2['price'];
                        $a = $qty * $price;
                        $b = $b + $a;
                        echo "<tr>
                                <td><b>" . $r++ . "</b></td>
                                <td><b>" . $row2['title'] . "</b></td>
                                <td><b>" . $row2['price'] . " RON</b></td>
                                <td><b>" . $row1['quantity'] . " </b></td>
                                <td><b>$a RON</b></td>
                            </tr>";
                    endwhile;
                endwhile;
            ?>
            <tr>
                <td colspan="4" style="text-align:right;border-top:1px solid #400040;"><b style="color:red;font-size:25px;">Total</b></td>
                <td style="border-top:1px solid #400040;border-bottom:1px solid #400040;"><b style="font-size:20px;"> <?php echo "" . $b . ""; ?> RON</b></td>
            </tr>
            <tr>
                <td colspan="5" style="font-size:20px"><strong>PAYMENT METHOD: <?php echo "" . $_GET['method'] . ""; ?></strong></td>
            </tr>
            <tr>
                <td colspan="5">
                    <form method="post"><input type="submit" name="place" value="Place Order" style="font-size:25px;margin-bottom:20px;width:200px;height:50px;border-radius:4px;background:#fff;border:3px solid black;"></form>
                </td>
            </tr>
        </table>
    </div>

    <div id="show">
    <h1 style='text-shadow: 5px 5px 5px #000;box-shadow: 3px 3px 3px #000;padding-left:10px;margin-left:60px;
    margin-top:20px;width:92%;background:black;color:#fff;text-align:center;height:40px;
    line-height:40px;font-size:30px;border-radius:4px;'>Order Details table </h1>
        <table>
            <tr>
                <th>Nr. Crt.</th>
                <th>Product</th>
                <th>Product Image</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Remove</th>
                <th>Total</th>
            </tr>

            <?php
                $query = $con->prepare("SELECT * FROM users WHERE username='" . $_COOKIE['usernameget'] . "'");
                $query->execute();
                $row = $query->fetch();

                $query21 = $con->prepare("SELECT * FROM add_to_cart WHERE user_id='" . $row['id'] . "' ORDER BY 1 DESC");
                $query21->execute();
                $r = 1;
                $b = 0;
                while ($row1 = $query21->fetch()) :
                    $qty = $row1['quantity'];
                    $getprodid = $row1['item_id'];
                    $getcartid = $row1['id'];
                    $query22 = $con->prepare("SELECT * FROM product_details WHERE product_id='$getprodid'");
                    $query22->execute();

                    while ($row2 = $query22->fetch()) :
                        $price = $row2['price'];
                        $a = $qty * $price;
                        $b = $b + $a;
                        echo "<tr>
                            <td>" . $r++ . "</td>
                            <td>" . $row2['title'] . "</td>
                            <td><img src='img/" . $row2['product_image'] . "' style='width:120px;height:120px;border-radius:4px;'></td>
                            <td>Rs. " . $row2['price'] . "</td>
                            <td><b>" . $row1['quantity'] . " </b><form method='get'><input type='text' name='qty' value='" . $row1['quantity'] . "' 
                            style='width:40px;height:20px;'><input type='hidden' name='cart_id' value='" . $row1['id'] . "' 
                            style='width:40px;height:20px;'><input type='submit' name='upqty' value='add' style='width:40px;height:20px;background:#fff;
                            color:#400040;border:1px solid #400040;margin-left:10px;'></form></td>

                            <td><a href='remove_products.php?cart_id=$getcartid'>Remove</a></td>
                            <td>$a RON</td>
                        </tr>";
                    endwhile;
                endwhile;
            ?>
    </div>
</body>
</html>

<?php
    if (isset($_GET['upqty'])) {
        $qty = $_GET['qty'];
        $cartid = $_GET['cart_id'];
        if ($qty <= 5) {
            $query = $con->prepare("UPDATE add_to_cart SET quantity='$qty' WHERE id='$cartid'");
            if ($query->execute()) {
                echo "<script>alert('Updated Successfully')</script>";
                echo "<script>window.open('place_order.php?method=cod','_self')</script>";
            } 
            else {
                echo "<script>alert('Updated Not Successfully')</script>";
            }
        } 
        else {
            echo "<script>alert('Maximum 5 items allowed to buy')</script>";
            echo "<script>window.open('place_order.php?method=cod','_self')</script>";
        }
    }
?>