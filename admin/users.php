<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("location:login.php");
  exit();
}
include_once 'Database.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Admin">
    <title>Manage Users</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
    <?php include_once("./templates/top.php"); ?>
    <?php include_once("./templates/navbar.php"); ?>
    <div class="container-fluid">
      <div class="row">
        <?php include "./templates/sidebar.php"; ?>
        <main role="main" class="col-md-10 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between mb-3">
            <h2>Users</h2>
          </div>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>City</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php
              $result = mysqli_query($conn, "SELECT * FROM user");
              while ($row = mysqli_fetch_array($result)) {
                $id = $row['id'];
              ?>
                <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['username']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td><?php echo $row['mobile']; ?></td>
                  <td><?php echo $row['city']; ?></td>
                  <td>
                    <button data-toggle="modal" data-target="#delete_users_modal<?php echo $id; ?>" class="btn btn-danger btn-sm">Delete</button>
                  </td>
                </tr>

                <!-- Delete Modal -->
                <div class="modal fade" id="delete_users_modal<?php echo $id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <form method="POST" action="insert_data.php">
                        <div class="modal-header">
                          <h5 class="modal-title">Delete User</h5>
                          <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Are you sure you want to delete user ID <strong><?php echo $id; ?></strong>?</p>
                          <input type="hidden" name="id" value="<?php echo $id; ?>">
                        </div>
                        <div class="modal-footer">
                          <button type="submit" name="deleteuser" class="btn btn-danger">Delete</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>
    <?php include_once("./templates/footer.php"); ?>
  </body>
</html>