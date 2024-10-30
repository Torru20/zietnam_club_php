<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require "../template/head.php";
    ?>
    <link rel="stylesheet" href="../css/chatchit.css">
  

</head>

<body>
  
    <?php
        require "../components/nav_bar.php";
    ?>

    <div class="container">
        <div class="chat-window">
            <div class="chat-header">
                <div class="row">
                    <div class="col-md-2">
                        <?php include "../components/chat_user_list.php"; ?>
                    </div>
                    <div class="col-md-10">
                        <h2>Tên cuộc trò chuyện</h2>
                        <p>Mô tả ngắn về cuộc trò chuyện</p>
                    </div>
                </div> 
            </div>
            
            <div class="chat-messages">

                <div class="row">
                    <div class="col-md-6">
                    <div class="message message-user1">
                        <p>Đây là lời nói của người 1</p>
                    </div>
                    </div>
                    <div class="col-md-6 offset-md-6">
                    <div class="message message-user2">
                        <p>Đây là lời nói của người 2</p>
                    </div>
                    </div>
                </div>


            </div>
            <div class="chat-input">
                <form>
                    <input type="text" class="form-control" placeholder="Type your message...">
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>   
            </div>
        </div>   
    </div>
  
  
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>