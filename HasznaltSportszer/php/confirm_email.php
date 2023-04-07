<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/vendor/autoload.php';



if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
};

if(isset($_POST['email'])) {
   $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
  
   
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

    
    $mail->setFrom('hasznalt.sportszer@gmail.com', 'Használt Sportszer Webshop');
   $mail->addAddress($email);               
    

    
   $mail->AddEmbeddedImage('images/image-1.png', 'my-facebook', 'image-1.png'); 
    $mail->AddEmbeddedImage('images/image-2.jpeg', 'my-logo', 'image-2.jpg'); 
    $mail->AddEmbeddedImage('images/image-3.png', 'my-github', 'image-3.png');      
       

    
    $mail->isHTML(true);                                  
    $mail->Subject = 'Rendelés igazolás';
    $mail->Body = '<table id="u_body" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #f7f7f7;width:100%" cellpadding="0" cellspacing="0">
    <tbody>
    <tr style="vertical-align: top">
      <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
      
      
  
  <div class="u-row-container" style="padding: 0px;background-color: transparent">
    <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #111111;">
      <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
       
        
 
  <div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
    <div style="height: 100%;width: 100% !important;">
    
    
  <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
    <tbody>
      <tr>
        <td style="overflow-wrap:break-word;word-break:break-word;padding:20px 10px;font-family:arial,helvetica,sans-serif;" align="left">
          
  <table width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr>
      <td style="padding-right: 0px;padding-left: 0px;" align="center">
        
       <img alt="logo" src="cid:my-logo" alt="Logo" title="Logo" align="center" border="0" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 530px;" width="530"/>
        
      </td>
    </tr>
  </table>
  
        </td>
      </tr>
    </tbody>
  </table>
  
   
    </div>
  </div>
 
      </div>
    </div>
  </div>
  
  
  
  <div class="u-row-container" style="padding: 0px;background-color: transparent">
    <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
      <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
       
        
  
  <div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
    <div style="height: 100%;width: 100% !important;">
    
    
  <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
    <tbody>
      <tr>
        <td style="overflow-wrap:break-word;word-break:break-word;padding:30px 10px 10px;font-family:arial,helvetica,sans-serif;" align="left">
          
    <h1 style="margin: 0px; line-height: 140%; text-align: center; word-wrap: break-word; font-family: arial,helvetica,sans-serif; font-size: 26px; ">A rendelését rögzítettük ☺️!</h1>
  
        </td>
      </tr>
    </tbody>
  </table>
  
  <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
    <tbody>
      <tr>
        <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;" align="left">
          
    <table height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #f1f1f1;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
      <tbody>
        <tr style="vertical-align: top">
          <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
            <span>&#160;</span>
          </td>
        </tr>
      </tbody>
    </table>
  
        </td>
      </tr>
    </tbody>
  </table>
  
    
    </div>
  </div>
  
      </div>
    </div>
  </div>
  
  
  
  <div class="u-row-container" style="padding: 0px;background-color: transparent">
    <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
      <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
      
  <div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
    <div style="height: 100%;width: 100% !important;">
   
    
  <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
    <tbody>
      <tr>
        <td style="overflow-wrap:break-word;word-break:break-word;padding:10px 15px;font-family:arial,helvetica,sans-serif;" align="left">
          
    <div style="line-height: 140%; text-align: left; word-wrap: break-word;">
      <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 16px; line-height: 22.4px;"><strong>Kedves Vásárlónk,</strong></span></p>
  <p style="font-size: 14px; line-height: 140%;"> </p>
  <p style="font-size: 14px; line-height: 140%; text-align: center;">A rendelését megkaptuk és elkezdtük a feldolgozását!<br /><span style="font-size: 16px; line-height: 22.4px;"></span></p>
  <p style="font-size: 14px; line-height: 140%; text-align: center;"> </p>
  <p style="font-size: 14px; line-height: 140%; text-align: center;">A feldolgozás általában 4-5 napot vesz igénybe, amint a terméke készenáll küldjük is ki önnek legyen bárhol az országban!</p>
  <p style="font-size: 14px; line-height: 140%;"> </p>
  <p style="font-size: 14px; line-height: 140%;"><span style="text-decoration: underline; line-height: 19.6px;"><strong><span style="font-size: 16px; line-height: 22.4px;">Rendelés részletei:</span></strong></span></p>
<p style="font-size: 14px; line-height: 140%;"> </p>
<ul>
<li style="font-size: 14px; line-height: 19.6px;">Vásárolt termék/termékek -- ' . $_POST['ossz_rendeles'] . '</li>
<li style="font-size: 14px; line-height: 19.6px;">Vásárlás összege -- ' . $_POST['ossz_ar'] . 'Ft</li>
<li style="font-size: 14px; line-height: 19.6px;">Vásárlásának időpontja -- ' . date("l jS \of F Y h:i:s A")  . '</li>
<li style="font-size: 14px; line-height: 19.6px;">Megadott email cím a vásárláskor -- ' . $_POST['email'] . '</li>
</ul>
<p style="font-size: 14px; line-height: 140%;">---------------------------------------------------------------------------------------------------------------</p>
<p style="font-size: 14px; line-height: 140%;"> </p>
<p style="font-size: 14px; line-height: 140%; text-align: center;">Kérdése vagy visszajelzése van? Írjon nekünk Facebookon vagy a <span style="color: #ba372a; line-height: 19.6px;"><a rel="noopener" href="mailto:hasznalt.sportszer@gmail.com" target="_blank" style="color: #ba372a;">hasznalt.sportszer@gmail.com</a></span> címen.</p>
<p style="font-size: 12px; line-height: 140%; text-align: center;">Ez egy automatikus üzenet kérjük ne válaszoljon rá.</p>
<p style="font-size: 14px; line-height: 140%;"><br /><span style="font-size: 16px; line-height: 22.4px;">Tisztelettel,</span><br /><strong>A Használt Sportszer Webshop csapata</strong><br />                </p>
    </div>
  
        </td>
      </tr>
    </tbody>
  </table>
  
   
    </div>
  
    
    </div>
  </div>
 
      </div>
    </div>
  </div>
  
  
  
  <div class="u-row-container" style="padding: 0px;background-color: transparent">
    <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
      <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: transparent;"><![endif]-->
        
 
  <div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
    <div style="height: 100%;width: 100% !important;">
  
    
  <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
    <tbody>
      <tr>
        <td style="overflow-wrap:break-word;word-break:break-word;padding:20px 10px 10px;font-family:arial,helvetica,sans-serif;" align="left">
          
  <div align="center">
    <div style="display: table; max-width:93px;">
  
    
      
    
      <table align="left" border="0" cellspacing="0" cellpadding="0" width="32" height="32" style="width: 32px !important;height: 32px !important;display: inline-block;border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 15px">
        <tbody><tr style="vertical-align: top"><td align="left" valign="middle" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
          <a href="https://www.facebook.com/profile.php?id=100090634102551" title="Facebook" target="_blank">
         <img alt="Facebook" src="cid:my-facebook" title="Facebook" width="32" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
          </a>
        </td></tr>
      </tbody></table>
     
      
      
      <table align="left" border="0" cellspacing="0" cellpadding="0" width="32" height="32" style="width: 32px !important;height: 32px !important;display: inline-block;border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 0px">
        <tbody><tr style="vertical-align: top"><td align="left" valign="middle" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
          <a href="https://github.com/HasznaltSportszerWebshop" title="GitHub" target="_blank">
          <img alt="Github" src="cid:my-github" title="GitHub" width="32" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
          </a>
        </td></tr>
      </tbody></table>
     
    </div>
  </div>
  
        </td>
      </tr>
    </tbody>
  </table>
  
  <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
    <tbody>
      <tr>
        <td style="overflow-wrap:break-word;word-break:break-word;padding:10px 10px 15px;font-family:arial,helvetica,sans-serif;" align="left">
          
    <div style="color: #888888; line-height: 180%; text-align: center; word-wrap: break-word;">
      <p style="font-size: 14px; line-height: 180%;">© 2023 Használt Sportszer. Minden jog fenntartva.</p>
    </div>
  
        </td>
      </tr>
    </tbody>
  </table>
  
    
    </div>
  </div>
  
      </div>
    </div>
  </div>
  
  
      
      </td>
    </tr>
    </tbody>
    </table>';
    

    $mail->send();
  };
 
?>