<?php
global $vnev;
global $vek;
global $vej;
global $vmb;
global $vmk;
global $vmj;
global $vhb;
global $vhk;
global $vhj;

// Define the database connection function
function dbConnect() {
    $conn = new mysqli('localhost', 'u11035', 'RZMdoGqHGep5', 'u11035');
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    mysqli_select_db($conn, "u11035");
    return $conn;
}

// Get posted data
$kodnev = isset($_POST["kodnev"]) ? $_POST["kodnev"] : "";

// Start the HTML document
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UtazzVelem! - Foglalás</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/fontAwesome.css">
    <link rel="stylesheet" href="css/hero-slider.css">
    <link rel="stylesheet" href="css/owl-carousel.css">
    <link rel="stylesheet" href="css/templatemo-style.css">
    <link rel="stylesheet" href="css/lightbox.css">
    <link rel="icon" type="image/x-icon" href="/img/uvicon.ico">
    
    <style>
        :root {
            --primary-color: #4a89dc;
            --secondary-color: #f5f7fa;
            --accent-color: #ff9800;
            --text-color: #333;
            --light-text: #777;
            --shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: var(--secondary-color);
            color: var(--text-color);
            line-height: 1.6;
        }
        
        .header {
            background: linear-gradient(135deg, var(--primary-color), #2d62a3);
            color: white;
            padding: 2rem 0;
            border-radius: 0 0 10px 10px;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
        }
        
        .booking-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: var(--shadow);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        
        .info-box {
            border-left: 4px solid var(--primary-color);
            padding: 0.5rem 1rem;
            margin: 1rem 0;
            background-color: #f8f9fa;
        }
        
        .warning-box {
            border-left: 4px solid var(--accent-color);
            padding: 0.5rem 1rem;
            margin: 1rem 0;
            background-color: #fff3e0;
        }
        
        .seat-map {
            max-width: 500px;
            margin: 0 auto;
        }
        
        .seat-map table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 10px;
        }
        
        .seat-map th, .seat-map td {
            text-align: center;
            padding: 10px;
            border-radius: 5px;
        }
        
        .seat-map th {
            background-color: var(--primary-color);
            color: white;
        }
        
        .seat-map td {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
        }
        
        .seat-available {
            background-color: #e8f5e9 !important;
            transition: all 0.3s;
        }
        
        .seat-available:hover {
            background-color: #c8e6c9 !important;
        }
        
        .seat-unavailable {
            background-color: #ffebee !important;
            color: #b71c1c;
        }
        
        .seat-driver {
            background-color: #eeeeee !important;
            color: #757575;
        }
        
        .btn-booking {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 10px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        
        .btn-booking:hover {
            background-color: #2d62a3;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        
        .btn-payment {
            background-color: var(--accent-color);
            color: white;
        }
        
        .btn-payment:hover {
            background-color: #f57c00;
        }
        
        .flash-warning {
            animation: flash 1s infinite;
        }
        
        @keyframes flash {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        
        .trip-details {
            background-color: #e3f2fd;
            padding: 15px;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
            margin: 1rem 0;
        }
        
        @media (max-width: 768px) {
            .header {
                padding: 1rem 0;
            }
            
            .booking-container {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3 text-center text-md-start">
                    <a href="index.html">
                        <img src="img/logo.png" alt="UtazzVelem Logo" height="90" width="100" class="img-fluid">
                    </a>
                </div>
                <div class="col-md-9 text-center text-md-start">
                    <h1>Foglalás <a href="index.html" class="text-white text-decoration-none">UtazzVelem!</a></h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <?php if (empty($kodnev)): ?>
        <!-- Trip Selection Form -->
        <div class="booking-container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="mb-4">Kedves (Leendő) Bérlő!</h3>
                    
                    <div class="info-box">
                        <p><i class="fas fa-info-circle me-2"></i> A foglaláshoz először válaszd ki a megfelelő utat, (amelyekre már van bérlő és sofőrrel együtt kérték a bérletet azok jelennek meg) majd nyomd meg az OK gombot!</p>
                        <p><i class="fas fa-info-circle me-2"></i> Ezután megjelennek a kiválasztott út adatai. Ezekhez tudsz csatlakozni az alábbi módon:</p>
                        <p><i class="fas fa-info-circle me-2"></i> A jelölő négyzetekkel tudod kiválasztani az ülőhelyedet. Egyszerre több személynek is foglalható hely.</p>
                        <p><i class="fas fa-info-circle me-2"></i> Add meg az e-mail címed, neved és telefonszámod és a beszállás tervezett helyét, majd a FOGLALÁS gomb megnyomása után a foglalást rögzitjük. Hamarosan kapsz egy visszaigazoló emailt.</p>
                        <p><i class="fas fa-info-circle me-2"></i> Ezek után a fizetés gomb megnyomásával kifizetheted a foglalót bankkártyával. A közleményt (melyik út) és a foglaló összegét Neked kell beírni, utána meg kell adni a fizetési adatokat.</p>
                    </div>
                    
                    <div class="warning-box">
                        <p><i class="fas fa-exclamation-triangle me-2"></i> <strong>A foglalás akkor válik érvényessé, ha a foglaló összege, vagy a bérlet teljes ára (amennyiben már kevés idő van az indulásig) be lett fizetve.</strong></p>
                        <p><i class="fas fa-exclamation-triangle me-2"></i> <strong>A foglaló befizetésére a foglalás után 3 nap a határidő. Az addig ki nem fizetett foglalásokat a program automatikusan törli.</strong></p>
                    </div>
                    
                    <div class="info-box mt-3">
                        <p><i class="fas fa-info-circle me-2"></i> Ha egy útra minden hely foglalt kérlek írj e-mailt az info@utazzvelem.eu email címre, s ha lemondás lesz, értesítelek!</p>
                        <p><i class="fas fa-info-circle me-2"></i> Sofőr nélküli bérléshez kérlek írj e-mailt az info@utazzvelem.eu email címre!</p>
                    </div>
                    
                    <div class="text-center mt-4">
                        <p class="mb-2">Ha már régebben foglaltál és csak fizetni szeretnél, nyomd meg a fizetés gombot:</p>
                        <form method="get" action="paypal.html" class="d-inline-block">
                            <button type="submit" class="btn btn-booking btn-payment"><i class="fas fa-credit-card me-2"></i>Fizetés</button>
                        </form>
                    </div>
                    
                    <div class="warning-box mt-4">
                        <p><strong><span id="warning" class="flash-warning"><i class="fas fa-exclamation-circle me-2"></i>Figyelem!</span> A vezetőülés melletti két hely szűkebb, mint a többi, ezért pl. egy gyereknek és egy felnőttnek javasolt. Két felnőtt nehezen fér el!</strong></p>
                    </div>
                    
                    <div class="mt-4">
                        <form action="booking.php" method="post" class="row g-3 justify-content-center">
                            <div class="col-md-8">
                                <label for="kodnev" class="form-label">Válassz utat:</label>
                                <select name="kodnev" id="kodnev" class="form-select" required>
                                    <option value="">Válassz...</option>
                                    <option value="Plitvice">Márc. 29. Plitvice</option>
                                    <option value="Csokigyár és outlet">Ápr. 15. Csokigyár és Pandorf outlet</option>
                                    <option value="Róma">Ápr. 17. Róma (Húsvét)</option>
                                    <option value="Pünkösd tengerpart">jún. 06. Pünkösd tengerpart</option>
                                </select>
                            </div>
                            <div class="col-12 text-center mt-4">
                                <button type="submit" id="form-submit" class="btn btn-booking"><i class="fas fa-check-circle me-2"></i>Kiválasztás</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php else: ?>
        
        <?php
        // Fetch trip details from database
        $conn = dbConnect();
        $sql = "SELECT * FROM idopontok WHERE (kodnev='$kodnev')";
        $result = mysqli_query($conn, $sql);
        
        while ($row = mysqli_fetch_assoc($result)) {
            $datum = $row["datum"];
            $foglalo = $row["foglalo"];
            $teljesar = $row["teljesar"];
            $penznem = $row["penznem"];
            $vek = $row["ek"];
            $vej = $row["ej"];
            $vmb = $row["mb"];
            $vmk = $row["mk"];
            $vmj = $row["mj"];
            $vhb = $row["hb"];
            $vhk = $row["hk"];
            $vhj = $row["hj"];
        ?>
        
        <!-- Trip Details and Seat Selection -->
        <div class="booking-container">
            <div class="row">
                <div class="col-12">
                    <h3 class="text-center mb-4">Ülésfoglalás</h3>
                    
                    <div class="trip-details">
                        <div class="row">
                            <div class="col-md-6">
                                <h4><?php echo $datum . " " . $kodnev; ?></h4>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-0">Teljes összeg: <?php echo $teljesar . " " . $penznem; ?>/fő</p>
                                <p class="mb-0">Foglaló: <?php echo $foglalo . " " . $penznem; ?>/fő</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="seat-map mt-5">
                        <div class="text-center mb-3">
                            <img src="img/vivaro.png" alt="VIVARO" height="200" width="84" class="img-fluid">
                        </div>
                        
                        <form action="booking2.php" method="post">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Ülés bal</th>
                                        <th>Ülés közép</th>
                                        <th>Ülés jobb</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>1. sor</th>
                                        <td class="seat-driver">
                                            Vezető ülés
                                        </td>
                                        <td class="<?php echo ($vek == "1") ? 'seat-available' : 'seat-unavailable'; ?>">
                                            <?php if ($vek == "1"): ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="chek" id="chek">
                                                    <label class="form-check-label" for="chek">Szabad</label>
                                                </div>
                                            <?php else: ?>
                                                Foglalt
                                                <input type="hidden" name="chek" value="no">
                                            <?php endif; ?>
                                        </td>
                                        <td class="<?php echo ($vej == "1") ? 'seat-available' : 'seat-unavailable'; ?>">
                                            <?php if ($vej == "1"): ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="chej" id="chej">
                                                    <label class="form-check-label" for="chej">Szabad</label>
                                                </div>
                                            <?php else: ?>
                                                Foglalt
                                                <input type="hidden" name="chej" value="no">
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>2. sor</th>
                                        <td class="<?php echo ($vmb == "1") ? 'seat-available' : 'seat-unavailable'; ?>">
                                            <?php if ($vmb == "1"): ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="chmb" id="chmb">
                                                    <label class="form-check-label" for="chmb">Szabad</label>
                                                </div>
                                            <?php else: ?>
                                                Foglalt
                                                <input type="hidden" name="chmb" value="no">
                                            <?php endif; ?>
                                        </td>
                                        <td class="<?php echo ($vmk == "1") ? 'seat-available' : 'seat-unavailable'; ?>">
                                            <?php if ($vmk == "1"): ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="chmk" id="chmk">
                                                    <label class="form-check-label" for="chmk">Szabad</label>
                                                </div>
                                            <?php else: ?>
                                                Foglalt
                                                <input type="hidden" name="chmk" value="no">
                                            <?php endif; ?>
                                        </td>
                                        <td class="<?php echo ($vmj == "1") ? 'seat-available' : 'seat-unavailable'; ?>">
                                            <?php if ($vmj == "1"): ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="chmj" id="chmj">
                                                    <label class="form-check-label" for="chmj">Szabad</label>
                                                </div>
                                            <?php else: ?>
                                                Foglalt
                                                <input type="hidden" name="chmj" value="no">
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>3. sor</th>
                                        <td class="<?php echo ($vhb == "1") ? 'seat-available' : 'seat-unavailable'; ?>">
                                            <?php if ($vhb == "1"): ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="chhb" id="chhb">
                                                    <label class="form-check-label" for="chhb">Szabad</label>
                                                </div>
                                            <?php else: ?>
                                                Foglalt
                                                <input type="hidden" name="chhb" value="no">
                                            <?php endif; ?>
                                        </td>
                                        <td class="<?php echo ($vhk == "1") ? 'seat-available' : 'seat-unavailable'; ?>">
                                            <?php if ($vhk == "1"): ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="chhk" id="chhk">
                                                    <label class="form-check-label" for="chhk">Szabad</label>
                                                </div>
                                            <?php else: ?>
                                                Foglalt
                                                <input type="hidden" name="chhk" value="no">
                                            <?php endif; ?>
                                        </td>
                                        <td class="<?php echo ($vhj == "1") ? 'seat-available' : 'seat-unavailable'; ?>">
                                            <?php if ($vhj == "1"): ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="chhj" id="chhj">
                                                    <label class="form-check-label" for="chhj">Szabad</label>
                                                </div>
                                            <?php else: ?>
                                                Foglalt
                                                <input type="hidden" name="chhj" value="no">
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            <!-- Hidden fields -->
                            <input type="hidden" name="chkodnev" value="<?php echo $kodnev; ?>">
                            <input type="hidden" name="chdatum" value="<?php echo $datum; ?>">
                            <input type="hidden" name="chfoglalo" value="<?php echo $foglalo; ?>">
                            <input type="hidden" name="chteljesar" value="<?php echo $teljesar; ?>">
                            <input type="hidden" name="chpenznem" value="<?php echo $penznem; ?>">
                            
                            <div class="row g-3 mt-4">
                                <div class="col-md-6">
                                    <label for="elerhetoseg" class="form-label">E-mail cím:</label>
                                    <input type="email" class="form-control" id="elerhetoseg" name="elerhetoseg" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="nev" class="form-label">Név:</label>
                                    <input type="text" class="form-control" id="nev" name="nev" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="telefon" class="form-label">Telefonszám:</label>
                                    <input type="tel" class="form-control" id="telefon" name="telefon" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="besz" class="form-label">Beszállás helye:</label>
                                    <input type="text" class="form-control" id="besz" name="besz" required>
                                </div>
                                <div class="col-12 text-center mt-4">
                                    <button type="submit" class="btn btn-booking"><i class="fas fa-ticket-alt me-2"></i>FOGLALÁS</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        mysqli_free_result($result);
        mysqli_close($conn);
        ?>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>UtazzVelem!</h5>
                    <p>Utazási élmények egy helyen</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p>Kapcsolat: <a href="mailto:info@utazzvelem.eu" class="text-white">info@utazzvelem.eu</a></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Flash warning animation
        setInterval(function() {
            var elem = document.getElementById("warning");
            elem.style.opacity = (elem.style.opacity == "0.5") ? "1" : "0.5";
        }, 500);
    </script>
</body>
</html>