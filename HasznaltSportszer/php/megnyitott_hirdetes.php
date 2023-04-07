<?php
error_reporting(E_ERROR);
include('kosarhoz_ad.php');

$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'sportszer_ab';


$conn = new mysqli($host, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Nem sikerült csatlakozni az adatbázishoz! " . $conn->connect_error);
}
$hir_id = $_GET['hir_id'];


$query = "SELECT * FROM hirdetesek INNER JOIN allapotok ON allapotok.allapotok_id = hirdetesek.allapotok_id INNER JOIN markak ON markak.markak_id = hirdetesek.markak_id INNER JOIN tipusok ON tipusok.tipusok_id = hirdetesek.tipusok_id INNER JOIN nemek ON nemek.nemek_id = hirdetesek.nemek_id INNER JOIN szinek ON szinek.szinek_id = hirdetesek.szinek_id INNER JOIN sportagak ON sportagak.sportagak_id = hirdetesek.sportagak_id  WHERE id = $hir_id";
$result = mysqli_query($conn, $query);
$fetch_product = mysqli_fetch_assoc($result);

$conn->close();
?>

<!DOCTYPE html>
<html lang ="hu">
<head>
<title>Használt Sportszer</title>
<meta http-equiv="Content-type" content="text/html" charset="utf-8">

 
 
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>  
   <script src="js/jquery-1.10.2.min.js"></script>   

    <link rel="stylesheet" href="../css/style.css" type="text/css" media="all"/>
</head>
<body>

<style>
   .message {
      background-color: #ff0000;
      border: 1px solid #DDDDDD;
      padding: 15px;
      margin: 5px 0;
   }
   .message span {
      color: #FFFFFF;
      font-weight: bold;
      font-size: 30px;
    }
   .message i {
      float: ;
      color: #999999;
      cursor: pointer;
   }
</style>

<!--*****  Header *****-->  
<header>

<div class="navigation btn-group">
    
<!--*****   Vissza gomb  *****-->  
<button type="button" class="btn btn-secondary submit-button" onclick="history.back()">VISSZA</button>
      

<!--*****   Főoldal  *****-->  
<button id="btIndex" type="button" class="btn btn-secondary  submit-button">FŐOLDAL</button>
  <script type="text/javascript">
        document.getElementById("btIndex").onclick = function() 
        {
            location.href = "../index.php";
        };
  </script>

<!--*****   Kontakt  *****-->
<button id="btSegitseg" type="button" class="btn btn-secondary submit-button">KONTAKT</button>
  <script type="text/javascript">
        document.getElementById("btSegitseg").onclick = function() 
        {
            location.href = "../segitseg.php";
        };
  </script>
  
<!--*****   Kosaram  *****-->  
<button id="btKosar" type="button" class="btn btn-secondary  submit-button">KOSARAM</button>
  <script type="text/javascript">
        document.getElementById("btKosar").onclick = function() 
        {
            location.href = "../bevasarlokocsi.php";
        };
  </script>
  
  


  <!--*****   Regisztálás  *****-->
  <button id="btRegisztral" type="button" class="btn btn-secondary  submit-button">REGISZTRÁLÁS</button>
  <script type="text/javascript">
        document.getElementById("btRegisztral").onclick = function() 
        {
            location.href = "registration.php";
        };
  </script>
  
  <!--*****   Hirdetés feltöltés  *****-->
  <button id="btHirdet" type="button" class="btn btn-secondary submit-button">HIRDETÉS FELTÖLTÉSE</button>
      <script type="text/javascript">
            document.getElementById("btHirdet").onclick = function() 
            {
                location.href = "../feltolt.php";
            };
      </script>
      
  <!--*****   Profilom(lenyíló gomb)  *****-->
<button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">PROFILOM</button>
<ul class="dropdown-menu bg-secondary">

  <!--*****   Bejelentkezés  *****-->
  <li><button type="button" class="btn btn-secondary">BEJELENTKEZÉS</button>
  <script type="text/javascript">
        document.getElementById("btProfil").onclick = function() 
        {
            location.href = "login.php";
        };
  </script></li>

  <!--*****   Profilom megtekintése  *****-->
  <li><button id="btProfilMegtekint" type="button" class="btn btn-secondary submit-button">PROFILOM MEGTEKINTÉSE</button>
  <script type="text/javascript">
        document.getElementById("btProfilMegtekint").onclick = function() 
        {
            location.href = "../profile.php";
        };
  </script></li>

  <!--*****   Kijelentkezés  *****-->
  <li><button id="btKilep" type="button" class="btn btn-secondary submit-button">KIJELENTKEZÉS</button>
  <script type="text/javascript">
        document.getElementById("btKilep").onclick = function() 
        {
            location.href = "profil_kijelentkezes.php";
        };
  </script></li>
</ul>
    </div>
    </header>
    
<!--*****      Főcím     *****-->
<h1 class="text-center fw-bold display-1">Kiválasztott termék</h1>

<div class="container">
    <div class="row">
        <div class="card text-white bg-secondary" style="border-radius: 25px;">
          <div class="col-md-6 mx-auto text-center">
            <!--*****    Képek   *****-->  
            <div id="product-carousel" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img class="d-block w-100" src="../hirdetes_kepek/<?= $fetch_product['kep1']; ?>" alt="Nem található a kép">
                </div>
                <?php if (!empty($fetch_product['kep2'])) : ?>
                  <div class="carousel-item">
                    <img class="d-block w-100" src="../hirdetes_kepek/<?= $fetch_product['kep2']; ?>" alt="Nem található a kép">
                  </div>
                <?php endif; ?>
                <?php if (!empty($fetch_product['kep3'])) : ?>
                  <div class="carousel-item">
                    <img class="d-block w-100" src="../hirdetes_kepek/<?= $fetch_product['kep3']; ?>" alt="Nem található a kép">
                  </div>
                <?php endif; ?>
                <?php if (!empty($fetch_product['kep4'])) : ?>
                  <div class="carousel-item">
                    <img class="d-block w-100" src="../hirdetes_kepek/<?= $fetch_product['kep4']; ?>" alt="Nem található a kép">
                  </div>
                <?php endif; ?>
                <?php if (!empty($fetch_product['kep5'])) : ?>
                  <div class="carousel-item">
                    <img class="d-block w-100" src="../hirdetes_kepek/<?= $fetch_product['kep5']; ?>" alt="Nem található a kép">
                  </div>
                <?php endif; ?>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#product-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Előző</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#product-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Következő</span>
              </button>
            </div>
              
            <!--*****      Ár      *****-->    
            <div class="card mt-3">
              <div class="card-body">
                <h2 class="card-title text-dark fw-bold"><?= $fetch_product['ar']; ?> Ft</h2>
              </div>
            </div>
          </div>
          <!--*****      Részletes adatok      *****-->              
          <div class="row mt-4">
          <div class="col-md-6 mx-auto">
            <table class="table">
              <tbody>
                <tr>
                  <td class="fw-bold text-white">Márka:</td>
                  <td class="text-white"><?= $fetch_product['markak_megn']; ?></td>
                </tr>
                <tr>
                  <td class="fw-bold text-white">Állapot:</td>
                  <td class="text-white"><?= $fetch_product['allapotok_megn']; ?></td>
                </tr>
                <tr>
                  <td class="fw-bold text-white">Nem:</td>
                  <td class="text-white"><?= $fetch_product['nemek_megn']; ?></td>
                </tr>
                <tr>
                  <td class="fw-bold text-white">Sportág:</td>
                  <td class="text-white"><?= $fetch_product['sportagak_megn']; ?></td>
                </tr>
                <tr>
                  <td class="fw-bold text-white">Szín:</td>
                  <td class="text-white"><?= $fetch_product['szinek_megn']; ?></td>
                </tr>
                <tr>
                  <td class="fw-bold text-white">Termék típusa:</td>
                  <td class="text-white"><?= $fetch_product['tipusok_megn']; ?></td>
                </tr>
                <tr>
                  <td colspan="2" class="text-white text-center"><?= $fetch_product['leiras']; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
            
          <!--*****      Kosárba helyezés      *****-->              
          <div class="row mt-4 mb-4">
          <div class="col-md-6 mx-auto">
            <form action="" method="post">
              <input type="hidden" name="kep1" value="<?= $fetch_product['kep1']; ?>">
              <input type="hidden" name="hir_id" value="<?= $fetch_product['id']; ?>">
              <input type="hidden" name="marka" value="<?= $fetch_product['markak_megn']; ?>">
              <input type="hidden" name="termektipus" value="<?= $fetch_product['tipusok_megn']; ?>">
              <input type="hidden" name="ar" value="<?= $fetch_product['ar']; ?>">
              <button type="submit" class="btn submit-button" name="add_to_cart"><img src="../css/images/kosar.ico" title="Kosárhoz ad" alt="kosárba"></button>
            </form>
          </div>
        </div>
        </div>
    </div>
</div>
    
    
<!--*****    Footer    *****-->
     <footer id="footerStat">
     <div class="row align-items-center">  
   
        <div class="col">
          <h3 class="ico ico2 ">Elérhetőségek</h3>
            <p>Bármiilyen segítségre van szüksége, kérdése van, keressen fel minket e-mailben (hasznalt.sportszer@gmail.com) vagy akár Facebook oldalunkon. Használja üzenetküldő rendszerünk a
                <a href="../segitseg.php">kontakt</a> fül alatt.</p>
        </div>
          <div class="col">
            <h3 class="ico ico3 ">Ajándék</h3>
              <p>Lepje meg családját, barátját vagy önmagát áron aluli kincsekkel. Önnek csak házhoz kell rendelnie a terméket, a szállítást már mi intézzük.</p>
          </div>
        </div>
    </footer>
    
 </body>
</html>