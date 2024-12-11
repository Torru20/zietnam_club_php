<?php
    include '../core/init.php';
    $getFromA->logout();
    if ($getFromA->loggedIn() === false) {
        header('Location:'.BASE_URL.'index.php');
    }
?>