<?php
include '../init.php';
var_dump($_POST);
if (isset($_POST['rent_id'])) {
    $rent_id = $_POST['rent_id'];
    $status = 'for_rent';
    $getFromR->update('rents', $rent_id, ['status' => $status]);
}else{
    echo "false";
}
?>