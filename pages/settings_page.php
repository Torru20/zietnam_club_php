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
            <input id="box-user-Id" class="form-control" type="text" placeholder="User ID" aria-label="Disabled input example" disabled>
        </div>
    </div>

    <div class="form-floating mb-3">
        <input type="email" class="form-control" id="floatingInputDisabled" placeholder="name@example.com" disabled>
        <label for="floatingInputDisabled">Name</label>
        </div>
            <div class="form-floating mb-3">
            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextareaDisabled" disabled></textarea>
            <label for="floatingTextareaDisabled">Email</label>
        </div>
        <div class="form-floating mb-3">
            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2Disabled" style="height: 100px" disabled>Disabled textarea with some text inside</textarea>
            <label for="floatingTextarea2Disabled">Bio</label>
        </div>
        <div class="form-floating">
            <select class="form-select" id="floatingSelectDisabled" aria-label="Floating label disabled select example" disabled>
                <option selected>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        <label for="floatingSelectDisabled">Works with selects</label>
    </div>

    <div class="setting_btn">
        <a class="btn btn-outline-primary" href="#" role="button">Sign out</a>
        <button class="btn btn-secondary" type="submit">Change Profile</button>
    </div>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>