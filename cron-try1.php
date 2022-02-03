<?php

//reset query 
//UPDATE `users_step1` SET `email_count`=0,`email_try1`=0,`email_try2`=0,`email_try3`=0,`email_count`=0  WHERE 1
define('WP_USE_THEMES', true);
//
require  '/home/agespace/public_html/wp-load.php';
//
//
//require  '/home/agespace/public_html/wp-content/themes/Agespace-Elementor/PHPMailer/PHPMailer.php';
    use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
        
if(isset($_GET['test'])){


    $subject="Welcome to Age Space and thanks for joining!";
  
    
    $email_to="amindiary@gmail.com";
    $email_name="Amin Diary";

$fields['first_name']="Amin";
   // sendWelcomeEmail($fields['first_name'],$subject,$email_name,$email_to);
//    ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
     $subject="#1 A big warm welcome 👋" ;
       $message="#3 This is email 1st test<br>"
               . "<h2>A big warm welcome 👋</h2>"
               . "Hello World! <b>#3</b> test";
       $email="amindiary@gmail.com";
         var_dump($message);
       sendEmailSMTP($email_to,$subject,$message,$email_name);
        $emailResult= mailGun($email,$subject,$message);
 //startScript();
}else{
    
startScript();

} 

date_default_timezone_set('UTC');

        function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
{
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);
   
    $interval = date_diff($datetime1, $datetime2);
   
    return $interval->format($differenceFormat);
   
}

function startScript(){

 global $wpdb;
// 
//
     //   $querySQL = "SELECT * FROM `users_step1` WHERE `email_count` < 3 AND is_full_member = 0";

     $querySQL = 'SELECT * FROM `users_step1` WHERE `email` = "amindiary@gmail.com"';

        $result = $wpdb->get_results($querySQL);
     //   $resultCount = $wpdb->num_rows;

    foreach($result as $user){
        $user=(array)$user;
         $email=$user['email'];
          $firstname=$user['first_name'];
           $lastname=$user['last_name'];
          $ID=$user['id'];
         $tryDate1=$user['email_try1'];
       
              $tryDate2=$user['email_try2'];
                    $tryDate3=$user['email_try3'];
                    $tryCount=$user['email_count'];
                    $registerDate=$user['register_date'];
                    $lastTryEmailDate="";
                    
                    switch((int)$tryCount){
                        case 0:
                            $lastTryEmailDate= $registerDate;
                            break;
                        
                         case 1:
                         //   $lastTryEmailDate=$tryDate1;
                              $lastTryEmailDate= $registerDate;
                            break;
                        
                         case 2:
                          //  $lastTryEmailDate=$tryDate2;
                              $lastTryEmailDate= $registerDate;
                            break;
                        
                         case 3:
                          //  $lastTryEmailDate=$tryDate3;
                              $lastTryEmailDate= $registerDate;
                            break;
                        
                         default:
                            $lastTryEmailDate=$registerDate;
                            break;
                    }
                     $currentTime = date("d-m-Y h:i:s A", current_time('timestamp'));
                  // '%y Year %m Month %d Day'                                    =>  1 Year 3 Month 14 Days
// '%m Month %d Day'                                            =>  3 Month 14 Day
// '%d Day %h Hours'                                            =>  14 Day 11 Hours
// '%d Day'                                                        =>  14 Days
// '%h Hours %i Minute %s Seconds'                                =>  11 Hours 49 Minute 36 Seconds
// '%i Minute %s Seconds'                                        =>  49 Minute 36 Seconds
// '%h Hours                                                    =>  11 Hours
// '%a Days                                                        =>  468 Days
                     
     try{  
        $day=dateDifference($currentTime,$lastTryEmailDate,'%d');
            $hour=dateDifference($currentTime,$lastTryEmailDate,'%h');
              $minute=dateDifference($currentTime,$lastTryEmailDate,'%i');
           
     } catch (Exception $e){
         continue;
     }
              
             $lastEmailTimeDiff=$day*24+$hour;
             
 $lastEmailTimeDiff=$minute;
 
 
 $lastEmailTimeDiff=(int)$lastEmailTimeDiff;
 $tryCount=(int)$tryCount;
//  echo '<br>';
// echo 'last timediff:'.($lastEmailTimeDiff);
//  echo '<br>';
//  echo 'last compare date:'.$lastTryEmailDate;
// echo '<br>';
//  echo 'try count:'. ($tryCount);
//
//  echo '<hr>';
    if($lastEmailTimeDiff >=2 && $tryCount==0 ){
       //   echo 'step 1 email';
                    sendFirstEmail($email,$currentTime,$firstname,$lastname);
                    continue;
             }
           
             if($lastEmailTimeDiff >=4 && $tryCount==1 ){
                 
           //      echo 'step 2 email';
                    sendSecondEmail($email,$currentTime,$firstname,$lastname);
                    continue;
             }
                if($lastEmailTimeDiff >=6 && $tryCount==2 ){
            //          echo 'step 3 email';
                    sendThirdEmail($email,$currentTime,$firstname,$lastname);
                    continue;
             }
             
                if( $tryCount==3 ){
             //         echo 'ignored more than 3';
                    ignoreUser($email,$currentTime);
                    continue;
             }
             
  }
}
      
    function updateUser($email,$currentTime,$tryNumber){

       global $wpdb;
      
       $tryNumber=(int)$tryNumber;
   //    echo '$tryNumber is: '.$tryNumber;
       switch($tryNumber){
           case 0: 
                $querySQL = "UPDATE `users_step1` SET "
            . "`email_try1`='".$currentTime."', "
            . "`email_count`=1 "
             
            . "WHERE `email` LIKE '%" . $email . "%'";
               break;
           
             case 1: 
                $querySQL = "UPDATE `users_step1` SET "
            . "`email_try2`='".$currentTime."', "
            . "`email_count`=2 "
             
            . "WHERE `email` LIKE '%" . $email . "%'";
               break;
           
             case 2: 
                $querySQL = "UPDATE `users_step1` SET "
            . "`email_try3`='".$currentTime."', "
            . "`email_count`=3 "
             
            . "WHERE `email` LIKE '%" . $email . "%'";
               break;
       }
       
 //   echo '$querySQL is: '.$querySQL;
//
    //  var_dump($querySQL);
    $result = $wpdb->get_results($querySQL);
    }
   
    
     function ignoreUser($email,$currentTime){
         //does nothing yet
     }
    
 function sendFirstEmail($email,$currentTime,$firstname,$lastname){
   $url='https://www.agespace.org/continue/?email='.$email.'&firstname='.$firstname.'&lastname='.$lastname;
     $subject="#1 A big warm welcome 👋";
       $message="#1 This is email 1st test<br>"
               . "<h2>A big warm welcome 👋</h2>"
               .'Your Personal Sign-up LINK is:'.$url.'<br>'
               . "Hello World! <b>#1</b> test";
       
     $emailName=$firstname.' '.$lastname;
    $emailResult= sendEmailSMTP($email,$subject,$message,$emailName);
    //var_dump($emailResult);
   //   echo "email 1 sent: ".$emailResult;
    if($emailResult){
        updateUser($email,$currentTime,0);
    }else{
        echo 'Email 1 Failed: '.$emailResult;
    }
 }
 
     
 function sendSecondEmail($email,$currentTime,$firstname,$lastname){
    $url='https://www.agespace.org/continue/?email='.$email.'&firstname='.$firstname.'&lastname='.$lastname;
     $subject="#2  A big warm welcome 👋";
       $message="#2 This is email 1st test<br>"
               . "<h2>A big warm welcome 👋</h2>"
                .'Your Personal Sign-up LINK is:'.$url.'<br>'
               . "Hello World! <b>#2</b> test";
       
    $emailName=$firstname.' '.$lastname;
    $emailResult= sendEmailSMTP($email,$subject,$message,$emailName);
 //   echo "email 2 sent: ".$emailResult;
    if($emailResult){
        updateUser($email,$currentTime,1);
    }else{
        echo 'Email 2 Failed: '.$emailResult;
    }
 }
 
 
 
     
 function sendThirdEmail($email,$currentTime,$firstname,$lastname){
    $url='https://www.agespace.org/continue/?email='.$email.'&firstname='.$firstname.'&lastname='.$lastname;
     $subject="#3 A big warm welcome 👋";
       $message="#3 This is email 1st test<br>"
               . "<h2>A big warm welcome 👋</h2>"
                 .'Your Personal Sign-up LINK is:'.$url.'<br>'
               . "Hello World! <b>#3</b> test";
       $emailName=$firstname.' '.$lastname;
    $emailResult= sendEmailSMTP($email,$subject,$message,$emailName);
      //  echo "email 3 sent: ".$emailResult;
    if($emailResult){
        updateUser($email,$currentTime,2);
    }else{
     //   echo 'Email 3 Failed: '.$emailResult;
    }
 }
 
 
 
    function sendEmail($to,$subject,$message){
      
    $email_from = "annabel@agespace.org";

    $full_name = 'Annabel James';
    $from_mail = $full_name.'<'.$email_from.'>';



 
  
    $from = $from_mail;

    $headers =   "From:" . $from . "\r\n" .
               "Reply-To:" . $from . "\r\n" .
               "X-Mailer: PHP/" . phpversion();
    $headers .= 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";        
    return mail($to,$subject,$message,$headers);
    }
    
   
    
function sendEmailSMTP($email_to,$subject,$message,$email_name){
  
    
        
    $email_from = "noreply@agespace.org";

    $full_name = 'Annabel James';
  $from_mail = $full_name.'<'.$email_from.'>';
    

    $from = $from_mail;

//    $headers =   "From:" . $from . "\r\n" .
//               "Reply-To:" . $from . "\r\n" .
//               "X-Mailer: PHP/" . phpversion();
//    $headers .= 'MIME-Version: 1.0' . "\r\n";
//    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";      
    
    
    
    
    
    $mail = new PHPMailer(true);
try {
    //SMTP Sunucu Ayarları
    $mail->SMTPDebug = 0; // DEBUG Kapalı: 0, DEBUG Açık: 2
    $mail->isSMTP();
    $mail->CharSet = 'UTF-8';
    $mail->Host       = 'agespace.org'; // Email sunucu adresi.
    $mail->SMTPAuth   = true; // SMTP kullanici dogrulama kullan
    $mail->Username   = 'smtp@agespace.org'; // SMTP sunucuda tanimli email adresi
    $mail->Password   = 'Y]AAPm]*_--L'; // SMTP email sifresi
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // SSL icin `PHPMailer::ENCRYPTION_SMTPS` kullanin. SSL olmadan 587 portundan gönderim icin `PHPMailer::ENCRYPTION_STARTTLS` kullanin
    $mail->Port       = 465; // Eger yukaridaki deger `PHPMailer::ENCRYPTION_SMTPS` ise portu 465 olarak guncelleyin. Yoksa 587 olarak birakin
    $mail->setFrom($email_from, $full_name); // Gonderen bilgileri yukaridaki $mail->Username ile aynı deger olmali
    //Alici Ayarları
    $mail->addAddress($email_to, $email_name); // Alıcı bilgileri
 
    //$mail->addReplyTo('YANITADRESI@domainadi.com'); // Alıcı'nın emaili yanıtladığında farklı adrese göndermesini istiyorsaniz aktif edin
    //$mail->addCC('CC@domainadi.com');
    //$mail->addBCC('BCC@domainadi.com');
    // Mail Ekleri
    //$mail->addAttachment('https://cdn.domainhizmetleri.com/var/tmp/file.tar.gz'); // Attachment ekleme
    //$mail->addAttachment('https://cdn.domainhizmetleri.com/tmp/image.jpg', 'new.jpg'); // Opsiyonel isim degistirerek Attachment ekleme
    // İçerik
    $mail->isHTML(true); // Gönderimi HTML türde olsun istiyorsaniz TRUE ayarlayin. Düz yazı (Plain Text) icin FALSE kullanin
    $mail->Subject = $subject;
    $mail->Body    = $message;
    return $mail->send();
 //   echo 'Great! Email sent successfully!';
} catch (Exception $e) {
    echo "Error: {$mail->ErrorInfo}";
     
}
//     if(get_current_user_id()==2380 && true ){//debug
//         var_dump('email sent');
//         die();
//     }


}
    
//
//           
//function mailGun($to,$subject,$message){
//
// ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ERROR);
//
//    $mail = new PHPMailer();
//
//$to="amindiary@gmail.com";
//  
//    $email_from = "annabel@agespace.org";
//
//    $full_name = 'Annabel James';
//    $from_mail = $full_name.'<'.$email_from.'>';
//
//
//
//           
//  
//    $from = $from_mail;
//
//    $headers =   "From:" . $from . "\r\n" .
//               "Reply-To:" . $from . "\r\n" .
//               "X-Mailer: PHP/" . phpversion();
//    $headers .= 'MIME-Version: 1.0' . "\r\n";
//    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";  
//    
//    try {
//// Settings
//$mail->IsSMTP();
//$mail->CharSet = 'UTF-8';
//
//$mail->Host       = "mail.agespace.org"; // SMTP server example
//$mail->SMTPDebug  =1;                     // enables SMTP debug information (for testing)
//$mail->SMTPAuth   = true;                  // enable SMTP authentication
//$mail->Port       = 465;                    // set the SMTP port for the GMAIL server
//$mail->Username   = "cron@agespace.org"; // SMTP account username example
//$mail->Password   = "I2FO2dcUp(yi";        // SMTP account password example
//
//
//
// //Recipients
//    $mail->setFrom($email_from, $full_name);
//    $mail->addAddress($to);     // Add a recipient
//
//    $mail->addReplyTo($email_from, $full_name);
// 
//
//           
//    
//// Content
//$mail->isHTML(true);                                  // Set email format to HTML
//$mail->Subject = 'Here is the subject';
//$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
//
//$result=$mail->send();
//     
//    echo 'Message has been sent';
//} catch (Exception $e) {
//    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
//} 
//    
//
//}