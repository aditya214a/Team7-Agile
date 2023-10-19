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
          Admin Users
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Admin Users</li>
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
                <a href="users_add.php" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> ADD</a>
              </div>
              <div class="box-body">
                <table id="example1" class="table">
                  <thead class="thead-dark" style="background-color: #284649;color: white;">
                    <th>Admin ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Image</th>
                    <th>Contact No</th>
                    <th>Gender</th>
                    <th>Power</th>
                    <th>DOB</th>
                    <th>Created On Date</th>
                    <th>Tools</th>
                  </thead>
                  <tbody>
                    <?php
                    include 'includes/connection.php';

                    try {
                      $query_values = "SELECT * FROM admin_details";
                      $query_result = mysqli_query($conn, $query_values);
                      while ($row = mysqli_fetch_array($query_result)) {
                        $image = 'uploaded_images/admin_images/' . $row['image'];
                        echo "
                          <tr>
                          <td style='vertical-align: middle;'>" . $row['admin_id'] . "</td>
                          <td style='vertical-align: middle;'>" . $row['username'] . "</td>
                          <td style='vertical-align: middle;'>" . $row['email'] . "</td>
                            <td style='vertical-align: middle;'>
                              <img src='" . $image . "' height='50px' width='50px' style='border-radius:20%'>
                              <span class='pull-right'><a href='#edit_photo' class='photo' data-toggle='modal' data-id='" . $row['admin_id'] . "'><i class='fa fa-edit'></i></a></span>
                            </td>
                            <td style='vertical-align: middle;'>" . $row['contact_no'] . "</td>
                            <td style='vertical-align: middle;'>" . $row['gender'] . "</td>
                            <td style='vertical-align: middle;'>" . $row['power'] . "</td>
                            <td style='vertical-align: middle;'>" . $row['dob'] . "</td>
                            <td style='vertical-align: middle;'>" . date('M d, Y', strtotime($row['created_on_date'])) . "</td>
                            <td style='vertical-align: middle;'>
                              <a href='users_edit.php?id=" . $row['admin_id'] . "' class='btn btn-success btn-sm edit btn-flat'><i class='fa fa-edit'></i> Edit</a>
                              <button class='btn btn-danger btn-sm delete btn-flat' data-id='" . $row['admin_id'] . "'><i class='fa fa-trash'></i> Delete</button>
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
    <?php include 'includes/users_modal.php'; ?>

  </div>
  <!-- ./wrapper -->

  <?php include 'includes/scripts.php'; ?>

  <script>
    $(function() {

      $(document).on('click', '.photo', function(e) {
        e.preventDefault();
        var user_id = $(this).data('id');
        $("#edit_photo #userid").val(user_id);
        return false;
      });

      $(document).on('click', '.delete', function(e) {
        e.preventDefault();
        $('#delete').modal('show');
        var user_id = $(this).data('id');
        $("#delete #userid").val(user_id);
        return false;
      });
    });
  </script>
</body>

</html>