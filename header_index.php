<!DOCTYPE html>
<html>

<head>
    <style>
        * {
            margin: 1%;
        }

        #header {
            background: #f2d974;
            width: 100%;
            height: 150px;
        }

        #header img {
            width: 125px;
            height: 125px;
            border-radius: 5px;
        }

        #header h1 {
            text-align: left;
            margin-left: 200px;
            margin-top: -125px;
            color: #000000;
        }

        #header ul li {
            float: right;
            margin-right: 20px;
            font-size: 20px;
            margin-top: -30px;
        }

        #header ul li a {
            color: black;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div id="header">
        <a href="index.php"><img src="img/lego.ico"></a>
        <h1>ONLINE LEGO STORE</h1>

        <ul>
            <?php
            include("db.php");

            if (!isset($_COOKIE['usernameget'])) {
                echo "<li><a href='login.php'>Login</a></li>
                <li><a href='signup.php'>Sign Up</a></li>";
            }

            if (isset($_COOKIE['usernameget'])) {
                $query = $con->prepare("SELECT * FROM users WHERE username='" . $_COOKIE['usernameget'] . "'");
                $query->execute();
                $row = $query->fetch();
                $query21 = $con->prepare("SELECT * FROM add_to_cart WHERE user_id='" . $row['id'] . "' ORDER BY 1 DESC");
                $query21->execute();
                $rcount = $query21->rowCount();
                echo "<li><a href='logout.php'>Logout</a></li>
                <li><a href='myaccount.php'>My Account</a></li>
                <li><a href='cart.php'>Cart (<b style='color:yellow;'>$rcount</b>)</a></li>";
            }

            ?>
        </ul>

        <?php
        if (isset($_COOKIE['usernameget'])) {
            echo "<h2 style='border-radius:4px;padding:10px;float:right;margin-right:-320px;margin-top:-85px;color:black;border:1px solid black;'>
        Welcome " . $_COOKIE['usernameget'] . "</h2>";
        }
        ?>
        <form method="post">
            <input type="text" name="search1" required style="margin-left:800px;margin-top:10px;width:300px;height:40px;border-radius:4px;border:1px solid #425298;">
            <input type="submit" name="search" value="Search" style="position:relative;margin-left:10px;margin-top:-40px;width:70px;height:40px;border-radius:4px;border:1px solid #425298;background:#fff;color:#425298;">
        </form>
    </div>

</body>

</html>

<?php
if (isset($_POST['search'])) {
    $keyword = $_POST['search1'];
    header("location:search.php?keyword=$keyword");
}
?>