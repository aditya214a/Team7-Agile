<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/connection.php'; ?>
<style type="text/css">
    .banner-area.bg-1 {
        background: rgba(0, 0, 0, 0) url("assets/images/banners/1.jpg") no-repeat scroll center center / cover;
    }

    .banner-area.bg-2 {
        background: rgba(0, 0, 0, 0) url("assets/images/banners/2.jpg") repeat scroll center center / cover;
    }

    .banner-area.bg-3 {
        background: rgba(0, 0, 0, 0) url("assets/images/banners/3.jpg") repeat scroll center center / cover;
    }

    .banner-area.bg-5 {
        background: rgba(0, 0, 0, 0) url("assets/images/banners/5.jpg") repeat scroll center center / cover;
    }

    .banner-area.bg-4 {
        background: rgba(0, 0, 0, 0) url("assets/images/banners/6.jpg") repeat scroll center center / cover;
    }

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
                        <!-- video -->
                        <div class="banner-area bg-4 overlay">
                            <div class="">
                                <div class="row align-items-center height-800 pb-111">
                                    <div class="col-sm-12">
                                        <div class="banner-text text-center">
                                            <h2>Sell Your Waste</h2>
                                            <p class="mt-30"><i>"Sell and Buy From InfiGreen To Give Your Stay a Nature Beauty"</i></p>
                                            <a class="venobox video-play" data-gall="gall-video" data-autoplay="true" data-vbtype="video" href="images/client/home_page/sellwaste.mp4">
                                                <i class="fa fa-play"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- video End -->
                        <!-- Information Read More Part -->
                        <div class="service-area mt-minus-100 sm-mt-80">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="sin-service">
                                            <img src="assets/images/projects/13.jpg" alt="promo">
                                            <h3>Let’s Recycle and Save the Earth by break waste chain</h3>
                                            <p>A wise man once said, Reuse the past and Recycle the present to save the future.</p>
                                            <a href="https://swapeco.com/blog/lets-recycle-and-save-the-earth/" class="readmore">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <!-- Information Read More Part End -->
                        <!-- Banner-Area Start-->
                        <div class="banner-area bg-2">
                            <div class="container">
                                <div class="row align-items-center height-800">
                                    <div class="col-lg-8 offset-lg-2 col-md-12">
                                        <div class="banner-text style-3 text-black text-center mt-minus-10">
                                            <h2>Selling Waste <br /> To InfiGreen A Best Choice</h2>
                                            <p class="mt-35">If you want to <b>SELL</b> your <b>WASTE</b> to InfiGreen you Need to <b>Apply</b> for <b>InfiGreen Card</b>. It will <b>Generate a Card</b> which helps you to Sell your waste to Nearby <b>InfiGreen Waste Center</b>. So amount will be Credited to your Card. From this you can Give a <b>Nature Beauty</b> to your <b>Homes or Workspace.</b></p>
                                            <?php
                                            if (!empty($_SESSION['client_users'])) {
                                            ?>
                                                <a href="#card_register" class="btn-common card-register brown-btn mt-40" style="background-color:brown;"><i class="fa fa-credit-card-alt mr-2"></i> Card Registration</a>
                                            <?php } else {
                                            ?>
                                                <a href="login.php" class="btn-common brown-btn mt-40"><i class="fa fa-sign-in"></i> Login</a>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--banner-area end-->
                        <!-- Benefit Area Start -->
                        <div class="benefit-area mt-80 sm-mt-65">
                            <div class="container">
                                <div class="row">
                                    <!-- Shadow Image -->
                                    <div class="col-lg-5 col-sm-12 d-none d-lg-block">
                                        <div class="img-shadow">
                                            <img src="assets/images/projects/16.jpg" class="img-shadow" alt="" />
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-sm-12">
                                        <div class="section-title style-4 text-left pt-10">
                                            <h2>Why to "SELL" Your "WASTE"?</h2>
                                        </div>
                                        <div class="row mt-30">
                                            <!-- 1st Column -->
                                            <div class="col-sm-6">
                                                <div class="sin-service style-2 text-left">
                                                    <i class="fa fa-pagelines" aria-hidden="true"></i>
                                                    <h3>Go green with recycling</h3>
                                                    <p>Deciding to green your life means finding effective ways to reduce your energy consumption while increasing the number of products you recycle or reuse in your home.</p>
                                                    <p><b> The goal of going green is to significantly reduce your family's contribution to waste production, greenhouse gas emissions and consumption of natural resources.</b></p>
                                                </div>
                                            </div>
                                            <!-- 2nd Column -->
                                            <div class="col-sm-6">
                                                <div class="sin-service style-2 text-left">
                                                    <i class="fa fa-globe" aria-hidden="true"></i>
                                                    <h3>It’s a small planet, Recycle</h3>
                                                    <p>Recycling, recovery and reprocessing of waste materials for use in new products. </p>

                                                    <p><b> The materials reused in recycling serve as substitutes for raw materials obtained from such increasingly scarce natural resources as petroleum, natural gas, coal, mineral ores, and trees. Recycling can help reduce the quantities of solid waste deposited in landfills, which have become increasingly expensive.</b></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--benefit-area end-->
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/card_registration_modal.php'; ?>
    <?php include 'includes/scripts.php'; ?>
    <script>
        $(document).on('click', '.card-register', function(e) {
            e.preventDefault();
            $('#card_register').modal('show');
            return false;
        });
    </script>
</body>

</html>