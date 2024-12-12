<?php 

    include '../init.php';
    var_dump($_POST);
    if (isset($_POST['rent_id'])) {
        $rent_id = $_POST['rent_id'];
    
        // Connect to the database
        // ...
    
        // Prepare and execute the DELETE query
        $sql = "DELETE FROM rents WHERE houseID = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$rent_id]);
    
        // Check if the query was successful
        if ($stmt->rowCount() > 0) {
            echo "Post deleted successfully";
        } else {
            echo "Error deleting post";
        }
    } else {
        echo "Invalid request";
    }
     

    
?>

<?php
/*
    $id = $_GET['id'];

   // Xóa dữ liệu
    try {
        $pdo = new PDO($dsn, $user, $password);
    
        // Prepare and execute a query
        $sql = "DELETE FROM rents WHERE houseID = $id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
    
        // Check if the query was successful
        if ($stmt->rowCount() > 0) {
            echo "Post deleted successfully";
        } else {
            echo "Error deleting post";
        }
    } catch (PDOException $e) {
        echo "Connection error: " . $e->getMessage();
    }
*/
?>