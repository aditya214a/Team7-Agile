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
          IWS Card Details
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">IWS Card Details</li>
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
          <!--  State Table -->
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header with-border">
                <!-- Just For trial -->
              </div>
              <div class="box-body">
                <table id="example1" class="table">
                  <thead class="thead-dark" style="background-color: #284649;color: white;">
                    <th>Card Id</th>
                    <th>Admin Handled</th>
                    <th>Waste Disposal ID</th>
                    <th>Waste Disposal Type</th>
                    <th>Waste Weight (lbs)</th>
                    <th>Account Points</th>
                    <th>Tools</th>
                  </thead>
                  <tbody>
                    <?php
                    include 'includes/connection.php';

                    try {
                      $query_res = "SELECT icd.*, wd.waste_disposal_id, wd.waste_deposit_type, ad.username from iws_card_details as icd, waste_deposit as wd, admin_details as ad where icd.waste_disposal_id=wd.waste_disposal_id and  icd.admin_id=ad.admin_id";
                      $query_res_exec = mysqli_query($conn, $query_res);

                      while ($row = mysqli_fetch_array($query_res_exec)) {
                        echo "
                          <tr>
                          <td style='vertical-align: middle; text-align:center;'>" . $row['iws_card_id'] . "</td>
                          <td style='vertical-align: middle; text-align:center;'>" . $row['username'] . "</td>
                          <td style='vertical-align: middle; text-align:center;'>" . $row['waste_disposal_id'] . "</td>
                          <td style='vertical-align: middle; text-align:center;'>" . $row['waste_deposit_type'] . "</td>
                          <td style='vertical-align: middle; text-align:center;'>" . $row['waste_weight'] . "</td>
                          <td style='vertical-align: middle; text-align:center;'>" . $row['card_points'] . "</td>
                          <td style='vertical-align: middle; text-align:center;'>
                              <button class='btn btn-success btn-sm edit btn-flat' data-id='" . $row['iws_card_id'] . "'><i class='fa fa-edit'></i> Update</button>
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
    <?php include 'includes/iws_card_details_modal.php'; ?>

  </div>
  <!-- ./wrapper -->

  <?php include 'includes/scripts.php'; ?>

  <script>
    $(function() {
      $(document).on('click', '.edit', function(e) {
        e.preventDefault();
        $('#edit').modal('show');
        var card_id = $(this).data('id');
        $("#edit #card_id").val(card_id);

        $.ajax({
          type: 'post',
          url: 'iws_card_details_update.php',
          data: {},
          success: function(data) {
            $('#waste_disposal_id').html(data);
          }
        });
      });
    });
  </script>


</body>

</html>