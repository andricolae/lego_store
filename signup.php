<html>
<head>
<title>Sign Up</title>
<style>
	body{
		margin:0 auto;
        background-color:#fffd8c;
		background-repeat:no-repeat;
		background-size: 100% 680px;
	}
	.container-signup{
		width:530px;
		height: auto;
		text-align: center;
		background-color:#a8d1f7;
		border-radius: 4px;
		margin:0 auto;
		margin-top:20px;
		transition:width 0.4s ease-in-out;
	}
	.container-signup img{
		width:100px;
		height: 100px;
		margin-top:20px;
		margin-bottom:20px;
		border-radius:60px;
		border:none;
	}
	.btn-signup
	{
		border-radius: 4px;
		padding:5px 15px;
		font-weight:bold;
		margin-top:10px;
		cursor:pointer;
		color:#00FFFF;
		margin-bottom:3px;
		}
	input[type="text"],input[type="password"],input[type="email"]{
		width:300px;
		height: 33px;
		border:none;
		border-radius:4px;
		font-size:15px;
		margin-bottom:15px;
		background-color:#fff;
		padding-left:3px;
		transition:width 0.4s ease-in-out;
	}
	.btn-signup{
		border-radius: 4px;
		padding:5px 15px;
		font-weight:bold;
		margin-top:10px;
		cursor:pointer;
		color:#400040;
		border:1px solid aquamarine;;
		background-color:#fff;
	}
	.btn-signup:hover{
		color:#fff;
		background:#400040;
	}
	input[type="password"]:focus{
        width:50%;
        border:2px solid aquamarine;
        background-color:#E9967A;
    }	
    input[type="email"]:focus{
        width:50%;
        border:2px solid aquamarine;
        background-color:#E9967A;
    }	
    input[type="text"]:focus{
        width:50%;
        border:2px solid aquamarine;
        background-color:#E9967A;
    }	
    input[type="submit"]:focus{
        width:20%;
        border:5px solid black;
        background-color:#0000CD;
    } 
</style>
</head>

<body>
	<div class="container-signup">
		<form  method="post" enctype="multipart/form-data">
		<center>
            <br><b style="color:#fff;">	Username:</b><input type="text" name="name" required placeholder="Enter Username" style="margin-left:15px;">
            <br><b style="color:#fff;">	Address:</b><input type="text" name="address" required placeholder="Enter Address" style="margin-left:25px;">	
            <br><b style="color:#fff;">	Phone:</b><input type="text" name="phone" placeholder="Enter Phone Number" style="margin-left:35px;">
            <br><b style="color:#fff;">	Email:</b><input type="email" name="email" required placeholder="Enter Email" style="margin-left:35px;">
            <br><b style="color:#fff;">	Password:</b><input type="password" name="password" required placeholder="Enter Password" id="password_id" style="margin-left:15px;"><br>
                <b style="color:#fff;">Show password:</b><input type="checkbox" onclick="myfunction()" value="Show password" style="color:#fff;"><br>	
            <br><input type="submit" name="submit" value="SUBMIT" class="btn-signup">
		</center>
		</form>
    </div>	
    
<script>
    function myfunction(){
        var x=document.getElementById("password_id");
        if(x.type == "password")
        {
            x.type="text";
        }
        else
        {
            x.type="password";
        }
    }
</script>
</body>
</html>

<?php
    if(isset($_POST['submit'])) 
    {
        include("db.php");
        $username=$_POST['name'];
        $phone=$_POST['phone'];
        $address=$_POST['address'];
        $email=$_POST['email'];
        $password=$_POST['password'];
                
        $pdoResult=$con->prepare("INSERT INTO users (username,phone,address,email,password) VALUES ('$username','$phone','$address','$email','$password')");
            
        if($pdoResult->execute()){
            echo"<script>alert('Register succefully')</script>";
            echo"<script>window.open('login.php','_self')</script>";
        }
        else{
            echo "Info not submited!";
        }
    }
?>