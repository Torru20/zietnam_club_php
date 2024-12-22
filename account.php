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
    <title>Account</title>
    <?php
        require "template/head.php";
    ?>
    <style>
        .grid-container{
            padding-top:50px;
        }
        
    </style>
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

        
    <?php
        require 'components/footer.php';
        require "template/footer.php";
    ?>
</body>

</html>
