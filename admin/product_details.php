<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/menubar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Product Details
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Product Details</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
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
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header with-border">
                <a href="product_details_add.php" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Add Product</a>
              </div>
              <div class="box-body">
                <table id="example1" class="table" style="overflow-x: scroll; display: block;">
                  <thead class="thead-dark" style="background-color: #284649;color: white;">
                    <th style="text-align: center;">Product_ID</th>
                    <th style="text-align: center;">Product_Type</th>
                    <th style="text-align: center;">Category_Type</th>
                    <th style="text-align: center;">Product_Name</th>
                    <th style="text-align: center;">Price</th>
                    <th style="text-align: center;">Sale_Price</th>
                    <th style="text-align: center;">QTY</th>
                    <th style="text-align: center; ">Image_1</th>
                    <th style="text-align: center;">Image_2</th>
                    <th style="text-align: center;">Image_3</th>
                    <th style="text-align: center;">Image_4</th>
                    <th style="text-align: center;">Details</th>
                    <th style="text-align: center;">Benefits</th>
                    <th style="text-align: center;">Video</th>
                    <th style="text-align: center; ">Product_Date</th>
                    <th style="text-align: center; padding-inline: 68px">Tools</th>
                  </thead>
                  <tbody>
                    <?php
                    include 'includes/connection.php';
                    try {
                      $query_values = "SELECT * FROM product_details as pd, product_category as pc, product_type as pt where pd.p_category_id=pc.p_category_id and pd.p_type_id=pt.p_type_id";
                      $query_result = mysqli_query($conn, $query_values);
                      while ($row = mysqli_fetch_array($query_result)) {
                        $image1 = 'uploaded_images/product_details_images/' . $row['p_image_1'];
                        $image2 = 'uploaded_images/product_details_images/' . $row['p_image_2'];
                        $image3 = 'uploaded_images/product_details_images/' . $row['p_image_3'];
                        $image4 = 'uploaded_images/product_details_images/' . $row['p_image_4'];
                        echo "
                          <tr>
                          <td style='vertical-align: middle; text-align: center;'>" . $row['p_id'] . "</td>
                          <td style='vertical-align: middle; text-align: center;'>" . $row['p_type_title'] . "</td>
                          <td style='vertical-align: middle; text-align: center;'>" . $row['p_category_title'] . "</td>
                          <td style='vertical-align: middle; text-align: center;'>" . $row['p_name'] . "</td>
                          <td style='vertical-align: middle; text-align: center;'>" . $row['p_price'] . "</td>
                          <td style='vertical-align: middle; text-align: center;'>" . $row['p_sale_price'] . "</td>
                          <td style='vertical-align: middle; text-align: center;'>" . $row['p_qty'] . "</td>

                          <td style='vertical-align: middle; text-align: center;'>
                          <img src='" . $image1 . "' height='50px' width='50px' style='border-radius:20%'>
                          <span class='pull-right'><a href='#edit_photo1' class='photo' data-toggle='modal' data-id='" . $row['p_id'] . "'><i class='fa fa-edit'></i></a></span>
                          </td>
                          <td style='vertical-align: middle; text-align: center;'>
                          <img src='" . $image2 . "' height='50px' width='50px' style='border-radius:20%'>
                          <span class='pull-right'><a href='#edit_photo2' class='photo' data-toggle='modal' data-id='" . $row['p_id'] . "'><i class='fa fa-edit'></i></a></span>
                          </td>
                          <td style='vertical-align: middle; text-align: center;'>
                          <img src='" . $image3 . "' height='50px' width='50px' style='border-radius:20%'>
                          <span class='pull-right'><a href='#edit_photo3' class='photo' data-toggle='modal' data-id='" . $row['p_id'] . "'><i class='fa fa-edit'></i></a></span>
                          </td>
                          <td style='vertical-align: middle; text-align: center;'>
                          <img src='" . $image4 . "' height='50px' width='50px' style='border-radius:20%'>
                          <span class='pull-right'><a href='#edit_photo4' class='photo' data-toggle='modal' data-id='" . $row['p_id'] . "'><i class='fa fa-edit'></i></a></span>
                          </td>

                          <td style='vertical-align: middle; text-align: center;'><a href='#p_details' data-toggle='modal' class='btn btn-info btn-sm btn-flat desc' data-id='" . $row['p_id'] . "'><i class='fa fa-search'></i> View</a></td>

                          <td style='vertical-align: middle;'><a href='#p_benefits' data-toggle='modal' class='btn btn-info btn-sm btn-flat desc' data-id='" . $row['p_id'] . "'><i class='fa fa-search'></i> View</a></td>

                          <td style='vertical-align: middle; text-align: center;'>" . $row['p_video'] . "</td>
                          <td style='vertical-align: middle; text-align: center; '>" . date('M d, Y', strtotime($row['p_date'])) . "</td>
                          
                          <td style='vertical-align: middle; text-align: center;'>
                            <a href='product_details_edit.php?id=" . $row['p_id'] . "' class='btn btn-success btn-sm edit btn-flat'><i class='fa fa-edit'></i> Edit</a>
                            <button class='btn btn-danger btn-sm delete btn-flat' data-id='" . $row['p_id'] . "'><i class='fa fa-trash'></i> Delete</button>
                          </td>
                          </tr>
                        ";
                      }
                    } catch (PDOException $e) {
                      echo $e->getMessage();
                    }
                    mysqli_close($conn);
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>

    </div>
    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/product_details_modal.php'; ?>

  </div>
  <!-- ./wrapper -->

  <?php include 'includes/scripts.php'; ?>

  <script>
    $(function() {

      $(document).on('click', '.delete', function(e) {
        e.preventDefault();
        $('#delete').modal('show');
        var user_id = $(this).data('id');
        $("#delete #userid").val(user_id);
        return false;
      });
      $(document).on('click', '.desc', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        getRow(id);
      });

      $(document).on('click', '.photo', function(e) {
        e.preventDefault();
        var user_id = $(this).data('id');
        $("#edit_photo1 #userid").val(user_id);
        $("#edit_photo2 #userid").val(user_id);
        $("#edit_photo3 #userid").val(user_id);
        $("#edit_photo4 #userid").val(user_id);
        return false;
      });

      function getRow(id) {
        $.ajax({
          type: 'POST',
          url: 'product_details_row.php',
          data: {
            id: id
          },
          dataType: 'json',
          success: function(response) {
            $('#details').html(response.details);
            $('#benefits').html(response.benefits);
            $('.names').html(response.productname);
            CKEDITOR.instances["editor2"].setData(response.details);
            CKEDITOR.instances["editor2"].setData(response.benefits);
          }
        });
      }

    });

    /* }); */
    /* 
<a href='cart.php?user=".$row['id']."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-search'></i> Cart</a> */
    /* function getRow(id){

    }  */
  </script>
</body>

</html>