const header = document.querySelector('.header-main');
const headerHeight = header.offsetHeight;

window.addEventListener('scroll', () => {
    if (window.scrollY > headerHeight) {
        header.classList.add('fixed');   

    } else {
        header.classList.remove('fixed');   

    }
});