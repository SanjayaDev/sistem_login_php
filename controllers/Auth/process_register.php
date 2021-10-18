<?php
session_start();

require_once("../../init.php");

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
        $sql_begin = "BEGIN";
        $execute_begin = mysqli_query($db, $sql_begin);

        if (mysqli_error($db)) {
          throw new Error_handle(mysqli_error($db), mysqli_errno($db));
        }

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

      try {
        $parameter_email = [];
        $parameter_email["to"] = $email;
        $parameter_email["subject"] = "KOnfirmasi Account";

        $message_email = "AKun anda telah terdaftar di system kami, mohon verifikasi dengan meng-klik link berikut ";
        $message_email .= " <a href='" . BASE_URL . "'>LINK VERIFIKASI</a>";
        
        $parameter_email["message"] = $message_email;

        $send_email = send_email($parameter_email);
        var_dump($send_email);

        if (!$send_email) {
          throw new Error_handle("Gagal Mengirim Email!");
        } else {
          $sql_commit = "COMMIT";
          $commit_query = mysqli_query($db, $sql_commit);

          if (mysqli_error($db)) {
            throw new Error_handle(mysqli_error($db), mysqli_errno($db));
          }
        }
      } catch (Error_handle $e) {
        $sql_rollback = "ROLLBACK";
        mysqli_query($db, $sql_rollback);

        $e->draw_message();
      }
    } else {
      $error_message = "Username / Email sudah pernah di daftarkan!";
    }
  } else {
    $error_message = "Password tidak sesuai!";
  }

  // if (empty($error_message)) {
  //   $_SESSION["success_message"] = $success_message;
  //   header("location:" . BASE_URL);
  // } else {
  //   $_SESSION["error_message"] = $error_message;
  //   header("location:" . BASE_URL . "register.php");
  // }
} else {
  // header("location:" . BASE_URL . "pages/404.php");
}
