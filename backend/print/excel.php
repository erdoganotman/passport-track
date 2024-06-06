<?php
include('../../layout/customer-list.php');
include('config.php'); 
require_once("PHPExcel.php");

// Yeni bir PHPExcel nesnesi oluşturun
$myExcel = new PHPExcel();

// Excel dosyasının özelliklerini ayarlayın
$myExcel->getProperties()->setCreator("Erdogan Otman")
                        ->setLastModifiedBy("Erdogan Otman")
                        ->setTitle("Üyeler")
                        ->setSubject("Üyeler")
                        ->setDescription("Üyeler")
                        ->setKeywords("")
                        ->setCategory("PhpToExcel");

// Excel dosyasında yeni bir sayfa oluşturun ve başlığını ayarlayın
$myExcel->setActiveSheetIndex(0);
$myExcel->getActiveSheet()->setTitle("Kayıtlar");
$myExcel->getActiveSheet()->setCellValue("A1", "İsim Soyisim");
$myExcel->getActiveSheet()->setCellValue("B1", "Alış Tarihi");
$myExcel->getActiveSheet()->setCellValue("C1", "Teslim Tarihi");
$myExcel->getActiveSheet()->setCellValue("D1", "Cihaz Modeli");
$myExcel->getActiveSheet()->setCellValue("E1", "Şikayet");
$myExcel->getActiveSheet()->setCellValue("F1", "Yapılan İşlem");
$myExcel->getActiveSheet()->setCellValue("G1", "Telefon");
$myExcel->getActiveSheet()->setCellValue("H1", "Tutar");
$myExcel->getActiveSheet()->setCellValue("I1", "Bakiye");

// Sütun genişliklerini ayarlayın
$myExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
$myExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
$myExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
$myExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
$myExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
$myExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
$myExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
$myExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
$myExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);


// Veritabanından verileri alın
$stmt = $db->prepare("SELECT * FROM tamir WHERE sube_id = 1");
$stmt->execute(array(1));
$phones = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Verileri Excel dosyasına aktarın
$more = 2;
foreach ($phones as $row) {
    $myExcel->getActiveSheet()->setCellValue('A' . $more, $row['musteri_adi']); // 'musteri_adi' sütununu ekleyin
    $myExcel->getActiveSheet()->setCellValue('B' . $more, $row['musteri_soyadi']); // 'iletisim' sütununu ekleyin
    $myExcel->getActiveSheet()->setCellValue('C' . $more, $row['teslim_tarihi']); // 'iletisim' sütununu ekleyin
    $myExcel->getActiveSheet()->setCellValue('D' . $more, $row['marka_model']); // 'iletisim' sütununu ekleyin
    $myExcel->getActiveSheet()->setCellValue('E' . $more, $row['sikayet']); // 'iletisim' sütununu ekleyin
    $myExcel->getActiveSheet()->setCellValue('F' . $more, $row['yapilan_islem']); // 'iletisim' sütununu ekleyin
    $myExcel->getActiveSheet()->setCellValue('G' . $more, $row['telefon']); // 'iletisim' sütununu ekleyin
    $myExcel->getActiveSheet()->setCellValue('H' . $more, $row['ucret']); // 'iletisim' sütununu ekleyin
    $myExcel->getActiveSheet()->setCellValue('I' . $more, $row['kalan']); // 'iletisim' sütununu ekleyin
    $more++;
}

// Excel dosyasını indirme ayarlarını yapın
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="uyeler.xlsx"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1'); // IE 9 için gerekli olabilir
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: cache, must-revalidate');
header('Pragma: public');

// Excel dosyasını kaydedin ve çıktıyı aktarın
$objWriter = PHPExcel_IOFactory::createWriter($myExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>
