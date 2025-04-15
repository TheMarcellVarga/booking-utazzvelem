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
    // For demo purposes, we'll skip the real database connection
    // and just return a mock connection object
    return new stdClass();
}

// Get posted data
$kodnev = isset($_POST["kodnev"]) ? $_POST["kodnev"] : "";

// If kodnev is set but we're in demo mode, let's create some mock data
if (!empty($kodnev)) {
    // Mock data for UI demonstration
    $mock_trip = [
        "datum" => "2025-04-15",
        "foglalo" => "15000",
        "teljesar" => "45000",
        "penznem" => "HUF",
        "ek" => "1",  // 1 = available, 0 = occupied
        "ej" => "0",
        "mb" => "1",
        "mk" => "1", 
        "mj" => "0",
        "hb" => "1",
        "hk" => "0",
        "hj" => "1"
    ];
    
    // We'll use this mock data instead of real database queries
    class MockResult {
        private $data;
        private $fetched = false;
        
        public function __construct($data) {
            $this->data = $data;
        }
        
        public function fetch_assoc() {
            if (!$this->fetched) {
                $this->fetched = true;
                return $this->data;
            }
            return null;
        }
    }
    
    // Replace the real database query with mock data
    function mysqli_query($conn, $sql) {
        global $mock_trip, $kodnev;
        return new MockResult($mock_trip);
    }
    
    function mysqli_fetch_assoc($result) {
        return $result->fetch_assoc();
    }
    
    function mysqli_free_result($result) {
        // Do nothing in mock mode
    }
    
    function mysqli_close($conn) {
        // Do nothing in mock mode
    }
}

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
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Fallback for Font Awesome -->
    <style>
        /* Icon fallbacks in case Font Awesome doesn't load */
        .icon-fallback-text {
            display: inline-block;
        }
        
        /* Hide the fallback text if Font Awesome loaded successfully */
        .fa-loaded .icon-fallback-text {
            display: none;
        }
    </style>
    <script>
        // Check if Font Awesome loaded correctly
        document.addEventListener('DOMContentLoaded', function() {
            var span = document.createElement('span');
            span.className = 'fa';
            span.style.display = 'none';
            document.body.insertBefore(span, document.body.firstChild);
            
            setTimeout(function() {
                if (window.getComputedStyle(span).fontFamily.indexOf('FontAwesome') !== -1 || 
                    window.getComputedStyle(span).fontFamily.indexOf('Font Awesome') !== -1) {
                    document.documentElement.className += ' fa-loaded';
                }
                document.body.removeChild(span);
            }, 0);
        });
    </script>
    
    <style>
        :root {
            --primary-color: #3f51b5;
            --primary-light: #757de8;
            --primary-dark: #002984;
            --secondary-color: #f5f5f5;
            --accent-color: #ff9800;
            --text-color: #212121;
            --light-text: #757575;
            --white: #ffffff;
            --shadow-sm: 0 2px 4px rgba(0,0,0,0.1);
            --shadow-md: 0 4px 8px rgba(0,0,0,0.1);
            --shadow-lg: 0 8px 16px rgba(0,0,0,0.1);
            --radius-sm: 4px;
            --radius-md: 8px;
            --radius-lg: 16px;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--secondary-color);
            color: var(--text-color);
            line-height: 1.6;
        }
        
        .header {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: var(--white);
            padding: 2rem 0;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-md);
        }
        
        .booking-container {
            background-color: var(--white);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-md);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        
        .info-box {
            border-left: 4px solid var(--primary-color);
            padding: 1rem 1.5rem;
            margin: 1rem 0;
            background-color: #e8eaf6;
            border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
        }
        
        .warning-box {
            border-left: 4px solid var(--accent-color);
            padding: 1rem 1.5rem;
            margin: 1rem 0;
            background-color: #fff3e0;
            border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
        }
        
        .seat-map {
            max-width: 500px;
            margin: 0 auto;
        }
        
        .seat-map table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 8px;
        }
        
        .seat-map th, .seat-map td {
            text-align: center;
            padding: 12px;
            border-radius: var(--radius-sm);
        }
        
        .seat-map th {
            background-color: var(--primary-color);
            color: var(--white);
            font-weight: 500;
        }
        
        .seat-map td {
            background-color: #f5f5f5;
            border: 1px solid #e0e0e0;
            transition: all 0.2s ease;
        }
        
        .seat-available {
            background-color: #e8f5e9 !important;
            border-color: #c8e6c9 !important;
        }
        
        .seat-available:hover {
            background-color: #c8e6c9 !important;
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }
        
        .seat-unavailable {
            background-color: #ffebee !important;
            border-color: #ffcdd2 !important;
            color: #c62828;
        }
        
        .seat-driver {
            background-color: #eeeeee !important;
            border-color: #e0e0e0 !important;
            color: #616161;
        }
        
        .form-check-input[type="checkbox"] {
            width: 20px;
            height: 20px;
            margin-right: 8px;
            cursor: pointer;
        }
        
        .form-check-label {
            cursor: pointer;
            font-weight: 500;
        }
        
        .form-control {
            padding: 10px 15px;
            border: 1px solid #e0e0e0;
            border-radius: var(--radius-sm);
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 0.25rem rgba(63, 81, 181, 0.25);
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--text-color);
        }
        
        .form-select {
            padding: 10px 15px;
            border: 1px solid #e0e0e0;
            border-radius: var(--radius-sm);
            cursor: pointer;
        }
        
        .btn {
            font-weight: 500;
            padding: 10px 20px;
            border-radius: 50px;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: var(--white);
            box-shadow: var(--shadow-sm);
        }
        
        .btn-primary:hover, .btn-primary:focus {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }
        
        .btn-warning {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            color: var(--white);
        }
        
        .btn-warning:hover, .btn-warning:focus {
            background-color: #f57c00;
            border-color: #f57c00;
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
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
            padding: 20px;
            border-radius: var(--radius-md);
            margin: 1.5rem 0;
            box-shadow: var(--shadow-sm);
        }
        
        .trip-details h4 {
            color: var(--primary-dark);
            margin-bottom: 0.5rem;
        }
        
        .vehicle-image {
            position: relative;
            margin: 2rem 0;
        }
        
        .vehicle-image img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        
        footer {
            background-color: var(--primary-dark);
            color: var(--white);
            padding: 2rem 0;
            margin-top: 3rem;
        }
        
        footer a {
            color: var(--white);
            text-decoration: none;
            transition: color 0.3s;
        }
        
        footer a:hover {
            color: var(--accent-color);
        }
        
        .logo-container {
            text-align: center;
            margin-bottom: 1rem;
        }
        
        .logo-container img {
            height: 80px;
            width: auto;
        }
        
        .btn-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        @media (max-width: 768px) {
            .header {
                padding: 1.5rem 0;
            }
            
            .booking-container {
                padding: 1.5rem;
            }
            
            .seat-map th, .seat-map td {
                padding: 8px;
            }
            
            h1 {
                font-size: 1.8rem;
            }
            
            h3 {
                font-size: 1.5rem;
            }
        }
        
        /* SVG icon fallbacks for critical buttons */
        .svg-icon {
            display: inline-block;
            width: 16px;
            height: 16px;
            margin-right: 5px;
            vertical-align: text-bottom;
        }
        
        /* Only show SVG if Font Awesome fails */
        .fa-loaded .svg-icon {
            display: none;
        }
        
        .text-logo {
            padding: 10px;
            transition: all 0.3s ease;
        }
        
        .text-logo:hover {
            transform: scale(1.05);
        }
        
        .text-logo span {
            display: inline-block;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
        }
    </style>
    
    <!-- Preload critical icons as inline SVG -->
    <div style="display: none;">
        <svg id="icon-check" class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"></path>
        </svg>
        <svg id="icon-ticket" class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
            <path fill="currentColor" d="M128 160h320v192H128V160zm400 96c0 26.51 21.49 48 48 48v96c0 26.51-21.49 48-48 48H48c-26.51 0-48-21.49-48-48v-96c26.51 0 48-21.49 48-48s-21.49-48-48-48v-96c0-26.51 21.49-48 48-48h480c26.51 0 48 21.49 48 48v96c-26.51 0-48 21.49-48 48zm-48-104c0-13.255-10.745-24-24-24H120c-13.255 0-24 10.745-24 24v208c0 13.255 10.745 24 24 24h336c13.255 0 24-10.745 24-24V152z"></path>
        </svg>
    </div>
    
    <!-- Favicon (embedded data URI so it always works) -->
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🚐</text></svg>"
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3 text-center text-md-start">
                    <a href="index.html" class="logo-container">
                        <div class="text-logo">
                            <span style="font-size: 24px; font-weight: bold; color: white; letter-spacing: 1px;">Utazz<span style="color: #FFC107;">Velem!</span></span>
                        </div>
                    </a>
                </div>
                <div class="col-md-9 text-center text-md-start">
                    <h1 class="mb-0">Foglalás <a href="index.html" class="text-white text-decoration-none">UtazzVelem!</a></h1>
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
                        <p><i class="fas fa-info-circle me-2"></i><span class="icon-fallback-text">ℹ️ </span>A foglaláshoz először válaszd ki a megfelelő utat, (amelyekre már van bérlő és sofőrrel együtt kérték a bérletet azok jelennek meg) majd nyomd meg az OK gombot!</p>
                        <p><i class="fas fa-info-circle me-2"></i><span class="icon-fallback-text">ℹ️ </span>Ezután megjelennek a kiválasztott út adatai. Ezekhez tudsz csatlakozni az alábbi módon:</p>
                        <p><i class="fas fa-info-circle me-2"></i><span class="icon-fallback-text">ℹ️ </span>A jelölő négyzetekkel tudod kiválasztani az ülőhelyedet. Egyszerre több személynek is foglalható hely.</p>
                        <p><i class="fas fa-info-circle me-2"></i><span class="icon-fallback-text">ℹ️ </span>Add meg az e-mail címed, neved és telefonszámod és a beszállás tervezett helyét, majd a FOGLALÁS gomb megnyomása után a foglalást rögzitjük. Hamarosan kapsz egy visszaigazoló emailt.</p>
                        <p class="mb-0"><i class="fas fa-info-circle me-2"></i><span class="icon-fallback-text">ℹ️ </span>Ezek után a fizetés gomb megnyomásával kifizetheted a foglalót bankkártyával. A közleményt (melyik út) és a foglaló összegét Neked kell beírni, utána meg kell adni a fizetési adatokat.</p>
                    </div>
                    
                    <div class="warning-box">
                        <p><i class="fas fa-exclamation-triangle me-2"></i><span class="icon-fallback-text">⚠️ </span><strong>A foglalás akkor válik érvényessé, ha a foglaló összege, vagy a bérlet teljes ára (amennyiben már kevés idő van az indulásig) be lett fizetve.</strong></p>
                        <p class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i><span class="icon-fallback-text">⚠️ </span><strong>A foglaló befizetésére a foglalás után 3 nap a határidő. Az addig ki nem fizetett foglalásokat a program automatikusan törli.</strong></p>
                    </div>
                    
                    <div class="info-box mt-3">
                        <p><i class="fas fa-info-circle me-2"></i><span class="icon-fallback-text">ℹ️ </span>Ha egy útra minden hely foglalt kérlek írj e-mailt az info@utazzvelem.eu email címre, s ha lemondás lesz, értesítelek!</p>
                        <p class="mb-0"><i class="fas fa-info-circle me-2"></i><span class="icon-fallback-text">ℹ️ </span>Sofőr nélküli bérléshez kérlek írj e-mailt az info@utazzvelem.eu email címre!</p>
                    </div>
                    
                    <div class="text-center mt-4">
                        <p class="mb-3">Ha már régebben foglaltál és csak fizetni szeretnél, nyomd meg a fizetés gombot:</p>
                        <form method="get" action="paypal.html" class="d-inline-block">
                            <button type="submit" class="btn btn-warning btn-icon"><i class="fas fa-credit-card"></i><span class="icon-fallback-text">💳 </span> Fizetés</button>
                        </form>
                    </div>
                    
                    <div class="warning-box mt-4">
                        <p class="mb-0"><strong><span id="warning" class="flash-warning"><i class="fas fa-exclamation-circle me-2"></i><span class="icon-fallback-text">⚠️ </span>Figyelem!</span> A vezetőülés melletti két hely szűkebb, mint a többi, ezért pl. egy gyereknek és egy felnőttnek javasolt. Két felnőtt nehezen fér el!</strong></p>
                    </div>
                    
                    <div class="mt-5">
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
                                <button type="submit" id="form-submit" class="btn btn-primary btn-icon">
                                    <svg class="svg-icon" viewBox="0 0 512 512">
                                        <use xlink:href="#icon-check"></use>
                                    </svg>
                                    <i class="fas fa-check-circle"></i><span class="icon-fallback-text">✓ </span> Kiválasztás
                                </button>
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
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h4><?php echo $datum . " " . $kodnev; ?></h4>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-0"><strong>Teljes összeg:</strong> <?php echo $teljesar . " " . $penznem; ?>/fő</p>
                                <p class="mb-0"><strong>Foglaló:</strong> <?php echo $foglalo . " " . $penznem; ?>/fő</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="seat-map mt-5">
                        <div class="vehicle-image mb-4">
                            <img src="img/vivaro.png" alt="VIVARO" class="img-fluid">
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
                                            <i class="fas fa-car-side me-2"></i><span class="icon-fallback-text">🚗 </span> Vezető ülés
                                        </td>
                                        <td class="<?php echo ($vek == "1") ? 'seat-available' : 'seat-unavailable'; ?>">
                                            <?php if ($vek == "1"): ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="chek" id="chek">
                                                    <label class="form-check-label" for="chek">
                                                        <i class="fas fa-chair me-1"></i><span class="icon-fallback-text">🪑 </span> Szabad
                                                    </label>
                                                </div>
                                            <?php else: ?>
                                                <i class="fas fa-ban me-1"></i><span class="icon-fallback-text">🚫 </span> Foglalt
                                                <input type="hidden" name="chek" value="no">
                                            <?php endif; ?>
                                        </td>
                                        <td class="<?php echo ($vej == "1") ? 'seat-available' : 'seat-unavailable'; ?>">
                                            <?php if ($vej == "1"): ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="chej" id="chej">
                                                    <label class="form-check-label" for="chej">
                                                        <i class="fas fa-chair me-1"></i><span class="icon-fallback-text">🪑 </span> Szabad
                                                    </label>
                                                </div>
                                            <?php else: ?>
                                                <i class="fas fa-ban me-1"></i><span class="icon-fallback-text">🚫 </span> Foglalt
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
                                                    <label class="form-check-label" for="chmb">
                                                        <i class="fas fa-chair me-1"></i><span class="icon-fallback-text">🪑 </span> Szabad
                                                    </label>
                                                </div>
                                            <?php else: ?>
                                                <i class="fas fa-ban me-1"></i><span class="icon-fallback-text">🚫 </span> Foglalt
                                                <input type="hidden" name="chmb" value="no">
                                            <?php endif; ?>
                                        </td>
                                        <td class="<?php echo ($vmk == "1") ? 'seat-available' : 'seat-unavailable'; ?>">
                                            <?php if ($vmk == "1"): ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="chmk" id="chmk">
                                                    <label class="form-check-label" for="chmk">
                                                        <i class="fas fa-chair me-1"></i><span class="icon-fallback-text">🪑 </span> Szabad
                                                    </label>
                                                </div>
                                            <?php else: ?>
                                                <i class="fas fa-ban me-1"></i><span class="icon-fallback-text">🚫 </span> Foglalt
                                                <input type="hidden" name="chmk" value="no">
                                            <?php endif; ?>
                                        </td>
                                        <td class="<?php echo ($vmj == "1") ? 'seat-available' : 'seat-unavailable'; ?>">
                                            <?php if ($vmj == "1"): ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="chmj" id="chmj">
                                                    <label class="form-check-label" for="chmj">
                                                        <i class="fas fa-chair me-1"></i><span class="icon-fallback-text">🪑 </span> Szabad
                                                    </label>
                                                </div>
                                            <?php else: ?>
                                                <i class="fas fa-ban me-1"></i><span class="icon-fallback-text">🚫 </span> Foglalt
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
                                                    <label class="form-check-label" for="chhb">
                                                        <i class="fas fa-chair me-1"></i><span class="icon-fallback-text">🪑 </span> Szabad
                                                    </label>
                                                </div>
                                            <?php else: ?>
                                                <i class="fas fa-ban me-1"></i><span class="icon-fallback-text">🚫 </span> Foglalt
                                                <input type="hidden" name="chhb" value="no">
                                            <?php endif; ?>
                                        </td>
                                        <td class="<?php echo ($vhk == "1") ? 'seat-available' : 'seat-unavailable'; ?>">
                                            <?php if ($vhk == "1"): ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="chhk" id="chhk">
                                                    <label class="form-check-label" for="chhk">
                                                        <i class="fas fa-chair me-1"></i><span class="icon-fallback-text">🪑 </span> Szabad
                                                    </label>
                                                </div>
                                            <?php else: ?>
                                                <i class="fas fa-ban me-1"></i><span class="icon-fallback-text">🚫 </span> Foglalt
                                                <input type="hidden" name="chhk" value="no">
                                            <?php endif; ?>
                                        </td>
                                        <td class="<?php echo ($vhj == "1") ? 'seat-available' : 'seat-unavailable'; ?>">
                                            <?php if ($vhj == "1"): ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="chhj" id="chhj">
                                                    <label class="form-check-label" for="chhj">
                                                        <i class="fas fa-chair me-1"></i><span class="icon-fallback-text">🪑 </span> Szabad
                                                    </label>
                                                </div>
                                            <?php else: ?>
                                                <i class="fas fa-ban me-1"></i><span class="icon-fallback-text">🚫 </span> Foglalt
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
                            
                            <div class="row g-3 mt-5">
                                <div class="col-md-6">
                                    <label for="elerhetoseg" class="form-label">
                                        <i class="fas fa-envelope me-2"></i><span class="icon-fallback-text">✉️ </span>E-mail cím:
                                    </label>
                                    <input type="email" class="form-control" id="elerhetoseg" name="elerhetoseg" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="nev" class="form-label">
                                        <i class="fas fa-user me-2"></i><span class="icon-fallback-text">👤 </span>Név:
                                    </label>
                                    <input type="text" class="form-control" id="nev" name="nev" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="telefon" class="form-label">
                                        <i class="fas fa-phone-alt me-2"></i><span class="icon-fallback-text">📞 </span>Telefonszám:
                                    </label>
                                    <input type="tel" class="form-control" id="telefon" name="telefon" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="besz" class="form-label">
                                        <i class="fas fa-map-marker-alt me-2"></i><span class="icon-fallback-text">📍 </span>Beszállás helye:
                                    </label>
                                    <input type="text" class="form-control" id="besz" name="besz" required>
                                </div>
                                <div class="col-12 text-center mt-5">
                                    <button type="submit" class="btn btn-primary btn-icon">
                                        <svg class="svg-icon" viewBox="0 0 576 512">
                                            <use xlink:href="#icon-ticket"></use>
                                        </svg>
                                        <i class="fas fa-ticket-alt"></i><span class="icon-fallback-text">🎟️ </span> FOGLALÁS
                                    </button>
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
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>UtazzVelem!</h5>
                    <p>Utazási élmények egy helyen</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p>Kapcsolat: <a href="mailto:info@utazzvelem.eu"><i class="fas fa-envelope me-1"></i><span class="icon-fallback-text">✉️ </span> info@utazzvelem.eu</a></p>
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