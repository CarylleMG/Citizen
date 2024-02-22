<?php

define('DB_HOST', '127.0.0.1');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'plasticdb');

//get connection
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$conn){
  die("Connection failed: " . $conn->error);
}

/*
function connect(){
  $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
  if($mysqli->connect_errno !=0){
    return $mysqli->connect_error;
  }
  else{
    return $mysqli;
  }
}
*/