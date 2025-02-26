<?php

session_start();
$_SESSION['name']="xyz";
$_SESSION['email']="xyz@xyz.com";
$_SESSION['phone']="65758698708676";

echo $_SESSION['name'];

session_unset();
echo "value are unset";
session_destroy();

?>