<?php
include '../core/init.php';
$user_id = $_SESSION['user_id'];
$user = $getFromU->userData( $user_id );
$notify  = $getFromM->getNotificationCount( $user_id );

if ( $getFromU->loggedIn() === false ) {
    header( 'Location: '.BASE_URL.'index.php' );
}

if ( isset( $_POST['tweet'] ) ) {
    $status = $getFromU->checkinput( $_POST['status'] );
    $tweetImage = '';

    if ( !empty( $status ) or !empty( $_FILES['file']['name'][0] ) ) {
        if ( !empty( $_FILES['file']['name'][0] ) ) {
            $tweetImage = $getFromU->uploadImage( $_FILES['file'] );
        }

        if ( strlen( $status ) > 1000 ) {
            $error = 'The text of your tweet is too long';
        }
        $tweet_id = $getFromU->create( 'tweets', array( 'status' => $status, 'tweetBy' => $user_id, 'tweetImage' => $tweetImage, 'postedOn' => date( 'Y-m-d H:i:s' ) ) );
        preg_match_all( '/#+([a-zA-Z0-9_]+)/i', $status, $hashtag );

        if ( !empty( $hashtag ) ) {
            $getFromT->addTrend( $status );
        }
        $getFromT->addMention( $status, $user_id, $tweet_id );
        header( 'Location: home.php' );
    } else {
        $error = 'Type or choose image to tweet';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require "../template/head.php";
    ?>
    <link rel="stylesheet" href="../css/forum_post.css">
    <link rel="stylesheet" href="../css/header.css">
</head>
<body>
    <?php
        require "../components/nav_bar.php";
    ?>
    <div class="post-body">
        <h1></h1>
        <?php

            include "../components/post.php";

            include "../components/floating-button.php";
        ?>
        <!--Tweet SHOW WRAPPER-->
    

        
        
    </div>
    <div class='tweets'>
        <?php $getFromT->tweets( $user_id, 20 );
        ?>
    </div>
    <script src="../js/header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


    <script type='text/javascript' src='../assets/js/like.js'></script>
    <script type='text/javascript' src='../assets/js/retweet.js'></script>
    <script type='text/javascript' src='../assets/js/popuptweets.js'></script>
    <script type='text/javascript' src='../assets/js/delete.js'></script>
    <script type='text/javascript' src='../assets/js/comment.js'></script>
    <script type='text/javascript' src='../assets/js/popupForm.js'></script>
    <script type='text/javascript' src='../assets/js/fetch.js'></script>
    <script type='text/javascript' src='../assets/js/messages.js'></script>
    <script type='text/javascript' src='../assets/js/notification.js'></script>
    <script type='text/javascript' src='../assets/js/postMessage.js'></script>
</body>
</html>