<?php
include 'core/init.php';
$user_id = $_SESSION['user_id'];
$user    = $getFromU->userData( $user_id );
$notify  = $getFromM->getNotificationCount( $user_id );

if ( $getFromU->loggedIn() === false ) {
    header( 'Location: index.php' );
}

if ( isset( $_POST['submit'] ) ) {
    $username  = $_POST['username'];
//    $email     = $_POST['email'];
    $error     = array();

    if ( !empty( $username )) {
        if ( preg_match( '/[^a-zA-Z0-9\!]/', $username ) ) {
            $error['username']  = 'Only characters and numbers allowed';
        }if ( $user->username != $username and $getFromU->checkUsername( $username ) === true ) {
            $error['username'] = 'Username is not available';
        }
//        else if ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
//            $error['email'] = 'Invalid email format';
//        } else if ( $user->email != $email and $getFromU->checkEmail( $email ) === true ) {
//            $error['email'] = 'Email is already in use';
//        } 
            else {
            $getFromU->update( 'users', $user_id, array( 'username' => $username));
            header( 'Location:'.BASE_URL.'account.php' );
        }
    } else {
        $error['fields']  = 'Please fill all the fields';
    }
}
?>
<html>

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
    <script src='<?php echo BASE_URL; ?>assets/js/jquery-3.1.1.min.js'></script>
</head>

<body>
    <?php
      require "components/nav_bar.php";
    ?>
    <div class='grid-container'>


        <div class='main'>

            <div class='setting-head'>
                <div class='account-text active'>
                    <a class='bold' href='<?php echo BASE_URL?>account.php'>Account</a>
                </div>
                <div class='password-text'>
                    <a href='<?php echo BASE_URL;?>password.php'>Password</a>
                </div>
            </div>

            <div class='righter mt-4'>
                <div class='inner-righter'>
                    <div class='acc'>
                        <div class='acc-heading' style="color: var(--text);">
                            <h5>Change your basic account settings</h5>
                        </div>
                        <div class='acc-content'>
                            <form id='account-form' method='POST'>
                                <div class='acc-wrap'>
                                    <label class='ml-3' for='' style="color: var(--text);">Username</label>
                                    <div class='form-group col-auto'>
                                        <input class='form-control' type='text' name='username' value="<?php echo $user->username;?>" />
                                        <span>
                                            <?php if ( isset( $error['username'] ) ) {
    echo $error['username'];
}
?>
                                        </span>
                                    </div>
                                </div>

<!--
                                <div class='acc-wrap'>
                                    <label class='ml-3' for=''>Email</label>
                                    <div class='form-group col-auto'>
                                        <input class='form-control' type='text' name='email' value="" />
                                        <span>
                                        </span>
                                    </div>
                                </div>
-->
                                <div class='acc-wrap'>
                                    <div class='acc-right mt-3'>
                                        <button class='new-btn' type='Submit' id='save' name='submit' value='Save changes'>Save</button>
                                    </div>
                                    <div class='settings-error'>
                                        <?php if ( isset( $error['fields'] ) ) {
                                            echo $error['fields'];
                                        }
                                        ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class='content-setting'>
                        <div class='content-heading'>

                        </div>
                        <div class='content-content'>
                            <div class='content-left'>

                            </div>
                            <div class='content-right'>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--RIGHTER ENDS-->
        </div>
        <!--CONTAINER_WRAP ENDS-->

        <div class='popupTweet'></div>

        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/search.js'></script>
        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/hashtag.js'></script>

        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/follow.js'></script>

        <script src='<?php echo BASE_URL;?>assets/js/jquery-3.1.1.min.js'></script>
        <script src='<?php echo BASE_URL;?>assets/js/popper.min.js'></script>
        <script src='<?php echo BASE_URL;?>assets/js/bootstrap.min.js'></script>

        <!-- SCRIPTS -->
        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/like.js'></script>
        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/retweet.js'></script>
        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/popuptweets.js'></script>
        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/delete.js'></script>
        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/comment.js'></script>
        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/popupForm.js'></script>
        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/fetch.js'></script>
        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/messages.js'></script>
        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/notification.js'></script>
        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/postMessage.js'></script>
        
        <script src="js/header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


    <?php
  include 'components/footer.php';
 ?>
    <script src="js/dark-mode.js"></script>
</body>

</html>
