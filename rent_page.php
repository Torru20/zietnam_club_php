<?php
include 'core/init.php';
$user_id = $_SESSION['user_id'];
$user = $getFromU->userData( $user_id );
$notify  = $getFromM->getNotificationCount( $user_id );

if ( $getFromU->loggedIn() === false ) {
    header( 'Location: '.BASE_URL.'index.php' );
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Find homestay</title>
    <?php
        require "template/head.php";
    ?>

    <link rel="stylesheet" href="css/rent-post.css">

</head>
<body>
    <?php
        require "components/nav_bar.php";
        require "components/chat_user_list.php";
        $getFromR->rents($user_id, 20 );
        require 'components/footer.php';
        require 'template/footer.php';
    ?>
</body>
</html>