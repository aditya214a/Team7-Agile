<?php
include 'includes/session.php';
include 'includes/scripts.php';
include 'includes/connection.php';


$p_type_name = @$_POST['p_type_name'];
$p_category_name = @$_POST['p_category_name'];
$p_name = @$_POST['p_name'];
$p_price = @$_POST['p_price'];
$p_sale_price = @$_POST['p_sale_price'];
$p_qty = @$_POST['p_qty'];
$p_details = @$_POST['p_details'];
$p_benefits = @$_POST['p_benefits'];
$p_video = @$_POST['p_video'];

$ptypeid = @$_GET['ptypeid'];

$product_type_query = "Select * from product_type";
$product_type_result = mysqli_query($conn, $product_type_query);

$product_category_query = "Select * from product_category where p_type_id=$ptypeid";
$product_category_result = mysqli_query($conn, $product_category_query);

$p_type_nameErr = $p_category_nameErr = $p_nameErr = $p_priceErr = $p_sale_priceErr = $p_qtyErr = $imageErr1 = $imageErr2 = $imageErr3 = $imageErr4 = $p_detailsErr = $p_benefitsErr = $p_videoErr = "";

if (isset($_POST['add'])) {
    $target_dir = "uploaded_images/product_details_images/";
    // Valid file extensions
    $extensions_arr = array("jpg", "jpeg", "png", "gif");

    $filename1 = $_FILES['photo1']['name'];
    $target_file1 = $target_dir . basename($_FILES["photo1"]["name"]);
    // Select file type
    $imageFileType1 = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));

    $filename2 = $_FILES['photo2']['name'];
    $target_file2 = $target_dir . basename($_FILES["photo2"]["name"]);
    // Select file type
    $imageFileType2 = strtolower(pathinfo($target_file2, PATHINFO_EXTENSION));

    $filename3 = $_FILES['photo3']['name'];
    $target_file3 = $target_dir . basename($_FILES["photo3"]["name"]);
    // Select file type
    $imageFileType3 = strtolower(pathinfo($target_file3, PATHINFO_EXTENSION));

    $filename4 = $_FILES['photo4']['name'];
    $target_file4 = $target_dir . basename($_FILES["photo4"]["name"]);
    // Select file type
    $imageFileType4 = strtolower(pathinfo($target_file4, PATHINFO_EXTENSION));


    /*  Validations  */

    $p_name_query = "SELECT * FROM product_details WHERE p_name='$p_name' LIMIT 1";
    $p_name_query_result = mysqli_query($conn, $p_name_query);
    $p_name_compare = mysqli_fetch_assoc($p_name_query_result);

    if ($p_name == "") {
        $p_nameErr = "* You Forgot to Enter Product Name!";
    } else if (!preg_match('/^[a-zA-Z ]*$/', $p_name)) {
        $p_nameErr = "* No Special Character or Number Allowed!";
    } else if (!preg_match('/^[a-zA-Z ]{2,35}$/', $p_name)) {
        $p_nameErr = "* Name Must be between 2-35 characters";
    } else if (@$p_name_compare['p_name'] === $p_name) {
        // if name exists 
        $p_nameErr = "* " . $p_name . " already Exists!";
    } else if ($p_price == "") {
        $p_priceErr = "* You Forgot to Enter Product Price!";
    } else if (!preg_match('/^[0-9 ]*$/', $p_price)) {
        $p_priceErr = "* No Special Character or Alphabets Allowed!";
    } else if (!preg_match('/^[0-9 ]*$/', $p_sale_price)) {
        $p_sale_priceErr = "* No Special Character or Alphabets Allowed!";
    } else if ($p_qty == "") {
        $p_qtyErr = "* You Forgot to Enter Product Quantity!";
    } else if (!preg_match('/^[0-9 ]*$/', $p_qty)) {
        $p_qtyErr = "* No Special Character or Alphabets Allowed!";
    } else if ($p_type_name == "--- Select Product Type ---") {
        $p_type_nameErr = "* You Forgot to Select Product Type!";
    } else if ($p_category_name == "--- Select Category Type ---") {
        $p_category_nameErr = "* You Forgot to Select Product Category!";
    } else if ($filename1 == "") {
        $imageErr1 = "* Compulsory to Upload Product Image 1!";
    } else if (!in_array($imageFileType1, $extensions_arr)) {
        $imageErr = "* Extension Supported: jpg, jpeg, png, gif";
    } else if ($filename2 == "") {
        $imageErr2 = "* Compulsory to Upload Product Image 2!";
    } else if (!in_array($imageFileType2, $extensions_arr)) {
        $imageErr2 = "* Extension Supported: jpg, jpeg, png, gif";
    } else if ($filename3 == "") {
        $imageErr3 = "* Compulsory to Upload Product Image 3!";
    } else if (!in_array($imageFileType3, $extensions_arr)) {
        $imageErr3 = "* Extension Supported: jpg, jpeg, png, gif";
    } else if ($filename4 == "") {
        $imageErr4 = "* Compulsory to Upload Product Image 4!";
    } else if (!in_array($imageFileType4, $extensions_arr)) {
        $imageErr4 = "* Extension Supported: jpg, jpeg, png, gif";
    } else if ($p_details == "") {
        $p_detailsErr = "* You Forgot to Write Product Details!";
    } else if ($p_benefits == "") {
        $p_benefitsErr = "* You Forgot to Write Product Benefits!";
    } else {
        try {
            if ($p_sale_price == "") {
                $p_sale_price = '0';
            }
            if ($p_video == "") {
                $p_video = 'NULL';
            }
            move_uploaded_file($_FILES['photo1']['tmp_name'], $target_dir . $filename1);
            move_uploaded_file($_FILES['photo2']['tmp_name'], $target_dir . $filename2);
            move_uploaded_file($_FILES['photo3']['tmp_name'], $target_dir . $filename3);
            move_uploaded_file($_FILES['photo4']['tmp_name'], $target_dir . $filename4);
            $now = date('Y-m-d h:i:sa');

            $insert_query = "INSERT INTO product_details(p_type_id,p_category_id,p_name,p_price,p_sale_price,p_qty,p_image_1,p_image_2,p_image_3,p_image_4,p_details,p_benefits,p_video,p_date) values($p_type_name,$p_category_name,'$p_name','$p_price','$p_sale_price','$p_qty','$filename1','$filename2','$filename3','$filename4','$p_details','$p_benefits','$p_video','$now')";
            mysqli_query($conn, $insert_query);
            $_SESSION['success'] = $p_name . ' Added Successfully';
            mysqli_close($conn);
            header('location: product_details.php');  // used for redirecting      
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }
    }
}
?>
<html>
<?php include 'includes/header.php'; ?>

<head>
    <style>
        input[type=checkbox],
        input[type=radio],
        input[type=file],
        select {
            cursor: pointer;
        }

        .form-check-label {
            cursor: pointer;
        }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Add Product Category
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box" style="padding:30px;">
                            <form name="addform" class="form-horizontal needs-validation" method="POST" action="" enctype="multipart/form-data" novalidate>

                                <!-- row 1 -->

                                <div class="row form-group">
                                    <label for="p_name" class="col-sm-2 control-label">Product Name</label>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="p_name" name="p_name" placeholder="product name" value="<?php echo $p_name ?>" required>
                                        <p class="invalid"><?php if (isset($p_nameErr)) echo $p_nameErr; ?></p>
                                    </div>

                                    <label for="p_price" class="col-sm-2 control-label">Product Price</label>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="p_price" name="p_price" placeholder="product mrp" value="<?php echo $p_price ?>" required>
                                        <p class="invalid"><?php if (isset($p_priceErr)) echo $p_priceErr; ?></p>
                                    </div>
                                </div>

                                <!-- row 2 -->

                                <div class="row form-group">
                                    <label for="p_sale_price" class="col-sm-2 control-label">Product Sale Price</label>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="p_sale_price" name="p_sale_price" placeholder="product sale price" value="<?php echo $p_sale_price ?>">
                                        <p class="invalid"><?php if (isset($p_sale_priceErr)) echo $p_sale_priceErr; ?></p>
                                    </div>

                                    <label for="p_qty" class="col-sm-2 control-label">Product Qty</label>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="p_qty" name="p_qty" placeholder="product qty" value="<?php echo $p_qty ?>" required>
                                        <p class="invalid"><?php if (isset($p_qtyErr)) echo $p_qtyErr; ?></p>
                                    </div>
                                </div>

                                <!-- row 3 -->

                                <div class="row form-group">
                                    <label for="p_type_name" class="col-sm-2 control-label">Select Product Type</label>
                                    <div class="col-sm-3">
                                        <select id="p_type_name" name="p_type_name" class="form-control" style="cursor:pointer;margin-bottom:10px;">
                                            <option>--- Select Product Type ---</option>
                                            <?php
                                            if (empty($ptypeid)) {
                                                while ($row = mysqli_fetch_assoc($product_type_result)) {
                                                    /* $selected = ($row['p_type_id'] == $check['p_type_id']) ? 'selected' : '';  */
                                                    echo "<option value='" . $row["p_type_id"] . "'>" . $row["p_type_title"] . "</option>";
                                                }
                                            }
                                            if (!empty($ptypeid)) {
                                                while ($row = mysqli_fetch_assoc($product_type_result)) {
                                                    $selected = ($row['p_type_id'] == $ptypeid) ? 'selected' : '';
                                                    echo "<option value='" . $row["p_type_id"] . "' " . $selected . ">" . $row["p_type_title"] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                        <p class="invalid"><?php if (isset($p_type_nameErr)) echo $p_type_nameErr; ?></p>
                                    </div>

                                    <label for="p_category_name" class="col-sm-2 control-label">Select Category Type</label>
                                    <div class="col-sm-3">
                                        <select id="p_category_name" name="p_category_name" class="form-control" style="cursor:pointer;margin-bottom:10px;">
                                            <option>--- Select Category Type ---</option>
                                            <?php
                                            if (!empty($ptypeid)) {
                                                while ($row = mysqli_fetch_assoc($product_category_result)) {
                                                    /* $selected = ($row['p_type_id'] == $check['p_type_id']) ? 'selected' : '';  */
                                                    echo "<option value='" . $row["p_category_id"] . "'>" . $row["p_category_title"] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                        <p class="invalid"><?php if (isset($p_category_nameErr)) echo $p_category_nameErr; ?></p>
                                    </div>
                                </div>

                                <!-- row 4 -->

                                <div class="row form-group">

                                    <label for="photo1" class="col-sm-2 control-label">Image 1</label>
                                    <div class="col-sm-3">
                                        <input type="file" id="photo1" name="photo1" required>
                                        <p class="invalid"><?php if (isset($imageErr1)) echo $imageErr1; ?></p>
                                    </div>

                                    <label for="photo2" class="col-sm-2 control-label">Image 2</label>
                                    <div class="col-sm-3">
                                        <input type="file" id="photo2" name="photo2" required>
                                        <p class="invalid"><?php if (isset($imageErr2)) echo $imageErr2; ?></p>
                                    </div>
                                </div>

                                <!-- row 5 -->

                                <div class="row form-group">

                                    <label for="photo3" class="col-sm-2 control-label">Image 3</label>
                                    <div class="col-sm-3">
                                        <input type="file" id="photo3" name="photo3" required>
                                        <p class="invalid"><?php if (isset($imageErr3)) echo $imageErr3; ?></p>
                                    </div>

                                    <label for="photo4" class="col-sm-2 control-label">Image 4</label>
                                    <div class="col-sm-3">
                                        <input type="file" id="photo4" name="photo4" required>
                                        <p class="invalid"><?php if (isset($imageErr4)) echo $imageErr4; ?></p>
                                    </div>
                                </div>

                                <!-- row 6 -->

                                <div class="row form-group">
                                    <p class="col-sm-2 control-label"><b>Product Details</b></p>
                                    <div class="form-group">
                                        <div class="col-sm-8">
                                            <textarea id="editor1" name="p_details" rows="10" cols="80" required><?php echo $p_details; ?></textarea>
                                        </div>
                                    </div>
                                    <p class="invalid"><?php if (isset($p_detailsErr)) echo $p_detailsErr; ?></p>
                                </div>

                                <!--  row 7 -->

                                <div class="row form-group">
                                    <p class="col-sm-2 control-label"><b>Product Benefits</b></p>
                                    <div class="form-group">
                                        <div class="col-sm-8">
                                            <textarea id="editor2" name="p_benefits" rows="10" cols="80" required><?php echo $p_benefits; ?></textarea>
                                        </div>
                                    </div>
                                    <p class="invalid"><?php if (isset($p_benefitsErr)) echo $p_benefitsErr; ?></p>
                                </div>

                                <!--  row 8 -->

                                <div class="row form-group">
                                    <label for="p_video" class="col-sm-2 control-label">Video Link</label>

                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="p_video" name="p_video" placeholder="product video link" value="<?php echo $p_video ?>" required>
                                        <p class="invalid"><?php if (isset($p_videoErr)) echo $p_videoErr; ?></p>
                                    </div>
                                </div>

                                <!--  row 9 -->

                                <div class="modal-footer">
                                    <a href="product_details.php"><button type="button" class="btn btn-danger btn-flat" name="close"><i class="fa fa-close"></i> Close</button></a>
                                    <button type="submit" class="btn btn-primary btn-flat" name="add" id="add"><i class="fa fa-save"></i> Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <?php include 'includes/footer.php'; ?>

    </div>
    <!-- ./wrapper -->

    <?php include 'includes/scripts.php'; ?>
    <script>
        $(document).ready(function() {
            $('#p_type_name').on('change', function() {
                var ptypeid = $(this).val();
                window.location = "?ptypeid=" + ptypeid;
            });
        });
    </script>
</body>

</html>