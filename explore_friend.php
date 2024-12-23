<?php
include 'core/init.php';
$user_id = $_SESSION['user_id'];
$user = $getFromU->userData( $user_id );
$notify  = $getFromM->getNotificationCount( $user_id );

if ( $getFromU->loggedIn() === false ) {
    header( 'Location: '.BASE_URL.'index.php' );
}

?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Explore</title>
    <?php
        require "template/head.php";
    ?>

<style>
    .grid-container{
        padding: 30px;
        margin-top: 30px;
        
    }
    .search-container{
        background-color: var(--surface-color);
        padding: 10px;
        border-radius: 20px;
        color: var(--secondary-color);
        font-family: 'Playwrite VN';
    }
    .search-result{
        margin-top: 40px;
        margin-bottom: 40px;
    }
    .nav-right-down-wrap{
        margin-top: 110px;
        z-index: 1;
    }
    .trends_header p{
        color:var(--text);
        font-family: 'Playwrite VN';
        font-weight: 100 400;
        
    }
    .media-inner{
        margin:10px;
    }
    .trends_show-more{
        margin-top: 30px;
    }
    .trends_show-more a{
        text-decoration: none;
        color:var(--text);
        font-family: 'Playwrite VN';
        font-weight: 100 400;
    }
    .trends_show-more a:hover{
        text-decoration: none;
        color:var(--inverseprimary-color);
        font-family: 'Playwrite VN';
        font-weight: 100 400;
    }
</style>
</head>

<body>

    <div class="grid-container">
        <!--    <div class='wrapper'>-->

        <?php require "components/nav_bar.php"; ?>
        <div class="search-container">
            <a href="" class="search-btn">
                <i class="fa fa-search"></i>
            </a>
            <input type="text" name="search" placeholder="search" class="search-input search" autocomplete="off">
        </div>
        <div class='search-result'></div>

        <?php 
            $getFromF->whoToFollow( $user_id, $user_id );
            $getFromT->trends();
            require 'components/footer.php';
            require 'template/footer.php';
        ?>
    </div>

</body>

</html>
