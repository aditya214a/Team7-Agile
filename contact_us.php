<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/connection.php';

$subject_nm = @$_POST['sub_name'];
$message = @$_POST['message'];

$subject_Err = $msg_Err = "";

if (isset($_POST['addmessage'])) {

    if ($subject_nm == "") {
        $subject_Err = "* You Forgot to Enter Subject Name!";
    } else if ($message == "") {
        $msg_Err = "* You Forgot to Enter Message!";
    } else {
        try {
            $client_id = $_SESSION['client_id'];
            $now = date('Y-m-d h:i:sa');

            $insert_query = "INSERT INTO contact_details(client_id,subject,message,created_on_date) values($client_id,'$subject_nm','$message','$now')";

            mysqli_query($conn, $insert_query);
            $_SESSION['success'] = ' Submitted Successfully.';
            mysqli_close($conn);
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }
    }
}

?>

<style type="text/css">
    .content {
        padding: 0px;
        padding-left: 0px;
        padding-right: 0px;
    }

    .btn-common {
        color: aliceblue;
        border-radius: 5px;
    }

    .btn-common:hover {
        color: aliceblue;
        border-radius: 5px;
    }

    .content {
        padding: 0px;
        padding-left: 0px;
        padding-right: 0px;
    }

    .invalid {
        color: red;
    }

    .mt-25 {
        margin-top: 25px;
    }

    .mb-40 {
        margin-bottom: 40px;
    }

    .sm-mt-20 {
        margin-top: 20px;
    }

    /* product css */
    .page-header {
        margin-bottom: 0px;
        font-family: 'Delius Swash Caps';
        font-weight: 500;
    }

    /* single product css */
    .single-product .product-thumb-sin a img {
        max-height: 420px;
        height: fit-content;
    }

    .product-action .add-to-cart {
        color: aliceblue;
    }

    /* product text css */
    .product-text h4 a {
        font-family: cursive;
        color: #444;
    }

    .product-text h4 a:hover {
        color: forestgreen;
    }

    .product-text {
        margin-top: 13px;
    }

    .product-sale-price {
        text-decoration: line-through;
        color: gray;
    }

    .product-text>.product-price {
        color: #464444;
        font-family: 'Delius Swash Caps';
        font-weight: 600;
    }

    /* extra css */
    .style-6 h2 {
        font-family: cursive;
        font-size: 28px
    }

    .style-6 a {
        color: aliceblue;
        border-radius: 5px;
    }

    .style-6 a:hover {
        color: aliceblue;
    }

    /* input checkbox */
    input[type=checkbox],
    input[type=radio],
    input[type=file],
    select {
        cursor: pointer;
    }

    .form-check-label {
        cursor: pointer;
    }

    .form-check-inline .form-check-input {
        margin-left: 45px;
    }
</style>

<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">

        <?php include 'includes/navbar1.php'; ?>
        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <?php
                        if (isset($_SESSION['error'])) {
                            echo "
                                <div class='alert alert-danger alert-dismissible' style='margin: 0px; margin-top: 6.5rem;'>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <h4><i class='icon fa fa-warning'></i> Error!</h4>
                                    " . $_SESSION['error'] . "
                                </div>
                            ";
                            unset($_SESSION['error']);
                        }
                        if (isset($_SESSION['success'])) {
                            echo "
                                <div class='alert alert-success alert-dismissible' style='margin: 0px; margin-top: 6.5rem;'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <h4><i class='icon fa fa-check'></i> Success!</h4>
                                " . $_SESSION['success'] . "
                                </div>
                            ";
                            unset($_SESSION['success']);
                        }
                        ?>
                        <!-- Contact US Start -->
                        <div class="container mt-5 pt-5">
                            <!-- Header Name -->
                            <div class="row mt-5 pb-4">
                                <div class="col-lg-8 offset-lg-2">
                                    <div class="section-title text-center">
                                        <h2>Contact US Form</h2>
                                    </div>
                                </div>
                            </div>

                            <?php
                            if (!empty($_SESSION['client_users'])) {
                            ?>
                                <div class="col-xs-12">
                                    <div class="box" style="padding:30px;">
                                        <form name="contactus" class="form-horizontal needs-validation" method="POST" action="" enctype="multipart/form-data" novalidate>

                                            <!-- row 1 -->

                                            <div class="row form-group">
                                                <label for="subject" class="col-sm-4 control-label">Subject Name</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" id="sub_name" name="sub_name" placeholder="subject name" value="<?php echo $subject_nm ?>" required></input>
                                                </div>
                                                <p class="invalid"><?php if (isset($subject_Err)) echo $subject_Err; ?></p>
                                            </div>

                                            <!-- row 2 -->

                                            <div class="row form-group"> </div>

                                            <!-- row 3 -->

                                            <div class="row form-group">
                                                <label for="message" class="col-sm-4 control-label">Message</label>
                                                <div class="col-sm-5">
                                                    <textarea type="text" class="form-control " id="message" name="message" placeholder="Write Down Your Message Here..." rows="5" value="<?php echo $message ?>" required></textarea>
                                                </div>
                                                <p class="invalid"><?php if (isset($msg_Err)) echo $msg_Err; ?></p>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col-sm-6"></div>
                                                <div class="col-sm-6">
                                                    <button type="submit" class="btn btn-primary btn-lg mt-3" name="addmessage" id="addmessage"><i class="fa fa-save"></i> Submit</button>
                                                </div>
                                                <div class="col-sm-3"></div>
                                        </form>
                                    </div>
                                <?php } else { ?>
                                    <a href="login.php" class="btn-common brown-btn mt-40"><i class="fa fa-sign-in"></i> Login</a>
                                <?php
                            }
                                ?>
                                </div>
                        </div>
                        <!-- Contact US End -->
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>
</body>

</html>