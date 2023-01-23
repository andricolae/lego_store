<html>
<head>
<style>
    * {
        margin: 0%;
    }
    body {
        background: #fffd8c;
    }
    h1 {
        text-align: center;
        color: #fff;
        background: black;
        border-radius: 4px;
        border: 2px solid #fff;
        margin-top: 50px;
    }
    table {
        width: 90%;
        height: auto;
        margin-left: 30px;
        border-radius: 10px;
        margin-top: 5px;
        background: #fff;
    }
    table,
    th,
    tr,
    td {
        border-collapse: collapse;
        border: 1px solid #400040;
        padding: 5px;
    }
    table td {
        text-align: center;
        font-size: 20px;
        color: #400040;
    }
    table th {
        font-size: 23px;
        color: #400040;
    }
    img {
        width: 50px;
        height: 50px;
    }
</style>
</head>

<body>
    <?php include("menubaradmin.php") ?>

    <h1>Manage Store Data</h1>
    <form method="post">
        <input type="text" name="search" placeholder="Search Item" style="margin-left:60px;margin-top:10px;border-radius:4px;border:3px solid black;width:300px;height:40px;padding-left:5px;font-size:20px;">
        <input type="submit" name="search_btn" value="Search" style="background:#fff;margin-left:10px;margin-top:10px;border-radius:4px;border:3px solid black;width:100px;height:40px;font-size:20px;">
    </form>
    <table>
        <tr>
            <th>Nr. Crt.</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Title</th>
            <th>Collection</th>
            <th>Description</th>
            <th>Price</th>
            <th>Product Image</th>
        </tr>

        <?php
        include("db.php");

        if (!isset($_POST['search_btn'])) {
            $query = $con->prepare("SELECT * FROM product_details ORDER BY 1 DESC");
            $query->execute();
        }
        if (isset($_POST['search_btn'])) {
            $getdata = $_POST['search'];
            $query = $con->prepare("SELECT * FROM product_details WHERE title LIKE '%$getdata%'");
            $query->execute();
        }
        $i = 1;
        while ($row = $query->fetch()) :
            echo "<tr>
                <td>" . $i++ . "</td>
			    <td><a href='edit_product_details.php?id=" . $row['product_id'] . "'>Edit</td>
				<td><a href='delete_product_details.php?id=" . $row['product_id'] . "'>Delete</td>

				<td>'" . $row['title'] . "'</td>
                <td>'" . $row['collection'] . "'</td>
                <td>'" . $row['description'] . "'</td>
                <td>'" . $row['price'] . "'</td>
                <td><img src='img/" . $row['product_image'] . "'></td>
			</tr>";
        endwhile;
        ?>
    </table>

</body>
</html>