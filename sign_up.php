<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


include 'includes/connection.php';

session_start();

$uname = @$_POST['username'];
$uname = ucwords($uname);
$email = @$_POST['email'];
$pass = @$_POST['password'];
$cpass = @$_POST['cpassword'];

$_SESSION['username'] = $uname;
$_SESSION['email'] = $email;

$user_check_query = "SELECT * FROM client_details WHERE username='$uname' LIMIT 1";
$user_result = mysqli_query($conn, $user_check_query);
$user_compare = mysqli_fetch_assoc($user_result);

$email_check_query = "SELECT * FROM client_details WHERE email='$email' LIMIT 1";
$email_result = mysqli_query($conn, $email_check_query);
$email_compare = mysqli_fetch_assoc($email_result);

if (isset($_POST['signup'])) {
	if (!preg_match('/^[a-zA-Z0-9]*$/', $uname)) {
		$_SESSION['error'] = "Username Can't have Special Characters!";
	} else if (!preg_match('/^[a-zA-Z0-9]{2,40}$/', $uname)) {
		$_SESSION['error'] = "Username Must be between 2-40 Characters";
	} else if (@$user_compare['username'] === $uname) {
		// if user exists 
		$_SESSION['error'] = $uname . " already Exists!";
	} else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		$_SESSION['error'] = "Your Email is Not Valid!";
	} else if (@$email_compare['email'] === $email) {
		// if email exists
		$_SESSION['error'] = $email . " already Exists!";
	} else if (!preg_match('/^(?=.*\d)(?=.*[a-zA-Z])(?=.*[@#$%^&-+=()]).*$/', $pass)) {
		$_SESSION['error'] = "Password Must Contain Numbers, Alphabets & Special Characters!";
	} else if (!preg_match('/^(?=.*\d)(?=.*[a-zA-Z])(?=.*[@#$%^&-+=()])(?=\S+$).{6,20}$/', $pass)) {
		$_SESSION['error'] = "Password length to be 6-20! Space is not Allowed!";
	} else if ($cpass != $pass) {
		$_SESSION['error'] = "Confirm Password Not Matching!";
	} else {
		$encpass = md5($pass);
		$now = date('Y-m-d h:i:sa');
		//generate code
		$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$code = substr(str_shuffle($set), 0, 12);

		try {
			$query_insert = "insert into client_details(username,email,contact_no,residential_address,city,state,image,password,status,activate_code,reset_code,created_on_date) values ('$uname','$email','Null','Null','Null','Null','profile.jpg','$encpass',1,'$code','Null','$now')";
			$query_test = mysqli_query($conn, $query_insert);


			try {
				unset($_SESSION['username']);
				unset($_SESSION['email']);

				header('location:login.php');
			} catch (Exception $e) {
				$_SESSION['error'] = 'Problem While Sign Up!';
				header('location:sign_up.php');
			}
		} catch (Exception $e) {
			$_SESSION['error'] = $e->getMessage();
		}
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Infigreen Create Account</title>
	<link rel="stylesheet" type="text/css" href="plugins/customcss/common.css" />
	<link rel="stylesheet" type="text/css" href="plugins/customcss/customstyle.css" />

	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">

	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		.alert-danger {
			padding: 10px;
			margin: 0px 0px 13px 0px;
		}

		.outside a {
			display: inline-block;
			color: #337ab7;
		}

		.outside a:hover {
			color: #208f4ae3;
			text-decoration: underline;
			font-size: medium;
		}

		.home-modify a {
			padding-inline-start: 60px;
		}

		.home-modify a:hover {
			color: #208f4ae3;
			font-size: medium;
		}

		.login-box {
			width: 375px;
			margin: 4% auto;
		}

		.login-content h2 {
			margin: 7px 0px 30px 0px;
		}

		.login-content {
			align-items: start;
			padding-top: 20px;
		}
	</style>
</head>

<body>
	<img class="wave" src="images/client/login/wave.png">
	<div class="container">
		<div class="img">
			<img src="images/client/login/bg.svg">
		</div>
		<div class="login-content">
			<form action="" method="POST" class="login-form">
				<div class="login-box">
					<?php
					if (isset($_SESSION['error'])) {
						echo "
				  <div class='alert alert-danger' role='alert'>
					  <p>" . $_SESSION['error'] . "</p> 
					  </div>
				  ";
						unset($_SESSION['error']);
					}
					if (isset($_SESSION['success'])) {
						echo "
					<div class='alert alert-success p-4' role='alert'>
						<p>" . $_SESSION['success'] . "</p> 
						</div>
					";
						unset($_SESSION['success']);
					}
					?>
					<img src="images/admin/login/avatar.svg">
					<h2 class="title">Create New Account</h2>
					<!-- username field -->
					<div class="input-div one">
						<div class="i">
							<i class="fa fa-user"></i>
						</div>
						<div class="div">
							<h5>Username</h5>
							<input type="text" class="input" name="username" value="<?php echo $uname; ?>" required>
						</div>
					</div>
					<!-- Email Field -->
					<div class="input-div one">
						<div class="i">
							<i class="fa fa-envelope"></i>
						</div>
						<div class="div">
							<h5>Email</h5>
							<input type="text" class="input" name="email" value="<?php echo $email; ?>" required>
						</div>
					</div>
					<!-- Password Field -->
					<div class="input-div pass">
						<div class="i">
							<i class="fa fa-lock"></i>
						</div>
						<div class="div">
							<h5>Password</h5>
							<input type="password" class="input" name="password" required>
						</div>
					</div>
					<!--  Confirm password -->
					<div class="input-div pass">
						<div class="i">
							<i class="fa fa-lock"></i>
						</div>
						<div class="div">
							<h5>Confirm Password</h5>
							<input type="password" class="input" name="cpassword" required>
						</div>
					</div>
					<!-- create account -->
					<input name="signup" type="submit" class="btn" value="Create Account">
				</div>
				<div style="display: flex; padding-inline-start: 19px;">
					<div class="outside">
						<text>Already have an account?</text>
						<a href="login.php">Sign In</a>
					</div>
					<div class="home-modify">
						<a href="index.php"><i class="fa fa-home"></i> Home</a>
					</div>
				</div>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="plugins/customjs/main.js"></script>
	<?php include 'includes/scripts.php' ?>
</body>

</html>