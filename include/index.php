<?php
    include('../include/header.php'); 
    include(__DIR__.'/../backend/table-list/meeting-list.php');
?>
<div class="container" id="i-card">
<div class ="row">
<div class="card text-white bg-danger mb-3 " style="max-width: 26rem;">
  <div class="card-header">En Yakın Randevular</div>
  <div class="card-body">
    <?php
            // Bugünkü tarihi al
            $today = date("Y-m-d");

            // $result değişkeninin tanımlı olup olmadığını kontrol et (veritabanı sorgusundan gelen sonuçlar)
            if ($result) {
            ?>
            <table>
                <tr>
                    <th>Müşteri Adı ve Soyadı</th>
                    <th style="padding-left: 40px;">Randevu Tarihi</th>
                </tr>
                <?php
                // Her sonuç üzerinde döngü oluştur ve bir tablo satırı oluştur
                foreach ($result as $row) {
                    // Randevu tarihinin bugünkü tarihten büyük veya eşit olup olmadığını kontrol et
                    if (strtotime($row['randevu_tarihi_saati']) >= strtotime($today)) {
                        // müşteri_id kullanarak müşteri adı ve soyadını almak için sorgu
                        $customerQuery = $conn->query("SELECT musteri_adi, musteri_soyadi, musteri_tc, musteri_pasaport_no FROM musteri WHERE musteri_id = " . $row['musteri_id']);
                        if ($customerQuery) {
                            $customerData = $customerQuery->fetch_assoc();
                            $customerName = $customerData['musteri_adi'] . ' ' . $customerData['musteri_soyadi'];
                        } else {
                            $customerName = "Bilinmeyen Müşteri";
                        }
                ?>
                <tr onclick="window.location='customer-details.php?id=<?= $row['musteri_id'] ?>'">
                    <td><?= $customerName ?></td>
                    <td style="padding-left: 40px;"><?= $row['randevu_tarihi_saati'] ?></td>
                </tr>
                <?php
                    }
                }
                ?>
            </table>
            <?php
            } else {
                echo "Veri bulunamadı.";
            }
            ?>
  </div>
</div>

  <div class="card text-white bg-warning mb-3" style="max-width: 26rem;">
  <div class="card-header">Duyurular ve Notlar</div>
  <div class="card-body">
    <?php include('backend/node/node-list.php') ?>
            <?php
            // Son 5 notu almak için sorgu
            $node = $conn->query("SELECT id, notlar FROM notlar ORDER BY id DESC LIMIT 5");
            if ($node) {
            ?>
            <table>
                <?php
                // Her sonuç üzerinde döngü oluştur ve bir tablo satırı oluştur
                while ($row = $node->fetch_assoc()) {
                ?>
                <tr>
                    <td><?= $row['notlar'] ?></td>
                </tr>
                <?php
                }
                ?>
            </table>
            <?php
            } else {
                echo "Veri bulunamadı.";
            }
            ?>
  </div>
</div>
<div class="card text-white bg-primary mb-3" style="max-width: 26rem;">
  <div class="card-header">Döviz Kurları</div>
  <div class="card-body">
    <?php include('../backend/doviz.php'); ?>
            <div class="doviz">
                <p><b>USD Alış: </b><?= $usdAlis; ?><b> USD Satış: </b><?= $usdSatis; ?></p>
                <p><b>EURO Alış: </b><?= $eurAlis; ?><b> EURO Satış: </b><?= $eurSatis; ?></p>
            </div>
            <h6>Döviz Hesaplama</h6>
            <form>
                <div style="display:flex;">
                <input type="text" id="doviz" name="doviz" placeholder="Döviz Miktarı" class="form-control" style="width:60%;height: 25px;font-size:10px;">
                <select id="curr" class="form-select" name="curr"style="width:27%;height: 25px;padding-left: 5px;font-size:10px;">
                    <option value="USD">USD</option>
                    <option value="EUR">EURO</option>
                </select>
            </div>
            <div>
                <button id="change"class="btn btn-light"style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; margin-top:10px;"type="button">Hesapla</button>
                </div>
            </form>
            <div id="result"></div>
            <script>
                document.getElementById('change').addEventListener('click', function(e) {
                    e.preventDefault(); // Formun submit olmasını engelle
                    var amount = parseFloat(document.getElementById('doviz').value);
                    var currency = document.getElementById('curr').value;

                    var usdAlis = <?= $usdAlis; ?>;
                    var eurAlis = <?= $eurAlis; ?>;

                    var result;

                    // Hesaplama işlemleri
                    if (currency === 'USD') {
                        result = amount * usdAlis; // USD alış kurunu kullanarak hesapla
                    } else if (currency === 'EUR') {
                        result = amount * eurAlis; // EURO alış kurunu kullanarak hesapla
                    }

                    // Sonucu ekrana yazdır
                    document.getElementById('result').innerHTML = "Sonuç: " + result +" TL";
                });
            </script>
  </div>
</div>
</div>  
</div>
<?php include('../include/Accordion.php');?>
<?php include('../include/footer.php'); ?>
