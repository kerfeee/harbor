<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Harbor</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="index.css" rel="stylesheet" type="text/css">
  </head>
<body>
  <div id="main">
    <div id="form">
      <form action="index.php" method="POST">
        <div>
          <input type="text" name="index_username" id="user" class="info" placeholder="Username">
        </div>
        <div>
          <input type="password" name="index_password" id="pass" class="info" placeholder="Password">
        </div>
        <div>
          <input type="submit" id="login" value="Login">
        </div>
      </form>
    </div>

    <div id="create_account">
      <span>Need an account? &#8594;</span>
      <a href="create-account.php">Sign up</a>
    </div>
  </div>

<?php
  // ini_set('display_errors', 1);
  $user = $_SESSION['user'] = htmlspecialchars($_POST['index_username']);
  $pass = $_SESSION['pass'] = htmlspecialchars($_POST['index_password']);

  if (!empty($user) && !empty($pass)) {
    require('connection.php');

    if (!$connection) {
      die('Connection failed: ' . mysqli_connect_error());
    } else {
         echo '<script>console.log("Connected to DB!");</script>';
      }

    $login_query = "SELECT user, pass FROM users WHERE user='$user' AND pass='$pass'";
    $account = mysqli_query($connection, $login_query);

    if (mysqli_num_rows($account) == 1) {
      header('Location: gateway/bridge.php');
    }
  }
?>
</body>
</html>
