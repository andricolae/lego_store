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
            line-height:40px;font-size:30px;border-radius:4px;'>Add New Product</h1>
            <table>
                <tr>
                    <td>Enter Product Title:</td>
                    <td><input type="text" name="prodtitle" placeholder="Enter the product's name"></td>
                </tr>
                <tr>
                    <td>Enter Product Description:</td>
                    <td><input type="text" name="proddetails" placeholder="Enter the product's details"></td>
                </tr>
                <tr>
                    <td>Enter Collection:</td>
                    <td><input type="text" name="prodcollection" placeholder="Enter the product's collection"></td>
                </tr>
                <tr>
                    <td>Enter Price:</td>
                    <td><input type="text" name="prodprice" placeholder="Enter the product's price"></td>
                </tr>
                <tr>
                    <td>Enter Product Image:</td>
                    <td><input type="file" name="prodimg"></td>
                </tr>
            </table>
            <input type="submit" name="click" value="Add Product" style="margin-left:400px;font-size:25px;margin-bottom:20px;width:200px;height:50px;border-radius:4px;background:#fff;border:3px solid black;">
        </div>
    </form>
</body>

</html>
<?php

if (isset($_POST['click'])) {
    include("db.php");

    $title = $_POST['prodtitle'];
    $description = $_POST['proddetails'];
    $coll = $_POST['prodcollection'];
    $price = $_POST['prodprice'];
    $img = $_FILES['prodimg']['name'];
    $prod_img_temp = $_FILES['prodimg']['tmp_name'];
    move_uploaded_file($prod_img_temp, "img/$img");

    $query = $con->prepare("INSERT INTO product_details(title, description, collection, price, product_image) 
        VALUES('$title','$description','$coll','$price','$img')");

    if ($query->execute()) {
        echo "<script>alert('Stored Product Details')</script>";
    } else {
        echo "<script>alert('Product Details Not Stored')</script>";
    }
}
?>