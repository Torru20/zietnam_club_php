const productImage = document.getElementById('productImage');
const colorOptions = document.querySelectorAll('.color-option');

colorOptions.forEach(option => {
  option.addEventListener('click', () => {
    const color = option.dataset.color;
    if(color==='red'){
        productImage.src = `../images/caphe1.jpg`; // Đổi tên file ảnh theo màu

    }
    if(color==='blue'){
        productImage.src = `../images/caphe2.jpg`; // Đổi tên file ảnh theo màu

    }
    if(color==='green'){
        productImage.src = `../images/caphe3.jpg`; // Đổi tên file ảnh theo màu

    }
    if(color==='pink'){
        productImage.src = `../images/caphe4.jpg`; // Đổi tên file ảnh theo màu

    }
  });
});