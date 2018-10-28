<?php

require ('../private/db.php');

//hoort de bezoeker hier tezijn?
if (!isset($_POST['submit_registration'])) {
  header('Location: register.php');
}

//zijn alle velden ingevuld?
if (empty($_POST['username']) OR empty($_POST['email']) OR empty($_POST['password']) OR empty($_POST['password2'])) {
  echo 'Je bent vergeten iets in te vullen!.<br>';
  echo 'Klik <a href="register.php">hier</a> om terug te keren.';
  exit();
}

//wachtwoorden
if ($_POST['password'] != $_POST['password2']) {
  echo 'wachtwoord komt niet overheen.<br>';
  echo 'Klik <a href="register.php">hier</a> om terug te keren.';
  exit();
}


$position = strpos($_POST['email'],'@ma-web.nl');
if (!$position) {
  echo'Sorry, je kunt je alleen registreren met een ma email adress.<br>';
  echo 'Klik <a href="register.php">hier</a> om terug te keren.';
}

// Bestaat deze user al?
$query = "SELECT userid FROM users WHERE username = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('s', $username);
$username = $_POST['username'];
$result = $stmt->execute() or die ('error querying user.');
$row = $stmt->fetch();
if ($row){
  echo 'Sorry maar deze naam bestaad al!<br>';
  echo 'Klik <a href="register.php">hier</a> om terug te keren.';
  exit();
}

//Bestaat deze mail al?
$query = "SELECT userid FROM users WHERE email = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('s', $email);
$email = $_POST['email'];
$result = $stmt->execute() or die ('error querying mail.');
$row = $stmt->fetch();
if ($row){
  echo 'Sorry maar het lijkt er op dat je al een account hebt!<br>';
  echo 'Klik <a href="register.php">hier</a> om terug te keren.';
  exit();
}

//Gebruiker toevoegen aan DB
$query = "INSERT INTO users VALUES (0,?,?,?,?,0)";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('ssss', $username, $email, $password, $hash );
$username = $_POST['username'];
$email = $_POST['email'];
$random_number = rand(0,1000000);
$hash = hash('sha512', $random_number);
$password = hash('sha512',$_POST['password']);
$stmt->execute() or die ('Error inserting user.');


//gebruiker mailen
$to = $_POST['email'];
$subject =  'verifeer je account bij photure';
$message =  'Klik op de volgende link om je account te activeren:' ;
$message .= 'http://24583.hosts.ma-cloud.nl/bewijzenmap/periode1.3/proj/TheWallProject/public/verify.php?email=' .$email . '&hash=' . $hash;                 //voeg host ma link toe tussen de / /
$headers =  'From: 24583@ma-web.nl';
mail($to,$subject,$message,$headers) or die('Error mailing.');
