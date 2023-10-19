<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>InfiGreen</title>
	<link rel="stylesheet" href="css/button.scss" type="text/css">
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
	<!-- Font Awesome -->

	<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
	<!-- Magnify -->
	<link rel="stylesheet" href="magnify/magnify.min.css">

	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

	<!-- Paypal Express -->
	<script src="https://www.paypalobjects.com/api/checkout.js"></script>
	<!-- Google Recaptcha -->
	<script src='https://www.google.com/recaptcha/api.js'></script>

	<script src="https://kit.fontawesome.com/a54d2cbf95.js"></script>

	<!-- Custom CSS -->
	<style type="text/css">
		html,
		body {
			scroll-behavior: smooth;
		}

		.to-top {
			background: black;
			position: fixed;
			bottom: 16px;
			right: 32px;
			width: 60px;
			height: 60px;
			border-radius: 50%;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 32px;
			color: #FFFFFF;
			text-decoration: none;
			opacity: 0;
			pointer-events: none;
			transition: all .4s;
		}

		.to-top.active {
			bottom: 32px;
			color: #FFFFFF;
			pointer-events: auto;
			opacity: 0.8;
			z-index: 1000;
		}

		/* Small devices (tablets, 768px and up) */
		@media (min-width: 768px) {
			#navbar-search-input {
				width: 60px;
			}

			#navbar-search-input:focus {
				width: 100px;
			}
		}

		/* Medium devices (desktops, 992px and up) */
		@media (min-width: 992px) {
			#navbar-search-input {
				width: 150px;
			}

			#navbar-search-input:focus {
				width: 150px;
			}
		}

		.word-wrap {
			overflow-wrap: break-word;
		}

		.prod-body {
			height: 300px;
		}

		.box:hover {
			box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
		}

		#trending {
			list-style: none;
			padding: 10px 5px 10px 15px;
		}

		#trending li {
			padding-left: 1.3em;
		}

		#trending li:before {
			content: "\f046";
			font-family: FontAwesome;
			display: inline-block;
			margin-left: -1.3em;
			width: 1.3em;
		}

		/*Magnify*/
		.magnify>.magnify-lens {
			width: 100px;
			height: 100px;
		}

		.simplebutton {
			display: block;
			width: 100px;
			height: 20px;
			line-height: 20px;
			font-family: 'Raleway', sans-serif;
			font-size: 14px;
			font-weight: 700;
			text-decoration: none;
			color: #333;
			border: 2px solid #333;
			letter-spacing: 2px;
			text-align: center;
			position: relative;
			transition: all .35s;
		}

		.nav1 {
			background: #000000;
			height: 80px;
			padding: 8px;
			align-items: center;
		}

		.sideimg {

			width: 100px;
			height: 100px;
			border-radius: 8px;
			display: flex;
			align-items: center;
			justify-content: center;
		}

		.sideimg:hover {
			width: 110px;
			height: 110px;
			box-shadow: 14px 14px 20px #cbced1, -14px -14px 20px white;
		}

		.sidetxt {
			margin: 6px;
			background: white;
			font-size: 15px;
			font-family: FontAwesome;
			font-weight: bold;
		}

		/* alert close btn */
		.alert .close {
			font-size: 3rem;
			color: white;
			opacity: .8;
		}

		.alert .close:hover {
			color: white;
			opacity: 1;
		}

		.style-6 h2 {
			font-family: 'Delius Swash Caps';
		}

		.style-7 h2 {
			font-family: "Roboto", Helvetica, Arial, sans-serif;
			color: #474343;
			font-weight: 100;
		}

		.style-7 h3 {
			font-family: "Roboto", Helvetica, Arial, sans-serif;
			color: #474343;
			font-weight: 600;
		}
	</style>

	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="manifest" href="site.html">
	<link rel="apple-touch-icon" href="icon.html">
	<!-- Place favicon.ico in the root directory -->

	<!-- bootstrap v4.0.0 -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<!-- fontawesome-icons css -->
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<!-- themify-icons css -->
	<link rel="stylesheet" href="assets/css/themify-icons.css">
	<!-- elegant css -->
	<link rel="stylesheet" href="assets/css/elegant.css">
	<!-- meanmenu css -->
	<link rel="stylesheet" href="assets/css/meanmenu.min.css">
	<!-- animate css -->
	<link rel="stylesheet" href="assets/css/animate.css">
	<!-- venobox css -->
	<link rel="stylesheet" href="assets/css/venobox.css">
	<!-- jquery-ui.min css -->
	<link rel="stylesheet" href="assets/css/jquery-ui.min.css">
	<!-- slick css -->
	<link rel="stylesheet" href="assets/css/slick.css">
	<!-- slick-theme css -->
	<link rel="stylesheet" href="assets/css/slick-theme.css">
	<!-- helper css -->
	<link rel="stylesheet" href="assets/css/helper.css">
	<!-- style css -->
	<link rel="stylesheet" href="style.css">
	<!-- responsive css -->
	<link rel="stylesheet" href="assets/css/responsive.css">

</head>