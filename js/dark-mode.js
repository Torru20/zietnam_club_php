//ktra xem có dảk mode chua

if (localStorage.getItem('darkMode') === 'true') {
    document.body.classList.add('dark-theme');
}

//button change mode
var changemode =document.getElementById("change-mode");


changemode.onclick=function(){
    
    document.body.classList.toggle("dark-theme");
    
    if(document.body.classList.contains("dark-theme")){
        changemode.classList.remove('fa-moon');
        changemode.classList.add('fa-sun');
        localStorage.setItem('darkMode','true');
    }else{
        changemode.classList.remove('fa-sun');
        changemode.classList.add('fa-moon');
        localStorage.removeItem('darkMode');
    }


    
}
