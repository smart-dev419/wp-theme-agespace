<?php
$advertiseformID=5;
$newsletterformID = 9;
$newsletterformNewHomeID = 11;
$newsletterformNewMOBILE = 25;
$newsletterformNewPageSignUpStyleID = 23;
$step2formID = 18;
$step1formID = 17;
  $coronavirusGuide=10;
  $siteRegisterFormID=2;
     $contactFormID=4; 
     $consaultingFormID=6; 
      $competitionFormID=12; 
       $competitionNEWFormID=16; 
       
       //newsletter form set cookie
add_action('gform_after_submission_' . $newsletterformID, 'addUserStep1', 10, 2);
add_action('gform_after_submission_' . $newsletterformNewHomeID, 'addUserStep1', 10, 2);
add_action('gform_after_submission_' . $newsletterformNewMOBILE, 'addUserStep1', 10, 2);

add_action('gform_after_submission_' . $newsletterformNewPageSignUpStyleID, 'addUserStep1', 10, 2);

// advertise form
add_action('gform_after_submission_' . $advertiseformID, 'addUserStep1', 10, 2);

// $coronavirusGuide form
add_action('gform_after_submission_' . $coronavirusGuide, 'addUserStep1', 10, 2);

// $contactFormID form
add_action('gform_after_submission_' . $contactFormID, 'addUserStep1', 10, 2);

// $siteRegisterFormID form
add_action('gform_after_submission_' . $siteRegisterFormID, 'addUserStep1', 10, 2);

// $consaultingFormID form
add_action('gform_after_submission_' . $consaultingFormID, 'addUserStep1', 10, 2);

// $competitionFormID form
add_action('gform_after_submission_' . $competitionFormID, 'addUserStep1', 10, 2);

add_action('gform_after_submission_' . $competitionNEWFormID, 'addUserStep1', 10, 2);

   
   
//---------------------------------
//
//New stepped forms
add_action('init', 'cloneRole');

function cloneRole() {
    global $wp_roles;
    if (!isset($wp_roles))
        $wp_roles = new WP_Roles();

    $adm = $wp_roles->get_role('subscriber');
    //Adding a 'new_role' with all admin caps
    $wp_roles->add_role('full_member', 'Full Member', $adm->capabilities);
  $wp_roles->add_role('exclude_cache_user_role', 'Exclude Cache User', $adm->capabilities);
    //Adding a 'new_role' with all admin caps
    $wp_roles->add_role('email_member', 'Email Member', $adm->capabilities);
}

function afterLoginStep1($user) {


    $userStatus = get_user_meta($user->ID, 'account_activated', true);
    $fnishedStep2 = get_field('user_finished_step2', 'user_' . $user->ID);

    $login_page = site_url('/register-continue/');

    if ($fnishedStep2 === 'false' && !isset($_GET['finished']) && !is_admin()) {
//     wp_redirect($login_page . "?finished=false");
//       exit;
    }


    return $user;
}

if (is_user_logged_in()) {
    afterLoginStep1(wp_get_current_user());
}


add_filter('wp_login', 'afterLoginStep1');


add_shortcode('step1-info', 'step1cookie');

function step1cookie() {
    if (isset($_COOKIE['userStep1'])) {
        $error = '<div id="returned-user" class="hidden">';
        $error .= '<h3>You back! We already have your information </h3>' .
                'First Name:' . $_COOKIE['userStep1_firstname'] . '<br>' .
                'Last Name:' . $_COOKIE['userStep1_lastname'] . '<br>' .
                'Email:' . $_COOKIE['userStep1_email'] . '<br>' .
                '<a class="btn btn-default" href="#clear-cookie">click here if you want to change this information</a>' .
                '<a class="btn btn-default" href="https://testhosting.co.uk/agespace/register-continue">Continue</a>'
        ;
        $error .= '</div>';
    } else {
        $error = "";
    }
    return $error;
}

//hakunama_wp22
//step 2 form
//add_filter( 'gform_pre_submission_filter_14', 'addUserStep1' );
//add_filter( 'gform_pre_validation_14', 'addUserStep1' );
//step 1 form
add_filter('gform_pre_submission_filter_' . $step1formID, 'addUserStep1');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);


add_filter('gform_validation_' . $step1formID, 'custom_validation');

function custom_validation($validation_result) {
    $form = $validation_result['form'];
    $email = rgpost('input_2');
    if ($email !== "" && $email !== NULL && $email !== undefined) {
        global $wpdb;
// 
//
        $querySQL = "SELECT * FROM `wp_users` WHERE `user_email` = '" . $email . "'";



        $result = $wpdb->get_results($querySQL);
        $resultCount = $wpdb->num_rows;


     //   var_dump($resultCount);
        //supposing we don't want input 1 to be a value of 86



        if ($resultCount > 0) {//is already a user
            //show an error message
            // set the form validation to false
            $validation_result['is_valid'] = false;


            //finding Field with ID of 1 and marking it as failed validation
            foreach ($form['fields'] as &$field) {

                //NOTE: replace 1 with the field you would like to validate
                if ($field->id == '2') {
                    $field->failed_validation = true;
                    $field->validation_message = 'This email address is already registered!';
                    break;
                }
            }
        }


        //Assign modified $form object back to the validation result
        $validation_result['form'] = $form;
        return $validation_result;
    }
    $validation_result['form'] = $form;
    return $validation_result;
}

//
//add_filter('gform_validation_' . $step2formID, 'step2_validation');

function step2_validation($validation_result) {
    $form = $validation_result['form'];
    $country = rgpost('input_11');
     $englandCounty = rgpost('input_13');
      $scotlandCounty = rgpost('input_14');
       $walesCounty = rgpost('input_15');
        $irelandCounty = rgpost('input_16');
      if(get_current_user_id()==2380 ){
   // var_dump($country);
      }
      $countryValidateFail=false;
      $englandCountyFail=false;
      $scotlandCountyFail=false;
      $walesCountyFail=false;
      $irelandCountyFail=false;
      
    if ($country==='first') {
        $countryValidateFail=true;
    }
        if ($country==='england') {
            $englandCountyFail=true;
        }
          if ($country==='scotland') {
            $scotlandCountyFail=true;
        }
          if ($country==='wales') {
            $walesCountyFail=true;
        }
          if ($country==='IE') {
            $irelandCountyFail=true;
        }
    
            //show an error message
            // set the form validation to false
            $validation_result['is_valid'] = false;


            //finding Field with ID of 1 and marking it as failed validation
            foreach ($form['fields'] as &$field) {

                //NOTE: replace 1 with the field you would like to validate
                
                if ($field->id == '11') {
                    $field->failed_validation = $countryValidateFail;
                    $field->validation_message = 'Please Select a country';
                    continue;
                }
                 if ($field->id == '13') {
                    $field->failed_validation = $englandCountyFail;
                    $field->validation_message = 'Please Select an England county';
                    continue;
                }
                 if ($field->id == '14') {
                    $field->failed_validation = $scotlandCountyFail;
                    $field->validation_message = 'Please Select a Scotland county';
                    continue;
                }
                
                 if ($field->id == '15') {
                    $field->failed_validation = $walesCountyFail;
                    $field->validation_message = 'Please Select a Wales county';
                    continue;
                }
                
                 if ($field->id == '16') {
                    $field->failed_validation = $irelandCountyFail;
                    $field->validation_message = 'Please Select a Ireland county';
                    continue;
                }
            }
        


        //Assign modified $form object back to the validation result
        $validation_result['form'] = $form;
        return $validation_result;
  
}


function addUserStep1($form) {
$advertiseformID=5;
$newsletterformID = 9;
$newsletterformNewHomeID=11;
$newsletterformNewMOBILE=25;
$newsletterformNewPageSignUpStyleID = 23;
  $coronavirusGuide=10;
  $siteRegisterFormID=2;
     $contactFormID=4; 
     $consaultingFormID=6; 
      $competitionFormID=12; 
      $competitionNEWFormID=16;
    $step2formID = 18;
$step1formID = 17;
    $formID = (int) $form['form_id'] ? : (int) $form['id'] ;
    $formSourceID=0;
    $formSourceName='';

    $formSourceID=$formID;
    
    switch ($formID) {
        
      
        
         case $newsletterformNewPageSignUpStyleID:
$formSourceName="Newsletter Page";
            $firstName = $_POST['input_1_3'];
            $lastName = $_POST['input_1_6'];
            $email = $_POST['input_2'];
             $optin = 'NULL';

            break;
        
        case $newsletterformID:
$formSourceName="Footer Newsletter";
            $firstName = $_POST['input_1_3'];
            $lastName = $_POST['input_1_6'];
            $email = $_POST['input_2'];
            $optin = $_POST['input_4_1'];

            break;
                case $newsletterformNewHomeID:
$formSourceName="New Home Newsletter";
            $firstName = $_POST['input_1_3'];
            $lastName = $_POST['input_1_6'];
            $email = $_POST['input_2'];
         $optin = 'NULL';

            break;
           case $newsletterformNewMOBILE:
$formSourceName="New Home Newsletter MOBILE";
          
            $email = $_POST['input_2'];
         $optin = 'NULL';

            break;
          

  case $advertiseformID:
    $formSourceName="Advertise Form";
            $firstName = $_POST['input_4_3'];
            $lastName = $_POST['input_4_6'];
            $email = $_POST['input_6'];
            $optin = 'NULL';

            break;
        
            case $coronavirusGuide:
$formSourceName="Coronavirus Guide";
            $firstName = $_POST['input_1_3'];
            $lastName = $_POST['input_1_6'];
            $email = $_POST['input_2'];
           $optin = 'NULL';

            break;
        
        case $siteRegisterFormID:
$formSourceName="Site Register Form";
            $firstName = $_POST['input_1'];
            $lastName = '';
            $email = $_POST['input_2'];
        $optin ='NULL';

            break;
        
              case $contactFormID:
$formSourceName="Contact Form";
            $firstName = $_POST['input_1'];
            $lastName = '';
            $email = $_POST['input_2'];
            $optin ='NULL';

            break;
        
           case $consaultingFormID:
$formSourceName="Consaulting Form";
            $firstName = $_POST['input_1'];
            $lastName = '';
            $email = $_POST['input_2'];
            $optin ='NULL';

            break;
     
    
           case $competitionFormID:
$formSourceName="Competition Form";
            $firstName = $_POST['input_11'];
            $lastName = $_POST['input_12'];
            $email = $_POST['input_2'];
            $optin = $_POST['input_13'];

            break;
        
                case $competitionNEWFormID:
$formSourceName="WIN a SureSafeGO Form";
            $firstName = $_POST['input_1_3'];
            $lastName = $_POST['input_1_6'];
            $email = $_POST['input_8'];
            $optin = $_POST['input_4_1'];
         
            break;
     
   
      
        
        case $step1formID:
$formSourceName="Step 1 Form";
            $firstName = $_POST['input_5_3'];
            $lastName = $_POST['input_5_6'];
            $email = $_POST['input_2'];
            $optin = $_POST['input_8'] ;

            break;
        
        
    }


    global $wpdb;

  
    $querySQL2 = "SELECT * FROM `users_step1` WHERE `email` LIKE '%" . $email . "%'";



    $result2 = $wpdb->get_results($querySQL2);
    $resultCount2 = $wpdb->num_rows;



    $email = trim(strtolower($email));
    
    $urlParams="?email=".$email."&firstname=".$firstName."&lastname=".$lastName;
    
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    $token = md5($email . $ip);

    $cookieExist = false;//isset($_COOKIE['userStep1']) && $token === $_COOKIE['userStep1'] ? true : false;


//
//
//    setcookie("userStep1", $token, time() + 9999);  /* expire in 1 hour */
//    setcookie("userStep1_firstname", $firstName, time() + 9999);  /* expire in 1 hour */
//    setcookie("userStep1_lastname", $lastName, time() + 9999);  /* expire in 1 hour */
//    setcookie("userStep1_email", $email, time() + 9999);  /* expire in 1 hour */
            if(get_current_user_id()==2380  && true){ //debug
   // var_dump($querySQL2,$resultCount2);
            }
    if ($resultCount2 > 0) {//email is registered already in our list
        //  echo 'email exist in database, add a redirect funtion to step 2 here';
         $formID = (int) $form['form_id'] ? : (int) $form['id'] ;
        switch ($formID) {
      case $newsletterformNewPageSignUpStyleID:


          wp_redirect(get_site_url() . '/continue'.$urlParams.'&newsletter=1');
             exit();
                break;
            
            case $newsletterformID:


                wp_redirect(get_site_url() . '/thanks');
             exit();
                break;

            case $newsletterformNewHomeID:


                wp_redirect(get_site_url() . '/continue'.$urlParams);
             exit();
                break;
               case $newsletterformNewMOBILE:


                wp_redirect(get_site_url() . '/continue'.$urlParams);
             exit();
                break;


            case $step1formID:
                wp_redirect(get_site_url() . '/continue'.$urlParams);
               exit();
                break;
            
               
            
            
        }


//add redirect
    } else {

date_default_timezone_set('UTC');

        //  $timestamp = time();
        $regDate = date("d-m-Y h:i:s A", current_time('timestamp'));
        //var_dump($regDate);
        $optin=1;
        $querySQL = "INSERT INTO `users_step1`( `first_name`, `last_name`, `email`,`is_full_member`, `optin`, `register_date`,`form_source_id`,`form_source_name`, `token`) VALUES ('" . $firstName . "','" . $lastName . "','" . $email . "','0','" . $optin . "','" . $regDate ."','" . $formSourceID ."','" . $formSourceName . "','" . $token . "')";
  
           $result = $wpdb->get_results($querySQL);
        if(current_user_can('administrator') ){
//           var_dump($querySQL);
//            var_dump($result);
         //   return;
       }
     
        //var_dump($result);
        switch ($formID) {

        
         case $newsletterformNewPageSignUpStyleID:


                wp_redirect(get_site_url() . '/continue'.$urlParams.'&newsletter=1');
                exit();
                break;
            
            case $newsletterformID:


                wp_redirect(get_site_url() . '/thanks');
                exit();
                break;

         case $newsletterformNewHomeID:
     if(!is_user_logged_in()){
                wp_redirect(get_site_url() . '/continue'.$urlParams);
                 exit();
     }
                 break;
        case $newsletterformNewMOBILE:

   if(!is_user_logged_in()){
                wp_redirect(get_site_url() . '/continue'.$urlParams);
                 exit();
     }
       break;
     
 case $competitionNEWFormID:
     if(!is_user_logged_in()){
                wp_redirect(get_site_url() . '/continue'.$urlParams);
                 exit();
     }
               
                break;
            
            case $step1formID:
                case $step1formID:
                wp_redirect(get_site_url() . '/continue'.$urlParams);
            exit();
                break;
        }
    }
}

//step 2
add_filter('gform_pre_render_' . $step2formID, 'fetchNameEmailForm');
add_action('gform_after_submission_' . $step2formID, 'addUserStep2', 10, 2);
//add_action('gform_pre_submission_filter_' . $step2formID, 'PreAddUserStep2', 10, 2);

add_shortcode('step2validationparams','step2validationparams');
function step2validationparams(){
  $js="";
     if(!isset($_GET['email'])){
  // $js='<script>window.location.href="'.get_home_url().'/join";</script>';
         
        }
           $email=$_GET['email'];
                   global $wpdb;
// 
//
        $querySQL = "SELECT * FROM `wp_users` WHERE `user_email` = '" . $email . "'";



        $result = $wpdb->get_results($querySQL);
        $resultCount = $wpdb->num_rows;
      //  var_dump($querySQL);

     //   var_dump($resultCount);
        //supposing we don't want input 1 to be a value of 86



        if ($resultCount > 0) {//is already a user
         wp_redirect(get_home_url() . '/join');
   exit();
        }
return $js ;
}

function fetchNameEmailForm($form) {
    if (is_admin()) {
        return $form;
    }
    $cookieExist = false;//isset($_COOKIE['userStep1']) ? true : false;
    
   
   
 if(isset($_GET['email'])){
      add_filter('gform_field_value_first_name', 'readName');

        function readName($value) {
            return $_GET['firstname'];
        }

        add_filter('gform_field_value_last_name', 'readLastName');

        function readLastName($value) {
            return $_GET['lastname'];
        }

        add_filter('gform_field_value_email', 'readEmail');
  
        function readEmail($value) {
            
            return $_GET['email'];
         
        }
 }else{
    
    if ($cookieExist) {
        add_filter('gform_field_value_first_name', 'readName');

        function readName($value) {
            return $_COOKIE['userStep1_firstname'];
        }

        add_filter('gform_field_value_last_name', 'readLastName');

        function readLastName($value) {
            return $_COOKIE['userStep1_lastname'];
        }

        add_filter('gform_field_value_email', 'readEmail');

        function readEmail($value) {
            return $_COOKIE['userStep1_email'];
        }

    } else {
        
     //   var_dump('redirecting...');
      
       wp_redirect(get_home_url() . '/join');
   exit();
    }

 }
    return $form;
}

function PreAddUserStep2($form) {
// TO FUTURE EMIN :: I used JS to update hidden field value and handled field on after submittion 
// 
// 
// 
// 
// 
//      $firstName=$_POST['input_5_3'];
//      $lastName=$_POST['input_5_6'];
// $email=$_POST['input_8'];
//$gender=$_POST['input_2']; 
//$country=$_POST['input_11']; 
//$countryEngland=$_POST['input_13'];
//$countryScotland=$_POST['input_14']; 
//
//$countryWales=$_POST['input_15'];
//$countryIreland=$_POST['input_16'];
//$stateField=$_POST['input_19'];
//$postcode=$_POST['input_10'];
//$whyhere=$_POST['input_4'];
//
//$hiddenState=$_POST['input_18'];
//
//switch($country){
//    case 'England' : 
//         $hiddenState=$countryEngland;
//        break;
//     case 'Wales' : 
//         $hiddenState=$countryWales;
//        break;
//     case 'Scotland' : 
//         $hiddenState=$countryScotland;
//        break;
//      break;
//     case 'Ireland' : 
//        $hiddenState=$countryIreland;
//        break;
//    
//    default:
//        $hiddenState=$stateField;
//        break;
//    
//}
//$form['fields'][18]=$hiddenState;

    return $form;
}

;

function addUserStep2($entry, $form) {

if(!isset($_POST['input_8'])){
       wp_redirect(get_home_url() . '/join');
   exit();
};
//     $email=$_POST['input_8'];
              global $wpdb;
//                   $firstName=$_POST['input_5_3'];
//     $lastName=$_POST['input_5_6'];
                $email=$_GET['email'];
                
    $querySQL = "SELECT * FROM `users_step1` WHERE `email` = '" . $email . "'";

    //  var_dump($querySQL);
    $result = $wpdb->get_results($querySQL);
       $sourceForm=$result[0]->form_source_name;
 
        
//    $fields = array(
//        'first_name' => $_POST['input_5_3'],
//        'last_name' => $_POST['input_5_6'],
//        
//        'email' => $_POST['input_8'],
//        'agerange' => $_POST['input_23'],
//        'gender' => $_POST['input_20'],
//        'country' => $_POST['input_11'],
//       
//        'postcode' =>$_POST['input_10'],
//         'zipcode' => $_POST['input_25'],
//          'county' => $_POST['input_18'],
//        'state' => $_POST['input_24'],
//       'source_form' => $sourceForm,
////           'whyhere' => rgar($entry, '4')
//    );
//    if(wp_get_current_user()->data->ID==="2380"){
//        var_dump($fields);
//        exit();
//    }
    $fields = array(
        'first_name' => rgar($entry, '5.3'),
        'last_name' => rgar($entry, '5.6'),
        
        'email' => rgar($entry, '8'),
        'agerange' => rgar($entry, '23'),
        'gender' => rgar($entry, '20'),
        'country' => rgar($entry, '11'),
        'email' => rgar($entry, '8'),
        'postcode' => rgar($entry, '10'),
         'zipcode' => rgar($entry, '25'),
          'county' => rgar($entry, '18'),
        'state' => rgar($entry, '24'),
//         'source_form' => $sourceForm,
//           'whyhere' => rgar($entry, '4')
    );

    //get userID by email 
    
   
    
    $registeredUser = get_user_by('email', $fields['email']);
    $userID = $registeredUser->ID;

    update_field('first_name', $fields['first_name'], 'user_' . $userID);
        update_field('last_name', $fields['last_name'], 'user_' . $userID);
      update_field('user_postcode', $fields['postcode'], 'user_' . $userID);
      update_field('user_zipcode', $fields['zipcode'], 'user_' . $userID);
    update_field('user_age_range', $fields['agerange'], 'user_' . $userID);
    update_field('user_gender', $fields['gender'], 'user_' . $userID);
    update_field('user_why_you_are_here', $fields['whyhere'], 'user_' . $userID);
    update_field('user_country', $fields['country'], 'user_' . $userID);
      update_field('user_county', $fields['county'], 'user_' . $userID);
    update_field('user_state', $fields['state'], 'user_' . $userID);
 update_field('source_form', $fields['source_form'], 'user_' . $userID);
  
  
    $querySQL = "UPDATE `users_step1` SET "
            . "`postcode`='".$fields['postcode']."', "
              . "`zipcode`='".$fields['zipcode']."', "
            . "`agerange`='".$fields['agerange']."', "
              . "`gender`='".$fields['gender']."', "
              . "`whyhere`='".$fields['whyhere']."', "
             . "`county`='".$fields['county']."', "
              . "`country`='".$fields['country']."', "
           
              . "`state`='".$fields['state']."', "
            . "`is_full_member`=1 "
            . "WHERE `email` LIKE '%" . $fields['email'] . "%'";

    //  var_dump($querySQL);
    $result = $wpdb->get_results($querySQL);

    //set hidden fields for selected contru and state


  $subject="Welcome to Age Space and thanks for joining!";

$to=$fields['first_name'].' '.$fields['last_name'].'<'.$fields['email'].'>';
$email_name=$fields['first_name'].' '.$fields['last_name'];
$email_to=$fields['email'];

//sendWelcomeEmail($fields['first_name'],$subject,$email_name,$email_to);

    return $form;
}

if(isset($_GET['testmail'])){
        ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

  //  require  '/home/hakunamatata/public_html/agespace/wp-includes/class-phpmailer.php';

// Gerekli dosyaları include ediyoruz
//require 'PHPMailer/PHPMailer.php';
//require 'PHPMailer/Exception.php';
//require 'PHPMailer/SMTP.php';

    
    $subject="Welcome to Age Space and thanks for joining!";
    $email_to="xxxxxxx@gmail.com";
    $email_name="xxxxxx";

$fields['first_name']="Amin";
    sendWelcomeEmail($fields['first_name'],$subject,$email_name,$email_to);
}



    use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;



function sendWelcomeEmail($firstname,$subject,$email_name,$email_to){
    $message='
<p><strong>Thanks for joining Age Space, '.$firstname.'!</strong></p>
<p>You are now an Age Space Member. Looking after an elderly parent is not always easy, and we understand that. Here at Age Space we provide lots of advice, support and information to help you navigate your way through all aspects of elderly care.</p>
<p>&nbsp;</p>
<p><strong>Member benefits&hellip;</strong></p>
<p>Being a member means that you have free access to lots of exclusive content and offers including:</p>
<p>- A weekly roundup from me, Annabel, founder of Age Space</p>
<p>- Free downloadable guides on:</p>
<p><a href="https://agespaceimages.s3.eu-west-2.amazonaws.com/wp-content/uploads/2019/04/26125837/age-space-guide-to-elderly-care.pdf">Delirium</a></p>
<p><a href="https://agespaceimages.s3.eu-west-2.amazonaws.com/wp-content/uploads/2019/04/26125837/age-space-guide-to-elderly-care.pdf">Elderly Care</a></p>
<p><a href="https://agespaceimages.s3.eu-west-2.amazonaws.com/wp-content/uploads/2020/10/30111732/Dementia-Guide.pdf">Dementia</a></p>
<p>&nbsp;</p>
<p><strong>Exclusive offers just for you&hellip;</strong></p>
<p>We arrange exclusive discounts for our members. You can also enter Age Space competitions for your chance to win a range of elderly care products.</p>
<p><a href="https://www.agespace.org/login">LOGIN TO VIEW DISCOUNTS</a></p>
<p>&nbsp;</p>
<p><strong>Get involved&hellip;</strong></p>
<p>Head over to our <a href="https://www.agespace.org/chat">friendly forum</a> and join the conversation today.</p>
<p>You can also find us on the socials, where our Age Space community helps each other with any challenges they face!</p>
<p><a href="https://twitter.com/agespace">Age Space on Twitter</a></p>
<p><a href="https://www.facebook.com/agespace.org/">Age Space on Facebook</a></p>
<p>&nbsp;</p>
<p>You&rsquo;ll hear from us next in our weekly newsletter &ndash; to make sure you don&rsquo;t miss out please add <strong>annabel.james@agespace.org</strong> to your safe senders list.</p>
<p>&nbsp;</p>
<p>Best Wishes,</p>
<p>Annabel James, Age Space Founder</p>
<p>(If you have any questions don&rsquo;t hesitate to contact us at <strong>support@agespace.org</strong>)</p>
<p>&nbsp;</p>
';
    
        
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
    $mail->send();
 //   echo 'Great! Email sent successfully!';
} catch (Exception $e) {
    echo "Error: {$mail->ErrorInfo}";
}
//     if(get_current_user_id()==2380 && true ){//debug
//         var_dump('email sent');
//         die();
//     }
}