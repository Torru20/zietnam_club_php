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


    // Tạo bảng comments--------------------------------
    $sql = "INSERT INTO `admin` (`adminID`, `adminName`, `password`) VALUES
        (1, 'admin', 'e10adc3949ba59abbe56e057f20f883e');";
    
    if (mysqli_query($conn, $sql)) {
        echo "Admin added successfully.";
    } else {
        echo "Error inserting admin: " . mysqli_error($conn);
    }

    mysqli_close($conn);

    ?>