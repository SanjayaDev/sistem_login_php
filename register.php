<?php 
session_start();
require_once("config/config.php"); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <title>REGISTER</title>
</head>

<body class="bg-primary">

  <div class="container">
    <div class="row mt-5">
      <div class="col-md-8 mx-auto">
        <div class="card">
          <div class="card-header text-center">
            <h4>Register</h4>
          </div>
          <div class="card-body">
            <?php 
            if (isset($_SESSION["error_message"]) && !empty($_SESSION["error_message"])) {
              $error_message = $_SESSION["error_message"];
              echo "<div class='alert alert-danger'>$error_message</div>";
              unset($_SESSION["error_message"]);
            }
            ?>
            <form action="<?php echo BASE_URL . "controllers/auth/process_register.php"; ?>" method="POST">
              <div class="form-group">
                <label>Username</label>
                <input type="text" name="name" class="form-control" placeholder="Input name...">
              </div>
              <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="full_name" class="form-control" placeholder="Input fullname...">
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Input email...">
              </div>
              <div class="form-group">
                <label>Phone</label>
                <input type="number" name="phone" class="form-control" placeholder="Input phone...">
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Input password...">
              </div>
              <div class="form-group">
                <label>Re-Password</label>
                <input type="password" name="repassword" class="form-control" placeholder="Input repassword...">
              </div>
              <button class="btn btn-success mt-3" type="submit">Register</button>
            </form>
          </div>
          <div class="card-footer">
            <p>Already member? <a href="<?php echo BASE_URL ?>">Login now!</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>