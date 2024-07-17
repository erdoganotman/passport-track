function deleteNode() {
    var nodeIdToDelete = getQueryParam('id');

    if (!nodeIdToDelete) {
        alert('Müşteri ID bulunamadı.');
        return;
    }

    if (confirm('Müşteriyi silmek istediğinize emin misiniz?')) {
        sendAjaxRequest('../backend/node/node-delete.php', 'deletenode=1&id=' + nodeIdToDelete, function (err, response) {
            if (err) {
                console.error(err);
                alert('Müşteri silme işlemi sırasında bir hata oluştu.');
                return;
            }
            console.log(response);
            if (response.trim() == "success") {
                alert('Müşteri başarıyla silindi.');
                window.location.reload();
            } else {
                alert('Müşteri silme işlemi başarısız: ' + response);
            }
        });
    }
}

function updateNode() {
    var notlar = document.getElementById('notlar').value;
    var nodeIdToUpdate = document.getElementById('node-id').value;

    if (!nodeIdToUpdate || !notlar) {
        alert('Güncellemek için gerekli bilgileri doldurun.');
        return;
    }

    var params = 'node-update=1&id=' + nodeIdToUpdate + '&notlar=' + encodeURIComponent(notlar);
    sendAjaxRequest('../backend/node/node-update.php', params, function (err, response) {
        if (err) {
            console.error(err);
            alert('Not güncelleme işlemi sırasında bir hata oluştu.');
            return;
        }
        console.log(response);
        if (response.trim() == "success") {
            alert('Not başarıyla güncellendi.');
            window.location.reload();
        } else {
            alert('Not güncelleme işlemi başarısız: ' + response);
        }
    });
}
