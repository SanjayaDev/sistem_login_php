<?php 
session_start();

require_once("../../koneksi.php");
require_once("../../config/exception.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $input = (object) $_POST;
  $name = mysqli_real_escape_string($db, $input->name);
  $full_name = mysqli_real_escape_string($db, $input->full_name);
  $email = mysqli_real_escape_string($db, $input->email);
  $phone = mysqli_real_escape_string($db, $input->phone);
  $password = $input->password;
  $repassword = $input->repassword;
  $error_message = "";
  $success_message = "";

  if ($password == $repassword) {
    $duplicate = 0;

    try {
      $sql = "SELECT * FROM `users` "
          .  "WHERE `name` = '$name' OR `email` = '$email';";
      $query = mysqli_query($db, $sql);
      // var_dump($sql);

      if (!mysqli_error($db)) {
        $duplicate = mysqli_num_rows($query);
      } else {
        throw new Error_handle(mysqli_error($db), mysqli_errno($db));
      }
    } catch (Error_handle $e) {
      $e->draw_message();
    }

    if ($duplicate == 0) {
      $password_hash = password_hash($password, PASSWORD_DEFAULT);

      try {
        $sql2 = "INSERT INTO `users` "
              . "(`tier_id`, `name`, `full_name`, `email`, `phone`, `password`, `created_at`) "
              . "VALUES (2, '$name', '$full_name', '$email', '$phone', '$password_hash', NOW());";
        $query2 = mysqli_query($db, $sql2);

        if (!mysqli_error($db)) {
          $success_message = "Register akun anda berhasil! Silahkan konfirmasi melalui email anda!";
        } else {
          throw new Error_handle(mysqli_error($db), mysqli_errno($db));
        }
      } catch (Error_handle $e) {
        $e->draw_message();
      }
    } else {
      $error_message = "Username / Email sudah pernah di daftarkan!";
    }
  } else {
    $error_message = "Password tidak sesuai!";
  }

  if (empty($error_message)) {
    $_SESSION["success_message"] = $success_message;
    header("location:" . BASE_URL);
  } else {
    $_SESSION["error_message"] = $error_message;
    header("location:" . BASE_URL . "register.php");
  }
} else {
  header("location:" . BASE_URL . "pages/404.php");
}