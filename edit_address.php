<!DOCTYPE html>
<html>
<head>
<style>
    #showaddress {
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
                line-height:40px;font-size:30px;border-radius:4px;'>Update Delivery to this Address</h1>        
            ";
        }
	?>
	<form method="post">
		<textarea name="address" style="font-size:20px;margin-left:300px;margin-top:100px;width:300px;height:60px;border-radius:4px;border:1px solid #425298;"><?php echo "" . $row['address'] . ""; ?></textarea>
		<br><input type="submit" name="updateaddress" value="UPDATE ADDRESS" style='margin-left:300px;font-size:20px;margin-bottom:20px;width:200px;height:50px;border-radius:4px;background:#fff;border:3px solid black;'>
	</form>
	</div>

</body>
</html>

<?php
    if (isset($_POST['updateaddress'])) {
        $address = $_POST['address'];
        $pdoResult = $con->prepare("UPDATE users SET address='$address' WHERE id='" . $row['id'] . "'");

        if ($pdoResult->execute()) {
            echo "<script>alert('Updated Successfully')</script>";
            echo "<script>window.open('deliveryaddress.php','_self')</script>";
        } else {
            echo "<script>alert('Updated not Successfully')</script>";
        }
    }
?>