<?php

include 'php/db_csat.php';
include 'php/confirm_email.php';


session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
};

if(isset($_POST['submit'])){

   $nev = $_POST['nev'];
   $nev = filter_var($nev, FILTER_SANITIZE_STRING);
   $telszam = $_POST['telszam'];
   $telszam = filter_var($telszam, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $modszer = $_POST['modszer'];
   $modszer  = filter_var($modszer, FILTER_SANITIZE_STRING);
   $cim = $_POST['cim'];
   $cim = filter_var($cim, FILTER_SANITIZE_STRING);
   $ossz_rendeles = $_POST['ossz_rendeles'];
   $ossz_ar = $_POST['ossz_ar'];

   $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $check_cart->execute([$user_id]);

   if($check_cart->rowCount() > 0){

      if($cim == ''){
         $message[] = 'Kérem adja meg a kiszállítási címet!';
      }else{
         
         $insert_order = $conn->prepare("INSERT INTO `rendelesek`(user_id, nev, telszam, email, modszer, cim, ossz_rendeles, ossz_ar) VALUES(?,?,?,?,?,?,?,?)");
         $insert_order->execute([$user_id, $nev, $telszam, $email, $modszer, $cim, $ossz_rendeles, $ossz_ar]);

         $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
         $delete_cart->execute([$user_id]);

         $message[] = 'Rendelését sikeresen leadta, figyelje az e-mail fiókját!';
      }
      
   }else{
      $message[] = 'A kosara üres';
   }

   
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

 $select_profile = $conn->prepare("SELECT * FROM `felhasznalo` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
              };

?>
<!DOCTYPE html>
<html lang ="hu">
<head>
<title>Használt Sportszer</title>
<meta http-equiv="Content-type" content="text/html" charset="utf-8">

 
 
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>  
   <script src="js/jquery-1.10.2.min.js"></script>   
   <script src="js/script.js"></script>
    

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


<!--*****     Főcím    *****-->    
<h1 class="text-center fw-bold display-1">Rendelés összegzés</h1>

<section>    
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-lg-12 col-xl-11">
            <div class="card text-white bg-secondary" style="border-radius: 25px;">
              <div class="card-body p-md-3">
                <div class="row justify-content-center">
                  <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                      <form action="" method="post">
                          <h2 class="text-center fw-bold">Rendelésem</h2>
                          <br>
                          <div class="table-responsive">
                          <?php
                            $termekDarab = 1; // inicializáljuk a termék sorszámát
                            $grand_total = 0;
                            $cart_items = array();
                            $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                            $select_cart->execute([$user_id]);
                            if($select_cart->rowCount() > 0){
                              while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
                                $cart_items[] = $fetch_cart['marka'].' - '.$fetch_cart['ar'].'Ft / ' ;
                                $total_products = implode($cart_items);
                                $grand_total += ($fetch_cart['ar']);
                          ?>
                          <table class="table text-white">
                            <tbody>
                              <tr>
                                  <td colspan="2" class="fw-bold"><h3 class="text-center fw-bold"> <?= $termekDarab ?>. termék</h3></td> 
                              </tr>
                              <tr>
                                <td>Márka:</td>
                                <td><?= $fetch_cart['marka']; ?></td>
                              </tr>
                              <tr>
                                <td>Típus:</td>
                                <td><?= $fetch_cart['termektipus']; ?></td>
                              </tr>    
                              <tr>
                                <td>Ár:</td>
                                <td><?= $fetch_cart['ar']; ?> Ft</td>
                              </tr>
                              <?php
                                $termekDarab++; // növeljük a termék sorszámát
                              ?>
                            </tbody>
                          </table>
                          <?php
                              }
                            } else {
                              echo '<p class="empty">A kosara üres!</p>';
                            }
                          ?>
                          <table class="table text-white">
                            <tbody>
                              <tr>
                                <td colspan="2" class="fw-bold bg-danger">Rendelés összege: <?= $grand_total; ?>Ft</td>  
                              </tr>
                            </tbody>
                          </table>
                        </div>


                          <a href="bevasarlokocsi.php" class="btn btn-dark mb-5">Kosaram megtekintése, módosítása</a>

                          <h2 class="text-center fw-bold mb-4">Adataim</h2>
                          
                          <div class="table-responsive">
                          <table class="table text-white">
                              <tr>
                                <td>Név:</td>
                                <td><?= $fetch_profile['name']; ?></td>
                              </tr>
                              <tr>
                                <td>Telefonszám:</td>
                                <td><?= $fetch_profile['number']; ?></td>
                              </tr>
                              <tr>
                                <td>E-mail:</td>
                                <td><?= $fetch_profile['email']; ?></td>
                              </tr>
                          </table>
                          </div>
                          <a href="profil_valtoztatas.php" class="btn btn-dark mb-5">Adatok megváltoztatása</a>
                          
                          <h2 class="text-center fw-bold mb-4">Kiszállítás cím</h2>
                          
                          <p><span><?php if($fetch_profile['address'] == ''){echo 'Adja meg a címét';}else{echo $fetch_profile['address'];} ?></span></p>
                          
                          <a href="profil_cim.php" class="btn btn-dark mb-3">Kiszállítási cím módosítása</a>

                          <select name="modszer" class="form-select bg-success text-white mb-3" required>
                            <option value="" disabled selected>Fizetési mód</option>
                            <option value="készpénz">Készpénz</option>
                            <option value="bankkártya">Bankkártya</option>
                            <option value="Revolut">Revolut</option>
                            <option value="Paypal">Paypal</option>
                          </select>

                          <input type="submit" name="submit" value="Rendelés leadása" class="btn btn-danger <?php if($fetch_profile['address'] == ''){echo 'disabled';} ?>">
                          <a href="index.php" class="btn btn-info text-white">Vásárlás folytatása</a>

                            <input type="hidden" name="ossz_rendeles" value="<?= $total_products; ?>">
                            <input type="hidden" name="ossz_ar" value="<?= $grand_total; ?>">
                            <input type="hidden" name="nev" value="<?= $fetch_profile['name'] ?>">
                            <input type="hidden" name="telszam" value="<?= $fetch_profile['number'] ?>">
                            <input type="hidden" name="email" value="<?= $fetch_profile['email'] ?>">
                            <input type="hidden" name="cim" value="<?= $fetch_profile['address'] ?>">
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
