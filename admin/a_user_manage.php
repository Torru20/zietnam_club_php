<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include "../template/head.php";  
    ?>
    <style>
        .align-items-start{
            padding-bottom: 50px;
        }
        #addon-wrapping{
        color: var(--text);
        background-color: var(--secondary-color);
        }
        .form-control:disabled{
            color: var(--text);
            background-color: var(--surface-color);
        }
        .form-control::placeholder{
            color: var(--text);
        }
        h3{
          padding-top:50px;
        }
        
    </style>
</head>
<body>
    <?php
        require "../components/a_navbar.php";
    ?>
    <div class="container-md">
    
        <div class="container text-center">
        <h3>User list</h3>

            <div class="row align-items-start">
                <div class="col">
                <div class="table-responsive">
                    <table class="table table-hover my-table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody" class="table-group-divider">
                            <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            </tr>
                            <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                            </tr>
                        </tbody>
                    </table>
                    <input type="text" id="searchInput" placeholder="Nhập từ khóa tìm kiếm">
                    <script>
                    const searchInput = document.getElementById('searchInput');
const tableBody = document.querySelector('tbody');

searchInput.addEventListener('input', (event) => {
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
                    </script>
                </div>
                </div>
            </div>
            <div class="row align-items-start">
                <div class="col">
                    <h5>find by</h5>
                </div>
            </div>

            <div class="row align-items-start">
                <div class="col">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">ID</span>
                        <input type="text" class="form-control" placeholder="id number" aria-label="Visitors" aria-describedby="Visitors number">
                    </div>
                </div>
                <div class="col">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">Name</span>
                        <input type="text" class="form-control" placeholder="user name" aria-label="Bans" aria-describedby="Bans">
                    </div>
                </div>

            </div>

            <div class="row align-items-start">

              <div class="input-group flex-nowrap">
                  <span class="input-group-text" id="addon-wrapping">Email</span>
                  <input type="text" class="form-control" placeholder="user email" aria-label="Bans" aria-describedby="Bans">
              </div>

              

            </div>
            <button type="button" class="btn btn-primary">Search</button>
            
        </div>
        
    </div>
    
    <?php
        include "../components/a_footer.php";
    ?>
</body>
</html>

