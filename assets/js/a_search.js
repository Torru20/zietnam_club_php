const searchInput = document.getElementById('searchInput');
const tableBody = document.querySelector('table tbody');

searchInput.addEventListener('input', (event) => {
    const searchTerm = event.target.value.toLowerCase();
    const rows = table.querySelectorAll('tr');

    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        let found = false;
        cells.forEach(cell => {
            if (cell.textContent.toLowerCase().includes(searchTerm)) {
                found = true;
            }
        });
        if (found) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});