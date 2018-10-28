<?php
include 'htmlhead.php';
 ?>

<h1>REGISTREREN</h1>

<form method="post" action="procces_registration.php">
      <label>Gebruikersnaam:<br><input name="username" /></label><br>
      <label>E-mail:<br><input type="email" name="email" /></label><br>
      <label>Wachtwoord:<br><input type="password" name="password" /></label><br>
      <label>Herhaal Wachtwoord:<br><input type="password" name="password2" /></label><br>
      <label><input type="submit" name="submit_registration" value="REGISTRER" /></label><br>
</form>

<?php
include 'htmlfoot.php';
 ?>
