<?php
include_once "Database.php";
session_start();

if ($_POST['username'] == '' || $_POST['password'] == '') {
    foreach ($_POST as $key => $value) {
        echo "<li>Please Enter " . $key . ".</li>";
    }
    exit();
}

$uname = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

$SALT = "V3ryS3cr3tSalt";
$input_password = $password . $SALT;

$sql_query = "SELECT pass FROM user WHERE username = '$uname'";
$result = mysqli_query($conn, $sql_query);

if ($result && mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $stored_hash = $row['pass'];

    // Verify the password against the stored hash
    if (password_verify($input_password, $stored_hash)) {
        $_SESSION['uname'] = $uname;
        echo 1;
    } else {
        echo "<li>Invalid Username or Password.</li>";
    }
} else {
    echo "<li>Invalid Username or Password.</li>";
}
?>
