<?php

class Post extends User{
	protected $message;

 	public function __construct($pdo){
		$this->pdo = $pdo;
		$this->message  = new Message($this->pdo);
	}
 
	public function posts($user_id, $num){
	    $stmt = $this->pdo->prepare("SELECT * FROM `posts` LEFT JOIN `users` ON `postBy` = `user_id` WHERE `postBy` = :user_id AND `repostID` = '0' OR `postBy` = `user_id` AND `repostBy` != :user_id AND `postBy` IN (SELECT `receiver` FROM `follow` WHERE `sender` =:user_id) ORDER BY `postID` DESC LIMIT :num");
	    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
	    $stmt->bindParam(":num", $num, PDO::PARAM_INT);
	    $stmt->execute();
	    $posts = $stmt->fetchAll(PDO::FETCH_OBJ);

	    foreach ($posts as $post) {
	      $likes = $this->likes($user_id, $post->postID);
	      $repost = $this->checkRepost($post->postID, $user_id);
	      $user = $this->userData($post->repostBy);
 	      echo '<div class="all-tweet">
			      	<div class="t-show-wrap" style="cursor: pointer;">
			       	<div class="t-show-inner">
			       '.((isset($repost['repostID']) ? $repost['repostID'] === $post->repostID OR $post->repostID > 0 : '') ? '
			      	<div class="t-show-banner">
			      		<div class="t-show-banner-inner">
			      			<span><i class="fa fa-retweet" aria-hidden="true"></i></span><span>'.$user->screenName.' Reposted</span>
			      		</div>
			      	</div>'
			        : '').'

			        '.((!empty($post->repostMsg) && $post->postID === $repost['postID'] or $post->repostID > 0) ? '<div class="t-show-head">
			        <div class="t-show-popup" data-tweet="'.$post->postID.'">
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
			        			'.$this->getPostLinks($post->repostMsg).'
			        		</div>
			        	</div>
			        </div>
			        <div class="t-s-b-inner">
			        	<div class="t-s-b-inner-in">
			        		<div class="retweet-t-s-b-inner">
			            '.((!empty($post->postImage)) ? '
			        			<div class="retweet-t-s-b-inner-left">
			        				<img src="'.BASE_URL.$post->postImage.'" class="imagePopup" data-tweet="'.$post->postID.'"/>
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

			      	<div class="t-show-popup" data-tweet="'.$post->postID.'">
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
			          ((!empty($post->postImage)) ?
			      		 '<!--tweet show head end-->
			            		<div class="t-show-body">
			            		  <div class="t-s-b-inner">
			            		   <div class="t-s-b-inner-in">
			            		     <img src="'.$post->postImage.'" class="imagePopup" data-tweet="'.$post->postID.'"/>
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
			      				<li>'.((isset($repost['repostID']) ? $post->postID === $repost['repostID'] : '') ? 
			      					'<button class="retweeted" data-tweet="'.$post->postID.'" data-user="'.$post->postBy.'" style="outline:none;"><i class="fa fa-retweet" aria-hidden="true" style="outline:none;"></i><span class="retweetsCount">'.(($post->repostCount > 0) ? $post->repostCount : '').'</span></button>' : 
			      					'<button class="retweet" data-tweet="'.$post->postID.'" data-user="'.$post->postBy.'" style="outline:none;"><i class="fa fa-retweet" aria-hidden="true"></i><span class="retweetsCount">'.(($post->repostCount > 0) ? $post->repostCount : '').'</span></button>').'
			      				</li>

			      				<li>'.((isset($likes['likeOn']) ? $likes['likeOn'] === $post->postID : '') ? 
			      					'<button class="unlike-btn" data-tweet="'.$post->postID.'" data-user="'.$post->postBy.'" style="outline:none;"><i class="fa fa-heart" aria-hidden="true"></i><span class="likesCounter">'.(($post->likesCount > 0) ? $post->likesCount : '' ).'</span></button>' : 
			      					'<button class="like-btn" data-tweet="'.$post->postID.'" data-user="'.$post->postBy.'" style="outline:none;"><i class="fa fa-heart-o" aria-hidden="true"></i><span class="likesCounter">'.(($post->likesCount > 0) ? $post->likesCount : '' ).'</span></button>').'
			      				</li>
			               
			                '.(($post->postBy === $user_id) ? '
			              	    <li>
			      					<a href="#" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true" style="outline:none;"></i></a>
			      					<ul>
			      					  <li><label class="deleteTweet" data-tweet="'.$post->postID.'">Delete Tweet</label></li>
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
  
	public function getUserPosts($user_id){
		//$stmt = $this->pdo->prepare("SELECT * FROM `posts` LEFT JOIN `users` ON `postBy` = `user_id` WHERE `postBy` = :user_id AND `repostID` = '0' OR `repostBy` = :user_id ORDER BY `postID` DESC");
		$stmt = $this->pdo->prepare("SELECT * FROM `posts` LEFT JOIN `users` ON `postBy` = `user_id` WHERE `postBy` = :user_id OR `repostBy` = :user_id ORDER BY `postID` DESC");

		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->execute();
		//return $stmt->fetchAll(PDO::FETCH_OBJ);
		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

	    foreach ($posts as $post) {
	      $likes = $this->likes($user_id, $post->postID);
	      $repost = $this->checkRepost($post->postID, $user_id);
	      $user = $this->userData($post->repostBy);
 	      echo '<div class="all-tweet">
			      	<div class="t-show-wrap" style="cursor: pointer;">
			       	<div class="t-show-inner">
			       '.((isset($repost['repostID']) ? $repost['repostID'] === $post->repostID OR $post->repostID > 0 : '') ? '
			      	<div class="t-show-banner">
			      		<div class="t-show-banner-inner">
			      			<span><i class="fa fa-retweet" aria-hidden="true"></i></span><span>'.$user->screenName.' Reposted</span>
			      		</div>
			      	</div>'
			        : '').'

			        '.((!empty($post->repostMsg) &&  $post->repostID > 0) ? '<div class="t-show-head">
			        <div class="t-show-popup" data-tweet="'.$post->postID.'">
			          <div class="t-show-img">
			        		<img src="'.BASE_URL.$user->profileImage.'"/>
			        	</div>
			        	<div class="t-s-head-content">
			        		<div class="t-h-c-name">
			        			<span><a href="'.BASE_URL.'profile_page.php?username='.$post->username.'"</a></span>
			        			<span>@'.$user->username.'</span>
			        			<span>'.$this->timeAgo($post->postedOn).'</span>

			        		</div>
			        		<div class="t-h-c-dis">
			        			'.$this->getPostLinks($post->repostMsg).'
			        		</div>
			        	</div>
			        </div>
			        <div class="t-s-b-inner">
			        	<div class="t-s-b-inner-in">
			        		<div class="retweet-t-s-b-inner">
			            '.((!empty($post->postImage)) ? '
			        			<div class="retweet-t-s-b-inner-left">
			        				<img src="'.BASE_URL.$post->postImage.'" class="imagePopup" data-tweet="'.$post->postID.'"/>
			        			</div>' : '').'
			        			<div>
			        				<div class="t-h-c-name">
			        					<span><a href="'.BASE_URL.$post->username.'">'.$post->screenName.'</a></span>
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

			      	<div class="t-show-popup" data-tweet="'.$post->postID.'">
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
			          ((!empty($post->postImage)) ?
			      		 '<!--tweet show head end-->
			            		<div class="t-show-body">
			            		  <div class="t-s-b-inner">
			            		   <div class="t-s-b-inner-in">
			            		     <img src="'.$post->postImage.'" class="imagePopup" data-tweet="'.$post->postID.'"/>
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
			      				<li>'.((isset($repost['repostID']) ? $post->postID === $repost['repostID'] : '') ? 
			      					'<button class="retweeted" data-tweet="'.$post->postID.'" data-user="'.$post->postBy.'" style="outline:none;"><i class="fa fa-retweet" aria-hidden="true" style="outline:none;"></i><span class="retweetsCount">'.(($post->repostCount > 0) ? $post->repostCount : '').'</span></button>' : 
			      					'<button class="retweet" data-tweet="'.$post->postID.'" data-user="'.$post->postBy.'" style="outline:none;"><i class="fa fa-retweet" aria-hidden="true"></i><span class="retweetsCount">'.(($post->repostCount > 0) ? $post->repostCount : '').'</span></button>').'
			      				</li>

			      				<li>'.((isset($likes['likeOn']) ? $likes['likeOn'] === $post->postID : '') ? 
			      					'<button class="unlike-btn" data-tweet="'.$post->postID.'" data-user="'.$post->postBy.'" style="outline:none;"><i class="fa fa-heart" aria-hidden="true"></i><span class="likesCounter">'.(($post->likesCount > 0) ? $post->likesCount : '' ).'</span></button>' : 
			      					'<button class="like-btn" data-tweet="'.$post->postID.'" data-user="'.$post->postBy.'" style="outline:none;"><i class="fa fa-heart-o" aria-hidden="true"></i><span class="likesCounter">'.(($post->likesCount > 0) ? $post->likesCount : '' ).'</span></button>').'
			      				</li>
			               
			                '.(($post->postBy === $user_id) ? '
			              	    <li>
			      					<a href="#" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true" style="outline:none;"></i></a>
			      					<ul>
			      					  <li><label class="deleteTweet" data-tweet="'.$post->postID.'">Delete Tweet</label></li>
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

	public function addLike($user_id, $post_id, $get_id){
		$stmt = $this->pdo->prepare("UPDATE `posts` SET `likesCount` = `likesCount`+1 WHERE `postID` = :post_id");
		$stmt->bindParam(":post_id", $post_id, PDO::PARAM_INT);
		$stmt->execute();

		$this->create('likes', array('likeBy' => $user_id, 'likeOn' => $post_id));
	
		if($get_id != $user_id){
			$this->message->sendNotification($get_id, $user_id, $post_id, 'like');
		}
	}

	public function unLike($user_id, $post_id, $get_id){
		$stmt = $this->pdo->prepare("UPDATE `posts` SET `likesCount` = `likesCount`-1 WHERE `postID` = :post_id");
		$stmt->bindParam(":post_id", $post_id, PDO::PARAM_INT);
		$stmt->execute();

		$stmt = $this->pdo->prepare("DELETE FROM `likes` WHERE `likeBy` = :user_id and `likeOn` = :post_id");
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->bindParam(":post_id", $post_id, PDO::PARAM_INT);
		$stmt->execute(); 
	}

	public function likes($user_id, $post_id){
		$stmt = $this->pdo->prepare("SELECT * FROM `likes` WHERE `likeBy` = :user_id AND `likeOn` = :post_id");
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->bindParam(":post_id", $post_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function getMension($mension){
		$stmt = $this->pdo->prepare("SELECT `user_id`,`username`,`screenName`,`profileImage` FROM `users` WHERE `username` LIKE :mension OR `screenName` LIKE :mension LIMIT 5");
		$stmt->bindValue("mension", $mension.'%');
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function addMention($status,$user_id, $post_id){
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
				$this->message->sendNotification($data->user_id, $user_id, $post_id, 'mention');
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

	public function getPopupPost($post_id){
		$stmt = $this->pdo->prepare("SELECT * FROM `posts`,`users` WHERE `postID` = :post_id AND `postBy` = `user_id`");
		$stmt->bindParam(":post_id", $post_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_OBJ);
	}

	public function repost($post_id, $user_id, $get_id, $comment){
		$stmt = $this->pdo->prepare("UPDATE `posts` SET `repostCount` = `repostCount`+1 WHERE `postID` = :post_id AND `postBy` = :get_id");
		$stmt->bindParam(":post_id", $post_id, PDO::PARAM_INT);
		$stmt->bindParam(":get_id", $get_id, PDO::PARAM_INT);
		$stmt->execute();

		$stmt = $this->pdo->prepare("INSERT INTO `posts` (`status`,`postBy`,`repostID`,`repostBy`,`postImage`,`postedOn`,`likesCount`,`repostCount`,`repostMsg`) SELECT `status`,`postBy`,`postID`,:user_id,`postImage`,`postedOn`,`likesCount`,`repostCount`,:repostMsg FROM `posts` WHERE `postID` = :post_id");
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->bindParam(":repostMsg", $comment, PDO::PARAM_STR);
		$stmt->bindParam(":post_id", $post_id, PDO::PARAM_INT);
		$stmt->execute();

		$this->message->sendNotification($get_id, $user_id, $post_id, 'repost');

 	}

	public function checkRepost($post_id, $user_id){
		$stmt = $this->pdo->prepare("SELECT * FROM `posts` WHERE `repostID` = :post_id AND `repostBy` = :user_id or `postID` = :post_id and `repostBy` = :user_id");
		$stmt->bindParam(":post_id", $post_id, PDO::PARAM_INT);
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function tweetPopup($post_id){
		$stmt = $this->pdo->prepare("SELECT * FROM `posts`,`users` WHERE `postID` = :post_id and `user_id` = `postBy`");
		$stmt->bindParam(":post_id", $post_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_OBJ);
	}

	public function comments($post_id){
		$stmt = $this->pdo->prepare("SELECT * FROM `comments` LEFT JOIN `users` ON `commentBy` = `user_id` WHERE `commentOn` = :post_id");
		$stmt->bindParam(":post_id", $post_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function countTweets($user_id){
		$stmt = $this->pdo->prepare("SELECT COUNT(`postID`) AS `totalPosts` FROM `posts` WHERE `postBy` = :user_id AND `repostID` = '0' OR `repostBy` = :user_id");
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->execute();
		$count = $stmt->fetch(PDO::FETCH_OBJ);
		echo $count->totalPosts;
	}

	public function countLikes($user_id){
		$stmt = $this->pdo->prepare("SELECT COUNT(`likeID`) AS `totalLikes` FROM `likes` WHERE `likeBy` = :user_id");
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->execute();
		$count = $stmt->fetch(PDO::FETCH_OBJ);
		echo $count->totalLikes;
	} 

	public function trends(){
		$stmt = $this->pdo->prepare("SELECT *, COUNT(`postID`) AS `postsCount` FROM `trends` INNER JOIN `posts` ON `status` LIKE CONCAT('%#',`hashtag`,'%') OR `repostMsg` LIKE CONCAT('%#',`hashtag`,'%') GROUP BY `hashtag` ORDER BY `postID` LIMIT 2");
		$stmt->execute();	
		$trends = $stmt->fetchAll(PDO::FETCH_OBJ);
		echo '<div class="trends_container"><div class="trends_box"><div class="trends_header"><p>Trends for you</p></div><!-- trend title end-->';
		foreach ($trends as $trend) {
			echo '<div class="trends_body">
					<div class="trend">
                    <span>Trending</span>
						<p>
							<a style="color: #000;">#'.$trend->hashtag.'</a>
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
                </div></div></div>';		
	} 

	
}
?>
