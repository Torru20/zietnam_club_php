<?php
include 'core/init.php';
$user_id = $_SESSION['user_id'];
$user = $getFromU->userData( $user_id );
$notify  = $getFromM->getNotificationCount( $user_id );

if ( $getFromU->loggedIn() === false ) {
    header( 'Location: '.BASE_URL.'index.php' );
}

if ( isset( $_POST['post-rent'] ) ) {
    $description = $getFromU->checkinput( $_POST['description'] );
    $price = $getFromU->checkinput( $_POST['price'] );
    $status='waiting';
    $postImage = '';

    if ( !empty( $description ) or !empty( $price ) or !empty( $_FILES['file']['name'][0] ) ) {
        if ( !empty( $_FILES['file']['name'][0] ) ) {
            $postImage = $getFromU->uploadImage( $_FILES['file'] );
        }

        if ( strlen( $description ) > 2000 ) {
            $error = 'The text of your post is too long';
        }
        $post_id = $getFromU->create( 'rents', array( 'description' => $description, 'houseOf' => $user_id, 'postImage' => $postImage, 'postedOn' => date( 'Y-m-d H:i:s' ) ,'price' => $price,'status' => $status) );
        
        header( 'Location: test.php' );
    } else {
        $error = 'Type description, set price or choose image to post';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require "template/head.php";
    ?>
    <title>VNhome</title>
    

    <link rel="stylesheet" href="css/table-style.css">
    <style>
        .floating-button {
            z-index: 1;
            position: fixed;
            bottom: 20px;
            right: 20px;
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
        .floating-button:hover {
            background-color: var(--inverseprimary-color);
            box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.5);
        }
        

    </style>
</head>
<body>
    <?php
        require "components/nav_bar.php";
    ?>
    <h1>Management rent posted</h1>
    <?php 
        $getFromR->rentsByID($user_id);
    ?>


    <button id="btn-popup" class="floating-button">
        <i class="fas fa-plus"></i>
    </button>
    <?php
        include "components/pop-up-form2.php";
    ?>
    <script>
        const btnPopup = document.getElementById('btn-popup');
        const popup = document.getElementById('popup');

        btnPopup.addEventListener('click', () => {
        popup.style.display = 'block';
        });
    </script>

    <?php
        require 'components/footer.php';
        require 'template/footer.php';
    ?>

    <script src="js/dark-mode.js"></script>
            
        </body>
</html>