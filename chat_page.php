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
    <style>
        @import "css/pallete.css";

    </style>
    <link rel='stylesheet' href='<?php echo BASE_URL; ?>assets/css/style-complete.css' />

    <link rel="stylesheet" href="css/forum_post.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/nav_bar.css">
    <link rel="stylesheet" href="css/chatchit.css">

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
            
        <a class="dropdown-item" id="messagePopup" href="#">Click</a>
        <?php
        if(isset($_POST['showChatPopup']) && !empty($_POST['showChatPopup'])){
            $messageFrom = $_POST['showChatPopup'];
            $user_id     = $_SESSION['user_id'];
            $user        = $getFromU->userData($messageFrom);
            ?>
            <div class="popup-message-body-wrap">
                <input id="popup-message-tweet" type="checkbox" checked="unchecked"/>
                <input id="message-body" type="checkbox" checked="unchecked"/>
                <div class="wrap3">
                <div class="message-send2">
                    <div class="message-header2">
                        <div class="message-h-left">
                            <label class="back-messages" for="mass"><i class="fa fa-angle-left" aria-hidden="true"></i></label>
                        </div>
                        <div class="message-h-cen">
                            <div class="message-head-img">
                              <img src="<?php echo BASE_URL.$user->profileImage;?>"/><h4>Messages</h4>
                            </div>
                        </div>
                        <div class="message-h-right">
                          <label class="close-msgPopup" for="message-body" ><i class="fa fa-times" aria-hidden="true"></i></label> 
                        </div>
                    </div>
                    <div class="message-del">
                        <div class="message-del-inner">
                            <h4>Are you sure you want to delete this message? </h4>
                            <div class="message-del-box">
                                <span>
                                    <button class="cancel mb-2" value="Cancel">Cancel</button>
                                </span>
                                <span>	
                                    <button class="delete mb-2" value="Delete">Delete</button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="main-msg-wrap">
                      <div id="chat" class="main-msg-inner">
                     
                       </div>
                    </div>
                    <div class="main-msg-footer">
                        <div class="main-msg-footer-inner form-group">
                            <ul>
                                <li><textarea class="form-control" id="msg" name="msg" cols="100%" placeholder="Write some thing!"></textarea></li>
                                <li><input id="msg-upload" type="file" value="upload"/><label for="msg-upload"><i class="fa fa-camera mt-2" aria-hidden="true"></i></label></li>
                                <li><input class="mt-2"id="send" data-user="<?php echo $messageFrom;?>" type="submit" value="Send"/></li>
                            </ul>
                        </div>
                    </div>
                  </div> <!--MASSGAE send ENDS-->
                </div> <!--wrap 3 end-->
                </div><!--POP UP message WRAP END-->
            <?php	
        }
        ?>

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