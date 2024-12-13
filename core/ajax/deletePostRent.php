<?php 

    include '../init.php';
    var_dump($_POST);
    if (isset($_POST['rent_id'])) {
        $rent_id = $_POST['rent_id'];
    //get tweet data from tweet id
        $rent     = $getFromR->rentFindByID($rent_id);
        //create link for tweet image to delete from
        $imageLink = '../../'.$rent->postImage;
        $getFromA->delete('rents', array('houseID' => $rent_id));
    //rentFindByID
        // Prepare and execute the DELETE query
        //$sql = "DELETE FROM rents WHERE houseID = ?";
        //$stmt = $pdo->prepare($sql);
        //$stmt->execute([$rent_id]);
    
        // Check if the query was successful
        /*
        if ($stmt->rowCount() > 0) {
            echo "Post deleted successfully";
        } else {
            echo "Error deleting post";
        }
    } else {
        echo "Invalid request";
    }
     */
        if(!empty($rent->postImage)){
            //delete the file
            unlink($imageLink);
        }
    }
    
?>

<?php
if (isset($_POST['acceptPost'])&&!empty($_POST['acceptPost'])) {
    $rent_id = $_POST['rent_id'];
    $status = 'for-rent';
    $getFromR->update('rents',$rent_id, array('status' => $status));
}
?>