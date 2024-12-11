<?php

class Rent extends User{

 	public function __construct($pdo){
		$this->pdo = $pdo;
	}
 
	public function rents($user_id, $num){
	    $stmt = $this->pdo->prepare("SELECT * FROM `rents` LEFT JOIN `users` ON `houseOf` = `user_id` WHERE `houseOf` = :user_id");
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->execute();
	    $rents = $stmt->fetchAll(PDO::FETCH_OBJ);
        echo'<div class="row row-cols-1 row-cols-md-3 g-4">';
	    foreach ($rents as $rent) {
	      $user = $this->userData($rent->houseOf);
          echo'
                <div class="col">
                    <div class="card">
                    <img src="'.BASE_URL.$rent->postImage.'" class="card-img-top" alt="...">
                   
                    <div class="card-body">
                        <h5 class="card-title">
                        '.$rent->screenName.'
                        </h5>
                        <p class="card-text">'.$rent->description.'</p>
                        <h3>
                            '.$rent->price.'
                        </h3>
                    </div>
                    <div class="card-footer">
                        <small class="text-body-secondary">'.$this->timeAgo($rent->postedOn).'</small>
                    </div>
                </div>
            </div>
            ';
        }
        echo '</div>';
    }

  
	public function getUserTweets($user_id){
		$stmt = $this->pdo->prepare("SELECT * FROM `tweets` LEFT JOIN `users` ON `tweetBy` = `user_id` WHERE `tweetBy` = :user_id AND `retweetID` = '0' OR `retweetBy` = :user_id ORDER BY `tweetID` DESC");
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
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
	
	public function getTrendByHash($hashtag){
		$stmt = $this->pdo->prepare("SELECT * FROM `trends` WHERE `hashtag` LIKE :hashtag LIMIT 5");
		$stmt->bindValue(":hashtag", $hashtag.'%');
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
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

	public function getTweetLinks($tweet){
		$tweet = preg_replace("/(https?:\/\/)([\w]+.)([\w\.]+)/", "<a href='$0' target='_blink'>$0</a>", $tweet);
        
        //$tweet = preg_replace("/#([\w]+)/", "<a href='http://localhost/twitter/hashtag/$1'>$0</a>", $tweet);		
        
		$tweet = preg_replace("/#([\w]+)/", "<a href='http://localhost/twitter/$1'>$0</a>", $tweet);	
        
		$tweet = preg_replace("/@([\w]+)/", "<a href='http://localhost/twitter/$1'>$0</a>", $tweet);
		return $tweet;		
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

	public function getTweetsByHash($hashtag){
		$stmt = $this->pdo->prepare("SELECT * FROM `tweets` LEFT JOIN `users` ON `tweetBy` = `user_id` WHERE `status` LIKE :hashtag OR `retweetMsg` LIKE :hashtag");
		$stmt->bindValue(":hashtag", '%#'.$hashtag.'%', PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function getUsersByHash($hashtag){
		$stmt = $this->pdo->prepare("SELECT DISTINCT * FROM `tweets` INNER JOIN `users` ON `tweetBy` = `user_id` WHERE `status` LIKE :hashtag OR `retweetMsg` LIKE :hashtag GROUP BY `user_id`");
		$stmt->bindValue(":hashtag", '%#'.$hashtag.'%', PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
}
?>
