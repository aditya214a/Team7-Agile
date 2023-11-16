<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<style type="text/css">
    .content {
        padding: 0px;
        padding-left: 0px;
        padding-right: 0px;
    }

    .height-800 {
        height: 600px;
    }

    .mt-47 {
        margin-top: 47px;
    }

    .mb-40 {
        margin-top: 40px;
    }

    .margin-top-6 {
        margin-bottom: 6px;
    }

    .sm-mt-35 {
        margin-top: 35px;
    }

    .img-shadow {
        max-height: 400px;
        max-width: 458px;
    }

    /* product css */
    /* single product css */
    .single-product .product-thumb-sin a img {
        max-height: 420px;
        height: fit-content;
    }

    .product-action .add-to-cart {
        color: aliceblue;
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
                                <div class='alert alert-danger'>
                                    " . $_SESSION['error'] . "
                                </div>
                            ";
                            unset($_SESSION['error']);
                        }
                        ?>
                        <!-- Banner-Area Start-->
                        <div class="banner-area bg-3">
                            <div class="container">
                                <div class="row align-items-center height-800">
                                    <div class="col-lg-8 offset-lg-2 col-md-12">
                                        <div class="banner-text style-3 text-black text-center mt-minus-10">
                                            <h2>Buy From InfiGreen<br /></h2>
                                            <p class="mt-35">Lets go for adventure & by that i mean lets go to Plant Shop</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Banner-Area End-->
                        <!-- Product List -->
                        <div class="service-area mt-5 mb-40 sm-mt-80">
                            <div class="container-fluid">
                                <!-- Product List Header Start-->
                                <div class="row mb-5">
                                    <div class="col-lg-8 offset-lg-2">
                                        <div class="section-title style-2">
                                            <h2>Shop From InfiGreen World</h2>
                                            <p>Just take a look we wont charge you, look for a best quality plant and in reasonable price.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product List Header End -->

                                <!-- Products-Area Start-->
                                <div class="container">
                                    <!-- <div class="col-lg-3"></div> -->
                                    <div class="products-area sm-mt-30" id="shop">
                                        <?php
                                        include 'includes/connection.php';

                                        if (!empty($_GET['p_cat_id'])) {
                                            $p_query = "SELECT p_id,p_name,p_price,p_sale_price,p_image_1 FROM product_details WHERE p_category_id=" . $_GET['p_cat_id'] . "";
                                            $p_query_execute = mysqli_query($conn, $p_query);
                                            $total_rows = mysqli_num_rows($p_query_execute);
                                            $testexp = ceil($total_rows / 3);


                                            /* No of rows in table must be more then 0 */
                                            if ($total_rows > 0) {
                                                for ($no = 1; $no <= $testexp; $no++) {
                                                    echo '<div class="row margin-top-6">';
                                                    for ($i = 1; $i <= 3; $i++) {
                                                        $row = mysqli_fetch_array($p_query_execute);
                                                        if (!empty($row['p_id'])) {
                                                            echo '
                                                                <!-- Product -->
                                                                <div class="col-lg-4">
                                                                    <div class="single-product">
                                                                        <div class="product-thumb-sin">
                                                                            <a href="product_page.php?pro_id=' . $row['p_id'] . '"><img src="admin/uploaded_images/product_details_images/' . $row['p_image_1'] . '" alt="product Image" /></a>
                                                                            <div class="product-action">
                                                                                <a href="product_page.php?pro_id=' . $row['p_id'] . '" class="add-to-cart">
                                                                                <i class="fa fa-shopping-cart"></i>
                                                                                <span>Add to Cart</span>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="product-text">
                                                                            <h4><a href="product_page.php?pro_id=' . $row['p_id'] . '">' . $row['p_name'] . '</a></h4>
                                                                    ';
                                        ?>
                                        <?php
                                                            if (empty($row['p_sale_price']) or $row['p_sale_price'] == '0') {
                                                                echo '<span class="product-price pr-1">' . $row['p_price'] . ' pts</span>';
                                                            } else {
                                                                echo '<span class="product-price pr-1">' . $row['p_sale_price'] . ' pts</span>';
                                                                echo ' <span class="product-sale-price">' . $row['p_price'] . ' pts</span>';
                                                            }
                                                            echo '  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                ';
                                                        }
                                                    }
                                                    echo '</div>';
                                                }
                                            }
                                            /* No Records In Table then Rows are 0 */ 
                                        }
                                        /* No Records In Table then Rows are 0 */                                         }
                                        ?>

                                    </div>

                                    <!-- Products-Area End-->
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>
</body>

</html>