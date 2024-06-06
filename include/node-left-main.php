<?php 
$nodeIdToUpdate = $_GET['id'] ?? '';
include(__DIR__.'/../backend/node/node-delete.php');
include(__DIR__.'/../backend/node/node-update.php');
?>
<script src="../asset/Script/script.js"></script>
<script src="../asset/Script/node-list.js"></script>
<link rel="stylesheet" href="../asset/Style/style.css">
<div class="sidenav">
  <a href="#" onclick="deleteNode()"><button type="button" class="btn btn-warning">Not Sil</button></a>
  <a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><button type="button" class="btn btn-warning">Not Güncelle</button></a>
</div>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Müşteri Kayıt Formu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="../backend/node/node-update.php" method="post">
      <input type="hidden" name="id" value="<?php echo $nodeIdToUpdate; ?>" id="id">
      <div class="input-group flex-nowrap">
  <span class="input-group-text" id="addon-wrapping" style="margin-top: 10px;">Notlar</span>
  <input type="text" class="form-control" id="notlar" name="notlar" aria-label="Musteri Adi" aria-describedby="addon-wrapping" >
</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
        <button type="submit" class="btn btn-primary" name="node-update" onclick="updateNode()">Kayıtları Güncelle</button>
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
<script>
function deleteNode() {
  var urlParams = new URLSearchParams(window.location.search);
  var nodeIdToDelete = urlParams.get('id');

  if (!nodeIdToDelete) {
    alert('Not ID bulunamadı.');
    return;
  }

  if (confirm('Notunuzu silmek istediğinize emin misiniz?')) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../backend/node/node-delete.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        var response = xhr.responseText;
        console.log(response);
        if (response == "success") {
          window.location.reload();
        } else {
          alert('Notunuzu silme işlemi başarısız!');
        }
      }
    };
    xhr.send('deletenode=1&id=' + nodeIdToDelete);
  }
}
function updateNode() {
    var notlar = document.getElementById('notlar').value;
    var nodeIdToUpdate = document.getElementById('id').value;

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
</script>
