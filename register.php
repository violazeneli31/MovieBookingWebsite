<?php
include_once "Database.php";
session_start();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['number'];
    $city = $_POST['city'];
    $password = $_POST['password'];

    $filename = $_FILES['image']['name'];
    $location = 'admin/image/' . $filename;

    $file_extension = pathinfo($location, PATHINFO_EXTENSION);
    $file_extension = strtolower($file_extension);
    $image_ext = array('jpg', 'png', 'jpeg', 'gif');

    if (in_array($file_extension, $image_ext)) {
        move_uploaded_file($_FILES['image']['tmp_name'], $location);
    }

    $SALT = "V3ryS3cr3tSalt";
    $hashed_password = password_hash($password . $SALT, PASSWORD_DEFAULT);

    $insert_record = mysqli_query($conn, "INSERT INTO user (`username`,`email`,`mobile`,`city`,`pass`,`img`) VALUES ('$username', '$email', '$mobile', '$city', '$hashed_password', '$filename')");

    if (!$insert_record) {
        echo "<script>alert('Registration failed. Please try again.'); window.history.back();</script>";
        exit();
    } else {
        echo "<script>
                alert('Registration successful! Now log into your created account.');
                window.location = 'login_form.php';
              </script>";
        exit();
    }
}
?>