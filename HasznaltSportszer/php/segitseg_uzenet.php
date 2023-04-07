<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/vendor/autoload.php';



if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
};

if(isset($_POST['email'])) {
   $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
};
if(isset($_POST['name'])) {
   $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
};
if(isset($_POST['number'])) {
   $number = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
};
if(isset($_POST['msg'])) {
   $msg = filter_var($_POST['msg'], FILTER_SANITIZE_STRING);
};

$mail = new PHPMailer(true);


    
    $mail = new \PHPMailer\PHPMailer\PHPMailer();   
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'hasznalt.sportszer@gmail.com';                     
    $mail->Password   = 'wugndpxlognxesmn';                               
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;  
    $mail->CharSet = "UTF-8";                                 

    
    $mail->setFrom('hasznalt.sportszer@gmail.com');
   $mail->addAddress('hasznalt.sportszer@gmail.com');               
    
      $mail->isHTML(true);                              
    $mail->Subject = 'Segítség fülröl érkezett üzenet';
    $mail->Body = "Név: $name <br> Telefonszám: $number <br> Email cím: $email <br> Üzenet: $msg";
    
    $message[] = 'Üzenetét sikeresen elküldte!';

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

    $mail->send();

    header('location:../segitseg.php')
   
?>