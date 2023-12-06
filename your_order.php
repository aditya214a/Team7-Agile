<?php
ob_start();
include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php
include 'includes/connection.php';

if (!empty($_GET['order_id'])) {
    #insert cancel order data
    $client_id = $client_query['client_id'];
    $order_id = $_GET['order_id'];
    $order_query_cancel = "SELECT * from client_orders WHERE order_id=$order_id";
    $order_query_cancel_exec = mysqli_query($conn, $order_query_cancel);
    $order_fetch = mysqli_fetch_assoc($order_query_cancel_exec);
    $order_date = date('M d, Y', strtotime($order_fetch['order_date']));

    #refund the payment
    $amount = $order_fetch['order_total_amt'];
    $update_card_amt = "UPDATE waste_deposit SET total_card_points = total_card_points + $amount WHERE client_id=$client_id";
    mysqli_query($conn, $update_card_amt);

    #wave off payment
    $cancel_order_payment = "DELETE FROM payment_status WHERE order_id=$order_id ";
    $cancel_order_payment_execute = mysqli_query($conn, $cancel_order_payment);
    #wave off order
    $cancel_order = "DELETE FROM client_orders WHERE order_id=$order_id";
    $cancel_order_execute = mysqli_query($conn, $cancel_order);
    $_SESSION['success_order'] = "Order Cancelled Successfully!";
}

if (!empty($_SESSION['client_users'])) {
    $order_query = "SELECT co.*,pd.p_name,pd.p_image_1,pd.p_price,pd.p_sale_price,pc.p_category_title,pt.p_type_title,os.order_status FROM client_orders as co, product_details as pd, product_category as pc, product_type as pt, order_status as os WHERE co.p_id=pd.p_id and pd.p_category_id=pc.p_category_id and pd.p_type_id=pt.p_type_id and co.order_status_id=os.order_status_id and client_id=" . $client_query['client_id'] . "";
    $order_query_exec = mysqli_query($conn, $order_query);
    $order_total_no = mysqli_num_rows($order_query_exec);
} else {
    $order_total_no = "0";
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

    .box-footer {
        background-color: #f7f7f7;
        padding: 20px;
        border-top: solid 1px #eeeeee;
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


    /* order details */
    .detail-label {
        text-transform: capitalize;
        padding-inline-start: 25px;
        font-size: large;
    }

    .detail-label.email {
        text-transform: inherit;
    }

    .pro-image {
        margin-inline: 15px;
        margin-bottom: 15px;
    }

    /* product details labels */
    .product-label {
        font-size: 1.8rem;
        color: #4c4949;
        text-transform: capitalize;
    }

    .product-list-price-label {
        text-decoration: line-through;
        color: #777777;
        font-size: larger;
    }

    .product-discount-label {
        color: #62a916;
        font-size: larger;
    }

    /* product price labels */
    .price-start-label {
        padding-inline-end: 0px;
    }

    .price-end-label {
        text-align: end;
    }

    /* address labels */
    .address-label {
        font-size: 1.5rem;
    }

    .contact-label {
        font-size: 1.5rem;
        color: #4c4949;
        text-transform: capitalize;
    }

    /* footer labels */
    .footer-label {
        text-transform: capitalize;
        font-size: 2.2rem;
        color: #4c4949;
    }

    .footer-label.not-delivered {
        color: #f39c12;
        font-size: 3rem;
    }

    .footer-label.delivered {
        color: green;
        font-size: 3rem;
    }

    .cancel-btn {
        font-size: 1.5rem;
        text-transform: capitalize;
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

                        <!-- Banner-Area Start-->
                        <div class="banner-area bg-3">
                            <div class="container">
                                <div class="row align-items-center height-800">
                                    <div class="col-lg-8 offset-lg-2 col-md-12">
                                        <div class="banner-text style-3 text-black text-center mt-minus-10">
                                            <h2>Your Orders<br /></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Banner-Area End-->

                        <!-- order area -->
                        <div class="container mt-4 mb-5">
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
                            if (isset($_SESSION['success_order'])) {
                                echo "
                                    <div class='alert alert-success alert-dismissible'>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <h4><i class='icon fa fa-check'></i> Success!</h4>
                                    " . $_SESSION['success_order'] . "
                                    </div>
                                ";
                                unset($_SESSION['success_order']);
                            }
                            ?>
                            <!-- client details row -->
                            <div class="row mb-5">
                                <div class="col-md-12">
                                    <!-- client details box Starts -->
                                    <div class="box-content style-7">
                                        <h2 class="mb-0">Your Order Details</h2>
                                        <hr class="mt-0 mx-4 mb-3">
                                        <p style="color:#4c4949;"> You have Placed <?php
                                                                                    if (!empty($_SESSION['client_users'])) {
                                                                                        echo $order_total_no;
                                                                                    } else {
                                                                                        echo '0';
                                                                                    }
                                                                                    ?> Orders Till Know!
                                        </p>
                                        <?php if ($order_total_no > 0) {  ?>
                                            <h3 class="px-4 pt-3">Order Details</h3>
                                        <?php } else {
                                            echo '
                                            <div class="box-footer"><!-- box-footer Starts -->
                                                <div class="pull-left footer-btn left"><!-- pull-left Starts -->
                                                        <a href="index.php" class="btn btn-default">
                                                        <i class="fa fa-chevron-left"></i> Continue Shopping
                                                        </a>
                                                </div><!-- pull-left Ends -->
                                            </div><!-- box-footer Ends -->   
                                            ';
                                        } ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <?php
                                            include 'includes/connection.php';
                                            if ($order_total_no > 0) {
                                                while ($order_row = mysqli_fetch_array($order_query_exec)) {
                                                    $total_discount = $order_row['discount'];
                                            ?>
                                                    <div class="box-content style-7">
                                                        <div class="row">
                                                            <!-- product details -->
                                                            <div class="col-2 mt-3">
                                                                <img src="<?php echo 'admin/uploaded_images/product_details_images/' . $order_row['p_image_1'] . ''; ?>" width="180px" height="180px" alt="Product image" style="border-radius:8px;" class="pro-image">
                                                            </div>
                                                            <div class="col-3 mt-4 pt-3 pl-5">
                                                                <div class="row">
                                                                    <label class="product-label">Name : </label>
                                                                    <label class="product-label pl-2"><?php echo $order_row['p_name']; ?></label>
                                                                </div>
                                                                <div class="row">
                                                                    <label class="product-label">Category : </label>
                                                                    <label class="product-label pl-2"><?php echo $order_row['p_category_title']; ?></label>
                                                                </div>
                                                                <div class="row">
                                                                    <label class="product-label">Type : <?php echo $order_row['p_type_title']; ?></label>
                                                                </div>
                                                                <?php
                                                                if (empty($order_row['p_sale_price']) or $order_row['p_sale_price'] == '0') {
                                                                    echo '<div class="row">
                                                                        <label class="product-label">Selling Price : ' . $order_row['p_price'] . '</label>
                                                                    </div>';
                                                                } else {
                                                                    echo '
                                                                    <div class="row">
                                                                        <label class="product-label">Price : </label>
                                                                        <label class="product-list-price-label pl-2">' . $order_row['p_price'] . '</label>
                                                                    </div>
                                                                    <div class="row">    
                                                                        <label class="product-label">Sale Price : ' . $order_row['p_sale_price'] . '</label>
                                                                    </div>';
                                                                }
                                                                ?>
                                                            </div>
                                                            <!-- price details -->
                                                            <div class="col-3 mt-3 pt-4">
                                                                <div class="row">
                                                                    <label class="product-label pl-5">Quantity : </label>
                                                                    <label class="product-label pl-5"><?php echo $order_row['order_qty']; ?></label>
                                                                </div>
                                                                <div class="row">
                                                                    <label class="product-label pl-5">Discount : </label>
                                                                    <label class="product-discount-label pl-4"><?php echo $total_discount . " pts"; ?></label>
                                                                </div>
                                                                <div class="row">
                                                                    <label class="product-label">Total Amount: </label>
                                                                    <label class="product-label pl-4"><?php echo $order_row['order_total_amt'] . " pts"; ?></label>
                                                                </div>
                                                            </div>
                                                            <!-- shipping details -->
                                                            <div class="col-4 mt-3 pt-4">
                                                                <div class="row">
                                                                    <label class="product-label pl-4"><?php echo $client_query['username']; ?></label>
                                                                </div>
                                                                <div class="row">
                                                                    <label class="address-label pl-4"><?php echo $client_query['residential_address']; ?></label>
                                                                </div>
                                                                <div class="row">
                                                                    <label class="address-label pl-4"><?php echo $client_query['city'] . ", " . $client_query['state']; ?></label>
                                                                </div>
                                                                <div class="row">
                                                                    <label class="contact-label pl-4">Phone Number:</label>
                                                                    <label class="contact-label pl-2"><?php echo $client_query['contact_no']; ?></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-4">
                                                                <label class="footer-label pl-3">🌱 Order Date :</label>
                                                                <label class="footer-label pl-2"><?php echo date('M d Y', strtotime($order_row['order_date'])); ?></label>
                                                            </div>
                                                            <div class="col-4 text-center">
                                                                <?php if ($order_row['order_status'] == "On The Way") { ?>
                                                                    <label class="footer-label not-delivered pl-4"><?php echo $order_row['order_status']; ?></label>
                                                                <?php } else { ?>
                                                                    <label class="footer-label delivered pl-4"><?php echo $order_row['order_status']; ?></label>
                                                                <?php } ?>
                                                            </div>
                                                            <div class="col-4 text-right pr-5">
                                                                <?php
                                                                if (($order_row['order_status'] == "On The Way")) { ?>
                                                                    <a href="your_order.php?order_id=<?php echo $order_row['order_id']; ?>" class="btn btn-danger btn-lg cancel-btn" onclick="return confirm('Are You Sure About Cancelling the Order?')">
                                                                        <i class="fa fa-minus-square"></i> Cancel Order
                                                                    </a>
                                                                <?php } else { ?>
                                                                    <label class="footer-label">🌱 Delivered Date :</label>
                                                                    <label class="footer-label"><?php echo date('d M Y', strtotime($order_row['order_delivered_date'])); ?></label>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                            <?php }
                                            } else {
                                                echo '';
                                            }
                                            ?>
                                        </div>
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
    <?php include 'includes/scripts.php'; ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>
<?php
ob_end_flush();
?>