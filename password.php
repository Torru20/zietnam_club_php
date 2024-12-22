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
	<title>Change Password</title>
    <?php
        require "template/head.php";
    ?>
    <style>
        .grid-container{
            padding-top:50px;
        }
        
    </style>
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

        

    <?php
        require 'components/footer.php';
        require "template/footer.php";
    ?>
</body>

</html>

