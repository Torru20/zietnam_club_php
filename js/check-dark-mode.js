// Kiểm tra trạng thái dark mode ban đầu
if (localStorage.getItem('darkMode') === 'true') {
    document.body.classList.add('dark-theme');
  }
  
  // Nút chuyển đổi
  const darkModeToggle = document.getElementById('darkModeToggle');
  
  darkModeToggle.addEventListener('click', () => {
    document.body.classList.toggle('dark-theme');   
  
  
    if (document.body.classList.contains('dark-theme')) {
      localStorage.setItem('darkMode',   
   'true');
    } else {
      localStorage.removeItem('darkMode');
    }
  });