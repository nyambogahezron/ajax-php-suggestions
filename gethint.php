<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "ajax";
$username_array = array();
$q = $_GET["q"]; // get the q parameter from URL
$hint = "";

$conn = mysqli_connect($servername, $username, $password, $db);

// Check connection
// if (!$conn) {
//   die("Connection failed: " . mysqli_connect_error());
// }
// echo "Connected successfully";

if (isset($_GET['q'])) {
  $getusers = mysqli_query($conn, "SELECT * FROM users");

  while($row = mysqli_fetch_assoc($getusers)) {
    $username_array[] = $row['name'];
  }

  $q = strtolower($q);
  $len=strlen($q);
  foreach($username_array as $name) {
    if (stristr($q, substr($name, 0, $len))) {
      if ($hint === "") {
        $hint = $name; //return the name if available
      } else {
        $hint .= ", $name "; //return suggestions
      }
    }
  }
  echo $hint === "" ? "no suggestion" : $hint;

}