<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Playwrite+CU:wght@100..400&family=Playwrite+VN:wght@100..400&family=Protest+Guerrilla&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8d9bbedb1f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/signin.css">
    

</head>
<body>
    <?php
        require "../components/header.php";
    ?>
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
            <div class="form-container sign-in">
                <form method="post">
                    <h1>Log in</h1>
                    <div class="social-icons">
                        <a href="#" class="icon"><i class="fa-brands fa-google"></i></a>

                        <a href="#" class="icon"><i class="fa-brands fa-facebook"></i></i></a>
                    </div>
                    <span>
                        or use your email for registeration
                    </span>
                    <input type="text" placeholder="Email">
                    
                    <input type="password" placeholder="Password">
                    
                    <a href="#">Forgot your password</a>
                    <button>Sign In</button>
                </form>
            </div>
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
</body>
</html>