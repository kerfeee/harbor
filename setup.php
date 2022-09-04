<?php

$host = readline('Enter the server host\'s name: ');
$user = readline('Enter your username: ');
$pwd = readline('Enter your password: ');
$db = readline('Enter the server\'s database: ');

$connection = mysqli_connect($host, $user, $pwd);
$create_db = "CREATE DATABASE IF NOT EXISTS $db";
mysqli_query($connection, $create_db);

$connection = mysqli_connect($host, $user, $pwd, $db);
$table_query = 'CREATE TABLE users (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, user VARCHAR(26) NOT NULL, pass VARCHAR(26) NOT NULL) CHARACTER SET utf8';
mysqli_query($connection, $table_query);

$command = "<?php\n
    \$serverhost = '$host';\n
    \$serverusername = '$user';\n
    \$serverpassword = '$pwd';\n
    \$serverdatabase = '$db';\n
    \$connection = mysqli_connect('$host', '$user', '$pwd', '$db');
  \n?>";

file_put_contents('connection.php', $command);

?>
