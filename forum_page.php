<?php
include 'core/init.php';
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
        header( 'Location: forum_page.php' );
    } else {
        $error = 'Type or choose image to tweet';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>My forum</title>
    <?php
    require "template/head.php";
    ?>
    <link rel="stylesheet" href="css/forum_post.css">
</head>
<body>
    <?php
        require "components/nav_bar.php";
    ?>
    <h1 style="padding-top:20px;"></h1>
    <div class="post-body">
        <?php
            require "components/floating-button.php";
        ?>
    </div>
    
    <div class="main">
            <div class=''>

                <div class='tweets'>
                    <?php $getFromT->posts( $user_id, 20 );
                    ?>
                </div>

                <div class='loading-div'>
                    <img id='loader' src='assets/images/loading.svg' style='display: none;' />
                </div>
                <div class='popupTweet'></div>
            </div>
        </div>


    
<?php
    require 'components/footer.php';
    require 'template/footer.php';
?>
    

</body>
</html>