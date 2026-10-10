<?php
session_start();
if (!isset($_SESSION['uname'])) {
  echo "<script>alert('You need to login first.'); window.location='login_form.php';</script>";
  exit();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

include("header.php");
include("Database.php");

$username = $_SESSION['uname'];
$user_query = mysqli_query($conn, "SELECT email FROM user WHERE username = '$username'");
$user_data = mysqli_fetch_assoc($user_query);
$email = $user_data['email'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = mysqli_real_escape_string($conn, $username);
  $user_email = mysqli_real_escape_string($conn, $email);
  $message = mysqli_real_escape_string($conn, $_POST['feedbackmassage']);

  if (!empty($message)) {
    $stmt = $conn->prepare("INSERT INTO feedback (name, email, massage) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $user_email, $message);
    if ($stmt->execute()) {
      $success = true;
    } else {
      $error = "Database error. Please try again.";
    }
    $stmt->close();
  } else {
    $error = "Message is required.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="description" content="Feedback Page">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/elegant-icons.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/slicknav.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
      body {
        font-family: 'Nunito Sans', sans-serif;
        background-color: #f8f9fa;
      }
      .card-custom {
        border: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
        padding: 30px;
        background-color: #ffffff;
      }
      textarea.form-control {
        border-radius: 10px;
        resize: none;
      }
      .btn-primary {
        background-color: #2a5298;
        border: none;
        padding: 10px 20px;
        border-radius: 30px;
        transition: background-color 0.3s ease;
      }
      .btn-primary:hover {
        background-color: #1e3c72;
      }
    </style>
  </head>
  <body>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card-custom">
          <h2 class="mb-4 text-center">We Value Your Feedback</h2>
          <?php if (!empty($success)): ?>
            <div class="alert alert-success">✅ Thank you for your feedback!</div>
          <?php elseif (!empty($error)): ?>
            <div class="alert alert-danger">❌ <?php echo $error; ?></div>
          <?php endif; ?>
          <form method="POST">
            <input type="hidden" name="feedbackname" value="<?= htmlspecialchars($username) ?>">
            <input type="hidden" name="feedbackemail" value="<?= htmlspecialchars($email) ?>">
            <div class="form-group mb-3">
              <label for="feedbackmassage" class="form-label">Your Message</label>
              <textarea class="form-control" name="feedbackmassage" rows="5" placeholder="Tell us what you think..."></textarea>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Send Feedback</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.nice-select.min.js"></script>
  <script src="js/jquery.nicescroll.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/jquery.slicknav.js"></script>
  <script src="js/mixitup.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/main.js"></script>
  </body>
</html>