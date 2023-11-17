<?php
ob_start();
include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php
include 'includes/connection.php';

if (empty($_SESSION['client_users'])) {
    header('location:login.php');
}
?>
<html>
<style type="text/css">
    .content {
        padding: 0px;
        padding-left: 0px;
        padding-right: 0px;
    }

    .height-800 {
        height: 600px;
    }

    /* box content */
    .box-content {
        background: white;
        margin: 0 0 20px;
        border: solid 1px #e6e6e6;
        box-sizing: border-box;
        border-radius: 10px;
        box-shadow: 0 1px 5px rgb(0 0 0 / 10%);
    }

    .box-content h2 {
        padding-inline: 20px;
        padding-top: 10px;
    }

    .box-content p {
        padding-inline: 20px;
    }

    .box-content .table-responsive {
        padding-inline: 15px;
        padding-bottom: 20px;
    }


    /* left footer btn */
    .footer-btn.left a {
        font-weight: 500;
        padding: 15px;
        text-transform: capitalize;
        font-size: small;
        width: fit-content;
        color: #333;
        background-color: #fff;
        border-color: #ccc;
    }

    .footer-btn.left a:hover {
        color: #333;
        background-color: #d4d4d4;
        border-color: #8c8c8c;
    }

    /* right footer btn */
    .footer-btn.right input {
        font-weight: 500;
        padding: 15px;
        padding-inline-start: 9px;
        text-transform: capitalize;
        font-size: small;
    }

    /* price css */
    .save-price {
        color: #62a916;
        font-size: larger;
    }

    .mrp-price {
        color: grey;
        font-size: smaller;
        text-decoration: line-through;
    }

    .price-tag {
        color: #575656;
        font-size: larger;
    }

    /* order summary */
    .style-7 h3 {
        text-align: center;
    }

    .box .box-header {
        background: #f7f7f7;
        padding: 20px;
        border-bottom: solid 1px #eeeeee;
        vertical-align: middle;
    }

    .text-muted {
        padding: 15px;
    }

    /* text details */
    .detail-label {
        text-transform: capitalize;
        padding-inline-start: 25px;
        font-size: large;
        display: flex;
        justify-content: flex-end;
        padding-inline-end: 15px;
    }

    .detail-label.text {
        padding: 0;
        display: flex;
        justify-content: space-between;
    }

    .detail-label.email {
        text-transform: inherit;
    }

    /* profile image */
    .pro-image {
        margin-inline-start: 15px;
        margin-inline-end: 8px;
        margin-bottom: 15px;
        width: 345px;
        height: 305px;
    }

    /* icon-edit photo */
    .edit-photo {
        color: #26cb24;
        font-size: 1.7rem;
    }

    .edit-photo:hover {
        color: #00a65a;
        font-size: 2rem;
    }

    /* icon-edit text */
    .edit-text {
        color: #26cb24;
        font-size: 1.5rem;
        padding-inline-start: 8px;
    }

    .edit-text:hover {
        color: #00a65a;
        font-size: 1.7rem;
    }

    /* side-box-icon */
    .icon.icon-side {
        font-size: 30px;
        top: 10px;
    }

    .small-box:hover .icon {
        font-size: 60px;
        top: 5px;
    }

    /* box text */
    .box-text {
        color: white;
        font-size: larger;
        font-family: cursive;
    }

    /* status of user */
    .status-active {
        color: green;
    }

    .status-deactive {
        color: orangered;
    }

    /* payment details */
    .payment-header {
        padding-inline: 16px;
        padding-bottom: 10px;
    }

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

    .form-control {
        text-align: center;
        font-size: 1.4rem;
    }
</style>

<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
        <?php include 'includes/navbar1.php'; ?>
        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content">
                <div class="row mt-5">
                    <div class="col-sm-12 mt-5">
                        <!-- cart area -->
                        <div class="container mt-5 mb-5">
                            <?php
                            if (isset($_SESSION['error'])) {
                                echo "
                                    <div class='alert alert-danger alert-dismissible'>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <h4><i class='icon fa fa-warning'></i> Error!</h4>
                                    " . $_SESSION['error'] . "
                                    </div>
                                ";
                                unset($_SESSION['error']);
                            }
                            if (isset($_SESSION['success'])) {
                                echo "
                                    <div class='alert alert-success alert-dismissible'>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <h4><i class='icon fa fa-check'></i> Success!</h4>
                                    " . $_SESSION['success'] . "
                                    </div>
                                ";
                                unset($_SESSION['success']);
                            }
                            ?>
                            <!-- client details row -->
                            <div class="row mb-5">
                                <div class="col-md-10">
                                    <!-- client details box Starts -->
                                    <div class="box-content style-7">

                                        <h2 class="mb-0">View Profile</h2>

                                        <hr class="mt-0 mx-4 mb-0">

                                        <div class="row align-items-center">
                                            <div class="col-5 mt-3 pr-0" style="display: flex; align-items: center;">
                                                <img src="<?php echo 'admin/uploaded_images/client_images/' . $client_query['image']; ?>" alt="Client image" style="border-radius:8px;" class="pro-image">
                                                <span class='pull-right'><a href='#edit_photo' class='edit-photo' data-toggle='modal'><i class='fa fa-edit'></i></a></span>
                                            </div>
                                            <div class="col-6 pl-2 style-7">
                                                <h3 style="text-align:start;">Account Details</h3>
                                                <hr class="mt-0 mx-0 mb-4" style="width:104%;">
                                                <div class="row">
                                                    <label class="detail-label col-5">Name :</label>
                                                    <label class="detail-label text col-7"><?php echo $client_query['username']; ?><span><a href='#edit_name' class='edit-text edit-name' data-toggle='modal'><i class='fa fa-edit'></i></a></span></label>
                                                </div>
                                                <div class="row">
                                                    <label class="detail-label col-5 email">Email :</label>
                                                    <label class="detail-label col-7 email text"><?php echo $client_query['email']; ?></label>
                                                </div>
                                                <div class="row">
                                                    <label class="detail-label col-5">Delivery Address :</label>
                                                    <label class="detail-label col-7 text"><?php echo $client_query['residential_address']; ?><span><a href='#edit_address' class='edit-text edit-address' data-toggle='modal'><i class='fa fa-edit'></i></a></span></label>
                                                </div>
                                                <div class="row">
                                                    <label class="detail-label col-5">City :</label>
                                                    <label class="detail-label col-7 text"><?php echo $client_query['city']; ?><span><a href='#edit_city' class='edit-text edit-city' data-toggle='modal'><i class='fa fa-edit'></i></a></span></label>
                                                </div>
                                                <div class="row">
                                                    <label class="detail-label col-5">State :</label>
                                                    <label class="detail-label col-7 text"><?php echo $client_query['state']; ?><span><a href='#edit_state' class='edit-text edit-state' data-toggle='modal' data-id=<?php echo $client_query['client_id'] ?>><i class='fa fa-edit'></i></a></span></label>
                                                </div>
                                                <div class="row">
                                                    <label class="detail-label col-5">Contact :</label>
                                                    <label class="detail-label col-7 text"><?php echo $client_query['contact_no']; ?><span><a href='#edit_contact' class='edit-text edit-contact' data-toggle='modal'><i class='fa fa-edit'></i></a></span></label>
                                                </div>
                                                <div class="row">
                                                    <label class="detail-label col-5">Account Status :</label>
                                                    <?php
                                                    if ($client_query['status'] == 1) {
                                                        echo '<label class="detail-label status-active col-7 text">Active';
                                                    } else {
                                                        echo '<label class="detail-label status-deactive col-7 text">Deactive</label>';
                                                    }
                                                    ?>
                                                </div>
                                                <div class="row">
                                                    <label class="detail-label col-5">Creation Date :</label>
                                                    <label class="detail-label col-7 text"><?php echo $client_query['created_on_date']; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  card details and other -->
                                        <div class="row">
                                            <div class="col-5 pr-0">
                                                <div class="row justify-content-center">
                                                    <h3 style="text-align:center;"><?php echo $client_query['username']; ?></h3>
                                                </div>
                                                <div class="row justify-content-center">
                                                    <h5 style="text-align:center;font-family:'Roboto', Helvetica, Arial, sans-serif;    color: #474343;"><?php echo $client_query['email']; ?></h5>
                                                </div>
                                                <div class="row justify-content-center">
                                                    <h5 style="text-align:center;font-family:'Roboto', Helvetica, Arial, sans-serif;    color: #474343;"><?php echo $client_query['state']; ?></h5>
                                                </div>
                                            </div>
                                            <div class="box-footer"><!-- box-footer Starts -->
                                                <div class="pull-left footer-btn left"><!-- pull-left Starts -->
                                                    <a href="index.php" class="btn btn-default">
                                                        <i class="fa fa-chevron-left"></i> Continue
                                                    </a>
                                                </div><!-- pull-left Ends -->
                                            </div><!-- box-footer Ends -->
                                        </div>
                                    </div>
                                    <!-- sidebar box -->
                                    <div class="col-md-2" style="margin-top:80px;">
                                        <div class="row small-box bg-aqua">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script>
        $(function() {
            /*  photo */
            $(document).on('click', '.edit-photo', function(e) {
                e.preventDefault();
                $('#edit_photo').modal('show');
            });
            /* name */
            $(document).on('click', '.edit-name', function(e) {
                e.preventDefault();
                $('#edit_name').modal('show');
            });
            /* address */
            $(document).on('click', '.edit-address', function(e) {
                e.preventDefault();
                $('#edit_address').modal('show');
            });
            /* contact */
            $(document).on('click', '.edit-contact', function(e) {
                e.preventDefault();
                $('#edit_contact').modal('show');
            });

        });
    </script>
    <?php include 'includes/edit_profile_modal.php'; ?>
    <?php include 'includes/scripts.php'; ?>

</body>

</html>
<?php
ob_end_flush();
?>