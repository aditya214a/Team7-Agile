<?php
include 'includes/connection.php';

session_start();

$uname = @$_POST['username'];
$pass = @$_POST['password'];

if (isset($_POST['login'])) {
	$encpass = md5($pass);
	$user_query = "SELECT * FROM client_details WHERE username='$uname'";
	$user_pass_query = "SELECT * FROM client_details WHERE username='$uname' AND password='$encpass'";

	$user_result = mysqli_query($conn, $user_query);
	$user_pass_result = mysqli_query($conn, $user_pass_query);
	$check_activation = mysqli_fetch_assoc($user_result);
	if (mysqli_num_rows($user_result) != 1) {
		$_SESSION['error'] = "Username is Invalid!";
	} else if (mysqli_num_rows($user_pass_result) != 1) {
		$_SESSION['error'] = "Password is Invalid!";
	} else if ($check_activation['status'] == '0') {
		$_SESSION['error'] = "Your Account is Not Activated! Please Activate It!";
	} else {
		$_SESSION['client_users'] = $uname;
		$_SESSION['success'] = "Welcome " . $uname . " to Infigreen World! Namaste :)";
		mysqli_close($conn);
		header('location: index.php');
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Infigreen Login</title>
	<link rel="stylesheet" type="text/css" href="plugins/customcss/common.css" />
	<link rel="stylesheet" type="text/css" href="plugins/customcss/customstyle.css" />

	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">

	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		.alert-danger {
			padding: 10px;
			margin: 0px 0px 20px 0px;
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
			padding-inline-start: 47px;
		}

		.home-modify a:hover {
			color: #208f4ae3;
			font-size: medium;
		}

		.login-box {
			width: 375px;
			margin: 7% auto;
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
					  <div class='callout callout-success text-center'>
						<p>" . $_SESSION['success'] . "</p> 
					  </div>
					";
						unset($_SESSION['success']);
					}

					?>
					<img src="images/admin/login/avatar.svg">
					<h2 class="title">Welcome To Infigreen Sign In</h2>
					<div class="input-div one">
						<div class="i">
							<i class="fas fa-user"></i>
						</div>
						<div class="div">
							<h5>Username</h5>
							<input type="text" class="input" name="username" value="<?php echo $uname; ?>" required>
						</div>
					</div>
					<div class="input-div pass">
						<div class="i">
							<i class="fas fa-lock"></i>
						</div>
						<div class="div">
							<h5>Password</h5>
							<input type="password" class="input" name="password" required>
						</div>
					</div>
					<input name="login" type="submit" class="btn" value="Login">
				</div>
				<div style="display: flex; padding-inline-start: 19px;">
					<div class="outside">
						<text>Don't have an account?</text>
						<a href="sign_up.php">Create New</a>
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