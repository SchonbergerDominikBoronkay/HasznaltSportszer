<?php

include 'php/db_csat.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:auth/login.php');
};

if(isset($_POST['add_product'])){

   $allapot = $_POST['allapot'];
   $allapot = filter_var($allapot, FILTER_SANITIZE_STRING);
   $marka = $_POST['marka'];
   $marka = filter_var($marka, FILTER_SANITIZE_STRING);
   $nem = $_POST['nem'];
   $nem = filter_var($nem, FILTER_SANITIZE_STRING);
   $sportag = $_POST['sportag'];
   $sportag = filter_var($sportag, FILTER_SANITIZE_STRING);
   $szin = $_POST['szin'];
   $szin = filter_var($szin, FILTER_SANITIZE_STRING);
   $termektipus = $_POST['termektipus'];
   $termektipus = filter_var($termektipus, FILTER_SANITIZE_STRING);
   $ar = $_POST['ar'];
   $ar = filter_var($ar, FILTER_SANITIZE_STRING);
   $leiras = $_POST['leiras'];
   $leiras = filter_var($leiras, FILTER_SANITIZE_STRING);

  
for ($i = 1; $i <= 5; $i++) {
  $input_name = 'kep' . $i;
  $image_name = $_FILES[$input_name]['name'];
  $image_name = filter_var($image_name, FILTER_SANITIZE_STRING);
  $image_size = $_FILES[$input_name]['size'];
  $image_tmp_name = $_FILES[$input_name]['tmp_name'];
  $image_folder = 'hirdetes_kepek/' . $image_name;

  move_uploaded_file($image_tmp_name, $image_folder);
  
  
  $image_array[] = $image_name;
}


$insert_product = $conn->prepare("INSERT INTO `hirdetesek`(allapotok_id, markak_id, nemek_id, sportagak_id, szinek_id, tipusok_id, ar, leiras, kep1, kep2, kep3, kep4, kep5) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
$insert_product->execute([$allapot, $marka, $nem, $sportag, $szin, $termektipus, $ar, $leiras, $image_array[0], $image_array[1], $image_array[2], $image_array[3], $image_array[4]]);

$message[] = 'új hirdetés hozzáadva!'; }

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `hirdetesek` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('hirdetes_kepek/'.$fetch_delete_image['kep1']);
   unlink('hirdetes_kepek/'.$fetch_delete_image['kep2']);
   unlink('hirdetes_kepek/'.$fetch_delete_image['kep3']);
   unlink('hirdetes_kepek/'.$fetch_delete_image['kep4']);
   unlink('hirdetes_kepek/'.$fetch_delete_image['kep5']);
   $delete_product = $conn->prepare("DELETE FROM `hirdetesek` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   header('location:index.php');

}

if(isset($message)){
  foreach($message as $message){
    echo '
    <div class="message text-center">
  <span>'.$message.'</span>
  <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
</div>
    ';
  }
}

?>

<!DOCTYPE html>
<html lang ="hu">
<head>
<title>Hirdetés feltöltése</title>
<meta http-equiv="Content-type" content="text/html" charset="utf-8" />

 
 
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>    
        
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
                location.href = "index.php";
            };
      </script>
    
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
   
      <!--*****   Regisztálás  *****-->
      <button id="btRegisztral" type="button" class="btn btn-secondary  submit-button">REGISZTRÁLÁS</button>
      <script type="text/javascript">
            document.getElementById("btRegisztral").onclick = function() 
            {
                location.href = "auth/registration.php";
            };
      </script>
      
      <!--*****   Hirdetés feltöltés  *****-->    
      <button type="button" class="btn btn-secondary  disabled">HIRDETÉS FELTÖLTÉSE</button>

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





<!--*****   Főcím, alcím  *****-->
    <h1 class="text-center fw-bold display-1">Hirdetés feltöltése</h1>
    <p class="text-center display-6">Nem hordja? Adja el!</p> 

<!--*****   Hirdetés feltöltési szekció  *****-->    
<section>
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-white bg-secondary" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <h3 class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-2">Hirdetés feltöltése</h3>

                <form class="mx-1 mx-md-4" action="" method="POST" enctype="multipart/form-data">

 <!--***** Márka *****-->
                  <div class="d-flex flex-row align-items-center mb-4">
                  <div class="form-outline flex-fill mb-0">
                      <select name="marka" class="form-control" required>
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
                  <label class="form-label">Adja meg a márkát!</label>
                  </div>
                  </div>
 <!--***** Sportág *****-->
                  <div class="d-flex flex-row align-items-center mb-4">
                  <div class="form-outline flex-fill mb-0">
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
                <label class="form-label">Adja meg a sportágat!</label>
                </div>
                </div>
<!--***** Szín *****-->
                  <div class="d-flex flex-row align-items-center mb-4">
                  <div class="form-outline flex-fill mb-0">
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
                <label class="form-label">Adja meg a domináns színt!</label>
                </div>
                </div>
<!--***** Terméktípus *****-->
                <div class="d-flex flex-row align-items-center mb-4">
                <div class="form-outline flex-fill mb-0">
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
                <label class="form-label">Adja meg a termék típusát!</label>
                </div>
                </div>

<!--***** Ár *****-->
                  <div class="d-flex flex-row align-items-center mb-4">
                    <div class="form-outline flex-fill mb-0">
                    <input type="number" class="form-control" name="ar" required placeholder="Ft" min="0" onkeypress="if(this.value.length == 10) return false;">
                      <label class="form-label">Adja meg az árat!</label>
                    </div>
                  </div>

<!--*****   Leírás  *****-->
                  <div class="d-flex flex-row align-items-center mb-4">
                    <div class="form-outline flex-fill mb-0">
                <textarea name="leiras" class="form-control" required placeholder="Rövid leírás" maxlength="500" cols="30" rows="10"></textarea>
                      <label class="form-label">Adja meg a termék leírását!</label>
                      </div>
                      </div>

<!--*****  Nem  *****-->
                  <div class="d-flex flex-row align-items-center mb-4">
                  <div class="form-outline flex-fill mb-0">
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
                <label class="form-label">Adja meg a nemet!</label>
                </div>
                </div>
                  
<!--*****  Állapot  *****-->
                  <div class="d-flex flex-row align-items-center mb-4">
                  <div class="form-outline flex-fill mb-0">
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

                      // Adatbázis-kapcsolat lezárása
                      $conn = null;
                  ?>
                  </select>
                  <label class="form-label">Adja meg a termék állapotát!</label>
                  </div>
                  </div>

<!--*****   Képek(fájlból)  *****-->
                <input type="file" name="kep1" class="form-control" accept="image/jpg, image/jpeg, image/png, image/webp">
                  <label class="form-label">1. kép</label>
                <input type="file" name="kep2" class="form-control" accept="image/jpg, image/jpeg, image/png, image/webp">
                  <label class="form-label">2. kép</label>
                <input type="file" name="kep3" class="form-control" accept="image/jpg, image/jpeg, image/png, image/webp">
                  <label class="form-label">3. kép</label>
                <input type="file" name="kep4" class="form-control" accept="image/jpg, image/jpeg, image/png, image/webp">
                  <label class="form-label">4. kép</label>
                <input type="file" name="kep5" class="form-control" accept="image/jpg, image/jpeg, image/png, image/webp">
                  <label class="form-label">5. kép</label>

<!--***** Feltölt gomb *****-->
                <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                <input type="submit" value="Feltöltés" name="add_product" class="form-control bg-dark text-white">
                </div>
                </form>

              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>



 
<!--*****    Footer    *****-->
     <footer id="footerStat">
     <div class="row align-items-center">  
   
        <div class="col">
          <h3 class="ico ico2 ">Elérhetőségek</h3>
            <p>Bármiilyen segítségre van szüksége, kérdése van, keressen fel minket e-mailben (hasznalt.sportszer@gmail.com) vagy akár Facebook oldalunkon. Használja üzenetküldő rendszerünk a
                <a href="segitseg.php">kontakt</a> fül alatt.</p>
        </div>
          <div class="col">
            <h3 class="ico ico3 ">Ajándék</h3>
              <p>Lepje meg családját, barátját vagy önmagát áron aluli kincsekkel. Önnek csak házhoz kell rendelnie a terméket, a szállítást már mi intézzük.</p>
          </div>
        </div>
    </footer>


    </body>
</html>
