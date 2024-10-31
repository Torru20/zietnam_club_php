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
        .my-table {
            color: var(--text);
            background-color: var(--surface-color);
        }

        .my-table th {
            background-color: var(--secondary-color);
        }
        .my-table th {
            background-color: var(--secondary-color);
        }
        .table{
            --bs-table-bg: var(--surface-color);
            --bs-table-hover-color: var(--text);
        }
        .table>:not(caption)>*>* {
            padding: .5rem .5rem;
            color: var(--bs-table-color-state, var(--bs-table-color-type, var(--text)));
        }
    </style>
</head>
<body>
    <?php
        require "../components/a_navbar.php";
    ?>
    <div class="container-md">
        <div class="container text-center">
            <div class="row align-items-start">
                <div class="col">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">Visitor</span>
                        <input type="text" class="form-control" placeholder="0" aria-label="Visitors" aria-describedby="Visitors number" disabled>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">Ban</span>
                        <input type="text" class="form-control" placeholder="0" aria-label="Bans" aria-describedby="Bans" disabled>
                    </div>
                </div>
            </div>

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
                            <tbody class="table-group-divider">
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
                                <tr>
                                <th scope="row">3</th>
                                <td colspan="2">Larry the Bird</td>
                                <td>@twitter</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <?php
        include "../components/a_footer.php";
    ?>
</body>
</html>

