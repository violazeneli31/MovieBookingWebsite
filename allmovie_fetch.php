<?php
// fetch_data.php

include('database_connection.php');

if (isset($_POST["action"])) {
  $query = "SELECT * FROM add_movie WHERE status = '1'";

  if (isset($_POST["categroy"])) {
    $categroy_filter = implode("','", $_POST["categroy"]);
    $query .= " AND categroy IN('" . $categroy_filter . "')";
  }
  if (isset($_POST["language"])) {
    $language_filter = implode("','", $_POST["language"]);
    $query .= " AND language IN('" . $language_filter . "')";
  }

  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  $total_row = $statement->rowCount();
  $output = '';

  if ($total_row > 0) {
    foreach ($result as $row) {
      $button_label = ($row['action'] == 'running') ? 'Book Now' : 'Upcoming';
      $output .= '
      <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
        <div class="card shadow-sm h-100 border-0 rounded-3 overflow-hidden">
          <img src="admin/image/' . $row['image'] . '" class="card-img-top" style="height: 180px; object-fit: cover;">
          <div class="card-body p-3">
            <h5 class="card-title mb-2 text-primary">' . $row['movie_name'] . '</h5>
            <p class="card-text mb-1"><strong>Director:</strong> ' . $row['directer'] . '</p>
            <p class="card-text mb-1"><strong>Category:</strong> ' . $row['categroy'] . '</p>
            <p class="card-text mb-3"><strong>Language:</strong> ' . $row['language'] . '</p>
          </div>
          <div class="card-footer bg-white border-0 text-center pb-3">
            <a href="movie_details.php?pass=' . $row['id'] . '" class="btn btn-outline-primary px-4 py-1 rounded-pill">' . $button_label . '</a>
          </div>
        </div>
      </div>';
    }
  } else {
    $output = '<h3>No Data Found</h3>';
  }

  echo $output;
}
?>

