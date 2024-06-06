<link rel="stylesheet" href="/asset/stil.css">
<div class="sidenav">
  <a href="#"><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Müşteri Ekle</button></a>
  <a href="#"><button type="button" class="btn btn-warning">Müşteri Sil</button></a>
 
</div>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Müşteri Kayıt Formu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="../backend/customer/customer-add.php" method="post">
      <div class="input-group flex-nowrap">
  <span class="input-group-text" id="addon-wrapping" style="margin-top: 10px;">Müşteri Adı</span>
  <input type="text" class="form-control"  name="musteri_adi" aria-label="Musteri Adi" aria-describedby="addon-wrapping">
</div>
<div class="input-group flex-nowrap">
  <span class="input-group-text" id="addon-wrapping" style="margin-top: 10px;">Müşteri Soyadı</span>
  <input type="text" class="form-control"  name="musteri_soyadi" aria-label="Musteri soyadi" aria-describedby="addon-wrapping">
</div>
<div class="input-group flex-nowrap">
  <span class="input-group-text" id="addon-wrapping" style="margin-top: 10px;">Müşteri T.C Kimlik No</span>
  <input type="text" class="form-control"   name="musteri_tc" aria-label="musteri_tc" aria-describedby="addon-wrapping">
</div>
     <div class="input-group flex-nowrap">
  <span class="input-group-text" id="addon-wrapping" style="margin-top: 10px;">Doğum Tarihi</span>
  <input type="date" class="form-control" placeholder="Dogum Tarihi" name="musteri_dogum_tarihi" aria-label="Dogum Tarihi" aria-describedby="addon-wrapping">
</div>
<div class="input-group flex-nowrap">
  <span class="input-group-text" id="addon-wrapping" style="margin-top: 10px;">Pasaport No</span>
  <input type="text" class="form-control"  name="musteri_pasaport_no" aria-label="Pasaport No" aria-describedby="addon-wrapping">
</div>
<div class="input-group flex-nowrap">
  <span class="input-group-text" id="addon-wrapping" style="margin-top: 10px;">Seyahat Edilecek Ülke</span>
  <input type="text" name="randevu_gidecegi_ulke" class="form-control">
</div>
    
     <div class="input-group flex-nowrap">
  <span class="input-group-text" id="addon-wrapping" style="margin-top: 10px;">Seyahat Tarihi</span>
  <input type="date" class="form-control" placeholder="Seyahat Tarihi" name="randevu_seyahat_tarihi" aria-label="Seyahat Tarihi" aria-describedby="addon-wrapping">
</div>
     <div class="input-group flex-nowrap">
  <span class="input-group-text" id="addon-wrapping" style="margin-top: 10px;">Randevu Tarihi</span>
  <input type="datetime-local" class="form-control" placeholder="Randevu Tarihi ve Saati" id="randevu_tarihi_saati" name="randevu_tarihi_saati" aria-label="Randevu Tarihi ve Saati" aria-describedby="addon-wrapping">
</div>
     <div class="input-group">
  <span class="input-group-text" id="addon-wrapping" style="margin-top: 10px;">Ödenen Ücret</span>
  <input type="text" class="form-control" aria-label="Euro amount (with dot and two decimal places)"name="alinan_para">
  <span class="input-group-text" id="e">€</span>
  <span class="input-group-text" id="e">0.00</span>
</div>
<div class="input-group">
<span class="input-group-text" id="addon-wrapping" style="margin-top: 10px;">Ödenecek Ücret</span>
  <input type="text" class="form-control" aria-label="Euro amount (with dot and two decimal places)"Name="odeyecegi_para">
  <span class="input-group-text" id="e">€</span>
  <span class="input-group-text" id="e">0.00</span>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
        <button type="submit" class="btn btn-primary" name="user-add">Kayıt Ekle</button>
        </form>
      </div>
    </div>
  </div>
</div>
<style>
  .form-control , #e {
    margin-top: 10px;
  }
</style>