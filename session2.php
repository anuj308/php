<?php

session_start();
echo $_SESSION['name'];
echo $_SESSION['email'];
echo $_SESSION['phone'];

if(isSet($_SESSION['name'])){
    echo "sesiion is not set";
}else{
    echo "session is set";
}
?>