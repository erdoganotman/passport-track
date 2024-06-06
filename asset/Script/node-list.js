document.addEventListener('DOMContentLoaded', function() {
    var rows = document.querySelectorAll('.node-row');
    rows.forEach(function(row) {
        row.addEventListener('click', function() {
            var nodeId = row.getAttribute('data-node-id');
            window.location.href = 'node-details.php?id=' + nodeId;
        });
    });
});
