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
<html>
<head>
  <?php
    require "template/head.php";
  ?>
    <link rel="stylesheet" href="css/home.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
    <title>ZietNam Club – Your Bridge to Vietnam </title>
    <script src="js/home.js"></script>

</head>
<body>
  <?php
    require "components/nav_bar.php";
  ?>
  <!-- Hero Image, text & button -->

  <div id="hero-header">
    <div id="hero-content">
      <h1 id="hero-title"> ZietNam Club <br> Your Bridge to Vietnam </H1>

      <p id="hero-text"> Where the International Community in Vietnam Meets </p>

      <a href="#features-container"><button id="hero-button"> More </button></a>
    </div>

  </div>



    <!-- "Features Section" -->

    <div id="features-container">

      <!-- Features Section Description -->
      <div id="features-description">
        <h1> Why choose <span id="red-text"> Zietnam Club </span> </h1>

        <hr id="title-text-separator" />

        <p> Vibrant community
          <br>
          User-friendly interface
        </p>
      </div>


      <!-- Features of the Services -->
      <div id="service-features">

        <div id="feature">
          <!--<i class="fa-solid fa-heart fa-beat" style="--fa-animation-duration: 2s;"></i>-->
          
          <i class="fa-solid fa-heart" ></i>
          <h2 id="feature-title"> Stay </h2>

          <p> Easily search and post listings for rentals </p>

          <a href="rent_page.php"><button id="feature-button"> Search </button></a>
        </div>

        <div id="feature">
          <i class="fa-solid fa-envelope"  ></i>
          <h2 id="feature-title"> Share </h2>

          <p> 
          Share experiences, ask questions, and discuss any topic.
          </p>

          <a href="forum_page.php"><button id="feature-button"> Forum </button></a>
        </div>

        <div id="feature">
          <i class="fa-solid fa-money-check-dollar " ></i>


          <h2 id="feature-title"> Say </h2>

          <p> Chat directly with new friends.</p>

          <a href="chat_page.php"><button id="feature-button"> Chat </button></a>
        </div>

        <div id="feature">
          <i class="fa-solid fa-lock "></i>

          <h2 id="feature-title"> So... </h2>

          <p> Find a travel companion to explore Vietnam.</p>
          <a href="explore_friend.php"><button id="feature-button"> Find </button></a>
        </div>

      </div>

    </div>
    
<!--thu-->




<!-- JavaScript/jQuery -->
 <?php
  require 'components/footer.php';
  require 'template/footer.php';
 ?>

  

</body>
</html>