<?php
session_start();
include_once 'Database.php';
$id = $_GET['pass'];
$result = mysqli_query($conn, "SELECT * FROM add_movie WHERE id = '" . $id . "'");
$row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Movie Detail">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo $row['movie_name']; ?> Movie Details</title>

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/elegant-icons.css">
  <link rel="stylesheet" href="css/magnific-popup.css">
  <link rel="stylesheet" href="css/nice-select.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/slicknav.min.css">
  <link rel="stylesheet" href="css/fonts-googleapis.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include("header.php"); ?>

<section id="aboutUs">
  <div class="container">
    <?php
    $result = mysqli_query($conn, "SELECT * FROM add_movie WHERE id = '" . $id . "'");
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_array($result)) {
    ?>
    <div class="row feature design">
      <div class="col-lg-5">
        <img src="admin/image/<?php echo $row['image']; ?>" class="resize-detail" alt="" width="100%">
      </div>
      <div class="col-lg-7">
        <table class="table">
          <thead><tr><th colspan="2">Movie Details</th></tr></thead>
          <tbody>
            <tr><td>Movie Name</td><td><?php echo $row['movie_name']; ?></td></tr>
            <tr><td>Release Date</td><td><?php echo $row['release_date']; ?></td></tr>
            <tr><td>Director Name</td><td><?php echo $row['directer']; ?></td></tr>
            <tr><td>Category</td><td><?php echo $row['categroy']; ?></td></tr>
            <tr><td>Language</td><td><?php echo $row['language']; ?></td></tr>
            <tr>
              <td>Trailer</td>
              <td>
                <a style="color: blue; text-decoration: underline; cursor: pointer;" data-toggle="modal" data-target="#tailer_modal<?php echo $row['id']; ?>">View Trailer</a>
                <div class="modal fade" id="tailer_modal<?php echo $row['id']; ?>" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <embed style="width: 100%; height: 450px;" src="<?php echo $row['you_tube_link']; ?>"></embed>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>

        <?php if ($row['action'] == "running") { ?>
        <div class="tiem-link">
          <h4>Click Below To Book:</h4><br>
          <?php
          $movie = $row['movie_name'];
          $time = trim($row['show']);
          if (!empty($time)) {
            echo "<a href='seatbooking.php?movie=$movie&time=$time' class='btn btn-outline-primary btn-sm'>$time</a>";
          }
          ?>
        </div>
        <?php } ?>
      </div>
    </div>
    <div class="description mt-4">
      <h4>Description</h4>
      <p><?php echo nl2br($row['decription']); ?></p>
    </div>
    <?php
      }
    }
    ?>
  </div>
</section>

<?php include("footer.php"); ?>

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
