let deleteMode = false;
const deleteBtn = document.getElementById('deleteBtn');
const table = document.getElementById('usersTable');
const form = document.getElementById('deleteForm');

deleteBtn.addEventListener('click', () => {
    if (!deleteMode) {
        // Primo click: mostra le checkbox
        const headerRow = table.querySelector('thead tr');
        const checkboxHeader = document.createElement('th');
        checkboxHeader.textContent = "";
        headerRow.insertBefore(checkboxHeader, headerRow.firstChild);

        table.querySelectorAll('tbody tr').forEach(row => {
            table.querySelectorAll('tbody tr').forEach(row => {
                const userId = row.dataset.userId;
                const checkboxCell = document.createElement('td');
                checkboxCell.classList.add('checkbox-cell');
                checkboxCell.innerHTML = `<input type="checkbox" name="delete_ids[]" value="${userId}">`;
                row.insertBefore(checkboxCell, row.firstChild);
            });            
        });

        deleteMode = true;
        deleteBtn.textContent = 'Confirm Deletion';
    } else {
        // Secondo click: invia il form
        if (form.querySelectorAll('input[type="checkbox"]:checked').length > 0) {
            form.submit();
        } else {
            alert('Seleziona almeno un utente da eliminare.');
        }
    }
});