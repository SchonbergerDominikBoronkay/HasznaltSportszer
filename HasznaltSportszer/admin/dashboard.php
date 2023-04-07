<?php

include '../php/db_csat.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

$select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="hu">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Felhasználói felület</title>

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<section class="dashboard">

   <h1 class="heading">Felhasználó felület</h1>

   <div class="box-container">

   <div class="box">
      <h3>Üdvözlöm</h3>
      <p><?= $fetch_profile['name']; ?></p>
      <a href="update_profile.php" class="btn">profil szerkesztése</a>
   </div>

      <div class="box">
      <?php
         $select_products = $conn->prepare("SELECT * FROM `hirdetesek`");
         $select_products->execute();
         $numbers_of_products = $select_products->rowCount();
      ?>
      <h3><?= $numbers_of_products; ?></h3>
      <p>Hírdetések</p>
      <a href="products.php" class="btn">Megnézés</a>
   </div>

   <div class="box">
      <?php
         $select_users = $conn->prepare("SELECT * FROM `felhasznalo`");
         $select_users->execute();
         $numbers_of_users = $select_users->rowCount();
      ?>
      <h3><?= $numbers_of_users; ?></h3>
      <p>Felhasználói fiókok</p>
      <a href="users_accounts.php" class="btn">Megnézés</a>
   </div>

   <div class="box">
      <?php
         $select_admins = $conn->prepare("SELECT * FROM `admin`");
         $select_admins->execute();
         $numbers_of_admins = $select_admins->rowCount();
      ?>
      <h3><?= $numbers_of_admins; ?></h3>
      <p>Adminok</p>
      <a href="admin_accounts.php" class="btn">Megnézés</a>
   </div>

  
   

   </div>

</section>

<script src="../js/admin_script.js"></script>

</body>
</html>