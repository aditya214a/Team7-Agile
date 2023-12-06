<?php 
ob_start();
include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<style type="text/css">
.content {
    padding: 0px;
    padding-left: 0px;
    padding-right: 0px;
}
.mt-25{
    margin-top: 25px;
}
.mb-40{
    margin-bottom: 40px;
}
.sm-mt-20{
    margin-top: 20px;
}
.img-shadow{
    max-width: 458px;
    max-height: 400px;
}
/* product css */
.page-header{
    margin-bottom:0px;
    font-family: 'Delius Swash Caps';
    font-weight: 500;
}
/* single product css */
.single-product .product-thumb-sin a img{
    max-height: 420px;
    height: fit-content;
}
.product-action .add-to-cart {
    color: aliceblue;
}
/* product text css */
.product-text h4 a{
    font-family: cursive;
    color: #444;
}
.product-text h4 a:hover{
    color: forestgreen;
}
.product-text{
    margin-top: 13px;
}
.product-sale-price{
    text-decoration:line-through;
    color: gray;
}
.product-text > .product-price{
    color:#464444;
    font-family: 'Delius Swash Caps';
    font-weight: 600;
}

/* extra css */
.style-6 h2{
    font-family: cursive;
    font-size:28px
}
.style-6 a{
    color: aliceblue;
    border-radius:5px;
}
.style-6 a:hover{
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
                        <!-- Products-Area Start-->
                        <div class="container mt-5 pt-5">
					        <div class="products-area sm-mt-30" id="shop">
                                <?php
                                    include 'includes/connection.php';

                                    if(isset($_POST['submit_search'])){
                                        $search_keyword = $_POST['search_keyword'];
                                        
                                        $search_keyword_query = "SELECT p_id,p_name,p_price,p_sale_price,p_image_1 FROM product_details WHERE p_name LIKE '%$search_keyword%'";
                                        $search_keyword_execute = mysqli_query($conn,$search_keyword_query);
                                        $search_keyword_no = mysqli_num_rows($search_keyword_execute);
                                        /* No of records matched to typed keyword */
                                        if($search_keyword_no == 0){
                                            echo '<h1 class="page-header">No results found for <b><i>"'.$search_keyword.'"</i></b></h1>';
                                        }
                                        /* Keywords matched to typed keyword */
                                        else{
                                            echo '<h1 class="page-header">Search results for <b><i>"'.$search_keyword.'"</i></b></h1>';
                                            $rounded_row= ceil($search_keyword_no/3);
                                            if($search_keyword_no>0){  
                                                for($no = 1; $no <= $rounded_row; $no++){
                                                    echo '<div class="row mb-4">';
                                                    for($i=1; $i<=3; $i++){
                                                        $row = mysqli_fetch_array($search_keyword_execute);
                                                        if(!empty($row['p_id']))
                                                        {   
                                                            echo '
                                                            <!-- Product -->
                                                            <div class="col-lg-4">
                                                                <div class="single-product mt-0">
                                                                    <div class="product-thumb-sin">
                                                                        <a href="product_page.php?pro_id='.$row['p_id'].'"><img src="admin/uploaded_images/product_details_images/'.$row['p_image_1'].'" alt="product Image" /></a>
                                                                        <div class="product-action">
                                                                            <a href="product_page.php?pro_id='.$row['p_id'].'" class="add-to-cart">
                                                                            <i class="fa fa-shopping-cart"></i>
                                                                            <span>Add to Cart</span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="product-text">
                                                                        <h4><a href="product_page.php?pro_id='.$row['p_id'].'">'.$row['p_name'].'</a></h4>
                                                                    ';
                                                                ?>
                                                                <?php 
                                                                    if(empty($row['p_sale_price']) or $row['p_sale_price']=='0'){
                                                                        echo '<span class="product-price pr-1">₹'.$row['p_price'].'</span>';
                                                                    }
                                                                    else{
                                                                        echo '<span class="product-price pr-1">₹'.$row['p_sale_price'].'</span>';
                                                                        echo ' <span class="product-sale-price">₹'.$row['p_price'].'</span>';
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
                                            else{
                                                echo '';
                                            }
                                        }
                                    }
                                ?>     
                            </div>
                                <!-- Products-Area End-->
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>
</html>
<?php 
ob_end_flush();
?>