<?php
include 'includes/session.php';
include 'includes/scripts.php';
include 'includes/connection.php';

$eid = @$_GET['id'];

$id = @$_POST['user_id'];
$edit_username = @$_POST['edit_username'];
$edit_email = @$_POST['edit_email'];
$edit_contact = @$_POST['edit_contact'];
$edit_gender = @$_POST['edit_gender'];
$edit_power = @$_POST['edit_power'];
$edit_dob = @$_POST['edit_dob'];

$usernameErr = $emailErr = $contactErr = $powerErr = $dobErr = " ";

if ($eid != "" or $id != "") {
    $edit_select_query = "SELECT * FROM admin_details WHERE admin_id=$eid";
    $edit_execute_query = mysqli_query($conn, $edit_select_query);
    $query_row_result = @mysqli_fetch_assoc($edit_execute_query);
}

if (isset($_POST['update'])) {

    if ($id != "") {
        $edit_select_query = "SELECT * FROM admin_details WHERE admin_id=$id";
        $edit_execute_query = mysqli_query($conn, $edit_select_query);
        $query_row_result = @mysqli_fetch_assoc($edit_execute_query);
    } else {
        $edit_select_query = "SELECT * FROM admin_details WHERE admin_id=$eid";
        $edit_execute_query = mysqli_query($conn, $edit_select_query);
        $query_row_result = @mysqli_fetch_assoc($edit_execute_query);
    }

    if ($edit_username == "") {
        $usernameErr = "* You Forgot to Enter Username!";
        /*  $edit */
    } else if (!preg_match('/^[a-zA-Z0-9]*$/', $edit_username)) {
        $usernameErr = "* No Special Character Allowed! Username Can be Alphanumeric!";
    } else if (!preg_match('/^[a-zA-Z0-9]{4,35}$/', $edit_username)) {
        $usernameErr = "* Username Must be between 4-35 characters";
    } else if ($edit_email == "") {
        $emailErr = "* You Forgot To Enter Email!";
    } else if (filter_var($edit_email, FILTER_VALIDATE_EMAIL) === false) {
        $emailErr = "* Your Email is Not Valid!";
    } else if ($edit_contact == "") {
        $contactErr = "* You Forgot To Enter Contact Number!";
    } else if (!is_numeric($edit_contact)) {
        $contactErr = "* Enter Numeric Value Only!";
    } else if (!preg_match('/^[0-9]{10}+$/', $edit_contact)) {
        $contactErr = "* Contact Number Must Contain 10 Digit!";
    } else if ($edit_power == "--- Select Admin Power ---") {
        $powerErr = "* You Need to Select Admin Power!";
    } else if ($edit_dob == "") {
        $dobErr = "* You Forgot to Enter DOB!";
    } else {

        $user_check_query = "SELECT * FROM admin_details WHERE username='$edit_username' and admin_id!=$eid LIMIT 1";
        $user_result = mysqli_query($conn, $user_check_query);
        $user_compare = mysqli_fetch_assoc($user_result);

        $email_check_query = "SELECT * FROM admin_details WHERE email='$edit_email' and admin_id!=$eid LIMIT 1";
        $email_result = mysqli_query($conn, $email_check_query);
        $email_compare = mysqli_fetch_assoc($email_result);

        $contact_check_query = "SELECT * FROM admin_details WHERE contact_no='$edit_contact' and admin_id!=$eid LIMIT 1";
        $contact_result = mysqli_query($conn, $contact_check_query);
        $contact_compare = mysqli_fetch_assoc($contact_result);

        if ($edit_username == @$user_compare['username']) {
            $usernameErr = "* " . $edit_username . " already Exists!";
        } else if ($edit_email == @$email_compare['email']) {
            $emailErr = "* " . $edit_email . " already Exists!";
        } else if ($edit_contact == @$contact_compare['contact_no']) {
            $contactErr = "* " . $edit_contact . " already Exists!";
        } else {
            try {
                $update_query = "UPDATE admin_details SET username='$edit_username', email='$edit_email', contact_no=$edit_contact, gender='$edit_gender', power='$edit_power', dob='$edit_dob' WHERE admin_id=$eid";
                mysqli_query($conn, $update_query);
                $_SESSION['success'] = $edit_username . ' Details Updated successfully';
                mysqli_close($conn);
                header('location: admin_users.php');
            } catch (PDOException $e) {
                $_SESSION['error'] = $e->getMessage();
            }
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
                    Update Admin
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box" style="padding:30px;">
                            <form name="editform" class="form-horizontal needs-validation" method="POST" action="" enctype="multipart/form-data" novalidate>

                                <input type="hidden" class="userid" name="user_id" id="user_id" value="<?php echo $eid; ?>" onkeyup="saveValue(this);" />

                                <div class="row form-group">

                                    <label for="edit_username" class="col-sm-2 control-label">Username</label>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="edit_username" name="edit_username" placeholder="admin name" value="<?php
                                                                                                                                                        if (($id != "" or $eid != "") and empty($edit_username)) {
                                                                                                                                                            echo $query_row_result['username'];
                                                                                                                                                        } else {
                                                                                                                                                            echo $edit_username;
                                                                                                                                                        }
                                                                                                                                                        ?>" required>
                                        <p class="invalid"><?php if (isset($usernameErr)) echo $usernameErr; ?></p>
                                    </div>

                                    <label for="edit_email" class="col-sm-2 control-label">Email</label>

                                    <div class="col-sm-3">
                                        <input type="email" class="form-control" id="edit_email" name="edit_email" placeholder="example@mail.com" value="<?php
                                                                                                                                                            if (($id != "" or $eid != "") and empty($edit_email)) {
                                                                                                                                                                echo $query_row_result['email'];
                                                                                                                                                            } else {
                                                                                                                                                                echo $edit_email;
                                                                                                                                                            }
                                                                                                                                                            ?>" required>
                                        <p class="invalid"><?php if (isset($emailErr)) echo $emailErr; ?></p>
                                    </div>
                                </div>


                                <div class="row form-group">
                                    <label for="edit_contact" class="col-sm-2 control-label">Contact</label>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="edit_contact" name="edit_contact" placeholder="contact number" value="<?php
                                                                                                                                                            if (($id != "" or $eid != "") and empty($edit_contact)) {
                                                                                                                                                                echo $query_row_result['contact_no'];
                                                                                                                                                            } else {
                                                                                                                                                                echo $edit_contact;
                                                                                                                                                            }
                                                                                                                                                            ?>" required>
                                        <p class="invalid"><?php if (isset($contactErr)) echo $contactErr; ?></p>
                                    </div>

                                    <label for="edit_gender" class="col-sm-2 control-label">Gender</label>

                                    <div class="form-check form-check-inline col-sm-1">
                                        <input class="form-check-input" type="radio" name="edit_gender" id="male" value="Male" <?php
                                                                                                                                if (($id != "" or $eid != "") and empty($edit_gender)) {
                                                                                                                                    if ($query_row_result['gender'] == "Male") {
                                                                                                                                        echo "checked";
                                                                                                                                    }
                                                                                                                                } else {
                                                                                                                                    if ($edit_gender == "Male") {
                                                                                                                                        echo "checked";
                                                                                                                                    }
                                                                                                                                }
                                                                                                                                ?>>
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>

                                    <div class="form-check form-check-inline col-sm-1">
                                        <input class="form-check-input" type="radio" name="edit_gender" id="female" value="Female" <?php
                                                                                                                                    if (($id != "" or $eid != "") and empty($edit_gender)) {
                                                                                                                                        if ($query_row_result['gender'] == "Female") {
                                                                                                                                            echo "checked";
                                                                                                                                        }
                                                                                                                                    } else {
                                                                                                                                        if ($edit_gender == "Female") {
                                                                                                                                            echo "checked";
                                                                                                                                        }
                                                                                                                                    } ?>>
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <label for="edit_power" class="col-sm-2 control-label">Admin Power</label>

                                    <div class="col-sm-3">
                                        <select id="edit_power" name="edit_power" class="form-control">
                                            <option>--- Select Admin Power ---</option>
                                            <option <?php
                                                    if (($id != "" or $eid != "") and empty($edit_power)) {
                                                        if ($query_row_result['power'] == "Root User") {
                                                            echo "selected";
                                                        }
                                                        if ($query_row_result['power'] == "General User") {
                                                            echo "selected";
                                                        }
                                                    } else {
                                                        if ($edit_power == "Root User") {
                                                            echo "selected";
                                                        }
                                                        if ($edit_power == "General User") {
                                                            echo "selected";
                                                        }
                                                    } ?>>Root User</option>
                                            <option <?php
                                                    if (($id != "" or $eid != "") and empty($edit_power)) {
                                                        if ($query_row_result['power'] == "Root User") {
                                                            echo "selected";
                                                        }
                                                        if ($query_row_result['power'] == "General User") {
                                                            echo "selected";
                                                        }
                                                    } else {
                                                        if ($edit_power == "Root User") {
                                                            echo "selected";
                                                        }
                                                        if ($edit_power == "General User") {
                                                            echo "selected";
                                                        }
                                                    } ?>>General User</option>
                                        </select>
                                        <p class="invalid"><?php if (isset($powerErr)) echo $powerErr; ?></p>
                                    </div>

                                    <label for="edit_dob" class="col-sm-2 control-label">Date of Birth</label>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control dobtext" id="edit_dob" name="edit_dob" placeholder="date of birth" value="<?php
                                                                                                                                                            if (($id != "" or $eid != "") and empty($edit_power)) {
                                                                                                                                                                echo $query_row_result['dob'];
                                                                                                                                                            } else {
                                                                                                                                                                echo $edit_dob;
                                                                                                                                                            }
                                                                                                                                                            ?>" required>
                                        <p class="invalid"><?php if (isset($dobErr)) echo $dobErr; ?></p>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <a href="admin_users.php"><button type="button" class="btn btn-danger btn-flat" name="close"><i class="fa fa-close"></i> Close</button></a>

                                    <button type="submit" class="btn btn-success edit btn-flat" name="update" id="update"><i class="fa fa-check-square-o"></i> Update</button>
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