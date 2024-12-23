<?php 
	include 'core/init.php';
 	$user_id = $_SESSION['user_id'];
	$user    = $getFromU->userData($user_id);
	$getFromM->notificationViewed($user_id);
	$notify  = $getFromM->getNotificationCount($user_id);
	if($getFromU->loggedIn() === false){
		header('Location: index.php');
	}
	$notification  = $getFromM->notification($user_id);
 
 ?>

<!DOCTYPE html>
<html>

<head>
    <title>Notification</title>
    <?php
        require "template/head.php";
    ?>
    <style>
        .grid-container{
            padding: 20px;
        }
        #title-page{
            color:var(--text);
            font-family: 'Playwrite VN';
            font-weight: 100 400;
        }
    </style>
</head>

<body>
    <div class="grid-container">


        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/search.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/like.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/retweet.js"></script>
        <?php
        require "components/nav_bar.php";
    ?>
    <h1 style="margin-top:70px;">

    </h1>

        <div class="main">
<!--            <div class="in-center">-->
<!--                <div class="in-center-wrap">-->

                    <!--NOTIFICATION WRAPPER FULL WRAPPER-->
                    <p id="title-page" class="page_title mb-0">Notifications</p>
                    <div class="notification-full-wrapper">

                        <div class="notification-full-head">
                            <div>
                                <a href="#">All</a>
                            </div>
                            <div>
                                <a href="#">Mention</a>
                            </div>
                            <div>
                                <a href="#">settings</a>
                            </div>
                        </div>
                        <?php foreach($notification as $data) :?>
                        <?php if($data->type == 'follow') :?>
                        <!-- Follow Notification -->
                        <!--NOTIFICATION WRAPPER-->
                        <div class="notification-wrapper">
                            <div class="notification-inner">
                                <div class="notification-header">

                                    <div class="notification-img">
                                        <span class="follow-logo">
                                            <i class="fa fa-child" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div class="notification-name">
                                        <div>
                                            <img src="<?php echo BASE_URL.$data->profileImage;?>" />
                                        </div>

                                    </div>
                                    <div class="notification-tweet">
                                        <a href="<?php echo BASE_URL?>profile_page.php?username=<?php echo $data->username;?>" class="notifi-name"><?php echo $data->screenName;?></a><span> Followed you - <span><?php echo $getFromU->timeAgo($data->time);?></span>

                                    </div>

                                </div>

                            </div>
                            <!--NOTIFICATION-INNER END-->
                        </div>
                        <!--NOTIFICATION WRAPPER END-->
                        <!-- Follow Notification -->
                        <?php endif;?>

                        <?php if($data->type == 'like') :?>
                        <!-- Like Notification -->
                        <!--NOTIFICATION WRAPPER-->
                        <div class="notification-wrapper">
                            <div class="notification-inner">
                                <div class="notification-header">
                                    <div class="notification-img">
                                        <span class="heart-logo">
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div class="notification-name">
                                        <div>
                                            <img src="<?php echo BASE_URL.$data->profileImage;?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="notification-tweet">
                                    <a href="<?php echo BASE_URL?>profile_page.php?username=<?php echo $data->username;?>" class="notifi-name"><?php echo $data->screenName;?></a><span> liked your <?php if($data->tweetBy === $user_id){echo 'Post';}else{echo 'Repost';}?> - <span><?php echo $getFromU->timeAgo($data->time);?></span>
                                </div>
                                <div class="notification-footer">
                                    <div class="noti-footer-inner">
                                        <div class="noti-footer-inner-left">
                                            <div class="t-h-c-name">
                                                
                                                <span><a href="<?php echo BASE_URL?>profile_page.php?username=<?php echo $user->username;?>"><?php echo $user->username;?></a></span>
                                                <span>@<?php echo $user->username;?></span>
                                                <span><?php echo $getFromU->timeAgo($data->postedOn);?></span>
                                            </div>
                                            <div class="noti-footer-inner-right-text">
                                                <?php echo $getFromT->getPostlinks($data->status);?>
                                            </div>
                                        </div>
                                        <?php if(!empty($data->tweetImage)) :?>
                                        <div class="noti-footer-inner-right">
                                            <img src="<?php echo BASE_URL.$data->tweetImage;?>" />
                                        </div>
                                        <?php endif;?>

                                    </div>
                                    <!--END NOTIFICATION-inner-->
                                </div>
                            </div>
                        </div>
                        <!--NOTIFICATION WRAPPER END-->
                        <!-- Like Notification -->
                        <?php endif;?>

                        <?php if($data->type == 'retweet') :?>
                        <!-- Retweet Notification -->
                        <!--NOTIFICATION WRAPPER-->
                        <div class="notification-wrapper">
                            <div class="notification-inner">
                                <div class="notification-header">

                                    <div class="notification-img">
                                        <span class="retweet-logo">
                                            <i class="fa fa-retweet" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div class="notification-tweet">
                                        <a href="<?php echo BASE_URL?>profile_page.php?username=<?php echo $data->username;?>" class="notifi-name"><?php echo $data->screenName;?></a><span> repost your <?php if($data->tweetBy === $user_id){echo 'Tweet';}else{echo 'Retweet';}?> - <span><?php echo $getFromU->timeAgo($data->time);?></span>
                                    </div>
                                    <div class="notification-footer">
                                        <div class="noti-footer-inner">

                                            <div class="noti-footer-inner-left">
                                                <div class="t-h-c-name">
                                                    <span><a href="<?php echo BASE_URL?>profile_page.php?username=<?php echo $user->username;?>"><?php echo $user->screenName;?></a></span>
                                                    <span>@<?php echo $user->username;?></span>
                                                    <span><?php echo $getFromU->timeAgo($data->postedOn);?></span>
                                                </div>
                                                <div class="noti-footer-inner-right-text">
                                                    <?php echo $getFromT->getPostLinks($data->status)?>
                                                </div>
                                            </div>


                                            <?php if(!empty($data->tweetImage)) :?>
                                            <div class="noti-footer-inner-right">
                                                <img src="<?php echo BASE_URL.$data->tweetImage;?>" />
                                            </div>
                                            <?php endif;?>

                                        </div>
                                        <!--END NOTIFICATION-inner-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--NOTIFICATION WRAPPER END-->
                        <!-- Retweet Notification -->
                        <?php endif;?>

                        <?php if($data->type == 'mention') :?>
                        <?php 
			$tweet = $data;
			$likes        = $getFromT->likes($user_id, $tweet->tweetID);
			$retweet      = $getFromT->checkRetweet($tweet->tweetID, $user_id);
    			echo '<div class="all-tweet-inner">
					<div class="t-show-wrap">	
					 <div class="t-show-inner"> 
							<div class="t-show-popup" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'">
								<div class="t-show-head">
									<div class="t-show-img">
										<img src="'.BASE_URL.$tweet->profileImage.'"/>
									</div>
									<div class="t-s-head-co	ntent">
										<div class="t-h-c-name">
											<span><a href="'.BASE_URL.'profile_page.php?username='.$user->username.'">'.$tweet->screenName.'</a></span>
											<span>Mentioned you - </span>
											<span>'.$getFromT->timeAgo($tweet->postedOn).'</span>
										</div>
										<div class="t-h-c-dis">
											'.$getFromT->getPostLinks($tweet->status).'
										</div>
									</div>
								</div>'.

						 ((!empty($tweet->tweetImage)) ?  
					       '<div class="t-show-body">
								  <div class="t-s-b-inner">
									   <div class="t-s-b-inner-in">
									     <img src="'.BASE_URL.$tweet->tweetImage.'" class="imagePopup" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"/>
									   </div>
								  </div>	
							   </div>' : '' ) .'
						
				       </div>
						<div class="t-show-footer">
							<div class="t-s-f-right">
								<ul> 
									<li><button><i class="fa fa-share" aria-hidden="true"></i></button></li>	
									<li>'.(((isset($retweet['retweetID'])) ? $tweet->tweetID === $retweet['retweetID'] OR $user_id === $retweet['retweetBy'] : '') ? '<button class="retweeted" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-retweet" aria-hidden="true"></i><span class="retweetsCount">'.(($tweet->retweetCount > 0) ? $tweet->retweetCount : '').'</span></button>' : '<button class="retweet" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-retweet" aria-hidden="true"></i><span class="retweetsCount">'.(($tweet->retweetCount > 0) ? $tweet->retweetCount : '').'</span></button>').'</li>
									<li>'.(((isset($likes['likeOn'])) ?$likes['likeOn'] == $tweet->tweetID : '') ? '<button class="unlike-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-heart" aria-hidden="true"></i><span class="likesCounter">'.(($tweet->likesCount > 0) ? $tweet->likesCount : '').'</span></button>' : '<button class="like-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-heart-o" aria-hidden="true"></i><span class="likesCounter">'.(($tweet->likesCount > 0) ? $tweet->likesCount : '').'</span></button>').'</li>
									'.(($tweet->tweetBy === $user_id) ? ' 
									<li>
										<a href="#" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
										<ul> 
										  <li><label class="deleteTweet" data-tweet="'.$tweet->tweetID.'">Delete Tweet</label></li>
										</ul>
									</li>' : '').'
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>';		 
			?>
                        <?php endif;?>
                        <?php endforeach;?>
                    </div>
                    <!--NOTIFICATION WRAPPER FULL WRAPPER END-->

                    <div class="loading-div">
                        <img id="loader" src="<?php echo BASE_URL;?>assets/images/loading.svg" style="display: none;" />
                    </div>
                    <div class="popupTweet"></div>
                    <!--Tweet END WRAPER-->
                    
                </div><!-- in left wrap-->
<!--            </div> in center end -->
<!--        </div>-->
<?php
  require 'components/footer.php';
  require 'template/footer.php';
 ?>
        

</body>

</html>
