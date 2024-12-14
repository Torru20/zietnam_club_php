<?php
include '../init.php';
var_dump($_POST);
if (isset($_POST['rent_id'])) {
    $rent_id = $_POST['rent_id'];
    $status = 'rented';
    $getFromR->update('rents', $rent_id, ['status' => $status]);
}else{
    echo "false";
}
?>