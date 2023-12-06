<?php
ob_start();
include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php
include 'includes/connection.php';

if (empty($_SESSION['client_users'])) {
    header('location:login.php');
}

if (isset($_POST['order_now'])) {

    $now = date('Y-m-d h:i:sa');

    $pay_amt = $_SESSION['check_price'];

    $cart_query = "SELECT * FROM cart_details WHERE client_id=" . $client_query['client_id'] . "";
    $cart_query_execute = mysqli_query($conn, $cart_query);
    $client_id = $client_query['client_id'];

    /*  cart fetch and add order */
    while ($order = mysqli_fetch_array($cart_query_execute)) {
        $p_id = $order['p_id'];
        $qty = $order['client_cart_qty'];
        $discount = $order['discount'];

        $order_insert = "INSERT INTO client_orders(client_id,order_status_id,p_id,order_qty,discount,order_total_amt,order_date,order_delivered_date) VALUES($client_id,2,$p_id,'$qty','$discount','$pay_amt','$now','NULL')";
        $order_execute_query = mysqli_query($conn, $order_insert);
        $success_code = 0;
    }
    $card_query = "SELECT * FROM waste_deposit WHERE client_id='" . $client_query['client_id'] . "'";
    $card_query_exec = mysqli_query($conn, $card_query);
    $card_query_num = mysqli_num_rows($card_query_exec);
    $card_query_fetch = mysqli_fetch_assoc($card_query_exec);

    if ($pay_amt <= $card_query_fetch['total_card_points']) {
        if ($success_code == 0) {
            #client order id fetch
            $payment_order_query = "SELECT order_id, order_total_amt FROM client_orders WHERE client_id=" . $client_query['client_id'] . "";
            $payment_order_query_exec = mysqli_query($conn, $payment_order_query);
            $order_no_query = mysqli_num_rows($payment_order_query_exec);

            #payment order id fetch
            $payment_order_check_query = "SELECT order_id FROM payment_status WHERE client_id=" . $client_query['client_id'] . "";
            $payment_order_check_query_exec = mysqli_query($conn, $payment_order_check_query);
            $payment_no_query = mysqli_num_rows($payment_order_check_query_exec);

            $client_id_update = $client_query['client_id'];
            $update = 1;
            $pay_date = date('m/d/Y');

            if ($order_no_query > 0) {
                while ($update_row = mysqli_fetch_array($payment_order_query_exec)) {
                    $payment_order_update_query = "SELECT order_id FROM payment_status WHERE client_id=" . $client_query['client_id'] . "";
                    $payment_order_update_query_exec = mysqli_query($conn, $payment_order_update_query);

                    if ($payment_no_query > 0) {
                        #check no duplicate entry is made
                        for ($i = 1; $i <= $payment_no_query; $i++) {
                            $payment_order_check = mysqli_fetch_array($payment_order_update_query_exec);

                            if ($payment_order_check['order_id'] == $update_row['order_id']) {
                                #don't Update Data
                                $update = 1;
                                break;
                            } else {
                                #update data
                                $update = 0;
                            }
                        }
                        if ($update == 0) {
                            $order_id_update = $update_row['order_id'];
                            $total_amt =   $pay_amt;
                            $update_payment = "INSERT INTO payment_status(order_id,client_id,payment_status,amount_paid,payment_date) VALUES($order_id_update,$client_id_update,'Paid','$total_amt','$pay_date')";
                            $update_payment_exec = mysqli_query($conn, $update_payment);
                            $cart_query = "SELECT * FROM cart_details WHERE client_id=" . $client_query['client_id'] . "";
                            $cart_query_execute = mysqli_query($conn, $cart_query);
                            while ($order = mysqli_fetch_assoc($cart_query_execute)) {
                                #delete from cart of client after order
                                $del_query = "DELETE FROM cart_details WHERE cart_id={$order['cart_id']}";
                                unset($_SESSION['final']);
                                unset($_SESSION['finalsave']);
                                unset($_SESSION['check_price']);
                                mysqli_query($conn, $del_query);
                            }
                            $update_amt = $card_query_fetch['total_card_points'] - $pay_amt;
                            $update_card_amt = "UPDATE waste_deposit SET total_card_points='$update_amt' WHERE client_id=" . $client_query['client_id'] . "";
                            mysqli_query($conn, $update_card_amt);
                        } else {
                        }
                    } else if ($payment_no_query == 0) {
                        $order_id_update = $update_row['order_id'];
                        $total_amt =   $pay_amt;
                        $update_payment = "INSERT INTO payment_status(order_id,client_id,payment_status,amount_paid,payment_date) VALUES($order_id_update,$client_id_update,'Paid','$total_amt','$pay_date')";
                        $update_payment_exec = mysqli_query($conn, $update_payment);

                        $cart_query = "SELECT * FROM cart_details WHERE client_id=" . $client_query['client_id'] . "";
                        $cart_query_execute = mysqli_query($conn, $cart_query);
                        while ($order = mysqli_fetch_array($cart_query_execute)) {
                            #delete from cart of client after order
                            $del_query = "DELETE FROM cart_details WHERE cart_id={$order['cart_id']}";
                            unset($_SESSION['final']);
                            unset($_SESSION['finalsave']);
                            unset($_SESSION['check_price']);
                            mysqli_query($conn, $del_query);
                        }
                        $update_amt = $card_query_fetch['total_card_points'] - $pay_amt;
                        $update_card_amt = "UPDATE waste_deposit SET total_card_points='$update_amt' WHERE client_id=" . $client_query['client_id'] . "";
                        mysqli_query($conn, $update_card_amt);
                    }
                }
                header('location:your_order.php');
                $_SESSION['success_order'] = "Your Order Placing and Payment was Done Successfully.";
            }
        }
    } else {
        #delete orders if payment failed
        $order_delete_query = "SELECT order_date from client_orders WHERE client_id=" . $client_query['client_id'] . "";
        $order_delete_query_exec = mysqli_query($conn, $order_delete_query);
        $check_date_now = date('Y-m-d h:i');

        while ($order_delete = mysqli_fetch_assoc($order_delete_query_exec)) {
            $check_date_now_db = date('Y-m-d h:i', strtotime($order_delete['order_date']));
            if ($check_date_now_db == $check_date_now) {
                $del_query = "DELETE FROM client_orders WHERE order_date like '$check_date_now_db%'";
                unset($_SESSION['final']);
                unset($_SESSION['finalsave']);
                unset($_SESSION['check_price']);
                mysqli_query($conn, $del_query);
            } else {
            }
        }
        $_SESSION['error'] = "Insufficient Balance In Card! Order Was Not Placed";
    }
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

    /* payment details */
    .payment-header {
        padding-inline: 16px;
        padding-bottom: 10px;
    }

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
                        <!-- Banner-Area Start-->
                        <div class="banner-area bg-3">
                            <div class="container">
                                <div class="row align-items-center height-800">
                                    <div class="col-lg-8 offset-lg-2 col-md-12">
                                        <div class="banner-text style-3 text-black text-center mt-minus-10">
                                            <h2>Check Out<br /></h2>
                                            <p class="mt-35"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Banner-Area End-->
                        <!-- cart area -->
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
                                <div class="col-md-8">
                                    <!-- client details box Starts -->
                                    <div class="box-content style-7">

                                        <h2 class="mb-0">Order Details</h2>

                                        <hr class="mt-0 mx-4 mb-0">

                                        <div class="row align-items-center">
                                            <div class="col-4 mt-3">
                                                <img src="<?php echo 'admin/uploaded_images/client_images/' . $client_query['image']; ?>" width="190px" height="200px" alt="Client image" style="border-radius:8px;" class="pro-image">
                                            </div>
                                            <div class="col-7">
                                                <div class="row">
                                                    <label class="detail-label col-6">Client Name : <?php echo $client_query['username']; ?></label>
                                                    <label class="detail-label col-6">Contact : <?php echo $client_query['contact_no']; ?></label>
                                                </div>
                                                <div class="row">
                                                    <label class="detail-label email">Email : <?php echo $client_query['email']; ?></label>
                                                </div>
                                                <div class="row">
                                                    <label class="detail-label">Delivery Address : <?php echo $client_query['residential_address']; ?></label>
                                                </div>
                                                <div class="row">
                                                    <label class="detail-label col-6">City : <?php echo $client_query['city']; ?></label>
                                                    <label class="detail-label col-6">State : <?php echo $client_query['state']; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-footer"><!-- box-footer Starts -->
                                            <div class="pull-left footer-btn left"><!-- pull-left Starts -->
                                                <a href="index.php" class="btn btn-default">
                                                    <i class="fa fa-chevron-left"></i> Continue Shopping
                                                </a>
                                            </div><!-- pull-left Ends -->
                                        </div><!-- box-footer Ends -->
                                    </div>
                                </div>
                                <!-- Order Summary Starts -->
                                <div class="col-md-4">
                                    <!-- box Starts -->
                                    <div class="box" id="order-summary">
                                        <!-- box-header Starts -->
                                        <div class="box-header style-7">
                                            <h3>Order Summary</h3>
                                        </div>
                                        <!-- box-header Ends -->

                                        <p class="text-muted">
                                            Shipping and additional costs are calculated based on the values you have entered.
                                        </p>

                                        <div class="table-responsive"><!-- table-responsive Starts -->
                                            <table class="table"><!-- table Starts -->
                                                <tbody><!-- tbody Starts -->
                                                    <tr>
                                                        <td style="padding-inline-start:15px;"> Order Total </td>
                                                        <th style="padding-inline-end:15px;"><?php
                                                                                                if (!empty($_SESSION['finalsave'])) {
                                                                                                    echo $_SESSION['final'] + $_SESSION['finalsave'];
                                                                                                } else {
                                                                                                    echo $_SESSION['final'];
                                                                                                }
                                                                                                ?></th>
                                                    </tr>
                                                    <tr>
                                                    <tr>
                                                        <td style="padding-inline-start:15px;">Discount</td>
                                                        <th style="padding-inline-end:15px;"><?php
                                                                                                if (!empty($_SESSION['finalsave'])) {
                                                                                                    echo "<label class='save-price'>-" . $_SESSION['finalsave'] . "</label></br>";
                                                                                                } else {
                                                                                                    echo "<label class='save-price'>-0</label></br>";
                                                                                                }
                                                                                                ?>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding-inline-start:15px;"> Shipping and Handling </td>
                                                        <th style="padding-inline-end:15px;"><?php
                                                                                                $free = 0;
                                                                                                if ($_SESSION['final'] > 250) {
                                                                                                    echo "<label class='save-price'>FREE</label></br>";
                                                                                                } else {
                                                                                                    echo "<label class='delivery-charge'>15</label></br>";
                                                                                                    $free = 1;
                                                                                                }
                                                                                                ?></th>
                                                    </tr>
                                                    <tr class="total">
                                                        <td style="padding-inline-start:15px;">Total</td>
                                                        <th style="padding-inline-end:15px;"><?php
                                                                                                if ($free == 0)
                                                                                                    echo "<label class='total-price price-tag'>" . $_SESSION['final'] . "</label>";
                                                                                                else {
                                                                                                    $_SESSION['check_price'] = $_SESSION['final'] + 15;
                                                                                                    echo "<label class='total-price price-tag'>" . $_SESSION['check_price'] . "</label>";
                                                                                                }
                                                                                                ?></th>
                                                    </tr>
                                                </tbody><!-- tbody Ends -->
                                            </table><!-- table Ends -->
                                        </div><!-- table-responsive Ends -->
                                    </div><!-- box Ends -->
                                </div>
                            </div>
                            <form action="checkout.php" method="post" enctype="multipart-form-data">
                                <!-- Payment Method Row -->
                                <div class="row mb-5">
                                    <div class="col-md-8">
                                        <!-- Payment details box Starts -->
                                        <div class="box-content style-7">

                                            <h2 class="mb-0">Payment Details</h2>

                                            <hr class="mt-0 mx-4 mb-0">

                                            <div class="row align-items-center">
                                                <!-- card payment -->
                                                <div class="col-8 mt-3 style-7 mb-5">
                                                    <h3 class="payment-header" style="text-align:start;"><i class="fa fa-credit-card"></i> Card Payment</h3>

                                                    <?php
                                                    $card_query_status = "SELECT * FROM waste_deposit WHERE client_id='" . $client_query['client_id'] . "'";
                                                    $card_query_status_exec = mysqli_query($conn, $card_query_status);
                                                    $card_query_status_num = mysqli_num_rows($card_query_status_exec);
                                                    $card_query_status = mysqli_fetch_assoc($card_query_status_exec);

                                                    if (($card_query_status_num > 0)) {
                                                    ?>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="payment" id="cardpay" value="InfiGreen Card">
                                                            <label class="form-check-label" for="cardpay">InfiGreen Card</label>
                                                        </div>
                                                    <?php } else {
                                                    ?>
                                                        <p class="ml-4">You Don't Have Account! To Apply For Waste Selling Infigreen Card 👇</p>
                                                        <div class="row justify-content-center">
                                                            <a href="sell_waste.php" style="font-size: larger;" class="btn btn-success btn-lg mb-3"><i class="fa fa-credit-card"></i> Waste Selling Card</a>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                            <div class="box-footer"><!-- box-footer Starts -->

                                                <div class="pull-right footer-btn right pr-3"><!-- pull-left Starts -->
                                                    <input type="submit" id="order_now" name="order_now" class="btn btn-success" value="Order Now">
                                                </div><!-- pull-left Ends -->
                                            </div><!-- box-footer Ends -->
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>

    <script type="text/javascript">

    </script>
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