<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Word Visa Vize Takip Otomasyonu</title>
    <link rel="icon" type="image/x-icon" href="../asset/images/white-logo.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <link rel="stylesheet" href="../asset/Style/style.css">
    <link rel="stylesheet" href="../asset/Style/stil.css">
    <link rel="stylesheet" href="../asset/Style/customer-details.css">
    <link rel="stylesheet" href="../asset/Style/customer-details.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <?php include(__DIR__."/../backend/login/session-control.php"); ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="../asset/images/logo.png" alt="" srcset="" class="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Anasayfa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="customer-list.php">Müşteriler</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" role="button" href="meeting-lists.php">Randevular</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="null-meeting-lists.php">Randevu Bekleyenler</a></li>
                            <li><a class="dropdown-item" href="appointment-list.php">Randevu Açan Ülkeler</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="payment-lists.php">Ödemeler</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" role="button" href="node-lists.php">Notlar</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrops">Not Ekle</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">İletişim</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="../backend/login/logout.php"><i class="bi bi-box-arrow-right">Çıkış Yap</i></a>
                </li>
                </ul>
                <span class="navbar-text">
                    <form class="d-flex" role="search" method="post" action="customer.php">
                        <input class="form-control me-2" type="search" placeholder="Arama" aria-label="Search" name="musteri_adi">
                        <button class="btn btn-outline-success" type="submit">Arama</button>
                    </form>
                </span>
            </div>
        </div>
    </nav>
    <!-- Diğer HTML içeriğiniz -->
    <!-- Bootstrap JS dosyası -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <div class="modal fade" id="staticBackdrops" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Müşteri Kayıt Formu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../backend/node/node-add.php" method="post">
                    <div class="input-group flex-nowrap">
                        <textarea class="form-control" placeholder="Notunuzu Ekleyiniz" id="floatingTextarea2" style="height: 100px" name="notlar"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                <button type="submit" class="btn btn-primary" name="node-adds">Ekleyin</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="module" src="../asset/Script/header.js"></script>
</body>
</html>
