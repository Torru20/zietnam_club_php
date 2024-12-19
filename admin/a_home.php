<?php
include '../core/init.php';
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
    <link rel="stylesheet" href="../css/nav_bar.css">
    <link rel="stylesheet" href="../css/home.css">
    
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">

    <title>ZietNam Club – Your Bridge to Vietnam </title>
    
    <script src="https://code.jquery.com/jquery-latest.js"></script>
    <script src="../js/home.js"></script>
    <script src="https://kit.fontawesome.com/8d9bbedb1f.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        require "../components/a_navbar.php";
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
        <h1> Page for <span id="red-text"> Admin </span> </h1>

        <hr id="title-text-separator" />

        <p> Vibrant community
          <br>
          User-friendly interface
        </p>
      </div>


      <!-- Features of the Services -->
      <div id="service-features">

        

        <div id="feature">
            <i class="fa-solid fa-lock "></i>
            <h2 id="feature-title"> USER MANAGE </h2>
            <p> Help user get forgot password and delete the spam account.</p>
            <a href="a_user_manage.php"><button id="feature-button"> Check </button></a>
            </div>

        <div id="feature">
            <i class="fa-solid fa-money-check-dollar " ></i>
            <h2 id="feature-title"> CHECK </h2>
            <p> Check the posting rent house of user.</p>
            <a href="a_rent_manage.php"><button id="feature-button"> Check </button></a>
        </div>

      </div>

    </div>
    
<!--thu-->
 <!--icon o day-->





<!-- JavaScript/jQuery -->
  <script src="js/header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


    
  <script src="js/dark-mode.js"></script>


    <?php
        include "../components/a_footer.php";
    ?>
</body>
</html>

