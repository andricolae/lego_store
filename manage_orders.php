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

    <h1>Manage Orders</h1>

    <table>
        <tr>
            <th>Nr. Crt.</th>
            <th>Name</th>
            <th>Address</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Date</th>
            <th>Ship/Cancel</th>
        </tr>

        <?php
        include("db.php");

        $qorders = $con->prepare("SELECT * FROM orders WHERE order_pending='1' ORDER BY 1 DESC");
        $qorders->execute();

        $i = 1;
        while ($row = $qorders->fetch()) :
            $qusers = $con->prepare("SELECT * FROM users WHERE id='".$row['user_id']."'");
            $qusers->execute();
            $rowusers = $qusers->fetch();
            $qproducts = $con->prepare("SELECT * FROM product_details WHERE product_id='".$row['product_id']."'");
            $qproducts->execute();
            $rowproducts = $qproducts->fetch();

            echo "<tr>
                <td>" . $i++ . "</td>

				<td>'" . $rowusers['username'] . "'</td>
                <td>'" . $rowusers['address'] . "'</td>
                <td>'" . $rowproducts['title'] . "'</td>
                <td>'" . $row['quantity'] . "'</td>
                <td>'" . $row['date_ord'] . "'</td>

                <td><a href='update_order.php?id=" . $row['id'] . "'>Update</td>
			</tr>";
        endwhile;
        ?>
    </table>

</body>
</html>