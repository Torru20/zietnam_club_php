<?php
if ($_SERVER['REQUEST_METHOD'] == "GET" && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
header('Location: a_homepage.php');
}
if(isset($_POST['login']) && !empty($_POST['login'])) {
    $adname = $_POST['adminname'];
    $password = $_POST['password'];

    if(!empty($adname) or !empty($password)) {
        $adname = $getFromA->checkInput($adname);
        $password = $getFromA->checkInput($password);

   
    if($getFromA->login($adname, $password) === false){
        $errorMsg = "The name or password is incorrect!";
        
    }
    }else {
    $errorMsg = "Please enter name and password!";
    }
}
?>


    <form method="post">
        <h1>Admin log in</h1>


        <input type="text" name="adminname" placeholder="Email">
        
        <input type="password" name="password" placeholder="Password">
        
        <button name="login" value="login" type="submit">Sign In</button>

        <?php
        if(isset($errorMsg)){
                echo '<div class="alert alert-danger" role="alert"style="width: 400px; margin:20px auto;text-align:center;">
                '.$errorMsg.'
                </div>';
        }
        ?> 
    
    </form>
