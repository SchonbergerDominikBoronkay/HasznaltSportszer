<?php

include 'php/db_csat.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:index.php');
};

if(isset($_POST['submit'])){

   $address = $_POST['ország'] .', '.$_POST['megye'].', '.$_POST['irszám'].', '.$_POST['település'] .', '. $_POST['utca'] .', '. $_POST['hazszam'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);

   $update_address = $conn->prepare("UPDATE `felhasznalo` set address = ? WHERE id = ?");
   $update_address->execute([$address, $user_id]);

   $message[] = 'Cím elmentve!';

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
  <h1 class="text-center fw-bold display-1">Cím módosítása</h1>


    <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-white bg-secondary" style="border-radius: 25px;">
          <div class="card-body p-md-3">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
    
                <form action="" method="post">
                <br>
                <h2 class="text-center fw-bold">Kiszállítási cím</h2>
                <br>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="ország" required maxlength="50" name="ország">
				</div>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="megye" required maxlength="50" name="megye">
				</div>
				<div class="mb-3">
                    <input type="text" class="form-control" placeholder="irányítószám" required maxlength="50" name="irszám">
				</div>
				<div class="mb-3">
                    <input type="text" class="form-control" placeholder="település" required maxlength="50" name="település">
				</div>
				<div class="mb-3">
					<input type="text" class="form-control" placeholder="utca" required maxlength="50" name="utca">
				</div>
				<div class="mb-3">
					<input type="text" class="form-control" placeholder="házszám"  name="hazszam">
				</div>
				<div class="mb-3">
				<input type="submit" value="Módosítás" name="submit" class="btn btn-dark">
                </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
   </div>
    </div>
    
    
    
<!--*****    Footer    *****-->
     <footer id="footerFix">
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
