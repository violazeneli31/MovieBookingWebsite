<?php
session_start(); 
if (!isset($_SESSION['admin'])) {
  header("location:login.php");
  exit();
}
include_once 'Database.php';

// Handle Delete Feedback
if (isset($_POST['deletefeedback'])) {
  $id = $_POST['id'];
  mysqli_query($conn, "DELETE FROM feedback WHERE id = $id");
  header("Location: feedback.php");
  exit();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Feedback Page</title>
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
          <h2>Feedback</h2>
          <div class="table-responsive">
            <table class="table table-bordered table-sm">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Message</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM feedback");
                while ($row = mysqli_fetch_assoc($result)) {
                  echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['massage']}</td>
                    <td>
                      <button class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deleteModal{$row['id']}'>Delete</button>
                    </td>
                  </tr>";
                  ?>

                  <!-- Delete Modal -->
                  <div class="modal fade" id="deleteModal<?php echo $row['id']; ?>" tabindex="-1">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form method="POST" action="">
                          <div class="modal-header">
                            <h5 class="modal-title">Confirm Delete</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                            <p>Are you sure you want to delete feedback from <strong><?php echo $row['name']; ?></strong>?</p>
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                          </div>
                          <div class="modal-footer">
                            <button type="submit" name="deletefeedback" class="btn btn-danger">Delete</button>
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

