<!DOCTYPE html>
<html>

<head>
<style>
    #show {
        width: 90%;
        height: 300px;
        background: #fff;
        margin-left: 100px;
        border-radius: 4px;
        box-shadow: 3px 3px 3px #000;
        border-radius: 4px;
        border: 2px solid #425298;
        margin-top: 20px;
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
        line-height:40px;font-size:30px;border-radius:4px;'>Select Payment Method</h1>
        <form method="post">
            <select name="selmethod" style="margin-left:300px;font-size:20px;margin-bottom:20px;width:200px;height:50px;border-radius:4px;background:#fff;border:3px solid black;">
                <option value="select">Choose Method</option>
                <option value="cash">Cash On Delivery</option>
                <option value="card">Visa/Mastercard</option>
            </select>
            <input type="submit" name="payment" value="Select Payment" style="margin-left:50px;font-size:20px;margin-bottom:20px;width:200px;height:50px;border-radius:4px;background:#fff;border:3px solid black;">
        </form>
    </div>
</body>
</html>

<?php
    if (isset($_POST['payment'])) {
        $getvalue = $_POST['selmethod'];
        if ($getvalue == 'select') {
            echo "<script>alert('Select One Method')</script>";
        }
        if ($getvalue == 'cash') {
            header("location:place_order.php?method=$getvalue");
        }
        if ($getvalue == 'card') {
            header("location:place_order.php?method=$getvalue");
        }
    }
?>