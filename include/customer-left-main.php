<?php include(__DIR__.'/../backend/customer/customer-delete.php'); 
include(__DIR__.'/../backend/customer/customer-update.php'); ?>
<link rel="stylesheet" href="../asset/Style/style.css">   
<link rel="stylesheet" href="../asset/Style/stil.css">   
<div class="sidenav">
  <a href="#" onclick="deleteCustomer()"><button type="button" class="btn btn-warning">Müşteri Sil</button></a>
  <a href="#"><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Müşteri Güncelle</button></a>
  <a href="#"><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Müşteri Güncelle</button></a>

  <a href="../backend/print/excel.php" class="btn btn-light btn-block"><i class='bx bx-plus mr-2'></i> Excele Aktar</a>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Müşteri Kayıt Formu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="customerUpdateForm">
          <input type="hidden" name="musteri_id" id="musteri_id" value="">
          <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping">Müşteri Adı</span>
            <input type="text" class="form-control" id="musteri_adi" name="musteri_adi" aria-label="Musteri Adi" aria-describedby="addon-wrapping">
          </div>
          <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping">Müşteri Soyadı</span>
            <input type="text" class="form-control" id="musteri_soyadi" name="musteri_soyadi" aria-label="Musteri soyadi" aria-describedby="addon-wrapping">
          </div>
          <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping">Müşteri TC</span>
            <input type="text" class="form-control" id="musteri_tc" name="musteri_tc" aria-label="musteri_tc" aria-describedby="addon-wrapping">
          </div>
          <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping">Doğum Tarihi</span>
            <input type="date" class="form-control" id="musteri_dogum_tarihi" name="musteri_dogum_tarihi" aria-label="Dogum Tarihi" aria-describedby="addon-wrapping">
          </div>
          <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping">Pasaport No</span>
            <input type="text" class="form-control" id="musteri_pasaport_no" name="musteri_pasaport_no" aria-label="Pasaport No" aria-describedby="addon-wrapping">
          </div>
          <input type="text" name="randevu_gidecegi_ulke" id="randevu_gidecegi_ulke" placeholder="Seyahat Edilecek Ülke" class="form-control">
          <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping">Seyahat Tarihi</span>
            <input type="date" class="form-control" id="randevu_seyahat_tarihi" name="randevu_seyahat_tarihi" aria-label="Seyahat Tarihi" aria-describedby="addon-wrapping">
          </div>
          <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping">Randevu Tarihi</span>
            <input type="datetime-local" class="form-control" id="randevu_tarihi_saati" name="randevu_tarihi_saati" aria-label="Randevu Tarihi ve Saati" aria-describedby="addon-wrapping">
          </div>
          <div class="input-group">
            <span class="input-group-text" id="addon-wrapping">Ödenen Ücret</span>
            <input type="text" class="form-control" id="alinan_para" name="alinan_para" aria-label="Euro amount (with dot and two decimal places)">
            <span class="input-group-text">€</span>
          </div>
          <div class="input-group">
            <span class="input-group-text" id="addon-wrapping">Ödenecek Ücret</span>
            <input type="text" class="form-control" id="odeyecegi_para" name="odeyecegi_para" aria-label="Euro amount (with dot and two decimal places)">
            <span class="input-group-text">€</span>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
        <button type="button" class="btn btn-primary" id="updateCustomerBtn">Kayıtları Güncelle</button>
      </div>
    </div>
  </div>
</div>
<style>
  .form-control, #e {
    margin-top: 10px;
  }
</style>
<script>
  function deleteCustomer() {
    // URL'den müşteri ID'sini al
    var urlParams = new URLSearchParams(window.location.search);
    var customerIdToDelete = urlParams.get('id');

    if (!customerIdToDelete) {
        alert('Müşteri ID bulunamadı.');
        return;
    }

    if (confirm('Müşteriyi silmek istediğinize emin misiniz?')) {
        // AJAX kullanarak müşteriyi silme işlemini gerçekleştir
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../backend/customer/customer-delete.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = xhr.responseText;
                console.log(response); // Hata mesajını konsola yazdır
                if (response == "success") {
                    // Silme işlemi başarılıysa sayfayı yeniden yükle
                    window.location.reload();
                } else {
                    // Silme işlemi başarısızsa uyarı göster
                    alert('Müşteri silme işlemi başarısız!');
                }
            }
        };
        // Silinecek müşteri ID'sini POST verisi olarak gönder
        xhr.send('deleteCustomer=1&id=' + customerIdToDelete);
    }
}

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
</script>
