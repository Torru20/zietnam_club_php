<?php

class Post extends User{
	protected $message;

 	public function __construct($pdo){
		$this->pdo = $pdo;
		$this->message  = new Message($this->pdo);
	}
 
	public function posts($user_id, $num){
	    $stmt = $this->pdo->prepare("SELECT * FROM `tweets` LEFT JOIN `users` ON `tweetBy` = `user_id` WHERE `tweetBy` = :user_id AND `retweetID` = '0' OR `tweetBy` = `user_id` AND `retweetBy` != :user_id AND `tweetBy` IN (SELECT `receiver` FROM `follow` WHERE `sender` =:user_id) ORDER BY `tweetID` DESC LIMIT :num");
	    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
	    $stmt->bindParam(":num", $num, PDO::PARAM_INT);
	    $stmt->execute();
	    $posts = $stmt->fetchAll(PDO::FETCH_OBJ);

	    foreach ($posts as $post) {
	      $likes = $this->likes($user_id, $post->tweetID);
	      $retweet = $this->checkRetweet($post->tweetID, $user_id);
	      $user = $this->userData($post->retweetBy);
 	      echo '<div class="all-tweet">
			      	<div class="t-show-wrap" style="cursor: pointer;">
			       	<div class="t-show-inner">
			       '.((isset($retweet['retweetID']) ? $retweet['retweetID'] === $post->retweetID OR $post->retweetID > 0 : '') ? '
			      	<div class="t-show-banner">
			      		<div class="t-show-banner-inner">
			      			<span><i class="fa fa-retweet" aria-hidden="true"></i></span><span>'.$user->screenName.' Retweeted</span>
			      		</div>
			      	</div>'
			        : '').'

			        '.((!empty($post->retweetMsg) && $post->tweetID === $retweet['tweetID'] or $post->retweetID > 0) ? '<div class="t-show-head">
			        <div class="t-show-popup" data-tweet="'.$post->tweetID.'">
			          <div class="t-show-img">
			        		<img src="'.BASE_URL.$user->profileImage.'"/>
			        	</div>
			        	<div class="t-s-head-content">
			        		<div class="t-h-c-name">
			        			<span><a href="'.BASE_URL.'profile_page.php?username='.$post->username.'">'.$user->screenName.'</a></span>
			        			<span>@'.$user->username.'</span>
			        			<span>'.$this->timeAgo($post->postedOn).'</span>

			        		</div>
			        		<div class="t-h-c-dis">
			        			'.$this->getPostLinks($post->retweetMsg).'
			        		</div>
			        	</div>
			        </div>
			        <div class="t-s-b-inner">
			        	<div class="t-s-b-inner-in">
			        		<div class="retweet-t-s-b-inner">
			            '.((!empty($post->tweetImage)) ? '
			        			<div class="retweet-t-s-b-inner-left">
			        				<img src="'.BASE_URL.$post->tweetImage.'" class="imagePopup" data-tweet="'.$post->tweetID.'"/>
			        			</div>' : '').'
			        			<div>
			        				<div class="t-h-c-name">
			        					<span><a href="'.BASE_URL.'profile_page.php?username='.$post->username.'">'.$post->screenName.'</a></span>
			        					<span>@'.$post->username.'</span>
			        					<span>'.$this->timeAgo($post->postedOn).'</span>
			        				</div>
			        				<div class="retweet-t-s-b-inner-right-text">
			        					'.$this->getPostLinks($post->status).'
			        				</div>
			        			</div>
			        		</div>
			        	</div>
			        </div>
			        </div>' : '

			      	<div class="t-show-popup" data-tweet="'.$post->tweetID.'">
			      		<div class="t-show-head">
			      			<div class="t-show-img">
			      				<img src="'.$post->profileImage.'"/>
			      			</div>
			      			<div class="t-s-head-content ">
			      				<div class="t-h-c-name media-body">
			      					<span><a href="'.BASE_URL.'profile_page.php?username='.$post->username.'">'.$post->screenName.'</a></span>
			      					<span>@'.$post->username.'</span>
			      					<span>'.$this->timeAgo($post->postedOn).'</span>
			      				</div>
			      				<div class="t-h-c-dis">
			      					'.$this->getPostLinks($post->status).'
			      				</div>
			      			</div>
			      		</div>'.
			          ((!empty($post->tweetImage)) ?
			      		 '<!--tweet show head end-->
			            		<div class="t-show-body">
			            		  <div class="t-s-b-inner">
			            		   <div class="t-s-b-inner-in">
			            		     <img src="'.$post->tweetImage.'" class="imagePopup" data-tweet="'.$post->tweetID.'"/>
			            		   </div>
			            		  </div>
			            		</div>
			            		<!--tweet show body end-->
			          ' : '').'

			      	</div>').'
			      	<div class="t-show-footer">
			      		<div class="t-s-f-right">
			      			<ul>
			      				<li><button style="outline:none;"><i class="fa fa-comment" aria-hidden="true"></i></button></li>
			      				<li>'.((isset($retweet['retweetID']) ? $post->tweetID === $retweet['retweetID'] : '') ? 
			      					'<button class="retweeted" data-tweet="'.$post->tweetID.'" data-user="'.$post->tweetBy.'" style="outline:none;"><i class="fa fa-retweet" aria-hidden="true" style="outline:none;"></i><span class="retweetsCount">'.(($post->retweetCount > 0) ? $post->retweetCount : '').'</span></button>' : 
			      					'<button class="retweet" data-tweet="'.$post->tweetID.'" data-user="'.$post->tweetBy.'" style="outline:none;"><i class="fa fa-retweet" aria-hidden="true"></i><span class="retweetsCount">'.(($post->retweetCount > 0) ? $post->retweetCount : '').'</span></button>').'
			      				</li>

			      				<li>'.((isset($likes['likeOn']) ? $likes['likeOn'] === $post->tweetID : '') ? 
			      					'<button class="unlike-btn" data-tweet="'.$post->tweetID.'" data-user="'.$post->tweetBy.'" style="outline:none;"><i class="fa fa-heart" aria-hidden="true"></i><span class="likesCounter">'.(($post->likesCount > 0) ? $post->likesCount : '' ).'</span></button>' : 
			      					'<button class="like-btn" data-tweet="'.$post->tweetID.'" data-user="'.$post->tweetBy.'" style="outline:none;"><i class="fa fa-heart-o" aria-hidden="true"></i><span class="likesCounter">'.(($post->likesCount > 0) ? $post->likesCount : '' ).'</span></button>').'
			      				</li>
			               
			                '.(($post->tweetBy === $user_id) ? '
			              	    <li>
			      					<a href="#" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true" style="outline:none;"></i></a>
			      					<ul>
			      					  <li><label class="deleteTweet" data-tweet="'.$post->tweetID.'">Delete Tweet</label></li>
			      					</ul>
			      				</li>' : '').'

			      			</ul>
			      		</div>
			      	</div>
			      </div>
			      </div>
			      </div>';
	    }
	}
  
	public function getUserTweets($user_id){
		//$stmt = $this->pdo->prepare("SELECT * FROM `tweets` LEFT JOIN `users` ON `tweetBy` = `user_id` WHERE `tweetBy` = :user_id AND `retweetID` = '0' OR `retweetBy` = :user_id ORDER BY `tweetID` DESC");
		$stmt = $this->pdo->prepare("SELECT * FROM `tweets` LEFT JOIN `users` ON `tweetBy` = `user_id` WHERE `tweetBy` = :user_id OR `retweetBy` = :user_id ORDER BY `tweetID` DESC");

		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->execute();
		//return $stmt->fetchAll(PDO::FETCH_OBJ);
		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

	    foreach ($posts as $post) {
	      $likes = $this->likes($user_id, $post->tweetID);
	      $retweet = $this->checkRetweet($post->tweetID, $user_id);
	      $user = $this->userData($post->retweetBy);
 	      echo '<div class="all-tweet">
			      	<div class="t-show-wrap" style="cursor: pointer;">
			       	<div class="t-show-inner">
			       '.((isset($retweet['retweetID']) ? $retweet['retweetID'] === $post->retweetID OR $post->retweetID > 0 : '') ? '
			      	<div class="t-show-banner">
			      		<div class="t-show-banner-inner">
			      			<span><i class="fa fa-retweet" aria-hidden="true"></i></span><span>'.$user->screenName.' Retweeted</span>
			      		</div>
			      	</div>'
			        : '').'

			        '.((!empty($post->retweetMsg) &&  $post->retweetID > 0) ? '<div class="t-show-head">
			        <div class="t-show-popup" data-tweet="'.$post->tweetID.'">
			          <div class="t-show-img">
			        		<img src="'.BASE_URL.$user->profileImage.'"/>
			        	</div>
			        	<div class="t-s-head-content">
			        		<div class="t-h-c-name">
			        			<span><a href="#"</a></span>
			        			<span>@'.$user->username.'</span>
			        			<span>'.$this->timeAgo($post->postedOn).'</span>

			        		</div>
			        		<div class="t-h-c-dis">
			        			'.$this->getPostLinks($post->retweetMsg).'
			        		</div>
			        	</div>
			        </div>
			        <div class="t-s-b-inner">
			        	<div class="t-s-b-inner-in">
			        		<div class="retweet-t-s-b-inner">
			            '.((!empty($post->tweetImage)) ? '
			        			<div class="retweet-t-s-b-inner-left">
			        				<img src="'.BASE_URL.$post->tweetImage.'" class="imagePopup" data-tweet="'.$post->tweetID.'"/>
			        			</div>' : '').'
			        			<div>
			        				<div class="t-h-c-name">
			        					<span><a href="'.BASE_URL.'profile_page.php?username='.$post->username.'">'.$post->screenName.'</a></span>
			        					<span>@'.$post->username.'</span>
			        					<span>'.$this->timeAgo($post->postedOn).'</span>
			        				</div>
			        				<div class="retweet-t-s-b-inner-right-text">
			        					'.$this->getPostLinks($post->status).'
			        				</div>
			        			</div>
			        		</div>
			        	</div>
			        </div>
			        </div>' : '

			      	<div class="t-show-popup" data-tweet="'.$post->tweetID.'">
			      		<div class="t-show-head">
			      			<div class="t-show-img">
			      				<img src="'.$post->profileImage.'"/>
			      			</div>
			      			<div class="t-s-head-content ">
			      				<div class="t-h-c-name media-body">
			      					<span><a href="'.BASE_URL.'profile_page.php?username='.$post->username.'">'.$post->screenName.'</a></span>
			      					<span>@'.$post->username.'</span>
			      					<span>'.$this->timeAgo($post->postedOn).'</span>
			      				</div>
			      				<div class="t-h-c-dis">
			      					'.$this->getPostLinks($post->status).'
			      				</div>
			      			</div>
			      		</div>'.
			          ((!empty($post->tweetImage)) ?
			      		 '<!--tweet show head end-->
			            		<div class="t-show-body">
			            		  <div class="t-s-b-inner">
			            		   <div class="t-s-b-inner-in">
			            		     <img src="'.$post->tweetImage.'" class="imagePopup" data-tweet="'.$post->tweetID.'"/>
			            		   </div>
			            		  </div>
			            		</div>
			            		<!--tweet show body end-->
			          ' : '').'

			      	</div>').'
			      	<div class="t-show-footer">
			      		<div class="t-s-f-right">
			      			<ul>
			      				<li><button style="outline:none;"><i class="fa fa-comment" aria-hidden="true"></i></button></li>
			      				<li>'.((isset($retweet['retweetID']) ? $post->tweetID === $retweet['retweetID'] : '') ? 
			      					'<button class="retweeted" data-tweet="'.$post->tweetID.'" data-user="'.$post->tweetBy.'" style="outline:none;"><i class="fa fa-retweet" aria-hidden="true" style="outline:none;"></i><span class="retweetsCount">'.(($post->retweetCount > 0) ? $post->retweetCount : '').'</span></button>' : 
			      					'<button class="retweet" data-tweet="'.$post->tweetID.'" data-user="'.$post->tweetBy.'" style="outline:none;"><i class="fa fa-retweet" aria-hidden="true"></i><span class="retweetsCount">'.(($post->retweetCount > 0) ? $post->retweetCount : '').'</span></button>').'
			      				</li>

			      				<li>'.((isset($likes['likeOn']) ? $likes['likeOn'] === $post->tweetID : '') ? 
			      					'<button class="unlike-btn" data-tweet="'.$post->tweetID.'" data-user="'.$post->tweetBy.'" style="outline:none;"><i class="fa fa-heart" aria-hidden="true"></i><span class="likesCounter">'.(($post->likesCount > 0) ? $post->likesCount : '' ).'</span></button>' : 
			      					'<button class="like-btn" data-tweet="'.$post->tweetID.'" data-user="'.$post->tweetBy.'" style="outline:none;"><i class="fa fa-heart-o" aria-hidden="true"></i><span class="likesCounter">'.(($post->likesCount > 0) ? $post->likesCount : '' ).'</span></button>').'
			      				</li>
			               
			                '.(($post->tweetBy === $user_id) ? '
			              	    <li>
			      					<a href="#" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true" style="outline:none;"></i></a>
			      					<ul>
			      					  <li><label class="deleteTweet" data-tweet="'.$post->tweetID.'">Delete Tweet</label></li>
			      					</ul>
			      				</li>' : '').'

			      			</ul>
			      		</div>
			      	</div>
			      </div>
			      </div>
			      </div>';
	    }
	}

	public function addLike($user_id, $tweet_id, $get_id){
		$stmt = $this->pdo->prepare("UPDATE `tweets` SET `likesCount` = `likesCount`+1 WHERE `tweetID` = :tweet_id");
		$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
		$stmt->execute();

		$this->create('likes', array('likeBy' => $user_id, 'likeOn' => $tweet_id));
	
		if($get_id != $user_id){
			$this->message->sendNotification($get_id, $user_id, $tweet_id, 'like');
		}
	}

	public function unLike($user_id, $tweet_id, $get_id){
		$stmt = $this->pdo->prepare("UPDATE `tweets` SET `likesCount` = `likesCount`-1 WHERE `tweetID` = :tweet_id");
		$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
		$stmt->execute();

		$stmt = $this->pdo->prepare("DELETE FROM `likes` WHERE `likeBy` = :user_id and `likeOn` = :tweet_id");
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
		$stmt->execute(); 
	}

	public function likes($user_id, $tweet_id){
		$stmt = $this->pdo->prepare("SELECT * FROM `likes` WHERE `likeBy` = :user_id AND `likeOn` = :tweet_id");
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function getMension($mension){
		$stmt = $this->pdo->prepare("SELECT `user_id`,`username`,`screenName`,`profileImage` FROM `users` WHERE `username` LIKE :mension OR `screenName` LIKE :mension LIMIT 5");
		$stmt->bindValue("mension", $mension.'%');
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
	public function addTrend($hashtag){
		preg_match_all("/#+([a-zA-Z0-9_]+)/i", $hashtag, $matches);
		if($matches){
			$result = array_values($matches[1]);
		}
		$sql = "INSERT INTO `trends` (`hashtag`, `createdOn`) VALUES (:hashtag, CURRENT_TIMESTAMP)";
		foreach ($result as $trend) {
			if($stmt = $this->pdo->prepare($sql)){
				$stmt->execute(array(':hashtag' => $trend));
			}
		}
	}
	public function addMention($status,$user_id, $tweet_id){
		if(preg_match_all("/@+([a-zA-Z0-9_]+)/i", $status, $matches)){
			if($matches){
				$result = array_values($matches[1]);
			}
			$sql = "SELECT * FROM `users` WHERE `username` = :mention";
			foreach ($result as $trend) {
				if($stmt = $this->pdo->prepare($sql)){
					$stmt->execute(array(':mention' => $trend));
					$data = $stmt->fetch(PDO::FETCH_OBJ);
				}
			}

			if($data->user_id != $user_id){
				$this->message->sendNotification($data->user_id, $user_id, $tweet_id, 'mention');
			}
		}
	}

	public function getPostLinks($post){
		$post = preg_replace("/(https?:\/\/)([\w]+.)([\w\.]+)/", "<a href='$0' target='_blink'>$0</a>", $post);
        
        //$post = preg_replace("/#([\w]+)/", "<a href='http://localhost/twitter/hashtag/$1'>$0</a>", $post);		
        //"'.BASE_URL.'profile_page.php?username='.$post->username.'"
		$post = preg_replace("/#([\w]+)/", "<a href='http://localhost/zietnam_club_php/$1'>$0</a>", $post);	
        
		$post = preg_replace("/@([\w]+)/", "<a href='http://localhost/zietnam_club_php/profile_page.php?username=$1'>$0</a>", $post);
		return $post;		
	}

	public function getPopupTweet($tweet_id){
		$stmt = $this->pdo->prepare("SELECT * FROM `tweets`,`users` WHERE `tweetID` = :tweet_id AND `tweetBy` = `user_id`");
		$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_OBJ);
	}

	public function retweet($tweet_id, $user_id, $get_id, $comment){
		$stmt = $this->pdo->prepare("UPDATE `tweets` SET `retweetCount` = `retweetCount`+1 WHERE `tweetID` = :tweet_id AND `tweetBy` = :get_id");
		$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
		$stmt->bindParam(":get_id", $get_id, PDO::PARAM_INT);
		$stmt->execute();

		$stmt = $this->pdo->prepare("INSERT INTO `tweets` (`status`,`tweetBy`,`retweetID`,`retweetBy`,`tweetImage`,`postedOn`,`likesCount`,`retweetCount`,`retweetMsg`) SELECT `status`,`tweetBy`,`tweetID`,:user_id,`tweetImage`,`postedOn`,`likesCount`,`retweetCount`,:retweetMsg FROM `tweets` WHERE `tweetID` = :tweet_id");
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->bindParam(":retweetMsg", $comment, PDO::PARAM_STR);
		$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
		$stmt->execute();

		$this->message->sendNotification($get_id, $user_id, $tweet_id, 'retweet');

 	}

	public function checkRetweet($tweet_id, $user_id){
		$stmt = $this->pdo->prepare("SELECT * FROM `tweets` WHERE `retweetID` = :tweet_id AND `retweetBy` = :user_id or `tweetID` = :tweet_id and `retweetBy` = :user_id");
		$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function tweetPopup($tweet_id){
		$stmt = $this->pdo->prepare("SELECT * FROM `tweets`,`users` WHERE `tweetID` = :tweet_id and `user_id` = `tweetBy`");
		$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_OBJ);
	}

	public function comments($tweet_id){
		$stmt = $this->pdo->prepare("SELECT * FROM `comments` LEFT JOIN `users` ON `commentBy` = `user_id` WHERE `commentOn` = :tweet_id");
		$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function countTweets($user_id){
		$stmt = $this->pdo->prepare("SELECT COUNT(`tweetID`) AS `totalTweets` FROM `tweets` WHERE `tweetBy` = :user_id AND `retweetID` = '0' OR `retweetBy` = :user_id");
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->execute();
		$count = $stmt->fetch(PDO::FETCH_OBJ);
		echo $count->totalTweets;
	}

	public function countLikes($user_id){
		$stmt = $this->pdo->prepare("SELECT COUNT(`likeID`) AS `totalLikes` FROM `likes` WHERE `likeBy` = :user_id");
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->execute();
		$count = $stmt->fetch(PDO::FETCH_OBJ);
		echo $count->totalLikes;
	} 

	public function trends(){
		$stmt = $this->pdo->prepare("SELECT *, COUNT(`tweetID`) AS `tweetsCount` FROM `trends` INNER JOIN `tweets` ON `status` LIKE CONCAT('%#',`hashtag`,'%') OR `retweetMsg` LIKE CONCAT('%#',`hashtag`,'%') GROUP BY `hashtag` ORDER BY `tweetID` LIMIT 2");
		$stmt->execute();	
		$trends = $stmt->fetchAll(PDO::FETCH_OBJ);
		echo '<h1 style="padding-top:30px;"></h1>
		<div class="trends_container"><div class="trends_box"><div class="trends_header"><p>Trends for you</p></div><!-- trend title end-->';
		foreach ($trends as $trend) {
			echo '<div class="trends_body">
					<div class="trend">
                    <span>Trending</span>
						<p>
							<a style="color: var(--text);">#'.$trend->hashtag.'</a>
						</p>
						<div class="trend-tweets">
							
						</div>
					</div>
                </div>
                <div>
				</div>';
		}
		echo '<div class="trends_show-more">
                    <a href="">Show more</a>
                </div></div></div>
				
				';		
	} 

	
}
?>
