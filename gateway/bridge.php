<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Bridge</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bridge.css" rel="stylesheet" type="text/css">
  </head>
<body>
  <h1 style="text-align:center;"><a href="../" style="color:black; text-decoration:none;">Bridge</a></h1>

  <div id="container">
    <div id="files_grid"></div>
  </div>

  <div id="file_selector">
    <form action="bridge.php" method="POST" enctype="multipart/form-data">
      <input type="file" class="btns" name="selected_file" id="selected_file">
      <input type="submit" class="btns" value="Submit">
    </form>
  </div>

  <form method="GET" action="bridge.php" id="hidden_form">
    <input type="hidden" name="dblclick_file" id="dblclick_file">
  </form>

<?php
  // ini_set('display_errors', 1);

  $user = $_SESSION['user'];
  $pass = $_SESSION['pass'];

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    move_uploaded_file($_FILES['selected_file']['tmp_name'], "../file-db/$user/{$_FILES['selected_file']['name']}");
  }

  $user_files = scandir("../file-db/$user");

  echo '<script>var folders = [';
  for ($i = 2; $i < count($user_files) - 1; $i++) {
    echo "\"$user_files[$i]\",";
  } // first two items in array are "." and ".." not needed
  echo '"'.end($user_files).'"];</script>';
  echo '<script>var username = "'.$user.'";</script>';

  function delete_file() {
    unlink("../file-db/{$_SESSION['user']}/{$_GET['dblclick_file']}");
    header('Location: bridge.php');
  }

  if (isset($_GET['dblclick_file'])) {
    delete_file();
  }
?>

  <div id="data_container">
    <div id="escape_arrow">&larr;</div>
    <div id="download_btn">
      <a id="download_link" download>Download</a>
    </div>
    <div id="delete">Delete</div>
    <div id="file_data"></div>
  </div>
</body>
<script src="bridge.js"></script>
</html>
