<style>
  .sidebar {
    background: linear-gradient(180deg, #1e3c72, #2a5298);
    min-height: 100vh;
    color: white;
  }

  .sidebar .nav-link {
    color: rgba(255, 255, 255, 0.8);
    font-weight: 500;
    transition: all 0.3s;
  }

  .sidebar .nav-link:hover,
  .sidebar .nav-link.active {
    color: #ffffff;
    background-color: rgba(255, 255, 255, 0.1);
    border-left: 4px solid #ffc107;
    padding-left: 1rem;
  }

  .sidebar .nav-link span[data-feather] {
    margin-right: 8px;
    stroke: #ffc107;
  }

  .sidebar .nav-heading {
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin: 1rem 1rem 0.5rem;
    color: #e0e0e0;
  }

  .main-heading {
    color: #2a5298;
  }
</style>

<nav class="col-md-2 d-none d-md-block sidebar shadow-sm">
  <div class="text-center" style="margin-top: 30px; margin-bottom: 20px;">
    <div style="
      display: inline-block;
      background-color: white;
      padding: 12px 20px;
      border-radius: 4px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    ">
      <img src="../img/logo.png" alt="Logo" class="img-fluid" style="max-height: 50px;">
    </div>
  </div>



    <div class="nav-heading">Admin Panel</div>
    <ul class="nav flex-column">
      <?php 
        $uri = $_SERVER['REQUEST_URI']; 
        $uriAr = explode("/", $uri);
        $page = end($uriAr);

        function active($filename) {
          global $page;
          return $page === $filename ? 'active' : '';
        }
      ?>

      <li class="nav-item">
        <a class="nav-link <?= active('index.php') ?>" href="index.php">
          <span data-feather="home"></span>
          All Admins
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link <?= active('add-movie.php') ?>" href="add-movie.php">
          <span data-feather="film"></span>
          Add Movie
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link <?= active('customers.php') ?>" href="customers.php">
          <span data-feather="users"></span>
          Customers
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link <?= active('Feedback.php') ?>" href="Feedback.php">
          <span data-feather="message-square"></span>
          Feedback
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link <?= active('users.php') ?>" href="users.php">
          <span data-feather="user-check"></span>
          Users
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link <?= active('all_tickets.php') ?>" href="all_tickets.php">
          <span data-feather="user-check"></span>
          All Tickets
        </a>
      </li>
    </ul>
  </div>
</nav>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3 mb-3 border-bottom">
    <h1 class="h4 main-heading">Welcome, <strong><?php echo htmlspecialchars($_SESSION["admin"]); ?></strong></h1>
  </div>
