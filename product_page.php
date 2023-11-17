<?php
ob_start();
include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php
include 'includes/connection.php';

if (!empty(@$_GET['pro_id'])) {
    $query_values = "SELECT pd.*, pt.p_type_title, pc.p_category_title FROM product_details as pd, product_type as pt, product_category as pc where pd.p_type_id=pt.p_type_id and pd.p_category_id=pc.p_category_id and pd.p_id=" . @$_GET['pro_id'] . "";

    $query_result = mysqli_query($conn, $query_values);
    $query_row = mysqli_fetch_assoc($query_result);
}
#add product to cart                             
if (isset($_GET['quantity'])) {
    $qty = @$_GET['quantity'];
    $pro_id = @$_GET['pro_id'];

    $inventory_query = "SELECT p_qty,p_price,p_sale_price from product_details where p_id=$pro_id";
    $inventory_query_execute = mysqli_query($conn, $inventory_query);
    $inventory_output = mysqli_fetch_assoc($inventory_query_execute);

    if ($inventory_output['p_sale_price'] != 0) {
        $discount = ($inventory_output['p_price'] - $inventory_output['p_sale_price']) * $qty;
        $final_total = $inventory_output['p_sale_price'] * $qty;
    } else {
        $discount = 0;
        $final_total = $inventory_output['p_price'] * $qty;
    }
    if (!preg_match('/^[0-9]{1,150}+$/', $qty)) {
        $_SESSION['error'] = "Quantity You've Entered It Must Be In Numbers Only!";
    } else if ($inventory_output['p_qty'] <= $qty) {
        $inventory = $inventory_output['p_qty'] - 1;
        $_SESSION['error'] = "Sorry We Dont Have " . $qty . " Quantity Right Know Available! We can Only Provide a Volume of " . $inventory . " Right Know!";
    } else {
        if (!empty($client_query['client_id'])) {
            $client_id = $client_query['client_id'];
            $select_cart_query = "SELECT * FROM cart_details where p_id=$pro_id and client_id=" . $client_query['client_id'] . "";
            $select_cart_execute = mysqli_query($conn, $select_cart_query);
            $cart_query_success = mysqli_fetch_assoc($select_cart_execute);

            if ($pro_id != @$cart_query_success['p_id']) {
                $cart_add_query = "INSERT INTO cart_details(p_id,client_id,client_cart_qty,discount,total_amount) values($pro_id,$client_id,'$qty','$discount','$final_total')";
                $cart_query_execute = mysqli_query($conn, $cart_add_query);
                $_SESSION["success"] = $query_row['p_name'] . " Successfully Added to Cart";
            } else if ($pro_id == $cart_query_success['p_id']) {
                $_SESSION['error'] = $query_row['p_name'] . " Already Exist in Cart!";
            }
        } else {
            $_SESSION['error'] = "You Need to Login First to Add any Item to Cart!";
            header('location:login.php');
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

    .height-800 {
        height: 600px;
    }

    .carousel {
        width: 46rem;
        height: 46rem;
    }

    .carousel-indicators li {
        border: none;
    }

    .carousel-indicators .active {
        width: 50px;
        height: 5px;
        background-color: #62b805;
    }

    .carousel-indicators li:hover {
        width: 50px;
        height: 5px;
        background-color: #62b805;
    }

    .carousel-inner .carousel-item img {
        height: 46rem;
        border-radius: 10px;
        cursor: pointer;
    }

    .box-area {
        padding-inline: 20px;
    }

    .inner-box-area {
        background-color: white;
        border-radius: 10px;
        padding: 20px 30px;
        height: 100%;
        border: solid 1px #e6e6e6;
        box-sizing: border-box;
        box-shadow: 0 1px 5px rgb(0 0 0 / 10%);
        -webkit-box-shadow: 0 1px 5px rgb(0 0 0 / 10%);
        -moz-box-shadow: 0 1px 5px rgb(0 0 0 / 10%);
        font-family: cursive;
    }

    .inner-box-area h2 {
        font-family: 'Delius Swash Caps';
        font-weight: lighter;
        font-size: 3.7rem;
        text-align: center;
        color: #333333;
    }

    .control-label {
        font-family: "Amazon Ember", Arial, sans-serif;
        color: black;
        font-size: 1.9rem;
        padding-inline-end: 4px;
        text-align: end;
        font-weight: 100;
    }

    .control-value {
        color: #01760a;
        font-size: 2.3rem;
        padding-inline-start: 3px;
        font-weight: 100;
    }

    .input-group-btn {
        padding-inline-start: 0px;
        padding-inline-end: 0px;
        text-align: end;
    }

    .input-group-btn button {
        width: 60px;
    }

    .input-group-text {
        padding: 0px;
        border: none;
    }

    .input-group-text .form-control {
        height: 100%;
        text-align: center;
        padding: 0px;
        font-size: 1.3rem;
    }

    /* price labels  */
    .label-price {
        font-family: "Amazon Ember", Arial, sans-serif;
        color: black;
        font-size: 2.3rem;
        padding-inline-end: 4px;
        text-align: end;
        font-weight: 100;
    }

    .label-value-price {
        color: #01760a;
        font-size: 3.3rem;
        padding-inline-start: 3px;
        font-weight: 100;
    }

    /* sale price */
    .label-price-over {
        font-family: "Amazon Ember", Arial, sans-serif;
        color: black;
        font-size: 1.9rem;
        padding-inline-end: 4px;
        text-align: end;
        font-weight: 100;
    }

    .label-value-price-over {
        color: #01760a;
        font-size: 1.9rem;
        padding-inline-start: 3px;
        font-weight: 100;
        text-decoration: line-through;
    }

    .btn-common {
        border-radius: 6px;
        color: white;
        background-color: #74c21f;
        border: 0px;
        height: 5.8rem;
    }

    .btn-common:hover {
        color: white;
        background-color: #04b685;
    }

    /* box content */
    .box-content {
        background: white;
        margin: 0 0 20px;
        border: solid 1px #e6e6e6;
        box-sizing: border-box;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 1px 5px rgb(0 0 0 / 10%);
    }

    .tab {
        display: inline-block;
        vertical-align: top;
        text-transform: Capitalize;
        font-size: 1.5rem;
        line-height: 35px;
        text-decoration: none;
        -webkit-transition: .3s;
        transition: .3s;
        min-width: fit-content;
    }

    .r-1 {
        display: contents;
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
                                            <h2>InfiGreen Product<br /></h2>
                                            <p class="mt-35">If you reach here from that far, make our globe greeny by purchasing it.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Banner-Area End-->
                        <!-- prodcut area -->
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
                                <!-- image carousel -->
                                <div class="col-lg-5">
                                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                                        </ol>
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <img class="d-block w-100" src="admin/uploaded_images/product_details_images/<?php echo $query_row['p_image_1']; ?>" alt="First slide">
                                            </div>
                                            <div class="carousel-item">
                                                <img class="d-block w-100" src="admin/uploaded_images/product_details_images/<?php echo $query_row['p_image_2']; ?>" alt="Second slide">
                                            </div>
                                            <div class="carousel-item">
                                                <img class="d-block w-100" src="admin/uploaded_images/product_details_images/<?php echo $query_row['p_image_3']; ?>" alt="Third slide">
                                            </div>
                                            <div class="carousel-item">
                                                <img class="d-block w-100" src="admin/uploaded_images/product_details_images/<?php echo $query_row['p_image_4']; ?>" alt="Third slide">
                                            </div>
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                                <!-- image carousel end -->

                                <div class="col-lg-7 box-area">
                                    <div class="inner-box-area">
                                        <h2><?php echo $query_row['p_name']; ?></h2>
                                        <div class="row mt-3 mb-2">
                                            <label class="col-4 control-label">Product Type :</label>
                                            <label class="col-8 control-value"><?php echo $query_row['p_type_title']; ?></label>
                                        </div>
                                        <div class="row mt-3 mb-2">
                                            <label class="col-4 control-label">Product Category :</label>
                                            <label class="col-8 control-value"><?php echo $query_row['p_category_title']; ?></label>
                                        </div>
                                        <form>
                                            <!-- qty row -->
                                            <div class="row mt-3 mb-2">
                                                <label class="col-4 control-label">Product Quantity :</label>
                                                <div class="col-8 control-value">
                                                    <div class="row">
                                                        <div class="col-2 input-group-btn" style="margin-inline-start: 5px;;">
                                                            <button type="button" id="minus" class="btn btn-danger btn-lg" onclick="decrement()"><i class="fa fa-minus"></i></button>
                                                        </div>
                                                        <div class="col-2 input-group-text">
                                                            <input type="text" name="quantity" id="quantity" class="form-control" value="<?php
                                                                                                                                            if (!empty($_GET['quantity']))
                                                                                                                                                echo $_GET['quantity'];
                                                                                                                                            else
                                                                                                                                                echo '1';
                                                                                                                                            ?>" min="1" max="150" onchange="validate()">
                                                        </div>
                                                        <div class="col-2 input-group-btn" style="text-align:start">
                                                            <button type="button" id="add" class="btn btn-primary btn-lg" onclick="increment()"><i class="fa fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" value="<?php echo $query_row['p_id']; ?>" name="pro_id">
                                                </div>
                                            </div>
                                            <!-- qty row end-->
                                            <?php

                                            if (empty($query_row['p_sale_price']) or $query_row['p_sale_price'] == '0') {
                                                echo '
                                                        <!--  price if no sale price there -->
                                                        <div class="row mt-5 mb-3">
                                                            <label class="col-4 label-price">Price(pts) :</label>
                                                            <label class="col-8 label-value-price">' . $query_row['p_price'] . ' pts</label>
                                                        </div>        
                                                    ';
                                            } else {
                                                echo '
                                                    <!-- price if there is sale price  -->
                                                    <!--  MRP -->
                                                    <div class="row mt-5 mb-2">
                                                        <label class="col-4 label-price-over">Price(pts) :</label>
                                                        <label class="col-8 label-value-price-over">' . $query_row['p_price'] . ' pts</label>
                                                    </div>
                                                    <!-- sale price -->
                                                    <div class="row mt-3 mb-3">
                                                        <label class="col-4 label-price">Sale Price(pts) :</label>
                                                        <label class="col-8 label-value-price">' . $query_row['p_sale_price'] . ' pts Only</label>
                                                    </div>
                                                    ';
                                            }
                                            ?>
                                            <!--  Add to Cart -->
                                            <div class="row mt-5 mb-2  justify-content-center">
                                                <button type="submit" class="btn-common"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- product row end -->

                            <!-- product description and features row -->
                            <div class="box-content">
                                <div class="row r-1">
                                    <!-- Description btn -->
                                    <a class="btn btn-success tab mr-2" style="margin-bottom:10px;" href="#description" data-toggle="tab">Description</a>
                                    <!-- Benefits btn -->
                                    <a class="btn btn-success tab mr-2" style="margin-bottom:10px;" href="#benefits" data-toggle="tab">Caring & Features</a>
                                </div>
                                <hr style="margin-top:0px;">
                                <!-- tab content start -->
                                <div class="tab-content">

                                    <!-- description tab-pane fade in active Starts -->
                                    <div id="description" class="tab-pane fade in active" style="margin-top:7px;">
                                        <p><?php echo $query_row['p_details']; ?></p>
                                    </div>
                                    <!-- description tab-pane fade in active Ends -->

                                    <!-- features tab-pane fade in  Starts -->
                                    <div id="benefits" class="tab-pane fade in" style="margin-top:7px;">
                                        <?php echo $query_row['p_benefits']; ?>
                                    </div>
                                    <!-- features tab-pane fade in  Ends -->

                                    <!-- video tab-pane fade in Starts -->
                                    <div id="videos" class="tab-pane fade in" style="margin-top:7px; text-align: center;">
                                        <?php
                                        if (!empty($query_row['p_video']) and $query_row['p_video'] != 'NULL') {
                                            echo '
                                                <iframe width="854" height="480" src="' . $query_row['p_video'] . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            ';
                                        } else {
                                            echo '
                                            <div class="service-area">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-lg-8 offset-lg-2">
                                                            <div class="section-title style-6">
                                                                <h2>🍀No Video Available🍀</h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            ';
                                        }
                                        ?>
                                    </div>
                                    <!-- video tab-pane fade in  Ends -->
                                </div>
                                <!-- tab content end -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>

    <script type="text/javascript">
        function increment() {
            var value = parseInt(document.getElementById('quantity').value);
            value = isNaN(value) ? 0 : value;
            if (value < 150) {
                value++;
                document.getElementById('quantity').value = value;
            } else {
                document.getElementById('quantity').value = 150;
            }
        }

        function decrement() {
            var value = parseInt(document.getElementById('quantity').value);
            value = isNaN(value) ? 0 : value;
            if (value > 1) {
                value--;
                document.getElementById('quantity').value = value;
            }

        }

        function validate() {
            var value = parseInt(document.getElementById('quantity').value);
            if (value > 150) {
                document.getElementById('quantity').value = 150;
            }
            if (value < 1) {
                document.getElementById('quantity').value = 1;
            }
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>
<?php
ob_end_flush();
?>

</html>