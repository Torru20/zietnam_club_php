<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nón lá</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/shop.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Playwrite+CU:wght@100..400&family=Playwrite+VN:wght@100..400&family=Protest+Guerrilla&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8d9bbedb1f.js" crossorigin="anonymous"></script>

</head>
<body>
    <?php
        include "../components/header.php";
    ?>
    <div class="shop-container">
        <div class="shop-image-container">
            <img src="../images/caphe1.jpg" alt="Sản phẩm" id="productImage">
        </div>
        <br>
        <div class="product-color-options">
            <div class="product-options-box">
                <button class="color-option" data-color="red" style="background-color: red;"></button>
                <h5>ca phe truyen thong</h5>
            </div>
            <div class="product-options-box">
                <button class="color-option" data-color="blue" style="background-color: blue;"></button>
                <h5>ca phe phong cach</h5>
            </div>
            <div class="product-options-box">
                <button class="color-option" data-color="green" style="background-color: green;"></button>
                <h5>ca phe hop thiec phong cach</h5>
            </div>
            <div class="product-options-box">
                <button class="color-option" data-color="pink" style="background-color: pink;"></button>
                <h5>ca phe cold brew</h5>
            </div>
            
        </div>
    </div>
    <script src="../js/shop.js"></script>
</body>
</html>