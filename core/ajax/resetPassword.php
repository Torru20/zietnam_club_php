<?php
include '../init.php';
var_dump($_POST);
if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $pass = '123456';
    $pass = md5($pass);
    $getFromA->update('users', $user_id, ['password' => $pass]);
}else{
    echo "false";
}
?>