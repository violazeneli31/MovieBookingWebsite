<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
if (!isset($_SESSION['admin'])) {
  header("location:login.php");
  exit();
}
include_once 'Database.php';

// Add Movie
if (isset($_POST['submit'])) {
    $movie_name = mysqli_real_escape_string($conn, $_POST['movie_name']);
    $directer_name = mysqli_real_escape_string($conn, $_POST['directer_name']);
    $release_date = mysqli_real_escape_string($conn, $_POST['release_date']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $language = mysqli_real_escape_string($conn, $_POST['language']);
    $tailer = mysqli_real_escape_string($conn, $_POST['tailer']);
    $decription = mysqli_real_escape_string($conn, $_POST['decription']);
    $action = mysqli_real_escape_string($conn, $_POST['action']);
    $show = mysqli_real_escape_string($conn, $_POST['show']);

    $image = $_FILES['img']['name'];
    $tmp_name = $_FILES['img']['tmp_name'];

    if (!empty($image)) {
        move_uploaded_file($tmp_name, "image/" . $image);
    }

    $sql = "INSERT INTO add_movie (movie_name, directer, release_date, categroy, `language`, you_tube_link, `show`, `action`, decription, image, `status`)
            VALUES ('$movie_name', '$directer_name', '$release_date', '$category', '$language', '$tailer', '$show', '$action', '$decription', '$image', 1)";

    if (!mysqli_query($conn, $sql)) {
        die("Add Movie Failed: " . mysqli_error($conn));
    }

    header("Location: Add-movie.php");
    exit();
}

// Edit Movie
if (isset($_POST['updatemovie'])) {
    $id = $_POST['e_id'];
    $movie_name = mysqli_real_escape_string($conn, $_POST['edit_movie_name']);
    $directer_name = mysqli_real_escape_string($conn, $_POST['edit_directer_name']);
    $release_date = mysqli_real_escape_string($conn, $_POST['edit_release_date']);
    $category = mysqli_real_escape_string($conn, $_POST['edit_category']);
    $language = mysqli_real_escape_string($conn, $_POST['edit_language']);
    $tailer = mysqli_real_escape_string($conn, $_POST['edit_tailer']);
    $decription = mysqli_real_escape_string($conn, $_POST['decription']);
    $action = mysqli_real_escape_string($conn, $_POST['edit_action']);
    $show = mysqli_real_escape_string($conn, $_POST['edit_show']);

    $image = $_POST['old_image'];
    if (!empty($_FILES['edit_img']['name'])) {
        $image = $_FILES['edit_img']['name'];
        $tmp_name = $_FILES['edit_img']['tmp_name'];
        move_uploaded_file($tmp_name, "image/" . $image);
    }

    $sql = "UPDATE add_movie SET 
            movie_name='$movie_name',
            directer='$directer_name',
            release_date='$release_date',
            categroy='$category',
            `language`='$language',
            you_tube_link='$tailer',
            `show`='$show',
            `action`='$action',
            decription='$decription',
            image='$image'
            WHERE id=$id";

    if (!mysqli_query($conn, $sql)) {
        die("Update Movie Failed: " . mysqli_error($conn));
    }

    header("Location: Add-movie.php");
    exit();
}

// Delete Movie
if (isset($_POST['deletemovie'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM add_movie WHERE id=$id";
    if (!mysqli_query($conn, $sql)) {
        die("Delete Movie Failed: " . mysqli_error($conn));
    }
    header("Location: Add-movie.php");
    exit();
}
?>



<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Movies Page</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php include_once("./templates/top.php"); ?>
<?php include_once("./templates/navbar.php"); ?>
<div class="container-fluid">
  <div class="row">
    <?php include("./templates/sidebar.php"); ?>
    <main role="main" class="col-md-10 ml-sm-auto col-lg-10 pt-3 px-3">
      <div class="d-flex justify-content-between mb-3">
        <h2>Movie List</h2>
        <button class="btn btn-primary" data-toggle="modal" data-target="#add_movie_modal">Add Movie</button>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Director</th>
              <th>Category</th>
              <th>Language</th>
              <th>Show</th>
              <th>Description</th>
              <th>Image</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $result = mysqli_query($conn, "SELECT * FROM add_movie");
          while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
              <td><?php echo $row['id']; ?></td>
              <td><?php echo $row['movie_name']; ?></td>
              <td><?php echo $row['directer']; ?></td>
              <td><?php echo $row['categroy']; ?></td>
              <td><?php echo $row['language']; ?></td>
              <td><?php echo $row['show']; ?></td>
              <td><?php echo $row['decription']; ?></td>
              <td><img src="image/<?php echo $row['image']; ?>" width="50"></td>
              <td>
                <div class="btn-group-vertical">
                  <button class="btn btn-danger btn-sm mb-1" data-toggle="modal" data-target="#deleteModal<?php echo $row['id']; ?>">Delete</button>
                  <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?php echo $row['id']; ?>">Edit</button>
                </div>
              </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form method="POST" action="" enctype="multipart/form-data">
                    <div class="modal-header">
                      <h5 class="modal-title">Edit Movie</h5>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      <input type="hidden" name="e_id" value="<?php echo $row['id']; ?>">
                      <input class="form-control mb-2" name="edit_movie_name" value="<?php echo $row['movie_name']; ?>">
                      <input class="form-control mb-2" name="edit_directer_name" value="<?php echo $row['directer']; ?>">
                      <input type="date" class="form-control mb-2" name="edit_release_date" value="<?php echo $row['release_date']; ?>">
                      <input class="form-control mb-2" name="edit_category" value="<?php echo $row['categroy']; ?>">
                      <input class="form-control mb-2" name="edit_language" value="<?php echo $row['language']; ?>">
                      <input class="form-control mb-2" name="edit_tailer" value="<?php echo $row['you_tube_link']; ?>">
                      <input class="form-control mb-2" name="edit_show" value="<?php echo $row['show']; ?>">
                      <textarea class="form-control mb-2" name="decription"><?php echo $row['decription']; ?></textarea>
                      <input type="file" name="edit_img" class="form-control mb-2">
                      <input type="hidden" name="old_image" value="<?php echo $row['image']; ?>">
                      <select class="form-control" name="edit_action">
                        <option value="upcoming" <?php if ($row['action'] == 'upcoming') echo 'selected'; ?>>Upcoming</option>
                        <option value="running" <?php if ($row['action'] == 'running') echo 'selected'; ?>>Running</option>
                      </select>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" name="updatemovie" class="btn btn-primary">Save changes</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

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
                      <p>Are you sure you want to delete movie ID <strong><?php echo $row['id']; ?></strong>?</p>
                      <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    </div>
                    <div class="modal-footer">
                      <button type="submit" name="deletemovie" class="btn btn-danger">Delete</button>
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

<!-- Add Movie Modal -->
<div class="modal fade" id="add_movie_modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title">Add Movie</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <input class="form-control mb-2" name="movie_name" placeholder="Movie Name">
          <input class="form-control mb-2" name="directer_name" placeholder="Director Name">
          <input type="date" class="form-control mb-2" name="release_date" placeholder="Release Date">
          <input class="form-control mb-2" name="category" placeholder="Category">
          <input class="form-control mb-2" name="language" placeholder="Language">
          <input class="form-control mb-2" name="tailer" placeholder="YouTube Trailer Link">
          <input class="form-control mb-2" name="show" placeholder="Show Time (e.g. 18:30)">
          <textarea class="form-control mb-2" name="decription" placeholder="Description"></textarea>
          <input type="file" name="img" class="form-control mb-2">
          <select class="form-control" name="action">
            <option value="upcoming">Upcoming</option>
            <option value="running">Running</option>
          </select>
        </div>
        <div class="modal-footer">
          <button type="submit" name="submit" class="btn btn-success">Add Movie</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include_once("./templates/footer.php"); ?>
</body>
</html>
