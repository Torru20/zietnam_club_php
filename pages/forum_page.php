<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require "../template/head.php";
    ?>
    <link rel="stylesheet" href="../css/forum_post.css">
    <link rel="stylesheet" href="../css/header.css">
</head>
<body>
    <?php
        require "../components/nav_bar.php";
    ?>
    <div class="post-body">
        <h1></h1>
        <?php

            include "../components/post.php";

            include "../components/floating-button.php";
        ?>
        

        
        
    </div>
    <script src="../js/header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>