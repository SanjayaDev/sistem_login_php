<?php 

$db = "";

try {
  $db = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

  if (mysqli_connect_errno()) {
    throw new Error_handle(mysqli_connect_error(), mysqli_connect_errno());
  }
} catch (Error_handle $e) {
  $e->draw_message();
}