document.addEventListener('DOMContentLoaded', function() {
    var rows = document.querySelectorAll('.customer-row');
    rows.forEach(function(row) {
        row.addEventListener('click', function() {
            var customerId = row.getAttribute('data-customer-id');
            window.location.href = 'customer-details.php?id=' + customerId;
        });
    });
});