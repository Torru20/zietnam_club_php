<?php
	include 'core/init.php';
	if($getFromU->loggedIn() === true){
		header('Location: pages/forum_page.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require "template/head.php";
    ?>
    <link rel="stylesheet" href="css/signin.css">
    

</head>
<body>

    <div class="form-body">
        <div class="container" id="container">
            <div class="form-container sign-up">
                <form>
                    <h1>Sign up</h1>
                    <div class="social-icons">
                        <a href="#" class="icon"><i class="fa-brands fa-google"></i></a>

                        <a href="#" class="icon"><i class="fa-brands fa-facebook"></i></i></a>
                    </div>
                    <span>
                        or use your email for registeration
                    </span>

                    <input type="text" placeholder="Name">
                    
                    <input type="text" placeholder="Email">
                    
                    <input type="password" placeholder="Password">
                    
                    <button>Sign up</button>
                </form>
            </div>

            <?php
            include "includes/login.php";
            ?>
            <div class="toggle-container">
                <div class="toggle">
                    <div class="toggle-panel toggle-left">
                        <h1>Welcome back</h1>
                        <p>Go to your home page</p>
                        <button class="hidden" id="login">Sign in</button>
                    </div>

                    <div class="toggle-panel toggle-right">
                        <h1>Hello Friend!</h1>
                        <p>Nice to meet you</p>
                        <button class="hidden" id="register">Sign up</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
        


            
            
     <script src="../js/signin.js"></script> 
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>