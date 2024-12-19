<?php 
	include 'core/init.php';
	$user_id = $_SESSION['user_id'];
	$user    = $getFromU->userData($user_id);
	$notify  = $getFromM->getNotificationCount($user_id);

 
 	if($getFromU->loggedIn() === false){
		header('Location: index.php');
	}

	if(isset($_POST['submit'])){
		$currentPwd  = $_POST['currentPwd'];
		$newPassword = $_POST['newPassword'];
		$rePassword  = $_POST['rePassword'];
		$error       = array();

		if(!empty($currentPwd) && !empty($newPassword) && !empty($rePassword)){
			if($getFromU->checkPassword($currentPwd) === true){
				if(strlen($newPassword) < 6){
					$error['newPassword'] = "Password is too short";
				}else if($newPassword != $rePassword){
					$error['rePassword'] = "Password does not match";
				}else{
					$getFromU->update('users', $user_id, array('password' => md5($newPassword)));
//					header('Location:'.$user->username);
					header('Location:'.BASE_URL.'password.php');
				}
			}else{
				$error['currentPwd'] = "Password does not match";
			}
		}else{
			$error['fields']  = "Please fill all the fields";
		}
	}
?>
<html>
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
    
    <link rel='stylesheet' href='<?php echo BASE_URL; ?>assets/css/style-complete.css' />

    <link rel="stylesheet" href="css/rent-post.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/nav_bar.css">
	</head>
<body>
<?php
      require "components/nav_bar.php";
    ?>
<div class="grid-container">
    
	<div class="main">
        
        <div class="setting-head">
           <div class="account-text">
            <a href="<?php echo BASE_URL?>account.php">Account</a>
            </div>
            <div class="password-text active">
            <a class="bold" href="<?php echo BASE_URL;?>password.php">Password</a>
                </div>
        </div>
		
		<div class="righter mt-4">
			<div class="inner-righter">
				<div class="acc">
					<div class="acc-heading">
						<h5 style="color: var(--text);">Change your password or recover your current one</h5>
					</div>
					<div class="acc-content">
					<form method="POST">
						<div class="acc-wrap">
							<label class="ml-3" for="" style="color: var(--text);">Current Password</label>
							<div class="form-group col-auto">
								<input class="form-control" type="password" name="currentPwd"/>
								<span>
								<?php if(isset($error['currentPwd'])){echo $error['currentPwd'];}?>
								</span>
							</div>
						</div>

						<div class="acc-wrap">
							<label class="ml-3" for="" style="color: var(--text);">New Password</label>
							<div class="form-group col-auto">
								<input class="form-control" type="password" name="newPassword"/>
								<span>
									<?php if(isset($error['newPassword'])){echo $error['newPassword'];}?>
								</span>
							</div>
						</div>
						
						<div class="acc-wrap">
							<label class="ml-3" for="" style="color: var(--text);">Verify Password</label>
							<div class="form-group col-auto">
								<input class="form-control" type="password" name="rePassword"/>
								<span>
									<?php if(isset($error['rePassword'])){echo $error['rePassword'];}?>
								</span>
							</div>
						</div>
						
						<div class="acc-wrap">
							<div class="acc-right mt-3">
                                <button class="new-btn"type="Submit" name="submit" value="Save changes"style="outline:none;">Save</button>
							</div>
							<div class="settings-error">
								<?php if(isset($error['fields'])){echo $error['fields'];}?>
   							</div>	
						</div>
					</form>
					</div>
				</div>
				<div class="content-setting">
					<div class="content-heading">
						
					</div>
					<div class="content-content">
						<div class="content-left">
							
						</div>
						<div class="content-right">
							
						</div>
					</div>
				</div>
			</div>	
		</div><!--RIGHTER ENDS-->
	</div>
	<!--CONTAINER_WRAP ENDS-->

	<div class="popupTweet"></div>

        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/search.js'></script>
        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/hashtag.js'></script>

        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/follow.js'></script>

        <script src='<?php echo BASE_URL;?>assets/js/jquery-3.1.1.min.js'></script>
        <script src='<?php echo BASE_URL;?>assets/js/popper.min.js'></script>
        <script src='<?php echo BASE_URL;?>assets/js/bootstrap.min.js'></script>

        <!-- SCRIPTS -->
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/popuptweets.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/delete.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/popupForm.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/retweet.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/like.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/hashtag.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/search.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/follow.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/messages.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/postMessage.js"></script>
        
		<script src="js/header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


    <?php
  include 'components/footer.php';
 ?>
    <script src="js/dark-mode.js"></script>
</body>

</html>

