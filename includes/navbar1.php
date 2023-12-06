<style type="text/css">
    .navbar {
        margin-bottom: 0px;
        height: 6.5rem;
    }

    .navbar-brand {
        display: flex;
        align-items: center;
    }

    .navbar-brand>img {
        margin-inline-end: 10px;
    }

    .navbar>.left-nav.container-fluid {
        justify-content: flex-start;
    }

    .navbar>.right-nav.container-fluid {
        justify-content: flex-end;
    }

    .nav-item>a>text {
        color: darkgrey;
        font-size: 1.6rem;
    }

    .nav-item>a>text:hover {
        color: peru;
        font-size: 1.9rem;
        transition: all .4s ease;
        -webkit-transition: all .4s ease;
    }

    .navbar-light .navbar-nav .nav-link {
        color: darkgrey;
        padding-inline: 15px;
    }

    .navbar-light .navbar-nav .nav-link:hover {
        color: peru;
        transition: all .4s ease;
        -webkit-transition: all .4s ease;
    }

    .middle-nav>.d-flex {
        padding-inline-end: 10px;
    }

    .d-flex>.form-control {
        margin-inline-end: 10px;
        font-size: 1.2rem;
    }

    .btn {
        width: fit-content;
    }

    .nav-item .nav-link span {
        font-size: 1.7rem;
        color: darkgrey;
    }

    .right-nav>.nav-item {
        margin-inline-start: 20px;
    }

    .nav-item .nav-link span:hover {
        font-size: 1.9rem;
        color: yellowgreen;
        transition: all .4s ease;
        -webkit-transition: all .4s ease;
    }

    .user-header>p {
        text-transform: capitalize;
    }

    .hidden-xs {
        text-transform: capitalize;
    }

    /* Profile user */
    .dropdown-menu>li>a {
        text-decoration: none;
        color: white;
        font-size: 1.5rem;
    }

    .dropdown-menu>li>a:hover {
        background-color: transparent;
        color: #8bc052;
        font-size: 1.7rem;
    }

    /* cart item */
    .cart-item {
        position: absolute;
        margin-inline-start: 13px;
        margin-bottom: 0px;
        margin-top: -6px;
        color: darkgray;
        font-family: monospace;
    }
</style>
<header class="main-header">
    <nav class="navbar navbar-expand-lg fixed-top navbar-light" style="background-color: #29353e;">
        <!-- Left Navbar -->
        <div class="left-nav container-fluid">
            <a class="navbar-brand" href="index.php" style="color:yellowgreen; font-size: 2.5rem;">
                <img src="images/client/home_page/logo.png" width="55" height="55" class="d-inline-block align-text-top" alt="logo">
                InfiGreen
            </a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php"><text>Home</text></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="product_type.php"><text>Shop</text></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sell_waste.php"><text>Sell Waste</text></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="contact_us.php"><text>Contact Us</text></a>
                </li>
            </ul>
        </div>
        <!-- Right Navbar -->
        <div class="right-nav container-fluid">
            <!-- Search Part -->
            <form method="POST" class="d-flex" action="#">
                <input name="search_keyword" class="form-control me-2" type="search" placeholder="Search Product" aria-label="Search">
                <button name="submit_search" class="btn btn-success" type="submit">Search</button>
            </form>
            <!-- Cart and User Login & Sign Up Part -->
            <div class="nav-item">
                <label class="cart-item">
                    <?php
                    include 'connection.php';

                    if (isset($_SESSION['client_users'])) {
                        $cart_q = "SELECT cart_id FROM cart_details where client_id=" . $client_query['client_id'] . "";
                        $cart_q_execute = mysqli_query($conn, $cart_q);
                        $cart_item = mysqli_num_rows($cart_q_execute);
                        echo $cart_item;
                    } else {
                        echo '0';
                    }
                    ?>
                </label>
                <a href="cart_view.php" class="nav-link">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Cart</span>
                </a>
            </div>
            <?php
            /* If User Login */
            if (isset($_SESSION['client_users'])) {
                echo '
                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav">
                                <li class="dropdown user user-menu">
                                    <a href="#" style="line-height: 35px; padding-top: 8px; padding-bottom: 11px;" class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="admin/uploaded_images/client_images/' . $client_query['image'] . '" class="user-image" style="width: 42px; height: 42px; border-radius: 15%;" alt="Client Image">
                                        <span class="hidden-xs">' . $client_query['username'] . '</span> 
                                    </a>
                                    <ul class="dropdown-menu pt-0">
                                        <!-- User image -->
                                        <li class="user-header" style="background-color: #17354b;">
                                            <img src="admin/uploaded_images/client_images/' . $client_query['image'] . '" class="img-circle" style="height: 95px; width: 95px; border-radius: 25%;" alt="Client Image" />
                                            <a href="profile.php">
                                                ' . $client_query['username'] . '   
                                            </a>
                                        </li>
                                        <li class="user-footer" style="background-color: #54697e;">
                                            <div class="pull-left">
                                                <a href="your_order.php" class="btn btn-info btn-lg">
                                                <i class="fa fa-cart-arrow-down"></i>
                                                Your Orders</a>
                                            </div>
                                            <div class="pull-right">
                                                <a href="./logout.php" class="btn btn-danger btn-lg">
                                                <i class="fa fa-sign-out"></i>
                                                Sign Out</a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    ';
            }
            /* If User is not Login  */ else {
                echo '
                        <div class="nav-item">
                            <a href="login.php" class="nav-link">
                                <i class="fa fa-sign-in"></i>
                                <span>Login</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="sign_up.php" class="nav-link">
                                <i class="fa fa-plus-square"></i>
                                <span>Sign up</span>
                            </a>
                        </div>
                    ';
            }
            ?>
        </div>
    </nav>
</header>