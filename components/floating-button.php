<style>
    @import "../css/pallete.css";
    .floating-button {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: var(--primary-color);
        color: white;
        border-radius: 50%; /* Ensures a perfect circle */
        padding: 20px;
        box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.3);
        width: 60px; /* Adjust the width and height for desired size */
        height: 60px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 24px;
    }
    .floating-button:hover {
        background-color: var(--inverseprimary-color);
        box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.5);
    }
    

</style>
<button id="btn-popup" class="floating-button">
    <i class="fas fa-plus"></i>
</button>
<?php
    include "../components/pop-up-form.php";
?>
<script>
    const btnPopup = document.getElementById('btn-popup');
    const popup = document.getElementById('popup');

    btnPopup.addEventListener('click', () => {
    popup.style.display = 'block';
    });

</script>


