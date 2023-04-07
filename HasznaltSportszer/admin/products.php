<?php

include '../php/db_csat.php';

if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
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
      $image_folder = '../hirdetes_kepek/' . $image_name;
    
      move_uploaded_file($image_tmp_name, $image_folder);
      
      
      $image_array[] = $image_name;
    }

   

   move_uploaded_file($image_tmp_name, $image_folder);
   $insert_product = $conn->prepare("INSERT INTO `hirdetesek`(allapotok_id, markak_id, nemek_id, sportagak_id, szinek_id, tipusok_id, ar, leiras, kep1, kep2, kep3, kep4, kep5) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
   $insert_product->execute([$allapot, $marka, $nem, $sportag, $szin, $termektipus, $ar, $leiras, $image_array[0], $image_array[1], $image_array[2], $image_array[3], $image_array[4]]);

   $message[] = 'Új hírdetés hozzáadva!';}

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `hirdetesek` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../hirdetes_kepek/'.$fetch_delete_image['kep1']);
   unlink('../hirdetes_kepek/'.$fetch_delete_image['kep2']);
   unlink('../hirdetes_kepek/'.$fetch_delete_image['kep3']);
   unlink('../hirdetes_kepek/'.$fetch_delete_image['kep4']);
   unlink('../hirdetes_kepek/'.$fetch_delete_image['kep5']);
   $delete_product = $conn->prepare("DELETE FROM `hirdetesek` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE hir_id = ?");
   $delete_cart->execute([$delete_id]);
   header('location:products.php');

}

?>

<!DOCTYPE html>
<html lang="hu">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Hírdetések</title>
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<section class="add-products">
   
   <form action="" method="POST" enctype="multipart/form-data">
   <h3>Hírdetés feltöltése</h3> 
   <select name="marka" class="box" required>
                  <option value="" disabled selected>Márka</option>
                  <?php
                      
                      
                      $sql = "SELECT markak_id, markak_megn FROM markak";
                      $result = $conn->query($sql);

                      
                      if ($result->rowCount() > 0) {
                          while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                              echo "<option value='" . $row["markak_id"] . "'>" . $row["markak_megn"] . "</option>";
                          }
                      }
                  ?>
                  </select>
                  
                  <select name="sportag" class="box" required>
                  <option value="" disabled selected>Sportág</option>
                  <?php
                      
                      $sql = "SELECT sportagak_id, sportagak_megn FROM sportagak";
                      $result = $conn->query($sql);

                      
                      if ($result->rowCount() > 0) {
                          while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                              echo "<option value='" . $row["sportagak_id"] . "'>" . $row["sportagak_megn"] . "</option>";
                          }
                      }

                  ?>
                </select>
                
                <select name="szin" class="box" required>
                  <option value="" disabled selected>Termékszín</option>
                  <?php

                      
                      $sql = "SELECT szinek_id, szinek_megn FROM szinek";
                      $result = $conn->query($sql);

                      
                      if ($result->rowCount() > 0) {
                          while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                              echo "<option value='" . $row["szinek_id"] . "'>" . $row["szinek_megn"] . "</option>";
                          }
                      }
                  ?>
                </select>
                
                <select name="termektipus" class="box" required>
                <option value="" disabled selected>Terméktípus</option>
                <?php
                   
                    $sql = "SELECT tipusok_id, tipusok_megn FROM tipusok";
                    $result = $conn->query($sql);

                    
                    if ($result->rowCount() > 0) {
                        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $row["tipusok_id"] . "'>" . $row["tipusok_megn"] . "</option>";
                        }
                    }

                ?>
                </select>
   <input type="number" min="0" max="9999999999" required placeholder="Adja meg a termék árát" name="ar" onkeypress="if(this.value.length == 10) return false;" class="box">
   <textarea name="leiras" class="box" required placeholder="Termék leírás röviden" maxlength="500" cols="30" rows="10"></textarea>
   <select name="nem" class="box" required>
                  <option value="" disabled selected>Nemek</option>
                  <?php
                      
                      $sql = "SELECT nemek_id, nemek_megn FROM nemek";
                      $result = $conn->query($sql);

                      
                      if ($result->rowCount() > 0) {
                          while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                              echo "<option value='" . $row["nemek_id"] . "'>" . $row["nemek_megn"] . "</option>";
                          }
                      }
                  ?>
                </select>
                
                <select name="allapot" class="box" required>
                  <option value="" disabled selected>Állapot</option>
                  <?php
                      
                      $sql = "SELECT allapotok_id, allapotok_megn FROM allapotok";
                      $result = $conn->query($sql);

                      
                      if ($result->rowCount() > 0) {
                          while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                              echo "<option value='" . $row["allapotok_id"] . "'>" . $row["allapotok_megn"] . "</option>";
                          }
                      }

                      
                      
                  ?>
                  </select>
   <input type="file" name="kep1" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
   <input type="file" name="kep2" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
   <input type="file" name="kep3" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
   <input type="file" name="kep4" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
   <input type="file" name="kep5" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
   <input type="submit" value="Feltöltés" name="add_product" class="btn">
   </form>

</section>



<section class="show-products" style="padding-top: 0;">

   <div class="box-container">

   <?php
      $show_products = $conn->prepare("SELECT * FROM hirdetesek INNER JOIN allapotok ON allapotok.allapotok_id = hirdetesek.allapotok_id INNER JOIN markak ON markak.markak_id = hirdetesek.markak_id INNER JOIN tipusok ON tipusok.tipusok_id = hirdetesek.tipusok_id INNER JOIN nemek ON nemek.nemek_id = hirdetesek.nemek_id INNER JOIN szinek ON szinek.szinek_id = hirdetesek.szinek_id INNER JOIN sportagak ON sportagak.sportagak_id = hirdetesek.sportagak_id;");
      $show_products->execute();
      if($show_products->rowCount() > 0){
         while($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <div class="box">
      <img src="../hirdetes_kepek/<?= $fetch_products['kep1']; ?>" alt="">
      <img src="../hirdetes_kepek/<?= $fetch_products['kep2']; ?>" alt="">
      <img src="../hirdetes_kepek/<?= $fetch_products['kep3']; ?>" alt="">
      <img src="../hirdetes_kepek/<?= $fetch_products['kep4']; ?>" alt="">
      <img src="../hirdetes_kepek/<?= $fetch_products['kep5']; ?>" alt="">
      <div class="flex">
         <div class="price"><?= $fetch_products['ar']; ?><span>Ft</span></div>
         <div class="category"><?= $fetch_products['nemek_megn']; ?></div>
         <div class="category"><?= $fetch_products['szinek_megn']; ?></div>
      </div>
      <div class="name"><?= $fetch_products['markak_megn']; ?></div>
      <div class="name"><?= $fetch_products['sportagak_megn']; ?></div>
      <div class="name"><?= $fetch_products['tipusok_megn']; ?></div>
      <div class="name"><?= $fetch_products['allapotok_megn']; ?></div>
      <div class="name"><?= $fetch_products['leiras']; ?></div>
      <div class="flex-btn">
         <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Kitörli ezt a hírdetést?');">Törlés</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">Nincs még feltöltve hírdetés!</p>';
      }
   ?>

   </div>

</section>
<script src="../js/admin_script.js"></script>

</body>
</html>