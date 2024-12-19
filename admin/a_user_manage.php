<?php
include '../core/init.php';

if ( $getFromA->loggedIn() === false ) {
    header( 'Location: '.BASE_URL.'index.php' );
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>My forum</title>
    <link rel="shortcut icon" type="image/x-icon" href="./assets/images/bird.svg">
    <link rel = 'stylesheet' href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css'/>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Playwrite+CU:wght@100..400&family=Playwrite+VN:wght@100..400&family=Protest+Guerrilla&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8d9bbedb1f.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <link rel="stylesheet" href="css/reset.css">
    <style>
        @import "css/pallete.css";

    </style>
    <link rel="stylesheet" href="../css/nav_bar.css">
    <link rel="stylesheet" href="../css/table-style.css">
    
    <link rel='stylesheet' href='<?php echo BASE_URL; ?>../assets/css/style-complete.css' />
  
    
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">

    <title>ZietNam Club – Your Bridge to Vietnam </title>
    
    <script src="https://code.jquery.com/jquery-latest.js"></script>
    <script src="../js/home.js"></script>
    <script src="https://kit.fontawesome.com/8d9bbedb1f.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        require "../components/a_navbar.php";
    ?>
    <h1>
        Admin management user account
    </h1>
    <div class="container-md">
    
        <div class="container text-center">
        <h1>Find by: </h1>
            <div class="row align-items-start">
                <div class="col">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">ID</span>
                        <input type="text" id="searchByID" class="form-control" placeholder="id number" aria-label="Visitors" aria-describedby="Visitors number">
                    </div>
                </div>
                <div class="col">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">Name</span>
                        <input type="text" id="searchByName" class="form-control" placeholder="user name" aria-label="Bans" aria-describedby="Bans">
                    </div>
                </div>

            </div>
            <div class="row align-items-start">
              <div class="input-group flex-nowrap">
                  <span class="input-group-text" id="addon-wrapping">Email</span>
                  <input type="text" id="searchByEmail" class="form-control" placeholder="user email" aria-label="Bans" aria-describedby="Bans">
              </div>
            </div>
        
            <div class="row align-items-start">
                <div class="col">
                <div class="table-responsive">
                    
                    <?php

                        $getFromA->listUsers();
                    ?>
                    <script>
                    const searchByName = document.getElementById('searchByName');
                    const tableBody = document.querySelector('tbody');

                    searchByName.addEventListener('input', (event) => {
                        const searchTerm = event.target.value.toLowerCase();
                        const rows = tableBody.querySelectorAll('tr');

                        rows.forEach(row => {
                            const nameCell = row.querySelector('td:nth-child(2)'); // Giả sử tên người dùng ở cột thứ 2
                            if (nameCell.textContent.toLowerCase().includes(searchTerm)) {
                                row.style.display = '';
                            } else {
                                row.style.display = 'none';
                            }
                        });
                    });


                    const searchbyEmail = document.getElementById('searchByEmail');
                    searchbyEmail.addEventListener('input', (event) => {
                        const searchTerm = event.target.value.toLowerCase();
                        const rows = tableBody.querySelectorAll('tr');

                        rows.forEach(row => {
                            const nameCell = row.querySelector('td:nth-child(4)'); // Giả sử tên người dùng ở cột thứ 2
                            if (nameCell.textContent.toLowerCase().includes(searchTerm)) {
                                row.style.display = '';
                            } else {
                                row.style.display = 'none';
                            }
                        });
                    });

                    const searchbyID = document.getElementById('searchByID');
                    searchbyID.addEventListener('input', (event) => {
                        const searchTerm = event.target.value.toLowerCase();
                        const rows = tableBody.querySelectorAll('tr');

                        rows.forEach(row => {
                            const nameCell = row.querySelector('th:nth-child(1)'); // Giả sử tên người dùng ở cột thứ 2
                            if (nameCell.textContent.toLowerCase().includes(searchTerm)) {
                                row.style.display = '';
                            } else {
                                row.style.display = 'none';
                            }
                        });
                    });


                    </script>
                </div>
                </div>
            </div>
            
            
        </div>
        
    </div>
    
    <?php
        include "../components/a_footer.php";
    ?>
    <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/delete-resetPass.js'></script>
</body>
</html>

