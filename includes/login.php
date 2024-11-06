<?php
if ($_SERVER['REQUEST_METHOD'] == "GET" && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
header('Location: pages/forum_page.php');
}
if(isset($_POST['login']) && !empty($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(!empty($email) or !empty($password)) {
    $email = $getFromU->checkInput($email);
    $password = $getFromU->checkInput($password);

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errorMsg = "Invalid format";
    }else {
        if($getFromU->login($email, $password) === false){
        $errorMsg = "The email or password is incorrect!";
        }
    }
    }else {
    $errorMsg = "Please enter username and password!";
    }
}
?>


    <form method="post">
        <h1>Log in</h1>
        <div class="social-icons">
            <a href="#" class="icon"><i class="fa-brands fa-google"></i></a>

            <a href="#" class="icon"><i class="fa-brands fa-facebook"></i></i></a>
        </div>
        <span>
            or use your email for registeration
        </span>
        <input type="text" name="email" placeholder="Email">
        
        <input type="password" name="password" placeholder="Password">
        
        <a href="#">Forgot your password</a>
        <button name="login" value="login" type="submit">Sign In</button>
        <?php
        if(isset($errorMsg)){
                echo '<div class="alert alert-danger" role="alert"style="width: 400px; margin:20px auto;text-align:center;">
                '.$errorMsg.'
                </div>';
        }
        ?> 
    
    </form>
