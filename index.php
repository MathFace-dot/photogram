<?php

include 'libs/load.php';

if (isset($_GET['logout'])) {
    if (Session::isset("session_token")) {
        $Session = new UserSession(Session::get("session_token"));
        if ($Session->removeSession()) {
            echo "<h3> Pervious Session is removing from db </h3>";
        } else {
            echo "<h3>Pervious Session not removing from db </h3>";
        }
    }
    Session::destroy();
    Header("Location:/");
   // die();
    //die("Session destroyed, <a href='logintest2.php'>Login Again</a>");
}else{
    // Session::renderPage();
Session::renderPage();
    
}





?>