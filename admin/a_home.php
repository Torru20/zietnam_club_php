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
            <h3>Report list</h3>
            <div class="row align-items-start">
                <div class="col">
                    <?php
                        require "../components/table.php";
                    ?>
                </div>
            </div>
        </div>
        
    </div>

    <?php
        include "../components/a_footer.php";
    ?>
</body>
</html>

