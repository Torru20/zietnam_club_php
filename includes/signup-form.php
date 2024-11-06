<?php
if ($_SERVER['REQUEST_METHOD'] == "GET" && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
	header('Location: ../index.php');
}
if(isset($_POST['signup'])){
	$screenName = $_POST['screenName'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$error = '';

	if(empty($screenName) or empty($password) or empty($email)){
		$error = 'All fields are required';
	}else {
		$email = $getFromU->checkInput($email);
		$screenName = $getFromU->checkInput($screenName);
		$password = $getFromU->checkInput($password);

		if(!filter_var($email)) {
			$error = 'Invalid email format';
		}else if(strlen($screenName) > 20){
			$error = 'Name must be between in 6-20 characters';
		}else if(strlen($password) < 5){
			$error = 'Password is too short';
		}else {
			if($getFromU->checkEmail($email) === true){
				$error = 'Email is already in use';
			}else {
				$user_id = $getFromU->create('users', array('email' => $email, 'password' => md5($password) , 'screenName' => $screenName, 'profileImage' => 'assets/images/defaultProfileImage.png', 'profileCover' => 'assets/images/defaultCoverImage.png'));
				$_SESSION['user_id'] = $user_id;
				header('Location: includes/signup.php?step=1');
			}
		}
	}
}
?>
<!--
<form method="post">
<div class="signup-div">
	<h3>Sign up </h3>
	<ul>
		<li>
		    <input type="text" name="screenName" placeholder="Full Name"/>
		</li>
		<li>
		    <input type="email" name="email" placeholder="Email"/>
		</li>
		<li>
			<input type="password" name="password" placeholder="Password"/>
		</li>
		<li>
			<input type="submit" name="signup" Value="Signup for Twitter">
		</li>
		
	</ul>

</div>
</form>
-->




    <form method="post">
        <?php
        if(isset($error)){
            echo '<div class="alert alert-danger" role="alert"style="width: 300px; margin:20px auto;text-align:center;">
                '.$error.'
            </div>';
            }
        ?>    
        <h1>Sign up</h1>
        <div class="social-icons">
            <a href="#" class="icon"><i class="fa-brands fa-google"></i></a>

            <a href="#" class="icon"><i class="fa-brands fa-facebook"></i></i></a>
        </div>
        <span>
            or use your email for registeration
        </span>

        <input type="text" name="screenName" placeholder="Name">
        
        <input type="text" name="email" placeholder="Email">
        
        <input type="password" name="password" placeholder="Password">
        
        <button type="submit" name="signup">Sign up</button>

    </form>


<script type="text/javascript">
    setTimeout(function() {
        // Closing the alert 
        $('#alert').alert('close');
    }, 3500);

</script>