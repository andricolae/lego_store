<!DOCTYPE html>
<html>

<head>
<style>
    body {
        background: #fff;
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
    #header input[type=submit] {
        margin-left: 610px;
        margin-top: -280px;
        width: 70px;
        height: 40px;
        border-radius: 4px;
        border: 1px solid #425298;
        background: #fff;
        color: #425298;
    }
</style>
</head>

<body>
    <?php
        include("header_index.php");
        include("db.php");

        $query = $con->prepare("SELECT * FROM product_details WHERE title like '%" . $_GET['keyword'] . "%'");
        $query->execute();

        echo "<div id='prod'>
        <h1 style='text-shadow: 5px 5px 5px #000;box-shadow: 3px 3px 3px #000;padding-left:10px;margin-left:60px;
        margin-top:20px;width:92%;background:black;color:#fff;text-align:center;height:40px;
        line-height:40px;font-size:30px;border-radius:4px;'>Search for '" . $_GET['keyword'] . "'</h1>";
        while ($row = $query->fetch()) :
            echo "<ul>
                <li><a href='viewdetails.php?id=" . $row['product_id'] . "'>
                    <h1 style='text-align:center;'>" . $row['title'] . "</h1>
                    <img src='img/" . $row['product_image'] . "' style='width:260px;height:250px;margin-left:20px;border-radius:4px;'>
                    <h1 style='text-align:center;font-size:20px;font-weight:normal;margin-top:5px;'>Price " . $row['price'] . " RON</h1>
                </a></li>
            </ul>";
        endwhile;
    ?>
</body>
</html>