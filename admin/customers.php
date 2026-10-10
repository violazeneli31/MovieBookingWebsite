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
    <title>Customer Page</title>
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
          <h2>Customers</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Username</th>
                  <th>Movie</th>
                  <th>Show Time</th>
                  <th>Seat</th>
                  <th>Total Seat</th>
                  <th>Price</th>
                  <th>Payment Date</th>
                  <th>Booking Date</th>
                  <th>Customer ID</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $result = mysqli_query($conn,"SELECT c.id, c.movie, c.booking_date, c.show_time, c.seat, c.totalseat, c.price, c.payment_date, c.custemer_id, u.username 
                                            FROM customers c 
                                            INNER JOIN user u ON c.uid = u.id");
                if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>
                      <td>{$row['id']}</td>
                      <td>{$row['username']}</td>
                      <td>{$row['movie']}</td>
                      <td>{$row['show_time']}</td>
                      <td>{$row['seat']}</td>
                      <td>{$row['totalseat']}</td>
                      <td>{$row['price']}</td>
                      <td>{$row['payment_date']}</td>
                      <td>{$row['booking_date']}</td>
                      <td>{$row['custemer_id']}</td>
                    </tr>";
                  }
                }
                ?>
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>
    <?php include_once("./templates/footer.php"); ?>
  </body>
</html>


