<?php
    if(isset($_GET['step']) === true && empty($_GET['step']) === false){
    include '../core/init.php';
    if (isset($_SESSION['user_id']) === false) {
    header('Location: ../index.php');
    }

    $user_id = $_SESSION['user_id'];
    $user = $getFromU->userData($user_id);
    $step = $_GET['step'];

    if(isset($_POST['next'])){
    $username = $getFromU->checkInput($_POST['username']);

    if (!empty($username)) {
    if(strlen($username) > 20){
        $error = "Username must be between in 6-20 characters";
    }else if(!preg_match('/^[a-zA-Z0-9]{6,}$/', $username)){
        $error = 'Username must be longer than 6 alphanumeric characters without any spaces';
    } else if($getFromU->checkUsername($username) === true){
        $error = "Username is already taken!";
    }else{
        $getFromU->update('users', $user_id, array('username' => $username));
        header('Location: signup.php?step=2');
    }
    }else{
    $error = "Please enter your username to choose";
    }
    }
?>
<!doctype html>
<html>
<head>
    <title>Sign Up Step</title>
    <meta charset="UTF-8" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css"/>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <link rel="stylesheet" href="../assets/css/font-awesome.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Playwrite+CU:wght@100..400&family=Playwrite+VN:wght@100..400&family=Protest+Guerrilla&display=swap" rel="stylesheet">

    <style>
        @import "../css/pallete.css";
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body{
            background-color: var(--surface-color) ;
            background: linear-gradient(to right,var(--secondary-color),var(--surface-color));
            
            /*
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
            */
            
        }
        .step-wrapper{
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 90vh;
            width: 50%;
	        margin: 0px auto;
        }
        .step-container {
            background-color: var(--tertiary-color);
            border-radius: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
            position: relative;
            overflow: hidden;
            width: 768px;
            max-width: 100%;
            min-height: 480px;
        }
        .step-container p {
            font-size: 14px ;
            line-height: 20px;
            letter-spacing: 0.3px;
            margin: 20px 0;
            
        }
        .step-container span {
            font-size: 12px;
            font-family: "Work Sans", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
        }
        .step-container a {
            color: var(--primary-color);
            font-size: 13px;
            text-decoration: none;
            margin: 15px 0 10px;
        }
        .step-container button{
            background-color: var(--inverseprimary-color);
            color: var(--tertiary-color);
            font-size: 12px;
            padding: 10px 45px;
            border: 1px solid transparent;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.5 px;
            text-transform: uppercase;
            margin-top: 10px;
            cursor: pointer;
            font-family: "Work Sans", system-ui;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;

        }
        .step-container form{
            background-color: var(--tertiary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            height: 100%;
        }
        .step-container form h1{
            font-family: "Playwrite VN", system-ui;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
            font-size: 30px;
            color: var(--inverseprimary-color);
        }
        .step-container form h4{
            font-family: "Pacifico", system-ui;
            
            color: var(--text);
        }
        .step-container input{
            background-color: var(--tertiary-color);
            border: none;
            margin: 8px 0;
            padding: 10px 15px;
            font-size: 13px;
            border-radius: 8px;
            width: 100%;
            outline: none;
            font-family: "Work Sans", sans-serif;
            font-optical-sizing: auto;
            font-weight: 100;
            font-style: normal;
            color:var(--secondary-color);
        }
        .step-container input:focus{
            background-color: var(--tertiary-color);
            border: none;
            margin: 8px 0;
            padding: 10px 15px;
            font-size: 13px;
            border-radius: 8px;
            width: 100%;
            outline: none;
            font-family: "Work Sans", sans-serif;
            font-optical-sizing: auto;
            font-weight: 300;
            font-style: normal;
            color:#546da3;
            box-shadow: 0 5px 15px var(--secondary-color);
        }
        form{
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
            left: 0;
            width: 100%;
        }
        .step-container ul li{
            list-style-type: none;
            color:var(--inverseprimary-color);
        }
        @import "../css/pallete.css";
        .navbar-brand{
            color: var(--inverseprimary-color);
            font-family: "Playwrite VN", system-ui;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
            font-size: 18px;
        }

        .lets-wrapper{
            width:90%;
            padding: 20px;
        }

        .step-letsgo{
            font-size: 22px;
            font-family: "Playwrite VN", system-ui;
            color: var(--text);
        }

        .step-letsgo h2,.step-letsgo p{
            margin: 10px 0px;
            color: var(--primary-color);
            text-align: right; 

        }
        .backButton{
            text-align: right;
            color:var(--primary-color);
            background-color: var(--tertiary-color);
            text-decoration: none;
            border-radius: 20px;
            
        }
       
        
    </style>
</head>
<!--Helvetica Neue-->
<body>
<div class="wrapper">
<!-- nav wrapper -->


<div class="nav-container">
    <h1 class="navbar-brand">Zietnam Club</h1>
    
</div><!-- nav container ends -->


<!---Inner wrapper-->
<div class="inner-wrapper">
<!-- main container -->
<div class="main-container">
    <!-- step wrapper-->
<?php if ($_GET['step'] == '1') {?>
    <div class="step-wrapper">
        <div class="step-container">
            <form method="post" autocomplete="off">
                <h1>Choose a Username</h1>
                <h4>Don't worry, you can always change it later.</h4>
                
                <input type="text" name="username" placeholder="Username">
                <div>
                    <ul>
                        <li><?php if (isset($error)){echo $error;} ?></li>
                    </ul>
                </div>
                <div>
                    
                    <button type="submit" name="next" value="Next">Next</button>
                </div>
            </form>

        </div>
    </div>
<?php } ?>
<?php if ($_GET['step'] == '2'){?>
<div class='lets-wrapper'>
    <div class='step-letsgo'>
        <h1>We're glad you're here, <?php echo $user->screenName; ?> </h1>
        <p style="font-size:22px;">Zietnam Club is a constantly updating stream of the coolest, most important news, media, sports, TV, conversations and more--all tailored just for you.</p>
        <br>
        <p style="font-size:22px;">
            Tell us about all the stuff you love and we'll help you get set up.
        </p>
        <span>
            <a href='../home.php?user_id=<?php echo $user_id;?>' class='backButton'>Let's go!</a>
        </span>
    </div>
</div>
<?php } ?>

</div><!-- main container end -->

</div><!-- inner wrapper ends-->
</div><!-- ends wrapper -->

</body>
</html>

<?php
}
?>
