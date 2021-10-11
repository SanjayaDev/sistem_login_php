<?php 
session_start();
require "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <title>LOGIN</title>
</head>
<body class="bg-primary">
  
  <div class="container">
    <div class="row mt-5">
      <div class="col-md-5 col-sm-6 mx-auto">
        <div class="card">
          <div class="card-header text-center">
            <h4>LOGIN</h4>
          </div>
          <div class="card-body">
            <?php 
            if (isset($_SESSION["success_message"]) && !empty($_SESSION["success_message"])) {
              $success_message = $_SESSION["success_message"];
              echo "<div class='alert alert-success'>$success_message</div>";
              unset($_SESSION["success_message"]);
            }
            if (isset($_SESSION["error_message"]) && !empty($_SESSION["error_message"])) {
              $error_message = $_SESSION["error_message"];
              echo "<div class='alert alert-success'>$error_message</div>";
              unset($_SESSION["error_message"]);
            }
            ?>
            <form action="" method="POST">
              <div class="form-group my-2">
                <label>Username</label>
                <input type="text" name="name" class="form-control" placeholder="Input username / email...">
              </div>
              <div class="form-group my-2">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Input password...">
                <small><a href="">Lupa Password</a></small>
              </div>

              <button class="btn btn-success" type="submit">LOGIN</button>
            </form>
          </div>
          <div class="card-footer">
            <p>New member? <a href="<?php echo BASE_URL . "register.php"; ?>">Register Now!</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>