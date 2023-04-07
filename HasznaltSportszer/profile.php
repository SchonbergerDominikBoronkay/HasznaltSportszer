<?php

include 'php/db_csat.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:auth/login.php');
};

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
<meta http-equiv="Content-type" content="text/html" charset="utf-8" />

 
 
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
   <li><button type="button" class="btn btn-secondary  disabled">PROFILOM MEGTEKINTÉSE</button></li>
   

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
     
            

<!--*****   Főcím   *****-->
   <h1 class="text-center fw-bold display-1">Személyes profilom</h1>
   
   

<section>
      <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
            <div class="card text-white bg-secondary" style="border-radius: 25px;">
            <div class="card-body p-md-3">
                  <div class="row justify-content-center">
                  <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                  <h3 class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Adataim</h3>

                  <table class="table table-borderless text-white">
                  <tbody>
                  <tr>
                        <td>Név</td>
                        <td class="text-dark fw-bold"><?= $fetch_profile['name']; ?></td>
                  </tr>
                  <tr>
                        <td>E-mail</td>
                        <td class="text-dark fw-bold"><?= $fetch_profile['email']; ?></td>
                  </tr>
                  <tr>
                        <td>Telefonszám</td>
                        <td class="text-dark fw-bold"><?= $fetch_profile['number']; ?></td>
                  </tr>
                  <tr>
                        <td>Kiszállítási cím</td>
                        <td class="text-dark fw-bold"><?= $fetch_profile['address']; ?></td>
                  </tr>
                  
                  </tbody>
                  </table>
                      
                    <div class="button-group">
                      <button type="button" class="btn submit-button bg-dark"><a href="profil_valtoztatas.php" class="text-white">Adatok módosítása</a></button>
                      <button type="button" class="btn submit-button bg-dark"><a href="profil_cim.php" class="text-white">Cím módosítása</a></button>
                    </div>  


                    </div>
                </div>
          </div>
          </div>
          </div>
        </div>
        </div>
</section>


<!--*****    Footer    *****-->
     <footer id="footerFix">
     <div class="row align-items-center">  
   
        <div class="col">
          <h3 class="ico ico2 ">Elérhetőségek</h3>
            <p>Bármiilyen segítségre van szüksége, kérdése van, keressen fel minket e-mailben (hasznlt.sportszer@gmail.com) vagy akár Facebook oldalunkon. Használja üzenetküldő rendszerünk a
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













