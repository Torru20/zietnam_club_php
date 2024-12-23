<?php
include '../core/init.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>Admin Hone</title>
    

    <?php
      require "../template/a_head.php";
    ?>
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
        require "../components/a_footer.php";
    ?>
</body>
</html>

