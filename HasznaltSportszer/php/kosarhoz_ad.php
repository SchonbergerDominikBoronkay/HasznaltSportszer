<?php

session_start();
require_once('db_csat.php');
$user_id = $_SESSION['user_id'];
if($user_id = '')
{
   header('location:auth/login.php');
}

if(isset($_POST['add_to_cart'])){

   $hir_id = $_POST['hir_id'];
      $hir_id = filter_var($hir_id, FILTER_SANITIZE_STRING);
      $termektipus = $_POST['termektipus'];
      $termektipus = filter_var($termektipus, FILTER_SANITIZE_STRING);
      $marka = $_POST['marka'];
      $marka = filter_var($marka, FILTER_SANITIZE_STRING);
      $ar = $_POST['ar'];
      $ar = filter_var($ar, FILTER_SANITIZE_STRING);
      $kep1 = $_POST['kep1'];
      $kep1 = filter_var($kep1, FILTER_SANITIZE_STRING);
      
         $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, hir_id, termektipus, marka, ar, kep1) VALUES(?,?,?,?,?,?)");
         $insert_cart->execute([$user_id, $hir_id, $termektipus, $marka, $ar, $kep1]);
         $message[] = 'Kosárhoz hozzáadva!';

   

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
