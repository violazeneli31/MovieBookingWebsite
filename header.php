<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once "Database.php";

// Handle Username Change
if (isset($_POST['change_username'])) {
    $new_username = mysqli_real_escape_string($conn, $_POST['new_username']);
    $current_username = $_SESSION['uname'];
    $query = "UPDATE user SET username='$new_username' WHERE username='$current_username'";
    if (mysqli_query($conn, $query)) {
        $_SESSION['uname'] = $new_username;
        $success_message = "Username updated successfully!";
    } else {
        $error_message = "Failed to update username.";
    }
}

// Handle Password Change
if (isset($_POST['change_password'])) {
    $current_username = $_SESSION['uname'];
    $SALT = "V3ryS3cr3tSalt";
    $new_password_raw = $_POST['new_password'];
    $hashed_password = password_hash($new_password_raw . $SALT, PASSWORD_DEFAULT);

    $query = "UPDATE user SET pass='$hashed_password' WHERE username='$current_username'";
    if (mysqli_query($conn, $query)) {
        $success_message = "Password updated successfully!";
    } else {
        $error_message = "Failed to update password.";
    }
}
?>

<!-- Page Preloder -->
<div id="preloder"><div class="loader"></div></div>

<!-- Offcanvas Menu Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div class="offcanvas__option">
        <div class="offcanvas__links">
            <a href="#" onclick="toggleDropdown()">Log in</a>
            <div class="dropdown-menu" id="loginMenuMobile">
                <a class="dropdown-item" href="login_form.php">Login as User</a>
                <a class="dropdown-item" href="admin/login.php">Login as Admin</a>
            </div>
        </div>
    </div>
    <div id="mobile-menu-wrap"></div>
</div>
<!-- Offcanvas Menu End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7"></div>
                <?php if (isset($_SESSION['uname'])): ?>
                <?php $uname = $_SESSION['uname']; $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$uname'"); ?>
                <div class="col-lg-6 col-md-5">
                    <div class="header__top__right">
                        <div class="header__top__links">
                            <?php 
                            if ($row = mysqli_fetch_assoc($result)) {
                                $avatar = $row['img'] ? "admin/image/".$row['img'] : "image/img_avatar.png";
                                echo '<img src="'.$avatar.'" alt="Avatar" class="avatar">';
                            }
                            ?>
                            <span>Hi <?= htmlspecialchars($uname) ?></span>
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" id="loginDropdown" onclick="toggleDropdown()">EDIT PROFILE</a>
                                <div class="dropdown-menu">
                                    <a href="#" onclick="document.getElementById('changeUsernameModal').style.display='block'">Change Username</a>
                                    <a href="#" onclick="document.getElementById('changePasswordModal').style.display='block'">Change Password</a>
                                </div>
                            </div>
                            <a href="logout.php">Logout</a>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__links">
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" id="loginDropdown" onclick="toggleDropdown()">Log in</a>
                                <div class="dropdown-menu" id="loginMenu">
                                    <a class="dropdown-item" href="login_form.php">Login as User</a>
                                    <a class="dropdown-item" href="admin/login.php">Login as Admin</a>
                                </div>
                            </div>
                            <a href="register_form.php">Register</a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="header__logo">
                    <a href="./index.php"><img src="./img/logo.png" alt="Logo"></a>
                </div>
            </div>
            <div class="col-lg-9 col-md-9">
                <nav class="header__menu mobile-menu">
                    <ul>
                        <li><a href="./index.php">Home</a></li>
                        <li><a href="allmovie.php">All Movies</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="./feedback.php">Feedback</a></li>
                        <li><a href="./contact.php">Contacts</a></li>
                        <li><a href="./usertickets.php">Your Tickets</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
</header>
<!-- Header Section End -->

<!-- Modal Forms -->
<div id="changeUsernameModal" class="modal" style="display:none">
    <form method="post" class="modal-content">
        <h3>Change Username</h3>
        <input type="text" name="new_username" placeholder="New Username" required>
        <button type="submit" name="change_username">Change</button>
        <button type="button" onclick="this.parentElement.parentElement.style.display='none'">Cancel</button>
    </form>
</div>

<div id="changePasswordModal" class="modal" style="display:none">
    <form method="post" class="modal-content">
        <h3>Change Password</h3>
        <input type="password" name="new_password" placeholder="New Password" required>
        <button type="submit" name="change_password">Change</button>
        <button type="button" onclick="this.parentElement.parentElement.style.display='none'">Cancel</button>
    </form>
</div>

<!-- Dropdown CSS -->
<style>
.avatar {
    width: 30px;
    height: 30px;
    border-radius: 50%;
}
.dropdown {
    position: relative;
    display: inline-block;
}
.dropdown-menu {
    display: none;
    position: absolute;
    background-color: white;
    min-width: 160px;
    z-index: 1000;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    border-radius: 4px;
    top: 100%;
    left: 0;
}
.dropdown:hover .dropdown-menu {
    display: block;
}
.dropdown-menu a {
    color: #000;
    padding: 10px 15px;
    text-decoration: none;
    display: block;
}
.dropdown-menu a:hover {
    background-color: #f0f0f0;
}
.modal {
    position: fixed;
    top: 20%;
    left: 50%;
    transform: translate(-50%, 0);
    background: #fff;
    z-index: 2000;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 8px 16px rgba(0,0,0,0.3);
}
.modal-content input, .modal-content button {
    display: block;
    width: 100%;
    margin: 10px 0;
    padding: 8px;
}
</style>

<!-- Dropdown JS -->
<script>
function toggleDropdown() {
    const desktopMenu = document.getElementById("loginMenu");
    const mobileMenu = document.getElementById("loginMenuMobile");

    if (desktopMenu) {
        desktopMenu.style.display = (desktopMenu.style.display === "block") ? "none" : "block";
    }

    if (mobileMenu) {
        mobileMenu.style.display = (mobileMenu.style.display === "block") ? "none" : "block";
    }
}

window.onclick = function(event) {
    if (!event.target.matches('#loginDropdown')) {
        const dropdowns = document.getElementsByClassName("dropdown-menu");
        for (let i = 0; i < dropdowns.length; i++) {
            dropdowns[i].style.display = "none";
        }
    }
}
</script>
