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

    .sm-mt-35 {
        margin-top: 35px;
    }

    .img-shadow {
        max-height: 400px;
        max-width: 458px;
    }

    .sin-service {
        width: 65rem;
        height: 27rem;
        max-width: 65rem;
        max-height: 30rem;
    }

    .sin-service h3 {
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
                                            <h2>Product Type<br /></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Banner-Area End-->

                        <!-- Product Type Start-->
                        <div class="service-area mt-47 sm-mt-40">
                            <div class="container">
                                <?php
                                include 'includes/connection.php';

                                $p_type_query = "SELECT * FROM product_type";
                                $p_type_query_execute = mysqli_query($conn, $p_type_query);
                                $total_rows = mysqli_num_rows($p_type_query_execute);

                                /* no of rows in table must be more then 0 */
                                if ($total_rows > 0) {
                                    echo '
                                            <!-- Product Type Header Start-->
                                            <div class="row">
                                                <div class="col-lg-8 offset-lg-2">
                                                    <div class="section-title style-2">
                                                        <h2>Shop From InfiGreen World</h2>
                                                        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters</p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Product Type Start-->
                                        ';
                                    for ($no = 1; $no <= $total_rows; $no++) {
                                        $row = mysqli_fetch_array($p_type_query_execute);
                                        if ($no % 2 == 0) {
                                            echo '
                                                <!-- Product ROW EVEN--> 
                                                <div class="row align-items-center mb-4 margin-top-40 sm-mt-50">
                                                    <!-- Product Type --> 
                                                    <div class="col-lg-7 col-md-5 col-sm-4">
                                                        <div class="sin-service">
                                                            <i class="fa fa-pagelines"></i>
                                                            <h3>' . $row['p_type_title'] . '</h3>
                                                            <p>' . $row['p_type_description'] . '</p>
                                                            <a href="product_category.php?p_id=' . $row['p_type_id'] . '" class="btn-common">Select Category</a>
                                                        </div>
                                                    </div>
                                                    <!-- Product Type Image --> 
                                                    <div class="col-lg-5 col-md-7 col-sm-8 d-none d-lg-block">
                                                        <div class="img-shadow">
                                                            <img src="admin/uploaded_images/product_type_images/' . $row['p_type_image'] . '" class="img-shadow" alt="Product Type Image"/>
                                                        </div>
                                                    </div>-
                                                </div>
                                                ';
                                        } else {
                                            echo '
                                                <!-- Product ROW ODD--> 
                                                <div class="row align-items-center mb-5 margin-top-40 sm-mt-50">
                                                    <!-- Product Type Image --> 
                                                    <div class="col-lg-5 col-md-7 col-sm-8 d-none d-lg-block">
                                                        <div class="img-shadow">
                                                            <img src="admin/uploaded_images/product_type_images/' . $row['p_type_image'] . '" class="img-shadow" alt="Product Type Image"/>
                                                        </div>
                                                    </div>
                                                    <!-- Product Type --> 
                                                    <div class="col-lg-7 col-md-5 col-sm-4">
                                                        <div class="sin-service">
                                                            <i class="fa fa-pagelines"></i>
                                                            <h3>' . $row['p_type_title'] . '</h3>
                                                            <p>' . $row['p_type_description'] . '</p>
                                                            <a href="product_category.php?p_id=' . $row['p_type_id'] . '" class="btn-common">Select Category</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                ';
                                        }
                                    }
                                }
                                /* No Records In Table then Rows are 0 */ else {
                                    echo '
                                            <div class="service-area mb-5">
                                                <div class="container-fluid">
                                                    <!-- Service Header Our Service Start -->
                                                    <div class="row">
                                                        <div class="col-lg-8 offset-lg-2">
                                                            <div class="section-title style-4">
                                                                    <h2>No Product Type Available🤷‍♂️</h2>
                                                                    <h2>Sorry For the Inconvenience❗</h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        ';
                                }
                                mysqli_close($conn);
                                ?>
                            </div>
                        </div>
                        <!-- Service Area 1 End-->
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>
</body>

</html>