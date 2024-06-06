<?php
    // Define default values for exchange rates
    $usdAlis = 0;
    $usdSatis = 0;
    $eurAlis = 0;
    $eurSatis = 0;

    // Load exchange rates if available
    $kur = simplexml_load_file("https://www.tcmb.gov.tr/kurlar/today.xml");
    if ($kur) {
        foreach ($kur->Currency as $cur) {
            if ($cur["Kod"] == "USD") {
                $usdAlis = $cur->ForexBuying;
                $usdSatis = $cur->ForexSelling;
            }
            if ($cur["Kod"] == "EUR") {
                $eurAlis = $cur->ForexBuying;
                $eurSatis = $cur->ForexSelling;
            }
        }
    }
    ?>