<?php
     error_reporting(E_ERROR); 
  ob_start(); 
  require_once('php/db_csat.php');

  session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

  include 'php/kosarhoz_ad.php';
?>

<!DOCTYPE html>
<html lang ="hu">
<head>
<title>Használt Sportszer</title>
<meta http-equiv="Content-type" content="text/html" charset="utf-8">

 
 
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>  
   <script src="js/jquery-1.10.2.min.js"></script>   
      
    

    <link rel="stylesheet" href="css/style.css" type="text/css" media="all"/>
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
    
<!--*****   Header  *****--> 
  <header>
  <div class="navigation btn-group">
    
    <!--*****   Vissza gomb  *****-->  
    <button type="button" class="btn btn-secondary submit-button" onclick="history.back()">VISSZA</button>
      
    <!--*****   Főoldal  *****-->  
    <button type="button" class="btn btn-secondary  disabled">FŐOLDAL</button>
    
    <!--*****   Kontakt  *****-->
    <button id="btSegitseg" type="button" class="btn btn-secondary submit-button">KONTAKT</button>
      <script type="text/javascript">
            document.getElementById("btSegitseg").onclick = function() 
            {
                location.href = "segitseg.php";
            };
      </script>
      
    <!--*****   Kosaram  *****-->  
    <button id="btKosar" type="button" class="btn btn-secondary  submit-button">KOSARAM</button>
      <script type="text/javascript">
            document.getElementById("btKosar").onclick = function() 
            {
                location.href = "bevasarlokocsi.php";
            };
      </script>

      <!--*****   Regisztrálás  *****-->
   <button id="btRegisztral" type="button" class="btn btn-secondary  submit-button">REGISZTRÁLÁS</button>
      <script type="text/javascript">
            document.getElementById("btRegisztral").onclick = function() 
            {
                location.href = "auth/registration.php";
            };
      </script>

    <!--*****   Hirdetés feltöltés  *****-->
   <button id="btHirdet" type="button" class="btn btn-secondary submit-button">HIRDETÉS FELTÖLTÉSE</button>
      <script type="text/javascript">
            document.getElementById("btHirdet").onclick = function() 
            {
                location.href = "feltolt.php";
            };
      </script> 

   <!--*****   Profilom(lenyíló gomb)  *****-->
    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">PROFILOM</button>
    <ul class="dropdown-menu bg-secondary">

      <!--*****   Bejelentkezés  *****-->
      <li><button id="btProfil" type="button" class="btn btn-secondary submit-button">BEJELENTKEZÉS</button>
      <script type="text/javascript">
            document.getElementById("btProfil").onclick = function() 
            {
                location.href = "auth/login.php";
            };
      </script></li>

      <!--*****   Profilom megtekintése  *****-->
      <li><button id="btProfilMegtekint" type="button" class="btn btn-secondary submit-button">PROFILOM MEGTEKINTÉSE</button>
      <script type="text/javascript">
            document.getElementById("btProfilMegtekint").onclick = function() 
            {
                location.href = "profile.php";
            };
      </script></li>

       <!--*****   Kijelentkezés  *****-->
       <li><button id="btKilep" type="button" class="btn btn-secondary submit-button">KIJELENTKEZÉS</button>
      <script type="text/javascript">
            document.getElementById("btKilep").onclick = function() 
            {
                location.href = "php/profil_kijelentkezes.php";
            };
      </script></li>
    </ul>
    </div>
    </header>


<!--*****  Cím, alcím  *****-->  
  <h1 class="text-center fw-bold display-1">Használt sportszer</h1>

  <p class="text-center display-6">Meg szeretne válni a feleslegessé vált sportcuccoktól? Mi segítünk! Töltse fel, adja el amit már nem használ!</p> 
  

<!--*****   Kezdőképek   *****-->       
    <div id="iranyjelzo" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
          
        <div class="carousel-item active">
          <img src="css/images/kezdokepek/penz.jpg" alt="img1" class="d-block" style="width:100%">
        </div>

        <div class="carousel-item">
          <img src="css/images/kezdokepek/ugyfel.jpg" alt="img2" class="d-block" style="width:100%">
        </div> 
      
        
        <div class="carousel-item">  
          <img src="css/images/kezdokepek/sportok.jpg" alt="img3" class="d-block" style="width:100%">
        </div>
      
      
      <!-- Left and right controls/icons -->
      <button class="carousel-control-prev" type="button" data-bs-target="#iranyjelzo" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#iranyjelzo" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
          
      <!-- Indicators/dots -->
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#iranyjelzo" data-bs-slide-to="0" class="active"></button>
        <button class="btIranyjelzo" type="button" data-bs-target="#iranyjelzo" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#iranyjelzo" data-bs-slide-to="2"></button>
      </div>
      </div>
      </div> 
    
        

<!--*****     Szűrések    *****--> 
  <div class="container-fluid">
    <br><br>
         <h2 class="text-center">Szűrési lehetőségek</h2><br>
          <h3>Állítson be szűrőket a hatékonyabb keresésért!</h3>

  <!--***** Sportág *****-->
        <div class="card-group bg-secondary">
            <div class="column">
            <div class="card bg-secondary  h-100">
              <h3 class="card-title ">Sportág</h3>
              <form action="#" method="post">
                <br>
                <select name="sportag" class="form-control" required>
                  <option value="" disabled selected>...</option>
                  <?php
                      // SQL-lekérdezés végrehajtása
                      $sql = "SELECT sportagak_id, sportagak_megn FROM sportagak";
                      $result = $conn->query($sql);

                      // Select mező feltöltése az adatokkal
                      if ($result->rowCount() > 0) {
                          while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                              echo "<option value='" . $row["sportagak_id"] . "'>" . $row["sportagak_megn"] . "</option>";
                          }
                      }
                  ?>
                </select>
               </form>
                </div>
            </div>
            
   <!--***** Minimum ár *****-->                  
            <div class="column">
            <div class="card bg-secondary  h-100">
              <h3 class="card-title ">Minimum</h3>
              <label for="minimum">Ft-tól:</label>
                    <input class="form-control form-control-sm" type="number" id="price_min" name="price_min" min="0"><br>
            </div>
            </div>  
            
            <br>

   <!--***** Maximum ár *****-->
            <div class="column">
            <div class="card bg-secondary  h-100">
              <h3 class="card-title ">Maximum</h3>
              <label for="maximum">Ft-tól:</label>
              <input class="form-control form-control-sm" type="number" id="price_max" name="price_max" min="0">
            </div>
            </div>  
            
   <!--***** Nem *****-->          
        <div class="column">
            <div class="card bg-secondary  h-100">
              <h3 class="card-title ">Férfi/Női</h3>
              <form action="#" method="post">
                <br>
                <select name="nem" class="form-control" required>
                  <option value="" disabled selected>...</option>
                  <?php         
                      // SQL-lekérdezés végrehajtása
                      $sql = "SELECT nemek_id, nemek_megn FROM nemek";
                      $result = $conn->query($sql);

                      // Select mező feltöltése az adatokkal
                      if ($result->rowCount() > 0) {
                          while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                              echo "<option value='" . $row["nemek_id"] . "'>" . $row["nemek_megn"] . "</option>";
                          }
                      }
                  ?>
                </select>
        </form>
              </div>
            </div>
            
   <!--***** Márka *****-->          
            <div class="column">
            <div class="card bg-secondary  h-100">
              <h3 class="card-title ">Márka</h3>
              <form method="post">
                <br>
            <select id="marka" name="marka" class="form-control">
            <option value="" disabled selected>...</option>
                    <?php
                      // SQL-lekérdezés végrehajtása
                      $sql = "SELECT markak_id, markak_megn FROM markak";
                      $result = $conn->query($sql);

                      // Select mező feltöltése az adatokkal
                      if ($result->rowCount() > 0) {
                          while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                              echo "<option value='" . $row["markak_id"] . "'>" . $row["markak_megn"] . "</option>";
                          }
                      }  
                  ?>
                </select>
                </form>
                </div>
            </div>
            
            <br>
            
   <!--***** Szín *****-->          
            <div class="column">
            <div class="card bg-secondary  h-100">
              <h3 class="card-title">Szín</h3>
              <form action="#" method="post">
                <br>
                <select name="szin" class="form-control" required>
                  <option value="" disabled selected>...</option>
                  <?php
                      // SQL-lekérdezés végrehajtása
                      $sql = "SELECT szinek_id, szinek_megn FROM szinek";
                      $result = $conn->query($sql);

                      // Select mező feltöltése az adatokkal
                      if ($result->rowCount() > 0) {
                          while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                              echo "<option value='" . $row["szinek_id"] . "'>" . $row["szinek_megn"] . "</option>";
                          }
                      }
                  ?>
                </select>  
              </form>
                </div>
            </div>
            
            <br>
            
   <!--***** Állapot *****-->          
            <div class="column">
            <div class="card bg-secondary  h-100">
              <h3 class="card-title">Állapot</h3>
              <form action="#" method="post">
                <br>
                <select name="allapot" class="form-control" required>
                  <option value="" disabled selected>...</option>
                  <?php
                      // SQL-lekérdezés végrehajtása
                      $sql = "SELECT allapotok_id, allapotok_megn FROM allapotok";
                      $result = $conn->query($sql);

                      // Select mező feltöltése az adatokkal
                      if ($result->rowCount() > 0) {
                          while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                              echo "<option value='" . $row["allapotok_id"] . "'>" . $row["allapotok_megn"] . "</option>";
                          }
                      } 
                  ?>
                </select>
              </form>
                </div>
            </div>
            
            <br>
            
   <!--***** Terméktípus *****-->          
            <div class="column">
            <div class="card bg-secondary  h-100">
              <h3 class="card-title">Típus</h3>
              <form action="#" method="post">
                <br>
                <select name="termektipus" class="form-control" required>
                <option value="" disabled selected>...</option>
                <?php
                    // SQL-lekérdezés végrehajtása
                    $sql = "SELECT tipusok_id, tipusok_megn FROM tipusok";
                    $result = $conn->query($sql);

                    // Select mező feltöltése az adatokkal
                    if ($result->rowCount() > 0) {
                        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $row["tipusok_id"] . "'>" . $row["tipusok_megn"] . "</option>";
                        }
                    }

                ?>
                </select>
              </form>
                </div>
            </div>
            </div>
      </div> 
      
 <!--***** Szűrés *****-->    
  <div class="row">
  <div class="mx-auto col-10 col-md-8 col-lg-6">
    <br>
     <input class="form-control bg-secondary text-white text-center" id="szures" type="submit" value="Szűrés">
     </div>
     </div>
     
    <br>

 <br>


<!--*****    Hirdetések    *****-->
    
    <h2 class="text-center">Elérhető Hirdetések</h2><br>
    <div class="container-fluid">
  <div class="row">
    <?php
      $show_products = $conn->prepare("SELECT * FROM `hirdetesek` INNER JOIN markak ON hirdetesek.markak_id = markak.markak_id INNER JOIN tipusok ON hirdetesek.tipusok_id = tipusok.tipusok_id;");
      $show_products->execute();
      if($show_products->rowCount() > 0){
         while($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)){  
    ?>
    
    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
      <div class="card-deck">
        <div class="card">
          <form method="post" action="">
            <img class="card-img-top" src="hirdetes_kepek/<?= $fetch_products['kep1']; ?>" alt="">
            <div class="card-body bg-secondary">
              <input type="hidden" name="kep1" value="<?= $fetch_products['kep1']; ?>">
              <input type="hidden" name="hir_id" value="<?= $fetch_products['id']; ?>">
              <input type="hidden" name="termektipus" value="<?= $fetch_products['tipusok_megn']; ?>">
              <input type="hidden" name="marka" value="<?= $fetch_products['markak_megn']; ?>">
              <input type="hidden" name="ar" value="<?= $fetch_products['ar']; ?>">
              <h1 class="card-title name text-dark"><?= $fetch_products['ar'];?> Ft</h1>
                <h2 class="card-title name"><?= $fetch_products['markak_megn']; ?></h2> 
              <br>
              <h3><?= $fetch_products['tipusok_megn']; ?></h3>
              <br>
              <p class="card-text"><?= $fetch_products['leiras']; ?></p>
              <a href="php/megnyitott_hirdetes.php?hir_id=<?= $fetch_products['id']; ?>" class="btn btn-dark">Bővebben...</a>
              <button type="submit" class="btn submit-button" name="add_to_cart"><img src="css/images/kosar.ico" title="Kosárhoz ad" alt="kosárba"></button>
            </div>
          </form>
                
        </div>
      </div>
    </div>
    
    <?php
        }
      }else{
         echo '<p class="empty text-center">Nincs még feltöltve hirdetés!</p>';
      }
    ?>
  </div>
  </div>

  <style>
   .empty{
      background-color: #ff0000;
      border: 1px solid #DDDDDD;
      padding: 10px;
      font-style: bold;
      }
     </style>




<!--*****    Footer    *****-->
     <footer id="footerStat">
     <div class="row align-items-center">  
   
        <div class="col">
          <h3>Elérhetőségek</h3>
            <p>Bármiilyen segítségre van szüksége, kérdése van, keressen fel minket e-mailben (hasznalt.sportszer@gmail.com) vagy akár Facebook oldalunkon. Használja üzenetküldő rendszerünk a
                <a href="segitseg.php">kontakt</a> fül alatt.</p>
        </div>
          <div class="col">
            <h3>Ajándék</h3>
              <p>Lepje meg családját, barátját vagy önmagát áron aluli kincsekkel. Önnek csak házhoz kell rendelnie a terméket, a szállítást már mi intézzük.</p>
          </div>
        </div>
    </footer>

            
    
</body>
</html>
<?php
  ob_end_flush(); 
?>
