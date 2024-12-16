<?php 
	include '../init.php';
	if(isset($_POST['search']) && !empty($_POST['search'])){
		$search = $getFromU->checkInput($_POST['search']);
		$result = $getFromU->search($search);
		if(!empty($result)){
		echo ' <div class="nav-right-down-wrap"><ul> ';
		foreach ($result as $user) {
			echo '		  	
					<li>
				  		<div class="nav-right-down-inner trend" data-user="'.$user->user_id.'">
							<div class="nav-right-down-left">
								<a href="'.BASE_URL.'settings_page.php?user_click='.$user->username.'" ><img src="'.BASE_URL.$user->profileImage.'"></a>
								
							</div>
							<div class="nav-right-down-right">
								<div class="nav-right-down-right-headline">
									<a href="'.BASE_URL.'settings_page.php?'.$user->username.'"><b>'.$user->screenName.'</b></a><br><span class="text-muted">@'.$user->username.'</span>
								</div>
								<div class="nav-right-down-right-body">
								 
							    </div>
							</div>
						</div> 
					 </li> ';
		}
			echo '</ul></div>';
		}
	}
?>