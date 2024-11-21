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
    <?php
        require "template/head.php";
    ?>
    <link rel="stylesheet" href="assets/css/style-complete.css">
    <link rel="stylesheet" href="css/chatchit.css">
    <link rel="stylesheet" href="css/nav_bar.css">

</head>

<body>
  
    <?php
        require "components/nav_bar.php";
    ?>
    


    <div class="container">
        <div class="chat-window">
            <div class="chat-header">
                <div class="row">
                    <div class="col-md-2">
                        <?php include "components/chat_user_list.php"; ?>
                    </div>
                    <div class="col-md-10">
                        <h2>Tên cuộc trò chuyện</h2>
                        <p>Mô tả ngắn về cuộc trò chuyện</p>
                    </div>
                    
                </div> 
            </div>    
		</div>
            

        </div>
        <div class="chat-input">
            <form>
                <input type="text" class="form-control" placeholder="Type your message...">
                <button type="submit" class="btn btn-primary">Send</button>
            </form>   
        </div>


    </div>
  
  
    <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/like.js'></script>
    <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/retweet.js'></script>
    <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/popuptweets.js'></script>
    <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/delete.js'></script>
    <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/comment.js'></script>
    <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/popupForm.js'></script>
    <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/fetch.js'></script>
    <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/messages.js'></script>
    <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/notification.js'></script>
    <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/postMessage.js'></script>
    <script src="js/header.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="js/dark-mode.js"></script>
</body>

</html>