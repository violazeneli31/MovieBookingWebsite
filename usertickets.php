<?php
session_start();
if (!isset($_SESSION['uname'])) {
  header("location:login_form.php");
  exit();
}
include_once 'Database.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Tickets</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
      .card {
        margin-bottom: 30px;
        font-size: 10px;
      }
      .ticket-title {
        font-size: 12px;
        font-weight: bold;
        margin-bottom: 10px;
      }
      .table td, .table th {
        padding: 0.25rem 0.4rem;
        vertical-align: middle;
        font-size: 10px;
      }
      .table-sm th {
        width: 25%;
      }
    </style>
  </head>
  <body>
    <?php include_once("./templates/top.php"); ?>
    <?php include_once("./templates/navbar.php"); ?>

    <div class="container py-4">
      <h2 class="mb-4">My Tickets</h2>

      <div class="row">
        <?php
          $username = $_SESSION['uname'];
          $user_result = mysqli_query($conn, "SELECT id FROM user WHERE username = '$username'");
          $user = mysqli_fetch_assoc($user_result);
          $uid = $user['id'];

          $result = mysqli_query($conn, "SELECT c.movie, c.booking_date, c.show_time, c.seat, c.totalseat, c.price, c.payment_date, c.custemer_id, u.username, u.email, u.mobile, u.city FROM customers c INNER JOIN user u ON c.uid = u.id WHERE c.uid = '$uid'");

          while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header bg-light">
                <img src="img/logo.png" class="mb-2" width="100">
                <h6 class="mb-2">+91 846050 2720</h6>
                <p class="mb-0"><strong>Customer ID:</strong> <?= $row['custemer_id'] ?> | <strong>Date:</strong> <?= $row['payment_date'] ?></p>
              </div>
              <div class="card-body">
                <h5 class="ticket-title text-center">🎬 <?= $row['movie'] ?></h5>
                <div class="table-responsive">
                  <table class="table table-bordered table-sm mb-2">
                    <tr>
                      <th>Name</th><td><?= $row['username'] ?></td>
                      <th>City</th><td><?= $row['city'] ?></td>
                    </tr>
                    <tr>
                      <th>Email</th><td><?= $row['email'] ?></td>
                      <th>Mobile</th><td><?= $row['mobile'] ?></td>
                    </tr>
                    <tr>
                      <th>Payment</th>
                      <td colspan="3">
                        <span style="font-weight:bold;">Lek</span> <?= $row['price'] ?> on <?= $row['payment_date'] ?>
                      </td>
                    </tr>
                  </table>

                  <h6 class="text-muted">🎟 Booking Details</h6>
                  <table class="table table-bordered table-sm">
                    <tr>
                      <th>Date</th><td><?= $row['booking_date'] ?></td>
                      <th>Time</th><td><?= $row['show_time'] ?></td>
                    </tr>
                    <tr>
                      <th>Seats</th><td colspan="3"><?= $row['seat'] ?> (<?= $row['totalseat'] ?> total)</td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>

    <div class="text-center mt-4">
        <a href="index.php" class="btn btn-primary btn-sm">← Back to Home</a>
    </div>

    <?php include_once("./templates/footer.php"); ?>
  </body>
</html>
