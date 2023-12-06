<?php
    include 'includes/session.php';
	include 'includes/scripts.php'; 
    include 'includes/connection.php';

    $eid=@$_GET['id'];

    $p_id = @$_POST['p_id'];
    $p_type_name = @$_POST['p_type_name'];
    $p_category_name = @$_POST['p_category_name'];
    $p_name = @$_POST['p_name'];
    $p_price = @$_POST['p_price'];
    $p_sale_price = @$_POST['p_sale_price'];
    $p_qty = @$_POST['p_qty'];
    $p_details = @$_POST['p_details'];
    $p_benefits = @$_POST['p_benefits'];
    $p_video = @$_POST['p_video'];


    $product_type_query="Select * from product_type";
	$product_type_result=mysqli_query($conn, $product_type_query);

    #save state of selected value in category :

    $product_category_query="Select * from product_category where p_type_id='$p_type_name'";
    $product_category_result=mysqli_query($conn, $product_category_query);
  

	$p_type_nameErr = $p_category_nameErr = $p_nameErr = $p_priceErr = $p_sale_priceErr = $p_qtyErr = $p_detailsErr = $p_benefitsErr = $p_videoErr = "";

    if($eid!="" or $p_id!="")
    {
        $edit_select_query="SELECT *, pc.p_category_title, pt.p_type_title FROM product_details as pd, product_type as pt, product_category as pc WHERE pd.p_type_id=pt.p_type_id and pd.p_category_id=pc.p_category_id  and pd.p_id=$eid";
        $edit_execute_query=mysqli_query($conn, $edit_select_query); 
        $query_row_result=@mysqli_fetch_assoc($edit_execute_query);
    }

	if(isset($_POST['update']))
	{
        if($p_id!=""){
            $edit_select_query="SELECT *, pc.p_category_title, pt.p_type_title FROM product_details as pd, product_type as pt, product_category as pc WHERE pd.p_type_id=pt.p_type_id and pd.p_category_id=pc.p_category_id  and pd.p_id=$p_id";
            $edit_execute_query=mysqli_query($conn, $edit_select_query); 
            $query_row_result=@mysqli_fetch_assoc($edit_execute_query);
        }
        else{
            $edit_select_query="SELECT *, pc.p_category_title, pt.p_type_title FROM product_details as pd, product_type as pt, product_category as pc WHERE pd.p_type_id=pt.p_type_id and pd.p_category_id=pc.p_category_id  and pd.p_id=$eid";
            $edit_execute_query=mysqli_query($conn, $edit_select_query); 
            $query_row_result=@mysqli_fetch_assoc($edit_execute_query);
        }

		if($p_name == "")
        {
			$p_nameErr="* You Forgot to Enter Product Name!";
        }
        else if(!preg_match('/^[a-zA-Z ]*$/',$p_name))
        {
            $p_nameErr="* No Special Character or Number Allowed!";
        }
		else if(!preg_match('/^[a-zA-Z ]{2,35}$/',$p_name))
        {
			$p_nameErr="* Name Must be between 2-35 characters";
        }     
        else if($p_price == "")
        {
			$p_priceErr="* You Forgot to Enter Product Price!";
        } 
        else if(!preg_match('/^[0-9 ]*$/',$p_price))
        {
            $p_priceErr="* No Special Character or Alphabets Allowed!";
        }
        else if(!preg_match('/^[0-9 ]*$/',$p_sale_price))
        {
            $p_sale_priceErr="* No Special Character or Alphabets Allowed!";
        }
        else if($p_qty == "")
        {
			$p_qtyErr="* You Forgot to Enter Product Quantity!";
        }
        else if(!preg_match('/^[0-9 ]*$/',$p_qty))
        {
            $p_qtyErr="* No Special Character or Alphabets Allowed!";
        } 
        else if($p_type_name=="--- Select Product Type ---")
        {  
            $p_type_nameErr="* You Forgot to Select Product Type!";
		}
        else if($p_category_name=="--- Select Category Type ---")
        {  
            $p_category_nameErr="* You Forgot to Select Product Category!";
		}
        else if($p_details == "")
        {
            $p_detailsErr="* You Forgot to Write Product Details!";
        }
        else if($p_benefits == "")
        {
            $p_benefitsErr="* You Forgot to Write Product Benefits!";
        }
		else{

            $p_name_check_query = "SELECT * FROM product_details WHERE p_name='$p_name' and p_id!=$eid LIMIT 1";
            $p_name_result = mysqli_query($conn, $p_name_check_query);
            $p_name_compare = mysqli_fetch_assoc($p_name_result);
			
            if($p_name == @$p_name_compare['p_name']){
                $p_nameErr="* ".$p_name." already Exists!";
            }      
            else{
                try{ 
                    if($p_sale_price=="")
                    {
                        $p_sale_price='0';
                    }
                    if($p_video==""){
                        $p_video='NULL';
                    }

                    $update_query="UPDATE product_details SET p_type_id='$p_type_name', p_category_id='$p_category_name', p_name='$p_name', p_price='$p_price', p_sale_price='$p_sale_price', p_qty='$p_qty', p_details='$p_details', p_benefits='$p_benefits', p_video='$p_video'  WHERE p_id=$eid";

                    mysqli_query($conn,$update_query);
                    $_SESSION['success'] = $p_name.' Updated Successfully';
                    mysqli_close($conn);
                    header('location: product_details.php');  // used for redirecting      
                }
                catch(Exception $e){
                    $_SESSION['error'] = $e->getMessage();
                }
            }
		}				
	}
?>
<html>
<?php include 'includes/header.php'; ?>
<head>
    <style>
    input[type=checkbox],
    input[type=radio], input[type=file], select{
        cursor: pointer;
    }
	.form-check-label{
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
                            <form name="addform" class="form-horizontal needs-validation" method="POST"
                                action="" enctype="multipart/form-data" novalidate>

                                <input type="hidden" class="p_id" name="p_id" id="p_id" value="<?php echo $eid; ?>"/>

                                <!-- row 1 -->
                    

                                <div class="row form-group">
                                    <label for="p_name" class="col-sm-2 control-label">Product Name</label>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="p_name" name="p_name"
                                            placeholder="product name" 
                                            value="<?php 
                                            if(($p_id!="" or $eid!="") and $p_name=="")
                                            {
                                                echo $query_row_result['p_name'];
                                            }
                                            else
                                            { 
                                                echo $p_name;
                                            } 
                                            ?>" required>
                                        <p class="invalid"><?php if(isset($p_nameErr))echo $p_nameErr; ?></p>
                                    </div>

                                    <label for="p_price" class="col-sm-2 control-label">Product Price</label>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="p_price" name="p_price"
                                            placeholder="product mrp" 
                                            value="<?php 
                                             if(($p_id!="" or $eid!="") and $p_price=="")
                                             {
                                                 echo $query_row_result['p_price'];
                                             }
                                             else
                                             { 
                                                 echo $p_price;
                                             } 
                                            ?>" required>
                                        <p class="invalid"><?php if(isset($p_priceErr))echo $p_priceErr; ?></p>
                                    </div>
                                </div>

                                <!-- row 2 -->

                                <div class="row form-group">
                                    <label for="p_sale_price" class="col-sm-2 control-label">Product Sale Price</label>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="p_sale_price" name="p_sale_price"
                                            placeholder="product sale price" 
                                            value="<?php 
                                             if(($p_id!="" or $eid!="") and $p_sale_price=="")
                                             {
                                                 echo $query_row_result['p_sale_price'];
                                             }
                                             else
                                             { 
                                                 echo $p_sale_price;
                                             } 
                                            ?>">
                                        <p class="invalid"><?php if(isset($p_sale_priceErr))echo $p_sale_priceErr; ?></p>
                                    </div>

                                    <label for="p_qty" class="col-sm-2 control-label">Product Qty</label>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="p_qty" name="p_qty"
                                            placeholder="product qty" 
                                            value="<?php 
                                              if(($p_id!="" or $eid!="") and $p_qty=="")
                                              {
                                                  echo $query_row_result['p_qty'];
                                              }
                                              else
                                              { 
                                                  echo $p_qty;
                                              } 
                                            ?>" required>
                                        <p class="invalid"><?php if(isset($p_qtyErr))echo $p_qtyErr; ?></p>
                                    </div>
                                </div>

                                <!-- row 3 -->

                                <div class="row form-group">
                                    <label for="p_type_name" class="col-sm-2 control-label">Select Product Type</label>
                                    <div class="col-sm-3">
                                        <select id="p_type_name" name="p_type_name" class="form-control" style="cursor:pointer;margin-bottom:10px;" onchange="fetch_select(this.value);">
                                            <option>--- Select Product Type ---</option>
                                            <?php 
                                                if(($p_id!="" or $eid!="") and $p_type_name=="")
                                                {
                                                    while($row = mysqli_fetch_assoc($product_type_result)) {
                                                    $selected = ($row['p_type_id'] == $query_row_result['p_type_id']) ? 'selected' : '';
                                                    echo "<option value='".$row["p_type_id"]."' ".$selected.">".$row["p_type_title"]."</option>";
                                                    }
                                                }
                                                else{
                                                    while($row = mysqli_fetch_assoc($product_type_result)) {
                                                        $selected = ($row['p_type_id'] == $p_type_name) ? 'selected' : '';
                                                        echo "<option value='".$row["p_type_id"]."' ".$selected.">".$row["p_type_title"]."</option>";
                                                        } 
                                                }
                                            ?>
                                        </select>
                                        <p class="invalid"><?php if(isset($p_type_nameErr))echo $p_type_nameErr; ?></p>
                                    </div>

                                    <label for="p_category_name" class="col-sm-2 control-label">Select Category Type</label>
                                    <div class="col-sm-3">
                                        <select id="p_category_name" name="p_category_name" class="form-control" style="cursor:pointer;margin-bottom:10px;">
                                            <option>--- Select Category Type ---</option>
                                           <?php
                                                if(($p_id!="" or $eid!="") and $p_category_name=="")
                                                {

                                                }
                                                else{
                                                    while($row = mysqli_fetch_assoc($product_category_result)) {
                                                        $selected = ($row['p_category_id'] == $p_category_name) ? 'selected' : '';
                                                        echo "<option value='".$row["p_category_id"]."' ".$selected.">".$row["p_category_title"]."</option>";
                                                        } 
                                                }
                                            ?>
                                        </select>
                                        <p class="invalid"><?php if(isset($p_category_nameErr))echo $p_category_nameErr; ?></p>
                                    </div>
                                </div>
                                
                                <!-- row 4 -->

                                <div class="row form-group">
                                    <p class="col-sm-2 control-label"><b>Product Details</b></p>
                                        <div class="form-group">
                                            <div class="col-sm-8">
                                    <textarea id="editor1" name="p_details" rows="10" cols="80" required><?php 
                                     if(($p_id!="" or $eid!="") and $p_details=="")
                                     {
                                         echo $query_row_result['p_details'];
                                     }
                                     else
                                     { 
                                         echo $p_details;
                                     } 
                                    ?></textarea>
                                     <p class="invalid"><?php if(isset($p_detailsErr))echo $p_detailsErr; ?></p>
                                            </div>      
                                        </div>
                                </div>

                               <!--  row 5 -->

                                <div class="row form-group">
                                    <p class="col-sm-2 control-label"><b>Product Benefits</b></p>
                                        <div class="form-group">
                                            <div class="col-sm-8">
                                                <textarea id="editor2" name="p_benefits" rows="10" cols="80" required><?php 
                                                if(($p_id!="" or $eid!="") and $p_benefits=="")
                                                {
                                                    echo $query_row_result['p_benefits'];
                                                }
                                                else
                                                { 
                                                    echo $p_benefits;
                                                } 
                                                ?></textarea>
                                                <p class="invalid"><?php if(isset($p_benefitsErr))echo $p_benefitsErr; ?></p>
                                            </div>             
                                        </div>
                                </div>              
                                
                               <!--  row 6 -->

                               <div class="row form-group">
                                    <label for="p_video" class="col-sm-2 control-label">Video Link</label>

                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="p_video" name="p_video"
                                            placeholder="product video link" value="<?php 
                                             if(($p_id!="" or $eid!="") and $p_video=="")
                                             {
                                                 echo $query_row_result['p_video'];
                                             }
                                             else
                                             { 
                                                 echo $p_video;
                                             } 
                                            ?>" required>
                                        <p class="invalid"><?php if(isset($p_videoErr))echo $p_videoErr; ?></p>
                                    </div>
                                </div>

                                <!--  row 7 -->

                                <div class="modal-footer">
                                    <a href="product_details.php"><button type="button" class="btn btn-danger btn-flat" name="close"><i
                                            class="fa fa-close"></i> Close</button></a>
                                    <button type="submit" class="btn btn-primary edit btn-flat" name="update" id="update"><i
                                            class="fa fa-check-square-o"></i> Update</button>
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
                function fetch_select(val)
                {
                    $.ajax({ 
                        type: 'post',
                        url: 'ajaxData.php',
                        data: {pid:val},
                        success: function(data) {     
                            $('#p_category_name').html(data);
                        }
                    });
                }
    </script>   
     
</body>

</html>