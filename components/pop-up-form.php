<style>
    #popup {
        background-color: var(--tertiary-color);
        padding: 40px;
        margin: 30px;
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
    .post-input {
        height: 200%;
        display: flex;
        flex-direction: column;
        align-items: center;
        column-gap: 10px;
        color: var(--inverseprimary-color);
        width: 300px;
        
    }
    .post-input input{
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
        font-weight: 100;
        font-style: bold;
        color:var(--secondary-color);
    }
    .post-input input:focus{
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
    textarea {
        width: 100%; /* Chiếm toàn bộ chiều rộng của phần tử cha */
        height: 200px;
        padding: 10px;
        margin: 8px 0;
        border: 1px solid var(--secondary-color);
        border-radius: 8px;
        resize: vertical; /* Cho phép người dùng thay đổi kích thước theo chiều dọc */
        font-family: "Work Sans", sans-serif;
        font-size: 17px;
        font-optical-sizing: auto;
        font-weight: 100;
        font-style: normal;
        color:var(--secondary-color);
    }
    textarea:focus{
        width: 100%; /* Chiếm toàn bộ chiều rộng của phần tử cha */
        height: 200px;
        padding: 10px;
        margin: 8px 0;
        border: 1px solid var(--secondary-color);
        border-radius: 8px;
        resize: vertical; /* Cho phép người dùng thay đổi kích thước theo chiều dọc */
        font-family: "Work Sans", sans-serif;
        font-size: 17px;
        font-optical-sizing: auto;
        font-weight: 300;
        font-style: normal;
        color:var(--primary-color);
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
    <form method="post">
        <div class="post-input">
            <input type="text" name = "post-title" placeholder="Topic">
            <textarea id="message" name="message" rows="10" cols="50" placeholder="Write everything u want, bae..."></textarea>
        </div>
        
        <div class="btn-post-form">
            <button id="btn-cancel">Hủy</button>
            <button type="submit">Gửi</button>
        </div>
    </form>
</div>

<script>
    const btnCancel = document.getElementById('btn-cancel');
    btnCancel.addEventListener('click', () => {
    popup.style.display = 'none';
    });

</script>