<style>
  .custom-navbar {
    background: linear-gradient(135deg, #0d1b2a, #1b263b);
  }

  .navbar-nav .nav-link {
    color: #ffffff !important;
    padding: 0.75rem 1rem;
  }

  .navbar-nav .nav-link:hover {
    color: #cce3ff !important;
    text-decoration: underline;
  }
</style>

<nav class="navbar navbar-dark fixed-top custom-navbar flex-md-nowrap p-0 shadow">
  <span class="navbar-text col-sm-3 col-md-2 mr-0 px-3 text-white font-weight-bold">
    Admin Dashboard
  </span>

  <ul class="navbar-nav ml-auto px-3">
    <li class="nav-item text-nowrap">
      <?php if (isset($_SESSION['admin'])): ?>
        <a class="nav-link" href="../admin/admin-logout.php">Sign out</a>
      <?php endif; ?>
    </li>
  </ul>
</nav>


