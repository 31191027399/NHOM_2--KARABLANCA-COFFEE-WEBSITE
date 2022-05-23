<?php
function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "root";
 $db = "karablanca";
 $pass="";
 $conn = new mysqli($dbhost, $dbuser,  $pass, $db) or die("Connect failed: %s\n". $conn -> error);
 return $conn;
 }

function CloseCon($conn)
 {
 $conn -> close();
 }
