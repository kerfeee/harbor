<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Port</title>
  </head>
<body>
  <h1>Create an account</h1>

  <form action="create-account.php" method="POST">
    <input type="text" name="created_username" id="user">
    <input type="password" name="created_password" id="pass">
    <input type="submit" id="submit" value="Sign up">
  </form>

<?php
  // ini_set('display_errors', 1);
  $created_user = $_POST['created_username']; // mysqli_real_escape_string() needs to be added
  $created_pass = $_POST['created_password']; // trim() and strip_tags() need to be added

  if (isset($created_user) && isset($created_pass)) {
    require('connection.php');

    if (!$connection) {
      die('Connection failed: ' . mysqli_connect_error());
    } else {
      echo '<script>console.log("Connected to DB!");</script>';
    }

    $data_query = "INSERT INTO users (user, pass) VALUES ('$created_user', '$created_pass')";

    mysqli_query($connection, $data_query);
    mkdir("file-db/$created_user");
    mysqli_close($connection);
    header('Location: index.php');
  }
?>
</body>
</html>
