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
// weblap
echo '<html>';
echo '<head>';
echo '<meta http-equiv="content-type" content="text/html; charset=UTF-8" >';
echo '<title>UtazzVelem! foglalás</title>';
echo '  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">';
echo '  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">';
echo '   <link rel="apple-touch-icon" href="apple-touch-icon.png">';
echo '       <link rel="stylesheet" href="css/bootstrap.min.css">';
echo '       <link rel="stylesheet" href="css/bootstrap-theme.min.css">';
echo '       <link rel="stylesheet" href="css/fontAwesome.css">';
echo '       <link rel="stylesheet" href="css/hero-slider.css">';
echo '      <link rel="stylesheet" href="css/owl-carousel.css">';
echo '      <link rel="stylesheet" href="css/templatemo-style.css">';
echo '     <link rel="stylesheet" href="css/lightbox.css">';
echo '   <link rel="icon" type="image/x-icon" href="/img/uvicon.ico">';
echo '</head>';
echo '<body>';
// ------------ FORM ---------------
/************ EZ A KÓDBEKÉRŐ ŰRLAP ********************/

echo '<center><h2>Foglalás <a href="index.html" >UtazzVelem!</a></h2></center>';
echo '<a href="index.html"><img src="img/logo.png" alt="LOGO" height="90" width="100"></a>';
echo "<center>Kedves (Leendő) Bérlő!    ";

echo "<br><br> A foglaláshoz először válaszd ki a megfelelő utat, (amelyekre már van bérlő és sofőrrel együtt kérték a bérletet azok jelennek meg) majd nyomd meg az OK gombot!<br>";
echo "  Ezután megjelennek a kiválasztott út adatai. Ezekhez tudsz csatlakozni az alábbi módon:<br>";
echo " A jelölő négyzetekkel tudod kiválasztani az ülőhelyedet. Egyszerre több személynek is foglalható hely.<br>";

echo " Add meg az e-mail címed, neved és telefonszámod és a beszállás tervezett helyét, majd a FOGLALÁS gomb megnyomása után a foglalást rögzitjük. Hamarosan kapsz egy visszaigazoló emailt.<br>";
echo " Ezek után a fizetés gomb megnyomásával kifizetheted a foglalót bankkártyával. A közleményt (melyik út) és a foglaló összegét Neked kell beírni, utána meg kell adni a fizetési adatokat.<br>";
echo '<b>';
echo " A foglalás akkor válik érvényessé, ha a foglaló összege, vagy a bérlet teljes ára (amennyiben már kevés idő van az indulásig) be lett fizetve.<br>";
echo '</b>';
echo '<b>';
echo " A foglaló befizetésére a foglalás után 3 nap a határidő. Az addig ki nem fizetett foglalásokat a program automatikusan törli. <br>";
echo '</b>';
//echo "A fizetési módokról egy külön emailben értesítjük azokat, akik széket foglaltak.<br>";
echo " Ha egy útra minden hely foglalt kérlek írj e-mailt az info@utazzvelem.eu email címre, s ha lemondás lesz, értesítelek!<br>";
echo " Sofőr nélküli bérléshez kérlek írj e-mailt az info@utazzvelem.eu email címre!<br>";

//echo " Az adventi útra New Yorkba csak telefonon (+36 20 363 36 36) lehet foglalni!";
echo "<br>";
echo "Ha már régebben foglaltál és csak fizetni szeretnél, nyomd meg a fizetés gombot: ";
echo '<form method="get" action="paypal.html" style="display: inline;">';
echo '<button type="submit" style="display: inline;">Fizetés</button>';
echo '</form>';
echo '<p><b><span id="warning">Figyelem!</span> A vezetőülés melletti két hely szűkebb, mint a többi, ezért pl. egy gyereknek és egy felnőttnek javasolt. Két felnőtt nehezen fér el!</b></p>';

echo '<script>
  setInterval(function() {
    var elem = document.getElementById("warning");
    elem.style.visibility = (elem.style.visibility == "hidden") ? "visible" : "hidden";
  }, 500);
</script>';
echo '<form action="booking.php" method="post">';

echo  '<br> Válassz utat: <select name="kodnev" id="kodnev" class="select" required>';
echo    '<option value="">Válassz...</option>';
//echo    '<option value="Szlovakia">febr. 25. Jégtemplom Szlovákia</option>';
//echo    '<option value="Nyíregyháza-Bp">nov. 1. Nyíregyháza-Bp</option>';
//echo    '<option value="Bp-Nyíregyháza">júl. 17. Bp-Nyíregyháza</option>';
//echo    '<option value="Jégtemplom">jan. 14. Jégtemplom Szlovákia</option>';
//echo    '<option value="Velence1">Jan. 26. Velence Karnevál</option>';
//echo    '<option value="Velence2">Febr. 2. Velence Karnevál</option>';

//echo    '<option value="Prága">jún. 3. Prága</option>';

//echo    '<option value="Trieszt">dec. 1. Trieszt - Koper</option>';
//echo    '<option value="Zakopane">Febr. 23. Zakopane</option>';
//echo    '<option value="Firenze">Márc. 1. Firenze</option>';

//echo    '<option value="Velence2">febr. 11. Velence Karnevál</option>';
//echo    '<option value="Trieszt-Koper">ápr. 9. Trieszt, Koper</option>';
//echo    '<option value="Bled">máj. 6. Bled Szlovénia</option>';
//echo    '<option value="Toszkána">máj. 26. Toszkána</option>';
//echo    '<option value="Caorle">júl. 28. Olasz hétvége</option>';
//echo    '<option value="Garda-tó">okt. 13. Garda-tó</option>';

//echo    '<option value="Salzburg">Máj. 18. Salzburg</option>';
//echo    '<option value="Caorle">Jún. 1. Caorle</option>';
//echo    '<option value="Lignano">Júl. 26. Lignano</option>';


//echo    '<option value="Porec">aug. 2. Porec</option>';
//echo    '<option value="Caorle thv">szept. 13. Caorle olasz hétvége</option>';
//echo    '<option value="Farsang Ptuj">Febr. 22. Farsang Ptuj</option>';
//echo    '<option value="Lendva">Jan. 25. Lendva</option>';

//echo    '<option value="Velence 2">Febr. 28. Velencei Karnevál</option>';
echo    '<option value="Plitvice">Márc. 29. Plitvice</option>';
echo    '<option value="Csokigyár és outlet">Ápr. 15. Csokigyár és Pandorf outlet</option>';
echo    '<option value="Róma">Ápr. 17. Róma (Húsvét)</option>';
echo    '<option value="Pünkösd tengerpart">jún. 06. Pünkösd tengerpart</option>';
//echo    '<option value="Mirabilandia 2.">aug. 21. Mirabilandia tábor</option>';
//echo    '<option value="Isztria">júl. 10. Isztria</option>';
//echo    '<option value="Ravenna">aug. 19. Ravenna</option>';
echo  '</select>';

//echo '<input type="submit" value="OK" >';
echo '<button type="submit" id="form-submit" class="pop-button">OK</button>';

echo '</form>';
echo '</center>';
echo '</body>';
echo '</html>';
// ---------- LEKERDEZES ----
$kodnev = $_POST["kodnev"];

if (isset($kodnev)&& kodnev!="nem")
{
$conn = new mysqli('localhost', 'u11035', 'RZMdoGqHGep5', 'u11035');
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

mysqli_select_db($conn, "u1135");

$sql = "SELECT *  FROM idopontok where (kodnev='$kodnev')" ;
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
		echo '<br><b><center>';
        printf ("%s %s \n", $row["datum"], $row["kodnev"]);
		echo '</b>';
		$datum=$row["datum"];
	    $foglalo=$row["foglalo"];
		$teljesar=$row["teljesar"];
		$peznem=$row["penznem"];
        $vek=$row["ek"];
        $vej=$row["ej"];
        $vmb=$row["mb"];
        $vmk=$row["mk"];
        $vmj=$row["mj"];
        $vhb=$row["hb"];
        $vhk=$row["hk"];
        $vhj=$row["hj"];
		echo '<b>';
		printf("%s \n ", "(Teljes összeg:");
		printf ("%s %s %s\n", $row["teljesar"], $row["penznem"] , "/fő)");

		echo '<br>';
		printf("%s \n ", "(Foglaló:");
	    printf ("%s %s %s\n", $row["foglalo"], $row["penznem"] , "/fő)");
		echo '</b></center>';

}

//printf("%s %s %s %s %s %s %s %s %s \n", $vnev, $vek, $vej, $vmb, $vmk, $vmj, $vhb, $vhk, $vhj);
//printf("%s \n", "változók után");



mysqli_free_result($result);

mysqli_close($conn);




echo '<html>';
echo '<head>';
echo '<meta http-equiv="content-type" content="text/html; charset=UTF-8" >';
echo '<title>Utazz Velem ülésfoglalás</title>';
echo '</head>';
echo '<body>';
echo '<center>';
echo '<img src="img/vivaro.png" alt="VIVARO" height="200" width="84">';

echo '<form action="booking2.php" method="post">';
echo '<br>';
echo '<table (border-collapse:collapse; border: 1px solid black)>';

echo '<thead>';
    echo'<tr>';
            echo'<th scope="col"></th>';
			echo'<th scope="col">ülés bal</th>';
            echo'<th scope="col"> ülés közép</th>';
            echo'<th scope="col">ülés jobb</th>';
    echo'</tr>';
    echo'</thead>';
echo '<tr>';
echo '<th scope="row">1. sor</th>';
echo '<td align="right">';
echo 'Vezető ülés';
echo '</td>';
echo '<td align="right">';
if ($vek=="1") {
echo '<input type="checkbox" name="chek">';
}
else {echo 'foglalt';
echo '<input type="hidden" name="chek" value="no"';
}
echo '</td>';
echo '<td align="right">';
if ($vej=="1") {
echo '<input type="checkbox" name="chej" />';
}
else {echo 'foglalt';
echo '<input type="hidden" name="chej" value="no"';}
echo '</td>';
echo '</tr>';
echo '<tr>';
echo '<th scope="row">2. sor</th>';
echo '<td align="right">';
if ($vmb=="1") {
echo '<input type="checkbox" name="chmb" >';
}
else {echo 'foglalt';
echo '<input type="hidden" name="chmb" value="no"';}
echo '</td>';
echo '<td align="right">';
if ($vmk=="1") {
echo '<input type="checkbox" name="chmk" >';
}
else {echo 'foglalt';
echo '<input type="hidden" name="chmk" value="no"';}
echo '</td>';
echo '<td align="right">';
if ($vmj=="1") {
echo '<input type="checkbox" name="chmj" />';
}
else {echo 'foglalt';
echo '<input type="hidden" name="chmj" value="no"';}
echo '</td>';
echo '</tr>';
echo '<tr>';
echo '<th scope="row">3. sor</th>';
echo '<td align="right">';
if ($vhb=="1") {
echo '<input type="checkbox" name="chhb" >';
}
else {echo 'foglalt';
echo '<input type="hidden" name="chhb" value="no"';}
echo '</td>';
echo '<td align="right">';
if ($vhk=="1") {
echo '<input type="checkbox" name="chhk" >';
}
else {echo 'foglalt';
echo '<input type="hidden" name="chhk" value="no"';}
echo '</td>';
echo '<td align="right">';
if ($vhj=="1") {
echo '<input type="checkbox" name="chhj" />';
}
else {echo 'foglalt';
echo '<input type="hidden" name="chhj" value="no"';}
echo '</td>';
echo '</tr>';
echo '</table>';
echo '<input type="hidden" name="chkodnev" value="'.$kodnev.'">';
echo '<input type="hidden" name="chdatum" value="'.$datum.'">';
echo '<input type="hidden" name="chfoglalo" value="'.$foglalo.'">';
echo '<input type="hidden" name="chteljesar" value="'.$leljesar.'">';
echo '<input type="hidden" name="chpenznem" value="'.$penznem.'">';
echo '<br>';
echo ' E-mail cím: <input type="email" name="elerhetoseg" value=""/ required>';
echo ' Név: <input type="name" name="nev" value=""/ required>';
echo ' Telefonszám: <input type="phone" name="telefon" value=""/ required>';
echo ' Beszállás helye: <input type="besz" name="besz" value=""/ required>';
//echo ' Hírlevelet kérek';
//echo '<input type="checkbox" name="hirlev" checked>';
echo '<input type="submit" value="FOGLALÁS" >';

echo '</form>';
echo '</center>';
echo '</body>';
echo '</html>';

}

?>