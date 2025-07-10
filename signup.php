<?php

include 'libs/load.php';

if(Session::isAuthenticated()){ //to skip or not to use login or register page if it loginin
    header("Location: /");      // signup -> index : if login sucess
    die();                      // not to go in signup.php again
}

Session::renderPage();
?>