document.addEventListener("DOMContentLoaded", function() {
    var randevuTarihleri = document.querySelectorAll("td:nth-child(6)"); // 6. sütun randevu_tarihi_saati hücresi

    randevuTarihleri.forEach(function(tarih) {
        if (tarih.textContent.trim() === "0000-00-00 00:00:00") {
            tarih.textContent = "Randevusu Yok";
        }
    });
});