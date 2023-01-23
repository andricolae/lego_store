<!DOCTYPE html>
<html>
<head>
<style>
    #showaddress {
        color: black;
        width: 90%;
        height: 400px;
        background: #fff;
        margin-left: 100px;
        border-radius: 4px;
        box-shadow: 3px 3px 3px #000;
        border-radius: 4px;
        border: 2px solid #425298;
        margin-top: 20px;
    }
    #showaddress li {
        list-style-type: none;
    }
</style>
</head>

<body>
    <?php
        if (isset($_COOKIE['usernameget'])) {
            include("db.php");
            $query = $con->prepare("SELECT * FROM users WHERE username='" . $_COOKIE['usernameget'] . "'");
            $query->execute();
            $row = $query->fetch();
            include("header_index.php");
            echo "<div id='showaddress'>
                <h1 style='text-shadow: 5px 5px 5px #000;box-shadow: 3px 3px 3px #000;padding-left:10px;margin-left:60px;
                margin-top:20px;width:92%;background:black;color:#fff;text-align:center;height:40px;
                line-height:40px;font-size:30px;border-radius:4px;'>Deliver to this Address</h1>
                <li style='text-align:center;margin-top:60px;font-size:30px;'>" . $row['address'] . "</li>
                <li style='margin-top:130px;margin-left:400px;'><a href='edit_address.php' style='font-size:30px;margin-bottom:20px;width:100px;height:50px;border-radius:4px;background:#fff;border:3px solid black;'>Edit Address</a></li>
                <li style='margin-top:-50px;margin-left:580px;'><a href='payment_type.php' style='font-size:30px;margin-bottom:20px;width:100px;height:50px;border-radius:4px;background:#fff;border:3px solid black;'>Continue with Checkout</a></li>
                </div>
            ";
        }
    ?>
</body>
</html>