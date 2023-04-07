<?php

include 'php/db_csat.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:auth/login.php');
};

if(isset($_POST['delete'])){
   $cart_id = $_POST['cart_id'];
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
   $delete_cart_item->execute([$cart_id]);
   $message[] = 'Termék törölve a kosárból!';
}

if(isset($_POST['delete_all'])){
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);
   
   $message[] = 'Kosár kiürítve';
}
$grand_total = 0;

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
<title>Használt Sportszer</title>
<meta http-equiv="Content-type" content="text/html" charset="utf-8">

 
 
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>    
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
      
      
    <!--*****   Kontakt  *****-->
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
    <button type="button" class="btn btn-secondary  disabled">KOSARAM</button>
      

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

  
<h1 class="text-center fw-bold display-1">Bevásárlókocsim</h1>


  
     <!--*****    Bevásárlókocsi tartalma   *****-->           
     <section>
    <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-white bg-secondary" style="border-radius: 25px;">
          <div class="card-body p-md-3">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <h3 class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Kosár tartalma</h3>
                <?php
                  $grand_total = 0;
                  $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                  $select_cart->execute([$user_id]);
                  if($select_cart->rowCount() > 0){
                      while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
                ?>
               <form action="" method="post" class="box">
                <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                <button type="submit" class="btn btn-dark" name="delete" onclick="return confirm('Törli ezt a terméket?');">Termék törlése</button>
                <br><br>
                <img class="card-img-top" src="hirdetes_kepek/<?= $fetch_cart['kep1']; ?>" alt="">
                <div class="name"><?= $fetch_cart['marka']; ?></div>
                <div class="name"><?= $fetch_cart['termektipus']; ?></div>
                <div class="flex">
                  <div><?= $fetch_cart['ar']; ?><span>Ft</span></div>
                  
                </div>
                </form>

                <?php
                        
                      }
                  }else{
                      echo '<h3>A kosara üres</h3>';
                  }
                ?>
                <br>
                
                <br>
                <a href="fizetes.php" class="btn btn-danger submit-button mb-3">Tovább a fizetéshez</a>
        

            
                <form action="" method="post">
                <button type="submit" class="btn btn-dark submit-button mb-3" name="delete_all" onclick="return confirm('Kitröli ezt a kosárból?');">Kosár tartalmának törlése</button>
                <button id="btIndex2" type="button" class="btn btn-dark submit-button">Folytatom a böngészést</button>
                <script type="text/javascript">
                    document.getElementById("btIndex2").onclick = function () {
                        location.href = "index.php";
                    };
                </script>
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