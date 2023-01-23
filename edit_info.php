<html>

<head>
<title>Lego Store</title>
<style>
    body {
        margin: 0 auto;
        background-color:#fffd8c;
        background-repeat: no-repeat;
        background-size: 100% 680px;
    }
    .container-signup {
        width: 470px;
        height: auto;
        text-align: center;
		background-color:#a8d1f7;
        border-radius: 4px;
        margin: 0 auto;
        margin-top: 50px;
        opacity: 0.8;
        transition: width 0.4s ease-in-out;
    }
    .btn-signup {
        border-radius: 4px;
        padding: 5px 15px;
        font-weight: bold;
        margin-top: 10px;
        cursor: pointer;
        color: #00FFFF;
        margin-bottom: 3px;
    }
    input[type="text"],
    input[type="password"],
    input[type="email"] {
        width: 300px;
        height: 33px;
        border: none;
        border-radius: 4px;
        font-size: 15px;
        margin-bottom: 15px;
        margin-top: 15px;
        background-color: #fff;
        padding-left: 3px;
        transition: width 0.4s ease-in-out;
    }
    .btn-signup {
        border-radius: 4px;
        padding: 5px 15px;
        font-weight: bold;
        margin-top: 10px;
        margin-bottom: 10px;
        cursor: pointer;
        color: #400040;
        border: 3px solid black;
        background-color: #fff;
    }
    .btn-signup:hover {
        color: #fff;
        background: #400040;
    }
    input[type="password"]:focus {
        width: 50%;
        border: 2px solid aquamarine;
        background-color: #E9967A;
    }
    input[type="email"]:focus {
        width: 50%;
        border: 2px solid aquamarine;
        background-color: #E9967A;
    }
    input[type="text"]:focus {
        width: 50%;
        border: 2px solid aquamarine;
        background-color: #E9967A;
    }
    input[type="submit"]:focus {
        width: 20%;
        border: 3px solid black;
        background-color: #0000CD;
    }
</style>
</head>

<body>
    <?php
        if (isset($_GET['userid'])) {
            include("db.php");
            $getid = $_GET['userid'];
            $getaddress = $con->prepare("SELECT * FROM users WHERE id='$getid'");
            $getaddress->execute();
            $row = $getaddress->fetch();
        }
    ?>
    <div class="container-signup">
        <form method="post" enctype="multipart/form-data">
            <center>
                <input type="text" name="name" required placeholder="Enter Username" value="<?php echo "" . $row['username'] . ""; ?>">
                <input type="text" name="address" required placeholder="Enter Address" value="<?php echo "" . $row['address'] . ""; ?>">
                <input type="text" name="phone" required placeholder="Enter Phone Number" value="<?php echo "" . $row['phone'] . ""; ?>">
                <input type="email" name="email" required placeholder="Enter Email" value="<?php echo "" . $row['email'] . ""; ?>">
                <input type="password" name="password" required placeholder="Enter Password" value="<?php echo "" . $row['password'] . ""; ?>"><br>
                
                <input type="submit" name="submit" value="UPDATE" class="btn-signup">
            </center>
        </form>
    </div>
</body>
</html>

<?php
    if (isset($_POST['submit'])) {
        include("db.php");

        $username = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        setcookie('usernameget', $username, time() + 60 * 60 * 7);

        $pdoResult = $con->prepare("UPDATE users SET username='$username',phone='$phone',address='$address',email='$email',password='$password' WHERE id='$getid'");

        if ($pdoResult->execute()) {
            echo "Data inserted";
            header("location:myaccount.php");
        } else {
            echo "Data not inserted";
        }
    }
?>