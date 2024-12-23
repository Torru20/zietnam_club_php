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
<div class="main">
            <div class=''>

                
                <!--TWEETS SHOW WRAPPER-->

                <div class='loading-div'>
                    <img id='loader' src='assets/images/loading.svg' style='display: none;' />
                </div>
                <div class='popupTweet'></div>
                <!--Tweet END WRAPER-->

                <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/messages-copy.js'></script>
                

            </div><!-- in left wrap-->
        </div>
    <?php
        require "components/nav_bar.php";
        require "components/chat_user_list.php";
        $getFromR->rents($user_id, 20 );
        require 'components/footer.php';
        require 'template/footer.php';
    ?>
</body>
</html>