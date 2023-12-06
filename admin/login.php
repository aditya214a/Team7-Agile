<?php

include 'includes/connection.php';

session_start();

$uname = @$_POST['username'];
$pass = @$_POST['password'];

$unameErr = $passErr = "";

if (isset($_POST['login'])) {
	if ($uname == "") {
		$unameErr = "You Forgot To Enter Username!";
	} else if (empty($pass)) {
		$passErr = "You Forgot To Enter Password!";
	} else {
		$encpass = md5($pass);
		$user_query = "SELECT * FROM admin_details WHERE username='$uname'";
		$user_pass_query = "SELECT * FROM admin_details WHERE username='$uname' AND password='$encpass'";

		$user_result = mysqli_query($conn, $user_query);
		$user_final_result = mysqli_fetch_assoc($user_result);
		$user_pass_result = mysqli_query($conn, $user_pass_query);
		if (mysqli_num_rows($user_result) != 1) {
			$_SESSION['error'] = "Username is Invalid!";
		} else if (mysqli_num_rows($user_pass_result) != 1) {
			$_SESSION['error'] = "Password is Invalid!";
		} else {
			$_SESSION['users'] = $uname;
			$_SESSION['admin_id'] = $user_final_result['admin_id'];
			$_SESSION['success'] = "You are now logged in Successfully";
			mysqli_close($conn);
			header('location: home.php');
		}
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Admin Login Form</title>
	<link rel="stylesheet" type="text/css" href="../plugins/customcss/common.css" />
	<link rel="stylesheet" type="text/css" href="../plugins/customcss/customstyle.css" />
	<!-- CSS only -->
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"> -->
	<!-- <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 -->
	<!-- Theme style -->
	<link rel="stylesheet" href="../dist/css/AdminLTE.min.css">

	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		.alert-danger {
			padding: 10px;
			margin: 0px 0px 20px 0px;
		}

		.login-content .input-div {
			margin: 0 0;
		}
	</style>
</head>

<body>
	<img class="wave" src="../images/admin/login/wave.png">
	<div class="container">
		<div class="img">
			<img src="../images/admin/login/bg.svg">
		</div>
		<div class="login-content">
			<form action="login.php" method="POST" class="login-form">
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

					?>
					<img src="../images/admin/login/avatar.svg">
					<h2 class="title">Welcome to Admin Login</h2>
					<div class="input-div one">
						<div class="i">
							<i class="fas fa-user"></i>
						</div>
						<div class="div">
							<h5>Username</h5>
							<input type="text" class="input" name="username" value="<?php echo $uname; ?>">
						</div>
					</div>
					<p class="invalid" style="padding: 6px 2px 15px 2px;"><?php if (isset($unameErr)) echo $unameErr; ?></p>
					<div class="input-div pass">
						<div class="i">
							<i class="fas fa-lock"></i>
						</div>
						<div class="div">
							<h5>Password</h5>
							<input type="password" class="input" name="password">
						</div>
					</div>
					<p class="invalid" style="padding: 6px 2px 15px 2px;"><?php if (isset($passErr)) echo $passErr; ?></p>
					<input name="login" type="submit" class="btn" value="Login">
				</div>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="../plugins/customjs/main.js"></script>
	<?php include 'includes/scripts.php' ?>
</body>

</html>