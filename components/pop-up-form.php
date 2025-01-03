<style>
    #popup {
        background-color: var(--tertiary-color);
        padding: 40px;
        margin-top: 100px;
        width: 60%;
        border-radius: 30px;
        position: fixed;
        z-index: 999;
        box-shadow: 0 5px 15px var(--secondary-color);
        align-items: center;
        justify-content: space-between;
        flex-direction: column;
        height: fit-content;
        overflow-y: auto;
        
    
    }
    #popup h1{
        font-family: "Playwrite VN", system-ui;
        font-optical-sizing: auto;
        font-weight: 400;
        font-style: normal;
        font-size: 20px;
        text-align: center;
        color: var(--inverseprimary-color);
        padding: 10px;
    }
    div .form-floating {
        color: var(--inverseprimary-color);
        margin: 10px;
    }
    .mb-3 input{
        background-color: var(--tertiary-color);
        margin: 8px 0;
        padding: 10px 15px;
        font-size: 20px;
        border-radius: 8px;
        width: 100%;
        outline: none;
        font-family: "Work Sans", sans-serif;
        font-optical-sizing: auto;
        font-weight: 100;
        font-style: bold;
        color:var(--secondary-color);
    }
    .mb-3 input:focus{
        background-color: var(--tertiary-color);
        border: none;
        margin: 8px 0;
        padding: 10px 15px;
        font-size: 20px;
        border-radius: 8px;
        width: 100%;
        outline: none;
        font-family: "Work Sans", sans-serif;
        font-optical-sizing: auto;
        font-weight: 300;
        font-style: normal;
        color:var(--primary-color);
    }
    textarea#floatingTextarea2 {
        color:var(--primary-color);
        background-color: var(--tertiary-color);
    }
    
    .btn-post-form {
        display: flex; /* Sử dụng flexbox để sắp xếp các phần tử theo hàng */
        justify-content: space-between; /* Tạo khoảng cách đều giữa các phần tử */
    }

    .btn-post-form button {
        /* Tùy chỉnh kiểu dáng của nút theo ý muốn */
        padding: 10px 20px;
        background-color: var(--inverseprimary-color);
        color: var(--surface-color);
        border: none;
        border-radius: 5px;
        cursor: pointer;

        font-family: "Work Sans", sans-serif;
        font-size: 17px;
        font-optical-sizing: auto;
        font-weight: 300;
        font-style: normal;
    }

    #btn-cancel {
        background-color: var(--secondary-color);  
    }
    

</style>

<div id="popup" style="display: none;">
    <h1>Say sth to everyone</h1>
    <form method="post" enctype='multipart/form-data'>
        <div class="form-floating">
            <textarea class="form-control" name='status' placeholder="sayyyy" id="floatingTextarea2" style="height: 100px"></textarea>
            <label for="floatingTextarea2">Write everything u want, bae...</label>
        </div>
        <div class='hash-box'>
            <ul>
            </ul>
        </div>

        <div class='tweet_icons-wrapper'>
            <div class='t-fo-left tweet_icons-add'>
                <ul>
                    <input type='file' name='file' id='file' />
                    <li><label for='file'><i class='fa fa-image' aria-hidden='true'></i></label>
                    </li>
                    <span class='tweet-error'><?php if ( isset( $error ) ) {
                        echo $error;
                    } else if ( isset( $imgError ) ) {
                        echo '<br>' . $imgError;
                    }
                    ?></span>
                    <!--<i class="fa fa-image"></i>-->

                </ul>
            </div>
        </div>
        <div class="btn-post-form">
            <button id="btn-cancel">Cancel</button>
            <button type="submit" name="tweet">OK</button>
        </div>
    </form>

   
</div>

<script>
    const btnCancel = document.getElementById('btn-cancel');
    btnCancel.addEventListener('click', () => {
    popup.style.display = 'none';
    });

</script>