<style>
    .chat-user-list .btn-primary{
        background-color:var(--primary-color);
        border-color:var(--primary-color);
    }
    .chat-user-list .btn-primary:hover{
        background-color:var(--inverseprimary-color);
        border-color:var(--inverseprimary-color);
    }
    .offcanvas-start {
        margin-top: 55px;
        background-color:var(--surface-color);
    }
    .offcanvas-header h5{
        color:var(--primary-color);
    }
    .offcanvas-body p{
        color:var(--text);
    }
</style>

<?php
    $user_id = $_SESSION['user_id'];
    $messages = $getFromM->recentMessages($user_id);
    $getFromM->messagesViewed($user_id);
    

?>


<div class="chat-user-list">
    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"><i class="fa-solid fa-chevron-left"></i></button>

    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Recent</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <p>Try to share cheap moment with your friend</p>
            <h4>Send message to:</h4>
            <input type="text" placeholder="Search people" class="search-user form-control"/>
            <ul class="search-result down">
                    
            </ul>
            <script type="text/javascript" src="assets/js/search.js"></script>
            
            <div class="list-group">
                <div class="message-body">
					<div class="message-recent">
					<?php foreach($messages as $message) :?>
						<!--Direct Messages-->
						<div class="people-message" data-user="<?php echo $message->user_id;?>">
							<div class="people-inner">
								<div class="people-img">
									<img src="<?php echo BASE_URL.$message->profileImage;?>"/>
								</div>
								<div class="name-right2">
									<span><a href="#"><?php echo $message->screenName;?></a></span><span>@<?php echo $message->username;?></span>
								</div>
								
								<span>
									<?php echo $getFromU->timeAgo($message->messageOn);?>
								</span>
							</div>
						</div>
						<!--Direct Messages-->
					<?php endforeach;?>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>


