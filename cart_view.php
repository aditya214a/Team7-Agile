<?php
ob_start();
include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php
include 'includes/connection.php';

if (empty($_SESSION['client_users'])) {
    header('location:login.php');
}

if (!empty($_GET['cpd_id'])) {
    $delete_query = "DELETE FROM cart_details WHERE cart_id=" . $_GET['cpd_id'] . "";
    $delete_query_execute = mysqli_query($conn, $delete_query);
    $_SESSION['success'] = "Item Removed Successfully!";
}
$cart_query = "SELECT *,pd.p_name,pd.p_price from cart_details as cd, product_details as pd where  cd.p_id=pd.p_id  and client_id=" . $client_query['client_id'] . "";

$cart_query_execute = mysqli_query($conn, $cart_query);
$query_row_no = mysqli_num_rows($cart_query_execute);

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

    /* table css */
    .pro-name a {
        text-decoration: none;
        color: #676768;
    }

    .pro-name a:hover {
        color: #00b527;
        font-weight: 600;
    }

    .form-control {
        text-align: center;
        font-size: medium;
    }

    .quantity {
        font-size: medium;
    }

    .coupon {
        width: 120px;
    }

    .delete {
        padding: 8px;
        font-weight: 500;
        text-transform: capitalize;
        font-size: smaller;
        width: fit-content;
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
    .footer-btn.right button {
        font-weight: 500;
        padding: 15px;
        text-transform: capitalize;
        font-size: small;
        width: fit-content;
        color: #333;
        background-color: #fff;
        border-color: #ccc;
    }

    .footer-btn.right button:hover {
        color: #333;
        background-color: #d4d4d4;
        border-color: #8c8c8c;
    }

    .footer-btn.right a {
        font-weight: 500;
        padding: 15px;
        padding-inline-start: 9px;
        text-transform: capitalize;
        font-size: small;
        width: fit-content;
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
                                            <h2>Shop Cart<br /></h2>
                                            <p class="mt-35">It is a long established fact that a reader will be
                                                distracted by the readable <br /> content of a page when looking at its
                                                layout. The point of using Lorem Ipsum</p>
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
                            <!-- product row -->
                            <div class="row mb-5">
                                <div class="col-md-9">
                                    <!-- box Starts -->
                                    <div class="box-content style-7">
                                        <!-- form Starts -->
                                        <form action="cart_view.php" method="post" enctype="multipart-form-data">

                                            <h2> Shopping Cart </h2>

                                            <p class="text-muted"> You have currently <?php echo $query_row_no; ?> item(s) in your cart. </p>

                                            <?php
                                            if ($query_row_no == 0) {
                                            } else {
                                            ?>

                                                <!-- table-responsive Starts -->
                                                <div class="table-responsive">
                                                    <!-- table start -->
                                                    <table class="table">
                                                        <!-- thead Starts -->
                                                        <thead>
                                                            <tr>
                                                                <th colspan="1">Product</th>

                                                                <th>Name</th>

                                                                <th>Unit Points</th>

                                                                <th>Quantity</th>

                                                                <th colspan="1"> Sub Total Points</th>

                                                                <th>Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <!-- thead Ends -->

                                                        <!-- tbody Starts -->
                                                        <tbody>
                                                            <?php
                                                            include 'includes/connection.php';

                                                            try {
                                                                $check = 0;
                                                                while ($query_row = mysqli_fetch_array($cart_query_execute)) {
                                                                    $image = 'admin/uploaded_images/product_details_images/' . $query_row['p_image_1'];

                                                                    if (empty($query_row['p_sale_price']) or $query_row['p_sale_price'] == '0') {
                                                                        $price = $query_row['p_price'];
                                                                        $saleprice = "";
                                                                    } else {
                                                                        $price = $query_row['p_sale_price'];
                                                                        $saleprice = '<label name="unitmrpprice" id="unitmrpprice" class="mrp-price">' . $query_row['p_price'] . ' pts</label>';
                                                                        $save = $query_row['p_price'] - $price;
                                                                        $totalsave = $save * $query_row['client_cart_qty'];
                                                                        @$finalsave = $finalsave + $totalsave;
                                                                        $check = 1;
                                                                    }
                                                                    $total = $price * $query_row['client_cart_qty'];
                                                                    @$final = $final + $total;

                                                                    echo '
                                                        <!-- tr Starts -->
                                                        <tr>
                                                            <td style="vertical-align:middle;">
                                                                <img src="' . $image . '" width="50px" height="60px" alt="product image" style="border-radius:4px;">
                                                            </td>
                                                            <td class="pro-name" style="vertical-align:middle;">
                                                                <a href="product_page.php?pro_id=' . $query_row['p_id'] . '">' . $query_row["p_name"] . ' </a>
                                                            </td>

                                                            <td style="vertical-align:middle;">
                                                                <label name="unitsaleprice" id="unitsaleprice" class="price-tag">' . $price . ' pts</label>
                                                                ' . $saleprice . '
                                                            </td>

                                                            <td style="vertical-align:middle;">
                                                                <label name="quantity" id="quantity" class="quantity">' . $query_row['client_cart_qty'] . '</label>
                                                            </td>

                                                            <td style="vertical-align:middle;">
                                                                <label name="totalprice" id="totalprice" class="price-tag">
                                                                ' . $total . '
                                                                 pts</label>
                                                            </td>
                                                            <td style="vertical-align:middle;">
                                                                <a href="cart_view.php?cpd_id=' . $query_row["cart_id"] . '" class="btn btn-danger btn-lg delete"><i class="fa fa-trash"></i> Delete</a>
                                                            </td>
                                                        </tr>
                                                        <!-- tr Ends -->';
                                                                }
                                                            } catch (PDOException $e) {
                                                                echo $e->getMessage();
                                                            }
                                                            mysqli_close($conn);
                                                            ?>
                                                        </tbody>
                                                        <!-- tbody Ends -->
                                                        <!-- tfoot Starts -->
                                                        <tfoot>
                                                            <tr>
                                                                <th style="padding-top: 14px;text-align: end;"></th>
                                                                <th class="pl-0" style="display:inline-flex;" colspan="2">
                                                                </th>
                                                                <th colspan="2" style="vertical-align:middle;text-align: end;">
                                                                    <?php if ($check == 1) {
                                                                        echo "<label class='save-price'>Discount:</label></br>";
                                                                    } ?>
                                                                    <label class="price-tag">Total Points:</label>
                                                                </th>
                                                                <th style="vertical-align:middle;">
                                                                    <?php
                                                                    if ($check == 1) {
                                                                        echo "<label class='save-price'>-" . $finalsave . " pts</label></br>";
                                                                        $_SESSION['finalsave'] = $finalsave;
                                                                    }
                                                                    ?>
                                                                    <?php
                                                                    echo "<label class='total-price price-tag'>" . $final . " pts</label>";
                                                                    $_SESSION['final'] = $final;
                                                                    ?>
                                                                </th>
                                                            </tr>
                                                        </tfoot>
                                                        <!-- tfoot Ends -->
                                                    </table>
                                                    <!-- table Ends -->
                                                </div>
                                                <!-- table-responsive Ends -->
                                            <?php } ?>

                                            <div class="box-footer"><!-- box-footer Starts -->
                                                <div class="pull-left footer-btn left"><!-- pull-left Starts -->
                                                    <a href="index.php" class="btn btn-default">
                                                        <i class="fa fa-chevron-left"></i> Continue Shopping
                                                    </a>
                                                </div><!-- pull-left Ends -->
                                                <!-- Checkout Button -->
                                                <?php
                                                if ($query_row_no == 0) {
                                                } else {
                                                ?>
                                                    <div class="pull-right footer-btn right">

                                                        <?php
                                                        echo '
                                                            <a href="#" class="btn btn-primary">
                                                            Proceed to Checkout <i class="fa fa-chevron-right"></i>
                                                            </a>
                                                            ';
                                                        ?>

                                                    </div><!-- pull-right Ends -->
                                                <?php } ?>

                                            </div><!-- box-footer Ends -->

                                        </form><!-- form Ends -->
                                    </div>
                                </div>

                                <div class="col-md-3">
                                </div>
                            </div>
                            <div class="row mb-5">
                            </div>
                            <!-- cart row end -->
                        </div>
                        <!-- cart area end -->
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
    <?php include 'includes/scripts.php'; ?>

</body>

</html>
<?php
ob_end_flush();
?>