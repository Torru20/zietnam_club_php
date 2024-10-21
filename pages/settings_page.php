<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Playwrite+CU:wght@100..400&family=Playwrite+VN:wght@100..400&family=Protest+Guerrilla&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8d9bbedb1f.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/signin.css">
    <link rel="stylesheet" href="../css/settings.css">
    

</head>
<body>
    <?php
      require "../components/nav_bar.php";
    ?>

    <div class="settings_container">
        <div class="settings_images_id">
            <img src="../images/Hinhdaidien.jpg" alt="User Avatar">
            <h4>ID:</h4>
        </div>

       
            <div class="settings_info_user">
                <p>
                    Name:<br>
                    Email:<br>
                    Phone:<br>
                    Address:
                </p>
            </div>
       

     </div>
     <div class="setting_btn">
        <div class="settings_button">
            <a href="login_page.php" class="button">Sign out</a>
         </div>
         <div class="settings_transfer">
            <a href="login_page.php" class="button">Transfer accounts</a>
        </div>
     </div>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>