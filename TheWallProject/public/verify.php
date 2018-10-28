<?php

require ('../private/db.php');


// checken of de mail klopt
$query = "SELECT userid FROM users WHERE email = ? AND hash = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('ss', $email, $hash);
$email = $_GET['email'];
$hash = $_GET['hash'];
$stmt->execute();
$stmt->bind_result($userid);
$row = $stmt->fetch();
if (!$userid){
  echo 'Sorry, maar deze combie bestaat niet!.';
  exit();
}
$stmt->close();

// Account activeren
$query = "UPDATE users SET active = 1 WHERE userid = ?";
$stmt = $mysqli->prepare($query) or die ('Error preparing for update.');
$stmt->bind_param('i', $userid);
$stmt->execute() or die ('Error updating.');
echo 'Je account is geactiveerd!';
