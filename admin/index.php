<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard</title>

    <?php 
    session_start();  
    if (!isset($_SESSION['admin'])) {
      header("location:login.php");
    }

    include "./templates/top.php"; 
    ?>
  </head>

  <body>
    <?php include "./templates/navbar.php"; ?>

    <div class="container-fluid">
      <div class="row">
        <?php include "./templates/sidebar.php"; ?>          
            
            <div class="card-header bg-primary text-white">
              <h5 class="mb-0">All Admins</h5>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                  <thead class="thead-dark">
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include_once 'Database.php';
                    $result = mysqli_query($conn, "SELECT * FROM admin");

                    if (mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_array($result)) {
                        echo '<tr>
                                <td>' . htmlspecialchars($row['id']) . '</td>
                                <td>' . htmlspecialchars($row['name']) . '</td>
                                <td>' . htmlspecialchars($row['email']) . '</td>
                                <td>' . ($row['is_active'] ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-secondary">Inactive</span>') . '</td>
                              </tr>';
                      }
                    } else {
                      echo '<tr><td colspan="4" class="text-center text-muted">No admins found.</td></tr>';
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
      </div>
    </div>

    <?php include "./templates/footer.php"; ?>
    <script src="./js/admin.js"></script>
  </body>
</html>

