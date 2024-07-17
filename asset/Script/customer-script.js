document.addEventListener('DOMContentLoaded', function() {
    var updateCustomerBtn = document.getElementById('updateCustomerBtn');
    var customerIdToUpdate = getQueryVariable('id');
    if (customerIdToUpdate) {
        document.getElementById('musteri_id').value = customerIdToUpdate;
    }

    updateCustomerBtn.addEventListener('click', function() {
        updateCustomer();
    });

    function updateCustomer() {
        if (!customerIdToUpdate) {
            alert('Müşteri ID bulunamadı.');
            return;
        }

        var formData = new FormData(document.getElementById('customerUpdateForm'));
        formData.append('user-update', '1');

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../backend/customer/customer-update.php', true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = xhr.responseText.trim();
                if (response === "success") {
                    alert('Müşteri güncelleme işlemi başarılı!');
                    window.location.reload();
                } else {
                    alert('Müşteri güncelleme işlemi başarısız: ' + response);
                }
            }
        };
        xhr.send(formData);
    }

    function getQueryVariable(variable) {
        var query = window.location.search.substring(1);
        var vars = query.split("&");
        for (var i = 0; i < vars.length; i++) {
            var pair = vars[i].split("=");
            if (pair[0] == variable) {
                return pair[1];
            }
        }
        return false;
    }
});
