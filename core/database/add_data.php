
<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tweety";

    // Tạo kết nối
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }
        echo "Connected successfully"; 

/*
    // Tạo bảng comments--------------------------------
    $sql = "INSERT INTO `admin` (`adminID`, `adminName`, `password`) VALUES
        (1, 'admin', 'e10adc3949ba59abbe56e057f20f883e');";
        */

    $sql = "INSERT INTO `rents` (`houseID`, `description`, `houseOf`,`postImage`,`postedOn`,`price`,`status`) VALUES
        (2,'homestay cho khach nuoc ngoai thue gia hop ly gan trung tam Q1', 8,'users/avtar2.jpg','2024-10-28 09:47:45',3000000,'waiting');";
    
    if (mysqli_query($conn, $sql)) {
        echo "Admin added successfully.";
    } else {
        echo "Error inserting admin: " . mysqli_error($conn);
    }
        

    

    mysqli_close($conn);

    ?>
