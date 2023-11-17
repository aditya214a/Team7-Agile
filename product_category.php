<?php
if (empty($_GET['p_id'])) {
    header('location: product_type.php');
}
?>
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

    .mt-40 {
        margin-top: 40px;
    }

    .mb-40 {
        margin-bottom: 40px;
    }

    .sin-service {
        padding: 0px;
        max-height: 58rem;
        height: 57rem;
    }

    .sin-service h3 {
        margin-top: 10px;
        margin-bottom: 0px;
    }

    .sin-service img {
        max-height: 37rem;
        height: 37rem;
    }

    .sin-service p {
        padding-inline: 10px;
        margin-top: 0px;
    }

    .btn-common {
        min-width: 100px;
        text-transform: capitalize;
        color: aliceblue;
        border-radius: 5px;
    }

    .btn-common:hover {
        color: aliceblue;
        border-radius: 5px;
    }

    .margin-top-40 {
        margin-top: 40px;
    }

    .style-6 h2 {
        font-family: cursive;
        font-size: 28px
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
                                            <h2>Product Category<br /></h2>
                                            <p class="mt-35">You cannot inspect quality into the product; it is already there.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Banner-Area End-->


                        <!-- Product Category -->
                        <div class="service-area mt-5 mb-40 sm-mt-80">
                            <div class="container">
                                <?php
                                include 'includes/connection.php';

                                $p_category_query = "SELECT * FROM product_category WHERE p_type_id=" . $_GET['p_id'] . "";
                                $p_category_query_execute = mysqli_query($conn, $p_category_query);
                                $total_rows = mysqli_num_rows($p_category_query_execute);

                                /* No of rows in table must be more then 0 */
                                if ($total_rows > 0) {
                                    echo '
                                            <!-- Product Category Header Start-->
                                            <div class="row">
                                                <div class="col-lg-8 offset-lg-2">
                                                    <div class="section-title style-2">
                                                        <h2>Shop From InfiGreen World</h2>
                                                        <p>Just take a look we wont charge you look for a best quality plant and in reasonable price.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Product Category List -->
                                        ';
                                    for ($no = 1; $no <= $total_rows; $no++) {
                                        $row = mysqli_fetch_array($p_category_query_execute);
                                        if ($no % 2 == 1) echo '<div class="row margin-top-40">';
                                        echo '
                                                <!-- Product Category List -->
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="sin-service">
                                                        <img src="admin/uploaded_images/product_category_images/' . $row['p_category_image'] . '" alt="category image"/>
                                                        <h3>' . $row['p_category_title'] . '</h3>
                                                        <p>' . $row['p_category_description'] . '</p>
                                                        <a href="product_list.php?p_cat_id=' . $row['p_category_id'] . '" class="btn-common">Buy Now</a>
                                                    </div>
                                                </div>
                                            ';
                                        if ($no % 2 == 0) echo '</div>';
                                    }
                                }
                                /* No Records In Table then Rows are 0 */ else {
                                    echo '
                                            <div class="service-area">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-lg-8 offset-lg-2">
                                                            <div class="section-title style-6">
                                                                <h2>🍀No Category Available🍀</h2>
                                                                <a href="product_type.php" class="btn-common">Select Another Type</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        ';
                                }
                                mysqli_close($conn);
                                ?>
                            </div><br>
                        </div>
                        <!-- Product Category End -->
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>
</body>

</html>