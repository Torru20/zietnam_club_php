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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>My forum</title>
    <link rel="shortcut icon" type="image/x-icon" href="./assets/images/bird.svg">
    <link rel = 'stylesheet' href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css'/>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Playwrite+CU:wght@100..400&family=Playwrite+VN:wght@100..400&family=Protest+Guerrilla&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8d9bbedb1f.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <link rel="stylesheet" href="css/reset.css">
    
    <link rel='stylesheet' href='<?php echo BASE_URL; ?>assets/css/style-complete.css' />

    <link rel="stylesheet" href="css/rent-post.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/nav_bar.css">
</head>
<body>
    <?php
        require "components/nav_bar.php";
    ?>
        <!--Tweet SHOW WRAPPER-->
    <?php include "components/chat_user_list.php"; ?>
    </h1>
    <?php $getFromR->rents($user_id, 20 );
                    ?>
    
    




        <div class="main">
            <div class=''>

                
                <!--TWEETS SHOW WRAPPER-->

                <div class='loading-div'>
                    <img id='loader' src='assets/images/loading.svg' style='display: none;' />
                </div>
                <div class='popupTweet'></div>
                <!--Tweet END WRAPER-->
                <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/like.js'></script>
                <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/retweet.js'></script>
                <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/popuptweets.js'></script>
                <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/delete.js'></script>
                <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/comment.js'></script>
                <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/popupForm.js'></script>
                <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/fetch.js'></script>

                <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/messages-copy.js'></script>
                <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/notification.js'></script>
                <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/postMessage.js'></script>

            </div><!-- in left wrap-->
        </div><!-- in center end -->


    <script src="js/header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


    <?php
  include 'components/footer.php';
 ?>
    <script src="js/dark-mode.js"></script>
</body>
</html>