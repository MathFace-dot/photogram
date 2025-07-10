<?php

include 'libs/load.php';

if(Session::isAuthenticated()){

Session::renderPage();
}else{
    Session::ensureLogin();
}
?>