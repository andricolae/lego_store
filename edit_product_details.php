<?php
    if (isset($_GET['id'])) {
        include("db.php");
        $prodid = $_GET['id'];
        $query = $con->prepare("SELECT * FROM product_details WHERE product_id='$prodid'");
        $query->execute();
        $row = $query->fetch();
    }
?>

<html>
<head>
<style>
     * {
        margin: 0%;
    }
    body {
        background: #fffd8c;
    }
    #mainact {
        width: 1000px;
        height: auto;
        background: #fff;
        margin-left: 160px;
        box-shadow: 5px 5px 5px #400040;
        border: 2px solid #400040;
        margin-top: 10px;
    }
    #mainact h1 {
        text-align: center;
        color: #fff;
        background: #400040;
        border-radius: 4px;
        border: 2px solid #fff;
    }
    #mainact table {
        margin-left: 200px;
    }
    #mainact table tr td {
        font-size: 25px;
        padding: 5px;
        font-weight: bold;
        margin-top: 5px;
    }
    #mainact table tr td input {
        font-size: 20px;
        padding: 5px;
        width: 300px;
        height: 40px;
        border-radius: 4px;
        border: 2px solid black;
        margin-left: 50px;
        margin-top: 5px;
    }
</style>
</head>

<body>
    <?php include("menubaradmin.php") ?>

    <form method="post" enctype="multipart/form-data">
        <div id="mainact">
            <h1 style='text-shadow: 5px 5px 5px #000;box-shadow: 3px 3px 3px #000;padding-left:10px;margin-left:30px;
            margin-top:5px;width:92%;background:black;color:#fff;text-align:center;height:40px;
            line-height:40px;font-size:30px;border-radius:4px;'>Update Product Details</h1>
            <table>
                <tr>
                    <td>Product Title:</td>
                    <td><input type="text" name="prodtitle" placeholder="Enter the product's name" value="<?php echo "" . $row['title'] . ""; ?>"></td>
                </tr>
                <tr>
                    <td>Product Description:</td>
                    <td><input type="text" name="proddetails" placeholder="Enter the product's details" value="<?php echo "" . $row['description'] . ""; ?>"></td>
                </tr>
                <tr>
                    <td>Collection:</td>
                    <td><input type="text" name="prodcollection" placeholder="Enter the product's collection" value="<?php echo "" . $row['collection'] . ""; ?>"></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="text" name="prodprice" placeholder="Enter the product's price" value="<?php echo "" . $row['price'] . ""; ?>"></td>
                </tr>
                <tr>
                    <td>Product Image:</td>
                    <td><input type="file" name="prodimg">
                        <img src="img/<?php echo "" . $row['product_image'] . ""; ?>" style="width:60px;height:60px;">
                    </td>
                </tr>
            </table>
            <input type="submit" name="click" value="Update Product" style="margin-left:400px;font-size:25px;margin-bottom:20px;width:200px;height:50px;border-radius:4px;background:#fff;border:3px solid black;">
        </div>
    </form>
</body>
</html>

<?php
    if (isset($_POST['click'])) {

        $title = $_POST['prodtitle'];
        $description = $_POST['proddetails'];
        $coll = $_POST['prodcollection'];
        $price = $_POST['prodprice'];

        if ($_FILES['prodimg']['tmp_name'] == "") {
        } 
        else {
            $prodimg = $_FILES['prodimg']['name'];
            $prod_img_temp = $_FILES['prodimg']['tmp_name'];
            move_uploaded_file($prod_img_temp, "img/$prodimg");

            $up_img2 = $con->prepare("UPDATE product_details SET product_image='$prodimg' WHERE product_id='$prodid'");

            $up_img2->execute();
        }

        $query = $con->prepare("UPDATE product_details SET title='$title',description='$description',collection='$coll',price='$price' WHERE product_id='$prodid'");

        if ($query->execute()) {
            echo "<script>alert('Product Details Updated')</script>";
            echo "<script>window.open('adminshop.php','_self')</script>";
        } else {
            echo "<script>alert('Product Details Not Updated')</script>";
        }
    }
?>