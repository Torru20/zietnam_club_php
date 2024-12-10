<?php
	include '../core/init.php';
	if($getFromA->loggedIn() === true){
		header('Location: a_homepage.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require "../template/head.php";
    ?>
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
        .form-body{
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 90vh;
        }
        .container {
            background-color: var(--tertiary-color);
            border-radius: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
            position: relative;
            overflow: hidden;
            width: 768px;
            max-width: 100%;
            min-height: 480px;
        }
        .container p {
            font-size: 14px ;
            line-height: 20px;
            letter-spacing: 0.3px;
            margin: 20px 0;
            
        }
        .container span {
            font-size: 12px;
            font-family: "Work Sans", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
        }
        .container a {
            color: var(--primary-color);
            font-size: 13px;
            text-decoration: none;
            margin: 15px 0 10px;
        }
        .container button{
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
        .container form{
            background-color: var(--tertiary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            height: 100%;
        }
        .container form h1{
            font-family: "Playwrite VN", system-ui;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
            font-size: 30px;
            color: var(--inverseprimary-color);
        }
        .container input{
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
        .container input:focus{
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
        .form-container{
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }
        .sign-in{
            left: 0;
            width: 100%;
        }
    </style>

</head>
<body>
    <div class="form-body">
        <div class="container" id="container">
            
            <div class="form-container sign-in">
            
                <?php
                    include '../includes/a_login.php';
                ?>
            </div>
            
        </div>
    </div>
        


            
            
     <script src="../js/signin.js"></script> 
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>



