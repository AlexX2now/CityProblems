document.getElementById('filterForm').addEventListener('submit', function(event) {
    event.preventDefault();
    var statusFilter = document.getElementById('status_filter').value;
    var rows = document.querySelectorAll('#issueTable tbody tr');
    rows.forEach(function(row) {
        var status = row.getAttribute('data-status');
        if (statusFilter === '' || statusFilter === status) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});