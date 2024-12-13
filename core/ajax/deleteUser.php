<?php 
    include '../init.php';
    var_dump($_POST);
    if (isset($_POST['user_id'])) {
        $user_id = $_POST['user_id'];
        $getFromA->delete('users', array('user_id' => $user_id));

    }
    
?>

