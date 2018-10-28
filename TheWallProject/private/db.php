<?php
define ('HOST','localhost');
define ('USER','24583');
define ('PASS','asellnht');
define ('DBNAME','24583_db');

$mysqli = new mysqli( HOST, USER, PASS, DBNAME);

if ($mysqli->errno){
  echo 'Connection error: ' . $mysqli->errno;
}
