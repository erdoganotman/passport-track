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