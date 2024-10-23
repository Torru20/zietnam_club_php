<style>
    .chat-user-list .btn-primary{
        background-color:var(--primary-color);
        border-color:var(--primary-color);
    }
    .chat-user-list .btn-primary:hover{
        background-color:var(--inverseprimary-color);
        border-color:var(--inverseprimary-color);
    }
    .offcanvas-start {
        margin-top: 55px;
        background-color:var(--surface-color);
    }
    .offcanvas-header h5{
        color:var(--primary-color);
    }
    .offcanvas-body p{
        color:var(--text);
    }


</style>
<div class="chat-user-list">
    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"><i class="fa-solid fa-chevron-left"></i></button>

    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Chat Chit</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <p>Try to share cheap moment with your friend</p>
            <div class="list-group">
                <?php
                include "../components/chat_user.php";
                ?>
            </div>
        </div>
    </div>
</div>


