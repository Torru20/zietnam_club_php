<?php
include '../core/init.php';

if ( $getFromA->loggedIn() === false ) {
    header( 'Location: '.BASE_URL.'index.php' );
}

if ( isset( $_POST['post-rent'] ) ) {
    $description = $getFromU->checkinput( $_POST['description'] );
    $price = $getFromU->checkinput( $_POST['price'] );
    $status='waiting';

    if ( !empty( $description ) or !empty( $price ) or !empty( $_FILES['file']['name'][0] ) ) {
        if ( !empty( $_FILES['file']['name'][0] ) ) {
            $postImage = $getFromU->uploadImage( $_FILES['file'] );
        }

        if ( strlen( $description ) > 2000 ) {
            $error = 'The text of your post is too long';
        }
        $post_id = $getFromU->create( 'rents', array( 'description' => $description, 'houseOf' => $user_id, 'postImage' => $postImage, 'postedOn' => date( 'Y-m-d H:i:s' ) ,'price' => $price,'status' => $status) );
        
        header( 'Location: a_home.php' );
    } else {
        $error = 'Type description, set price or choose image to post';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>My forum</title>
    
    <link rel="stylesheet" href="../css/table-style.css">
    
    <?php
      require "../template/a_head.php";
    ?>
</head>
<body>
    <?php
        require "../components/a_navbar.php";
    ?>
    <h1>
        Admin management rent posted
    </h1>
    

    <?php
        $getFromR->rentsAdmin();
    ?>


    <script src="../js/header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/delete-rentpost.js'></script>
   
    <?php
        require "../components/a_footer.php";
    ?>
    <script src="../js/dark-mode.js"></script>
            
    </body>
</html>