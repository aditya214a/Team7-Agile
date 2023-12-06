<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/menubar.php'; ?>
    <style>
      .green {
        color: green;
        font-weight: 600;
      }

      .red {
        font-weight: 600;
        color: orangered;
      }
    </style>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          IWS Card History
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">IWS Card History Data</li>
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
                <a href="create_history.php" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Create History</a>
              </div>
              <div class="box-header with-border">
                <!-- Just For trial -->
              </div>
              <div class="box-body">
                <table id="example1" class="table">
                  <thead class="thead-dark" style="background-color: #284649;color: white;">
                    <th>Operator Name</th>
                    <th>Disposal Registration ID</th>
                    <th>Waste Disposal Type</th>
                    <th>Waste Weight (lbs)</th>
                    <th>Gained Points(+)</th>
                    <th>Penalized Points(-)</th>
                    <th>Improvement Feedback</th>
                    <th>Total Points Added</th>
                    <th>History Date</th>
                    <th>Tools</th>
                  </thead>
                  <tbody>
                    <?php
                    include 'includes/connection.php';

                    try {
                      $query_res = "SELECT ich.*, ad.username, wd.waste_uniq_id from iws_card_history as ich, waste_deposit as wd, admin_details as ad where ich.waste_disposal_id=wd.waste_disposal_id and ich.admin_id=ad.admin_id";
                      $query_res_exec = mysqli_query($conn, $query_res);

                      while ($row = mysqli_fetch_array($query_res_exec)) {
                        echo "
                          <tr>
                          <td style='vertical-align: middle; text-align:center;'>" . $row['username'] . "</td>
                          <td style='vertical-align: middle; text-align:center;'>" . $row['waste_uniq_id'] . "</td>
                          <td style='vertical-align: middle; text-align:center;'>" . $row['waste_type'] . "</td>
                          <td style='vertical-align: middle; text-align:center;'>" . $row['waste_weight'] . "</td>
                          <td style='vertical-align: middle; text-align:center;' class='green'>" . $row['gained_points'] . "</td>
                          <td style='vertical-align: middle; text-align:center;' class='red'>" . $row['penalized_points'] . "</td>
                          <td style='vertical-align: middle; text-align:center;'>" . $row['improve_feedback'] . "</td>
                          <td style='vertical-align: middle; text-align:center;'>" . $row['total_points'] . "</td>
                          <td style='vertical-align: middle;'>" . date('M d, Y', strtotime($row['history_created_date'])) . "</td>
                          <td style='vertical-align: middle; text-align:center;'>
                              <button class='btn btn-danger btn-sm delete btn-flat' data-id='" . $row['iws_card_history_id'] . "'><i class='fa fa-trash'></i> Delete</button>
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
    <?php include 'includes/card_history_modal.php'; ?>

  </div>
  <!-- ./wrapper -->

  <?php include 'includes/scripts.php'; ?>

  <script>
    $(function() {

      $(document).on('click', '.delete', function(e) {
        e.preventDefault();
        $('#delete').modal('show');
        var cardid = $(this).data('id');
        $("#delete #cardid").val(cardid);
        return false;
      });
    });
  </script>

</body>

</html>