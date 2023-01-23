<html>
<head>

<style>
    body {
        background: white;
    }
    #box1 {
        border: 1px solid black;
        padding-left: 200px;
        color: black;
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
        border: 2px solid black;
    }
    table td {
        text-align: center;
        padding: 10px;
        font-size: 20px;
    }
    #show {
        background: #fff;
    }
</style>
</head>

<body>
    <a href="index.php" style="color:black;font-size:25px;">Return to Home</a>
    
    <?php
    include("db.php");

    $a = 1;
    $name = $_COOKIE['usernameget'];
    $orderdetails = $con->prepare("SELECT * FROM users WHERE username='$name'");

    $orderdetails->execute();

    $row = $orderdetails->fetch();

    $userid = $row['id'];

    echo "<h1 style='text-shadow: 5px 5px 5px #000;box-shadow: 3px 3px 3px #000;padding-left:10px;margin-left:60px;
        margin-top:20px;width:92%;background:black;color:#fff;text-align:center;height:40px;
        line-height:40px;font-size:30px;border-radius:4px;'>Member Info</h1>";
    echo "<div id='box1'>";
    echo "<h2>" . $row['username'] . "</h2>";
    echo "<h2>" . $row['address'] . ",</h2>";
    echo "<h2>" . $row['email'] . "</h2>";
    echo "<h2>" . $row['phone'] . "</h2><br><a href='edit_info.php?userid=" . $row['id'] . "'>
    <input type='submit' value='Edit Info' style='font-size:20px;margin-bottom:20px;width:100px;height:50px;border-radius:4px;background:#fff;border:3px solid black;'></a>";

    echo "</div>";
    ?>

    <div id="show">
        <h1 style='text-shadow: 5px 5px 5px #000;box-shadow: 3px 3px 3px #000;padding-left:10px;margin-left:60px;
        margin-top:20px;width:92%;background:black;color:#fff;text-align:center;height:40px;
        line-height:40px;font-size:30px;border-radius:4px;'>Your Orders</h1>
        <hr style="color:#425298;">
        <table>
            <tr>
                <th>Nr. Crt.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Date</th>
                <th>Total</th>
            </tr>
            <?php
                include("db.php");
                $query = $con->prepare("SELECT * FROM users WHERE username='" . $_COOKIE['usernameget'] . "'");
                $query->execute();

                $row = $query->fetch();

                $query21 = $con->prepare("SELECT * FROM orders WHERE user_id='" . $row['id'] . "' order by 1 desc");
                $query21->execute();
                $r = 1;
                $b = 0;
                while ($row1 = $query21->fetch()) :
                    $qty = $row1['quantity'];
                    $getprodid = $row1['product_id'];
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
                            <td>" . $row2['price'] . " RON</td>
                            <td><b>" . $row1['quantity'] . " </b></td>
                            <td><b>" . $row1['date_ord'] . " </b></td>
                            <td>$a RON</td>
                        </tr>";
                    endwhile;
                endwhile;
            ?>
    </div>
</body>
</html>