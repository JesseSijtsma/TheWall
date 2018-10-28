<?php

//checken of de user verdwaald is
if (!isset($_COOKIE['userid'])) {
    header('Location: login.php');
}

//checken of de userid en de hash een match zijn in de db
require ('../private/db.php');
$query = "SELECT userid FROM users WHERE userid = ? AND hash = ?";
$stmt = $mysqli->prepare($query) or die ('Error preparing');
$stmt->bind_param( 'is', $userid, $hash) or die ('Error binding params.');
$userid = $_COOKIE['userid'];
$hash = $_COOKIE['hash'];
$password = hash( 'sha512', $password) or die ('Error hashing');
$stmt->execute() or die ('Error executing');
$fetch_succes = $stmt->fetch();

if (!$fetch_succes) {
  header('Location: uilogpoort.php');
}

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>COOKIES</title>
  </head>
  <body>
    <h1>COOKIES</h1>
    <?php
      echo 'Welkom, je bent ingelogd als gebruiker' . $_COOKIE['userid'] . '<br>';

     ?>
  </body>
</html>
