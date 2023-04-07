<?php

include '../php/db_csat.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
   header('location:../profile.php');
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `felhasznalo` WHERE email = ? AND password = ?");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $_SESSION['user_id'] = $row['id'];
      header('location:../index.php');
   }else{
      $message[] = 'Helytelen email cím vagy jelszó!';
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

?>


<!DOCTYPE html>
<html lang ="hu">
<head>
<title>Használt Sportszer</title>
<meta http-equiv="Content-type" content="text/html" charset="utf-8" />

 
 
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>    
    

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
  <li><button type="button" class="btn btn-secondary  disabled">BEJELENTKEZÉS</button></li>


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
            location.href = "../php/profil_kijelentkezes.php";
        };
  </script></li>
</ul>
    </div>
    </header>

  
<!--*****   Főcím, alcím  *****-->
  <h1 class="text-center fw-bold display-1">Bejelentkezés</h1>
  <p class="text-center display-6">Lépjen be a fiókjába!</p> 



<!--*****   Bejelentkezés szekció   *****-->
<section>
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-8">
        <div class="card text-white bg-secondary" style="border-radius: 25px;">
          <div class="card-body p-md-3">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <h3 class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Belépés</h3>
                  <!--*****  Email  *****-->
                <form class="mx-1 mx-md-4" action="" method="post"> 
                   <div class="d-flex flex-row align-items-center mb-4">
                    <div class="form-outline flex-fill mb-0">
                    <input type="email" class="form-control" name="email" required placeholder="valami@szolgaltato.com" oninput="this.value = this.value.replace(/\s/g, '')">
                      <label class="form-label">E-mail</label>
                    </div>
                  </div>      
                 <!--*****  Jelszó  *****-->
                   <div class="d-flex flex-row align-items-center mb-4">
                    <div class="form-outline flex-fill mb-0">
                        <input type="password" class="form-control" name="pass" required placeholder="Jelszó" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
                        <label class="form-label">Jelszó</label>
                    </div>
                  </div>
                    
                   <!--***** Belépés gomb *****-->
                  <div class="d-flex justify-content-center mx-3 mb-3 mb-lg-4">
                  <input type="submit" value="Belépek" name="submit" class="form-control bg-dark text-white">
                  </div>
                  <h3>Nincs fiókja?<br><br> <a href="registration.php">Regisztráljon!</a></h3>
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
     <footer id="footerFix">
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

















