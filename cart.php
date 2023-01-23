<html>
<head>
<title>Lego Store</title>
<style>
    #myBtn {
        display: none;
        position: fixed;
        bottom: 20px;
        right: 30px;
        z-index: 99;
        font-size: 18px;
        border: none;
        outline: none;
        background-color: red;
        color: white;
        cursor: pointer;
        padding: 15px;
        border-radius: 4px;
    }
    #myBtn:hover {
        background-color: #555;
    }
    table {
        width: 95%;
        height: auto;
        margin-left: 30px;
        border-collapse: collapse;
    }
    table th {
        font-size: 25px;
        border-collapse: collapse;
        border: 2px solid #400040;
    }
    table td {
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
    <h1 style='text-shadow: 5px 5px 5px #000;box-shadow: 3px 3px 3px #000;padding-left:10px;margin-left:60px;
        margin-top:20px;width:92%;background:black;color:#fff;text-align:center;height:40px;
        line-height:40px;font-size:30px;border-radius:4px;'>Your Cart</h1>
    <table>
        <tr>
            <th>Nr. Crt.</th>
            <th>Title</th>
            <th>Image</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Remove</th>
            <th>Total</th>
        </tr>
        <?php
        include("db.php");
        $query = $con->prepare("SELECT * FROM users WHERE username='" . $_COOKIE['usernameget'] . "'");
        $query->execute();
        $row = $query->fetch();
        $query21 = $con->prepare("SELECT * FROM add_to_cart WHERE user_id='" . $row['id'] . "' order by 1 desc");
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
                $rate = $row2['price'];
                $a = $qty * $rate;
                $b = $b + $a;
                echo "<tr>
                    <td>" . $r++ . "</td>
                    <td>" . $row2['title'] . "</td>
                    <td><img src='img/" . $row2['product_image'] . "' style='width:120px;height:120px;border-radius:4px;'></td>
                    <td>" . $row2['price'] . " RON</td>
                    <td><b>" . $row1['quantity'] . " </b><form method='get'><input type='text' name='qty' value='" . $row1['quantity'] . "' style='width:40px;
                    height:20px;'><input type='hidden' name='cart_id' value='" . $row1['id'] . "' style='width:40px;height:20px;'><input type='submit' 
                    name='upqty' value='add' style='width:40px;height:20px;background:#fff;color:#400040;border:1px solid #400040;margin-left:10px;'></form></td>
                    <td><a href='removecart.php?cart_id=$getcartid'>Remove</a></td>
                    <td>$a RON</td>
				</tr>";
            endwhile;
        endwhile;
    ?>
    <tr>
        <td colspan="6" style="text-align:right;border-top:1px solid #400040;"><b style="color:red;font-size:25px;">Total</b></td>
        <td style="border-top:1px solid #400040;border-bottom:1px solid #400040;"><?php echo "" . $b . ""; ?> RON</td>
    </tr>
    </table>
    <a href="deliveryaddress.php" style='margin-left:150px;font-size:25px;margin-bottom:20px;width:150px;height:100px;border-radius:4px;background:#fff;border:2px solid black;'>Checkout</a>
    <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>

    <script>
        window.onscroll = function() {
            scrollFunction()
        };
        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("myBtn").style.display = "block";
            } 
            else {
                document.getElementById("myBtn").style.display = "none";
            }
        }
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
    <script>
        function myFunction() {
            var x = "";
            x = document.getElementById("mySelect").value;
            window.open("" + x, "_self");
        }
    </script>

</body>
</html>

<?php
    if (isset($_GET['upqty'])) {
        include("db.php");

        $qty = $_GET['qty'];
        $cartid = $_GET['cart_id'];
        if ($qty <= 10) {
            $query = $con->prepare("UPDATE add_to_cart SET quantity='$qty' WHERE id='$cartid'");

            if ($query->execute()) {
                echo "<script>alert('updated Succefully')</script>";
                echo "<script>window.open('cart.php','_self')</script>";
            } else {
                echo "<script>alert('updated not Succefully')</script>";
            }
        } else {
            echo "<script>alert('maximum 3 products only buy')</script>";
            echo "<script>window.open('cart.php','_self')</script>";
        }
    }
?>