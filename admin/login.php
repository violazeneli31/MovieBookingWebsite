<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="ajaxValidation.js"></script>
</head>
<body style="height: 100vh; margin: 0; font-family: 'Montserrat', sans-serif; background-image: url('../img/login-background.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; display: flex; justify-content: center; align-items: center;">

  <div style="background: rgba(255, 255, 255, 0.95); padding: 40px 30px; border-radius: 12px; box-shadow: 0 0 20px rgba(0,0,0,0.3); width: 100%; max-width: 400px;">

    <a href="../index.php">
      <img src="../img/logo.png" alt="Logo" width="160" style="display: block; margin: 0 auto 25px auto;">
    </a>

    <h4 class="text-center mb-4" style="font-weight: bold;">Admin Login</h4>

    <div class="mb-3">
      <label for="userEmail" class="form-label">Admin Username</label>
      <input type="email" class="form-control" id="userEmail" placeholder="Enter admin username">
    </div>

    <div class="mb-3">
      <label for="userPassword" class="form-label">Password</label>
      <input type="password" class="form-control" id="userPassword" placeholder="Enter password">
    </div>

    <p id="message" style="color: red; text-align: center;"></p>

    <div class="d-grid">
      <button class="btn" id="checkValidation" style="background-color: #dc3545; color: white;">Login</button>
    </div>

    <div class="mt-3 text-center">
      <a href="../index.php" style="font-size: 14px; color: #333;">← Back to Home</a>
    </div>

  </div>

</body>
</html>