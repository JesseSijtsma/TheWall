<?php

// checken of de ebruiker verdwaald is?
if (!isset($_POST['submit_login'])) {
  header("Location: login.php");
}

//checken of de gebruiker alles heeft ingevuld
if (empty($_POST['username']) OR empty($_POST['password'])) {
  echo 'je hebt ietvergeten intevullen';
  echo 'Klik <a href="login.php">hier</a> om het nog eens te proberen';
  exit();
}

// checken of de gebruiker bestaat (en of zijn wachtwoord klopt )
require ('../private/db.php');
$query = "SELECT userid, hash, active FROM users WHERE username = ? AND password = ?";
$stmt = $mysqli->prepare($query) or die ('Error preparing');
$stmt->bind_param( 'ss', $username, $password) or die ('Error binding params.');
$stmt->bind_result( $userid, $hash,$active) or die ('Error binding result');
$username = $_POST['username'];
$password = $_POST['password'];
$password = hash( 'sha512', $password) or die ('Error hashing');
$stmt->execute() or die ('Error executing');
$fetch_succes = $stmt->fetch();

if (!$fetch_succes) {
  echo 'Sorry, er is iets misgegaan';
  echo 'Klik <a href="login.php"> Hier </a> om het nog eens te proberen';
  exit();
} else if ($active == 0) {
  echo 'Sorry, je account is nog niet geactiveerd!.';
  echo 'Klik <a href="login.php">hier</a> om het nog eens te proberen.';
  exit();
}

setcookie('userid', $userid, time() + 3600 * 24 * 7);
setcookie('hash', $hash, time() + 3600 *24 * 7);
header('Location: welkom.php');
