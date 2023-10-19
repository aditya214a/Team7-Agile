<?php
include 'includes/session.php';
include 'includes/scripts.php';
include 'includes/connection.php';

$username = @$_POST['username'];
$email = @$_POST['email'];
$contact = @$_POST['contact'];
$gender = @$_POST['gender'];
$power = @$_POST['power'];
$dob = @$_POST['dob'];
$password = @$_POST['password'];
$cpassword = @$_POST['cpassword'];

$usernameErr = $emailErr = $imageErr = $contactErr = $powerErr = $dobErr = $passwordErr = $cpasswordErr = " ";

$user_check_query = "SELECT * FROM admin_details WHERE username='$username' LIMIT 1";
$user_result = mysqli_query($conn, $user_check_query);
$user_compare = mysqli_fetch_assoc($user_result);

$email_check_query = "SELECT * FROM admin_details WHERE email='$email' LIMIT 1";
$email_result = mysqli_query($conn, $email_check_query);
$email_compare = mysqli_fetch_assoc($email_result);

$contact_check_query = "SELECT * FROM admin_details WHERE contact_no='$contact' LIMIT 1";
$contact_result = mysqli_query($conn, $contact_check_query);
$contact_compare = mysqli_fetch_assoc($contact_result);


if (isset($_POST['add'])) {
    $filename = $_FILES['photo']['name'];
    $target_dir = "uploaded_images/admin_images/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    // Select file type
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Valid file extensions
    $extensions_arr = array("jpg", "jpeg", "png", "gif");

    if ($username == "") {
        $usernameErr = "* You Forgot to Enter Username!";
    } else if (!preg_match('/^[a-zA-Z0-9]*$/', $username)) {
        $usernameErr = "* No Special Character Allowed! Username Can be Alphanumeric!";
    } else if (!preg_match('/^[a-zA-Z0-9]{4,35}$/', $username)) {
        $usernameErr = "* Username Must be between 4-35 characters";
    } else if (@$user_compare['username'] === $username) {
        // if user exists 
        $usernameErr = "* Username already Exists!";
    } else if ($email == "") {
        $emailErr = "* You Forgot To Enter Email!";
    } else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $emailErr = "* Your Email is Not Valid!";
    } else if (@$email_compare['email'] === $email) {
        // if email exists
        $emailErr = "* Email already Exists!";
    } else if ($filename == "") {
        $imageErr = "* Compulsory to Upload Admin Image!";
    } else if (!in_array($imageFileType, $extensions_arr)) {
        $imageErr = "* Extension Supported: jpg, jpeg, png, gif";
    } else if ($contact == "") {
        $contactErr = "* You Forgot To Enter Contact Number!";
    } else if (!is_numeric($contact)) {
        $contactErr = "* Enter Numeric Value Only!";
    } else if (!preg_match('/^[0-9]{10}+$/', $contact)) {
        $contactErr = "* Contact Number Must Contain 10 Digit!";
    } else if (@$contact_compare['contact_no'] === $contact) {
        // if contact exists
        $contactErr = "* Contact number already Exists!";
    } else if ($power == "--- Select Admin Power ---") {
        $powerErr = "* You Need to Select Admin Power!";
    } else if ($dob == "") {
        $dobErr = "* You Forgot to Enter DOB!";
    } else if ($password == "") {
        $passwordErr = "* You Forgot To Enter Password!";
    } else if (!preg_match('/^(?=.*\d)(?=.*[a-zA-Z])(?=.*[@#$%^&-+=()]).*$/', $password)) {
        $passwordErr = "* Password must contain Numbers, Alphabets, Special Characters!";
    } else if (!preg_match('/^(?=.*\d)(?=.*[a-zA-Z])(?=.*[@#$%^&-+=()])(?=\S+$).{6,20}$/', $password)) {
        $passwordErr = "* Password length to be 6-20! Space is not Allowed!";
    } else if ($cpassword == "") {
        $cpasswordErr = "* You Forgot to Enter Confirm Password!";
    } else if ($cpassword != $password) {
        $cpasswordErr = "* Password You Entered is Not Matching with Confirm Password!";
    } else {
        $pass = md5($password);
        $now = date('Y-m-d h:i:sa');
        try {
            $query = "insert into admin_details(username,email,image,contact_no,gender,power,dob,password,created_on_date) values ('$username','$email','$filename','$contact','$gender','$power','$dob','$pass','$now')";
            mysqli_query($conn, $query);
            $_SESSION['success'] = 'Admin User added successfully';
            // Upload file
            move_uploaded_file($_FILES['photo']['tmp_name'], $target_dir . $filename);
            mysqli_close($conn);
            header('location: admin_users.php');  // used for redirecting      
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }
    }
}
?>
<html>
<?php include 'includes/header.php'; ?>

<head>
    <style>
        input[type=checkbox],
        input[type=radio],
        input[type=file],
        select {
            cursor: pointer;
        }

        .form-check-label {
            cursor: pointer;
        }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Add Admin
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box" style="padding:30px;">
                            <form name="addform" class="form-horizontal needs-validation" method="POST" action="users_add.php" enctype="multipart/form-data" novalidate>

                                <div class="row form-group">

                                    <label for="username" class="col-sm-2 control-label">Username</label>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="username" name="username" placeholder="admin name" value="<?php echo $username ?>" required>
                                        <p class="invalid"><?php if (isset($usernameErr)) echo $usernameErr; ?></p>
                                    </div>

                                    <label for="email" class="col-sm-2 control-label">Email</label>

                                    <div class="col-sm-3">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="example@mail.com" value="<?php echo $email ?>" required>
                                        <p class="invalid"><?php if (isset($emailErr)) echo $emailErr; ?></p>
                                    </div>
                                </div>


                                <div class="row form-group">

                                    <label for="photo" class="col-sm-2 control-label">Photo</label>

                                    <div class="col-sm-3">
                                        <input type="file" id="photo" name="photo" required>
                                        <p class="invalid"><?php if (isset($imageErr)) echo $imageErr; ?></p>
                                    </div>

                                    <label for="contact" class="col-sm-2 control-label">Contact</label>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="contact" name="contact" placeholder="contact number" value="<?php echo $contact ?>" required>
                                        <p class="invalid"><?php if (isset($contactErr)) echo $contactErr; ?></p>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <label for="gender" class="col-sm-2 control-label">Gender</label>

                                    <div class="form-check form-check-inline col-sm-1">
                                        <input class="form-check-input" type="radio" name="gender" id="male" value="Male" checked>
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>

                                    <div class="form-check form-check-inline col-sm-1">
                                        <input class="form-check-input" type="radio" name="gender" id="female" value="Female" <?php if ($gender == "Female") {
                                                                                                                                    echo "Checked";
                                                                                                                                } ?>>
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                    <div class="col-sm-1"></div>

                                    <label for="power" class="col-sm-2 control-label">Admin Power</label>

                                    <div class="col-sm-3">
                                        <select id="power" name="power" class="form-control">
                                            <option>--- Select Admin Power ---</option>
                                            <option value="Root User" <?php if ($power == "Root User") {
                                                                            echo "selected";
                                                                        } ?>>Root User</option>
                                            <option value="General User" <?php if ($power == "General User") {
                                                                                echo "selected";
                                                                            } ?>>General User</option>
                                        </select>
                                        <p class="invalid"><?php if (isset($powerErr)) echo $powerErr; ?></p>
                                    </div>
                                </div>

                                <div class="row form-group">

                                    <label for="dob" class="col-sm-2 control-label">Date of Birth</label>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control dobtext" id="dob" name="dob" placeholder="date of birth" value="<?php echo $dob ?>" required>
                                        <p class="invalid"><?php if (isset($dobErr)) echo $dobErr; ?></p>
                                    </div>

                                    <label for="password" class="col-sm-2 control-label">Password</label>

                                    <div class="col-sm-3">
                                        <input type="password" class="form-control pass1" id="password" name="password" placeholder="password" value="<?php echo $password ?>" required>
                                        <div class="input-group-append">
                                            <span id="p1" class="iconeye"><i id="changei1" class="fa fa-eye-slash"></i></span>
                                        </div>
                                        <p class="invalid"><?php if (isset($passwordErr)) echo $passwordErr; ?></p>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <label for="cpassword" class="col-sm-2 control-label">Confirm Password</label>

                                    <div class="col-sm-3">
                                        <input type="password" class="form-control pass2" id="cpassword" name="cpassword" placeholder="confirm password" value="<?php echo $cpassword ?>" required>
                                        <div class="input-group-append">
                                            <span id="p2" class="iconeye"><i id="changei2" class="fa fa-eye-slash"></i></span>
                                        </div>
                                        <p class="invalid"><?php if (isset($cpasswordErr)) echo $cpasswordErr; ?></p>
                                    </div>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <a href="admin_users.php"><button type="button" class="btn btn-danger btn-flat" name="close"><i class="fa fa-close"></i> Close</button></a>
                            <button type="submit" class="btn btn-primary btn-flat" name="add" id="add"><i class="fa fa-save"></i> Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            </section>

        </div>
        <?php include 'includes/footer.php'; ?>

    </div>
    <!-- ./wrapper -->

    <?php include 'includes/scripts.php'; ?>


</body>

</html>