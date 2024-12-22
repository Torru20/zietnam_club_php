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
    <title>Chat chit</title>
    <?php
        require "template/head.php";
    ?>
    <style>
        @import "css/pallete.css";
        .new-chat {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .new-chat h2 {
        color: var(--primary-color);
        
        margin-top: 10px;
    }
    .new-chat-btn {
        background-color: var(--primary-color);
        color: white;
        border-radius: 50%; /* Ensures a perfect circle */
        padding: 20px;
        box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.3);
        width: 60px; /* Adjust the width and height for desired size */
        height: 60px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 24px;
    }
    .new-chat-btn:hover {
        background-color: var(--inverseprimary-color);
        box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.5);
    }
        

    </style>
</head>
<body>
    <?php
        require "components/nav_bar.php";
        require "components/chat_user_list.php";
    ?>

    <div class="new-chat">
        <button class="new-chat-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"><i class="fas fa-plus"></i></button>
        <h2 style="color: var(--text);">New chat</h2>
    </div>


    <div class="main">
        <div class=''>
            <div class='popupTweet'></div>
            <?php
                require 'components/footer.php';
                require 'template/footer.php';
            ?>
        </div><!-- in left wrap-->
    </div><!-- in center end -->

</body>
</html>