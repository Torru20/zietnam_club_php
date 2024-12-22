<?php
	include 'core/init.php';
	if($getFromU->loggedIn() === true){
		header('Location: forum_page.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>ZietnamClub</title>
    <?php
        require "template/head.php";
    ?>
    <link rel="stylesheet" href="css/signin.css">

</head>
<body>

    <div class="form-body">
        <div class="container" id="container">
            <div class="form-container sign-up">
                <?php
                include "includes/signup-form.php";
                ?>
            </div>
            <div class="form-container sign-in">
                <?php
                include "includes/login.php";
                ?>
            </div>
            
            <div class="toggle-container">
                <div class="toggle">
                    <div class="toggle-panel toggle-left">
                        <h1>Welcome back</h1>
                        <p>Go to your home page</p>
                        <button type="button" class="hidden" id="login">Sign in</button>
                    </div>

                    <div class="toggle-panel toggle-right">
                        <h1>Hello Friend!</h1>
                        <p>Nice to meet you</p>
                        <button type="button" class="hidden" id="register">Sign up</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
        

    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <p class="col-md-4 mb-0 text-body-secondary">© 2024 BlueTeam, Inc</p>

   
  </footer>
            
            
    <script src="js/signin.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>