<?php
include '../core/init.php';

if ( $getFromA->loggedIn() === false ) {
    header( 'Location: '.BASE_URL.'index.php' );
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User management</title>
    
    <link rel="stylesheet" href="../css/table-style.css">
    <link rel='stylesheet' href='<?php echo BASE_URL; ?>../assets/css/style-complete.css' />
    <?php
      require "../template/a_head.php";
    ?>
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

