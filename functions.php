<?php


//function hello_elementor_child_enqueue_scripts() {
//	wp_enqueue_style(
//		'hello-elementor-child-style',
//		get_stylesheet_directory_uri() . '/style.css',
//		[
//			'hello-elementor-theme-style',
//		],
//		'1.0.0'
//	);
//}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts', 20 );


add_action( 'init', 'replace_jquery_src' );
/**
 * Modify loaded scripts
 */
function replace_jquery_src() {
    if ( ! is_admin() ) {

        // Remove the default jQuery
        wp_deregister_script( 'jquery-core-js' );

        // Register our own under 'jquery' and enqueue it
        wp_register_script( 'jquery-core-js-custom', get_site_url() .'/wp-includes/js/jquery/jquery.min.js', false );
        wp_enqueue_script( 'jquery-core-js-custom' );
    }
}

add_filter( 'script_loader_tag', 'add_async_to_jquery', 10, 3 );

/**
 * Filter script tag output
 *
 * @param string $tag    HTML output
 * @param string $handle registered name
 * @param string $src    path to JS file
 *
 * @return string
 */
function add_async_to_jquery( $tag, $handle, $src ) {

    // Check for our registered handle and add async
    if ( 'jquery-core-js-custom' === $handle ) {
        return str_replace( ' src=', ' async src=', $tag );
    }

    // Allow all other tags to pass
    return $tag;
}
add_shortcode('countyurl','countyURL');

function countyURL(){
    $pageURL='https://www.agespace.org/services/home-care/';
    $post_id=get_the_ID();
    $post = get_post($post_id); 
$slug = $post->post_name;
    return $pageURL.''.$slug;
}
function visiblePartnerSection($id) {

    //return $count;
    $args = array(
      'post_type'     => 'partner_section', //post type, I used 'product'
      'post_status'   => 'publish', // just tried to find all published post
      'posts_per_page' => -1,  //show all
      'tax_query' => array(
        'relation' => 'AND',
        array(
          'taxonomy' => 'featured_local_partner',  //taxonomy name  here, I used 'product_cat'
          'field' => 'id',
          'terms' => array( $id )
        )
      )
    );

    $query = new WP_Query( $args);

    /*
    echo '<pre>';

    print_r($query->post_count);
    echo '</pre>';
    */

    return (int)$query->post_count > 0 ? true : false ;

}

add_shortcode('show-partners', 'showPartners');

function showPartners(){
    
     $ids=[];
       $idsToCheck=[];
         $parentID = get_post_ancestors(get_the_ID());
       
      $pageID=get_the_ID();
      
      $idsToCheck[]=$pageID;
        $idsToCheck= array_merge($idsToCheck,$parentID);
       
        foreach ($idsToCheck as $key => $value) {
   //ID pages to check if is visible or not
    switch ($value) {
            
                   case 29145 :  $ids[]= 102303; break; // norfolk
                   case 16964 :  $ids[]= 102309; break; // sussex
                   case 39886 :  $ids[]= 102307; break; // surrey
                   case 31246 :  $ids[]= 102305; break; // suffolk
                   case 23815 :  $ids[]= 102301; break; // merseyside
                   case 31181 :  $ids[]= 102299; break; // kent
                   case 31247 :  $ids[]= 102297; break; // hampshire
                   case 44265 :  $ids[]= 102295; break; // hertfordshire  
                   case 39877 :  $ids[]= 102293; break; // essex  
                   case 48141 :  $ids[]= 102291; break; // dorset  
                   case 23173 :  $ids[]= 23173; break; // cheshire  
                   case 39866 :  $ids[]= 102287; break; // cambridgeshire  
                   case 44314 :  $ids[]= 102285; break; // buckinghamshire  
                   case 44259 :  $ids[]= 102283; break; // berkshire  
                               
                   case 7987 :    $ids[]=102313; break; // real life
                   case 4935 :    $ids[]=102311; break; // your local
                   case 1717 :   $ids[]=102239 ; break; // care
                   case 204705 :  $ids[]=102243; break; // legal
                   case 1148 :  $ids[]=102241; break; // finance
                   case 1003 :  $ids[]=102245; break; // health
                   case 216339 :  $ids[]=102247; break; // dementia
    }
    if(count($ids)>0){
        return true;
    }
}
 return false;
}
function var_dump3($data) {
    print("<pre>" . print_r($data, true) . "</pre>");
}



 add_action( 'elementor/query/partnersQuery', function( $query ) {
   //REAL posts (ids are taxonomies)
     // $postsCats=get_terms('featured_local_partner');
      $ids=[];
       $idsToCheck=[];
//      foreach($postsCats as $postsCat){
//       $ids[]=  $postsCat->term_id;
//       
//      }
       $parentID = get_post_ancestors(get_the_ID());
       
      $pageID=get_the_ID();
      
      $idsToCheck[]=$pageID;
        $idsToCheck= array_merge($idsToCheck,$parentID);
      if(isAmin()){
 
      //    var_dump('$idsToCheck: ',$idsToCheck);
}
foreach ($idsToCheck as $key => $value) {
 
   
    switch ($value) {
        
                    case 29145 :  $ids[]= 112343; break; // norfolk
                    case 16964 :  $ids[]= 112349; break; // sussex
                    case 39886 :  $ids[]= 112347; break; // surrey
                    case 31246 :  $ids[]= 112345; break; // suffolk
                    case 23815 :  $ids[]= 112341; break; // merseyside
                    case 31181 :  $ids[]= 112323; break; // kent
                    case 31247 :  $ids[]= 112339; break; // hampshire
                    case 44265 :  $ids[]= 112337; break; // hertfordshire  
                    case 39877 :  $ids[]= 112335; break; // essex  
                    case 48141 :  $ids[]= 112333; break; // dorset  
                    case 23173 :  $ids[]= 112331; break; // cheshire  
                    case 39866 :  $ids[]= 112329; break; // cambridgeshire  
                    case 44314 :  $ids[]= 112327; break; // buckinghamshire  
                    case 44259 :  $ids[]= 112325; break; // berkshire  

                    case 7987 :    $ids[]=102313; break; // real life
                    case 4935 :    $ids[]=102311; break; // your local
                    case 1717 :   $ids[]=102239 ; break; // care
                    case 204705 :  $ids[]=102243; break; // legal
                    case 1148 :  $ids[]=102241; break; // finance
                    case 1003 :  $ids[]=102245; break; // health
                    case 216339 :  $ids[]=102247; break; // dementia
    }
}

//     switch ($pageID) {
//                  case 29145 :  $ids[]= 102303; break; // norfolk
//                   case 16964 :  $ids[]= 102309; break; // sussex
//                    case 39886 :  $ids[]= 102307; break; // surrey
//                     case 31246 :  $ids[]= 102305; break; // suffolk
//                      case 23815 :  $ids[]= 102301; break; // merseyside
//                       case 31181 :  $ids[]= 102299; break; // kent
//                        case 31247 :  $ids[]= 102297; break; // hampshire
//                         case 44265 :  $ids[]= 102295; break; // hertfordshire  
//                     case 39877 :  $ids[]= 102293; break; // essex  
//                         case 48141 :  $ids[]= 102291; break; // dorset  
//                           case 23173 :  $ids[]= 23173; break; // cheshire  
//                             case 39866 :  $ids[]= 102287; break; // cambridgeshire  
//                              case 44314 :  $ids[]= 102285; break; // buckinghamshire  
//                               case 44259 :  $ids[]= 102283; break; // berkshire  
//                               
//                             case 7987 :    $ids[]=102313; break; // real life
//                  case 4935 :    $ids[]=102311; break; // your local
//                  case 1717 :   $ids[]=102239 ; break; // care
//                case 204705 :  $ids[]=102243; break; // legal
//                  case 1148 :  $ids[]=102241; break; // finance
//                case 1003 :  $ids[]=102245; break; // health
//                case 2979 :  $ids[]=102247; break; // dementia
//                
//              
//            }
//            
//             switch ($parentID) {
//                  case 7987 :    $ids[]=102313; break; // real life
//                  case 4935 :    $ids[]=102311; break; // your local
//                  case 1717 :   $ids[]=102239 ; break; // care
//                case 204705 :  $ids[]=102243; break; // legal
//                  case 1148 :  $ids[]=102241; break; // finance
//                case 1003 :  $ids[]=102245; break; // health
//                case 2979 :  $ids[]=102247; break; // dementia
//             
//              
//            }

//         $taxquery = array(
//      array(
//          'taxonomy' => 'featured_local_partner',
//          'field' => 'term_id',
//       
//          'terms' => array(112323),
//          'operator' => 'IN'
//      )
//  );
//         
         
//         $tax_query[]  = array(
//		array(
//                     'post_type' => 'partner_section',
//			'taxonomy' => 'featured_local_partner',
//			'field' => 'term_id',
//			'terms' => $ids,
//                        'compare' => 'IN'
//		),
//	);


//  $taxquery[] =
//      array(
//          'taxonomy' => 'featured_local_partner',
//          'field' => 'term_id',
//       
//          'terms' => $ids,
//          'operator' => 'IN'
//      );
  
//  $meta_query[] = [
//            'post_type' => 'designs',
//            'taxonomy' => 'featured_local_partner',
//            'value' => $ids,
//            'compare' => 'in',
//];
//$query->set( 'meta_query', $meta_query );


$tax_query = $query->get( 'tax_query' );

	// If there is no meta query when this filter runs, it should be initialized as an empty array.
	if ( ! $tax_query ) {
		$tax_query = [];
	}
        
$meta_query = $query->get( 'meta_query' );

	// If there is no meta query when this filter runs, it should be initialized as an empty array.
	if ( ! $meta_query ) {
		$meta_query = [];
	}

	// Append our meta query
	$meta_query[] = [
		'taxonomy' => 'featured_local_partner',
		 'field' => 'term_id',
       
          'terms' => $ids,
          'operator' => 'IN'
	];
	$query->set( 'meta_query', $meta_query );

	// Append our meta query

//        
//$tax_query = array(
//        array(
//            'taxonomy' => 'featured_local_partner',
//            'field'    => 'term_id',
//            'terms'    => $ids,
//        ),
//    );
//  
////

 
        $taxquery[] =[
             'taxonomy' => 'featured_local_partner',
          'field' => 'term_id',
       
          'terms' => $ids,
          'operator' => 'IN'
        ];
       
      
    
	$query->set( 'tax_query', $taxquery );


  
//$query->set( 'meta_query', $tax_query );
//        
        

  //$query->set('tax_query', $tax_query);
//  

	//$query->set( 'tax_query', $tax_query );
//$query->set('post__in', $ids);
//$query->set( 'post_type', [ 'partner_section' ] ); 

// Set for the posts_per_page 
//$query->set( 'posts_per_page', 12 ); 


 if(isAmin()){
 //var_dump('$taxquery: ',$tax_query);
 //var_dump3($query);
}
}); 


add_shortcode('partners-section', 'partnerSection');

function partnerSection() {

     $terms = get_terms('featured_local_partner');

   $parentID = wp_get_post_parent_id(get_the_ID());
            $pageID=get_the_ID();
   
    if (is_home() || is_front_page()) {
        
   //  return visiblePartnerSection(102281);
    } 
         
       
//        $termsToShow = [];
//        foreach ($terms as $term) {
//         
//            if(isAmin()){
//                var_dump($pageID,$parentID);
//              
//              
//  
//}

                        if(isAmin()){
             
              
             
  
}
$ids=[];
  
//             switch ($pageID) {
//                  case 29145 :   return visiblePartnerSection(102303); break; // norfolk
//                   case 16964 :   return visiblePartnerSection(102309);; break; // sussex
//                    case 39886 :  return visiblePartnerSection(102307);$ids[]= 102307; break; // surrey
//                     case 31246 :  return visiblePartnerSection(102305);$ids[]= 102305; break; // suffolk
//                      case 23815 : return visiblePartnerSection(102301); $ids[]= 102301; break; // merseyside
//                       case 31181 :  return visiblePartnerSection(102299);$ids[]= 102299; break; // kent
//                        case 31247 :  return visiblePartnerSection(102297);$ids[]= 102297; break; // hampshire
//                         case 44265 :  return visiblePartnerSection(102295);$ids[]= 102295; break; // hertfordshire  
//                     case 39877 :  return visiblePartnerSection(102293);$ids[]= 102293; break; // essex  
//                         case 48141 : return visiblePartnerSection(102291); $ids[]= 102291; break; // dorset  
//                           case 23173 :  return visiblePartnerSection(23173);$ids[]= 23173; break; // cheshire  
//                             case 39866 :  return visiblePartnerSection(102287);$ids[]= 102287; break; // cambridgeshire  
//                              case 44314 :  return visiblePartnerSection(102285);$ids[]= 102285; break; // buckinghamshire  
//                               case 44259 : return visiblePartnerSection(102283); $ids[]= 102283; break; // berkshire  
//                               
//                
//              
//            }
//           
//          
//                
//                   switch ($parentID) {
//                       case 7987 :  return visiblePartnerSection(102313);  $ids[]=102313; break; // real life
//                  case 4935 :    return visiblePartnerSection(102311); $ids[]=102311; break; // your local
//                  case 1717 :  return visiblePartnerSection(102239);  $ids[]=102239 ; break; // care
//                  case 204705 :  return visiblePartnerSection(102243); $ids[]=102243; break; // legal
//                  case 1148 : return visiblePartnerSection(102241);  $ids[]=102241; break; // finance
//                  case 1003 : return visiblePartnerSection(102245);  $ids[]=102245; break; // health
//                  case 216339 : return visiblePartnerSection(102247);  $ids[]=102247; break; // dementia
//             
//              
//           
//             
//              
//            }

//            $visibleParentPageIDS=array(4935,1717,204705,1148,1003,2979,216339);
                        $visibleParentPageIDS=get_field('visible_partner_parents_pages','options');
                        
            $isParentValid=in_array($parentID,$visibleParentPageIDS);
            
             $visiblePageIDS=get_field('visible_partner_pages','options');
            $isPageIDValid=in_array($pageID,$visiblePageIDS);
            
              if(isAmin()){
         //         var_dump($parentID,$visibleParentPageIDS);
              //    die();
   

}
          return ($isParentValid || $isPageIDValid) ? true : false ;
            
//            
//            switch ($term->slug) {
//                  case 'your-local' : if ($parentID == 4935) {
//                       return true;
//                   }
//                   case 'norfolk' : if ($pageID == 29145) {
//                       return true;
//                   }
//                case 'legal' : if ($parentID == 204705) {
//                        return "true";
//                    } break;
//                case 'care' : if ($parentID == 1717) {
//                        return "true";
//                    } break;
//                   
//                      case 'products' : if ($parentID == 49951) {
//                        return "true";
//                    } break;
//                    
//                case 'finance' : if ($parentID == 1148) {
//                        return "true";
//                    } break;
//                case 'health' : if ($parentID == 1003) {
//                        return "true";
//                    } break;
//                case 'dementia' : if ($parentID == 2979) {
//                        return "true";
//                    } break;
//              
//            }
      //  }
      


        return false;
   




}

// refresh/flush permalinks in the dashboard if this is changed in any way
function custom_rewrite_rules2() {
   // add_rewrite_rule('^services/(.*)/', 'index.php?post_type="ag_location"&ag_primary_inspection_cat=$matches[1]', 'bottom');
  //   add_rewrite_rule('^services/(.*)/(.*)?', 'index.php?post_type="ag_location"&ag_primary_inspection_cat=$matches[1]&ag_county=$matches[2]', 'top');
//     add_rewrite_rule('^services/(.*)/town/(.*)?', 'index.php?post_type="ag_location"&ag_primary_inspection_cat=$matches[1]&ag_cities=$matches[2]', 'top');
//    add_rewrite_rule('^services/(.*)/region/(.*)?', 'index.php?post_type="ag_location"&ag_primary_inspection_cat=$matches[1]&ag_regions=$matches[2]', 'top');
//    add_rewrite_rule('^services/(.*)/(.*)?', 'index.php?post_type="ag_location"&ag_primary_inspection_cat=$matches[1]&ag_county=$matches[2]', 'top');
//    add_rewrite_rule('^services/(.*)/(.*)/(.*)?', 'index.php?post_type="ag_location"&ag_primary_inspection_cat=$matches[1]&ag_cities=$matches[3]', 'top');
 //add_rewrite_rule('^services/(.*)/(.*)?', 'index.php?post_type="ag_location"&ag_primary_inspection_cat=$matches[1]&ag_county=$matches[2]&ag_cities=$matches[3]', 'top');
    
     
   //  add_rewrite_rule('^services/(.*)/(.*)?', 'index.php?post_type="ag_location"&ag_primary_inspection_cat=$matches[1]&ag_county=$matches[2]', 'top');
   
    
   
//add_rewrite_rule(
//    'services/([^/]*)/([^/]*)/([^/]*)/?',
//    'index.php?post_type="ag_location"&ag_primary_inspection_cat=$matches[1]&ag_cities=$matches[3]',
//    'top' );
    
    add_rewrite_rule(
    'services/([^/]*)/([^/]*)/([^/]*)/([^/]*)/?',
    'index.php?ag_location=$matches[3]&ag_primary_inspection_cat=$matches[1]&ag_county=$matches[2]&ag_cities=$matches[4]',
    'top' );

add_rewrite_rule(
    'services/([^/]*)/town/([^/]*)/?',
    'index.php?post_type="ag_location"&ag_primary_inspection_cat=$matches[1]&ag_cities=$matches[2]',
    'top' );

add_rewrite_rule(
    'services/([^/]*)/brand/([^/]*)/?',
    'index.php?ag_location=$matches[2]',
    'top' );

add_rewrite_rule(
    'services/([^/]*)/location/([^/]*)/?',
    'index.php?ag_location=$matches[2]',
    'top' );

                    
add_rewrite_rule(
    'services/([^/]*)/([^/]*)/?',
    'index.php?post_type="ag_location"&ag_primary_inspection_cat=$matches[1]&ag_county=$matches[2]',
    'top' );


add_rewrite_rule(
    'services/([^/]*)/?',
    'index.php?post_type="ag_location"&ag_primary_inspection_cat=$matches[1]',
    'top' );
    
}
            
add_action('init', 'custom_rewrite_rules2');

//function resources_cpt_generating_rule($wp_rewrite) {
//    
//    
//    $rules = array();
//    $terms = get_terms( array(
//        'taxonomy' => 'ag_county',
//        'hide_empty' => false,
//    ) );
//   
//    $post_type = 'resources_post_type';
//
//    foreach ($terms as $term) {    
//                
//        $rules['services' . $term->slug . '/([^/]*)$'] = 'index.php?ag_county=$matches[1]&name=$matches[1]';
//                        
//    }
//
//    // merge with global rules
//    $wp_rewrite->rules = $rules + $wp_rewrite->rules;
//}
//add_filter('generate_rewrite_rules', 'resources_cpt_generating_rule');
// refresh/flush permalinks in the dashboard if this is changed in any way

function isPageSlug($slug) {
    global $wp;
    $url = ($_SERVER['REQUEST_URI']);

    if (preg_match('/' . $slug . '/', $url)) {
        return true;
    } else {
        return false;
    }
}

//var_dump($_SERVER['HTTP_USER_AGENT']);
// $isPingdom=  preg_match_all('/PingdomPageSpeed/', $_SERVER['HTTP_USER_AGENT']);
// $isGtmetrix=  preg_match_all('/86.0.4240.193/', $_SERVER['HTTP_USER_AGENT']);
// $isLighthouse=  preg_match_all('/Lighthouse/', $_SERVER['HTTP_USER_AGENT']);
//  $isPageSpeed=  preg_match_all('/PageSpeed/', $_SERVER['HTTP_USER_AGENT']);
//  
// 
// if($isGtmetrix || $isPingdom || $isLighthouse || $isPageSpeed){
//  
//     die();
// }

include('shortcodes.php');
include('functions-extend.php');
include('step-forms.php');
include('acf-blocks.php');

function pageTypeChecker() {
    global $wp_query;
    $loop = 'notfound';

    if ( $wp_query->is_page ) {
        $loop = is_front_page() ? 'front' : 'page';
    } elseif ( $wp_query->is_home ) {
        $loop = 'home';
    } elseif ( $wp_query->is_single ) {
        $loop = ( $wp_query->is_attachment ) ? 'attachment' : 'single';
    } elseif ( $wp_query->is_category ) {
        $loop = 'category';
    } elseif ( $wp_query->is_tag ) {
        $loop = 'tag';
    } elseif ( $wp_query->is_tax ) {
        $loop = 'tax';
    } elseif ( $wp_query->is_archive ) {
        if ( $wp_query->is_day ) {
            $loop = 'day';
        } elseif ( $wp_query->is_month ) {
            $loop = 'month';
        } elseif ( $wp_query->is_year ) {
            $loop = 'year';
        } elseif ( $wp_query->is_author ) {
            $loop = 'author';
        } else {
            $loop = 'archive';
        }
    } elseif ( $wp_query->is_search ) {
        $loop = 'search';
    } elseif ( $wp_query->is_404 ) {
        $loop = 'notfound';
    }

    return $loop;
}
if(isAmin()){
 
}

function slugHasWord($word){
    $url =  $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];


if (strpos($url,$word) !== false) {
   return true;
} else {
    return false;
}
}
function isDirectory(){

   if(  isPageSlug('wp-json') ||  is_tax() || slugHasWord('services/home-care') || slugHasWord('/location/') ){
       return true;
   }
}
if (isDirectory() ) {
  
 
     
}

if(is_home() || is_front_page() || is_single()){
    
}else{
     include('functions-directory.php');
}
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
if(isAmin()){

  
}
 
//if($isDirectory)
//        {
//    
//     include('functions-directory.php');
//}

function _remove_script_version($src) {
    $parts = explode('?ver', $src);
    return $parts[0];
}

add_filter('script_loader_src', '_remove_script_version', 15, 1);
add_filter('style_loader_src', '_remove_script_version', 15, 1);

function my_plugin_scripts($hook) {
    $current_page = get_current_screen()->base;
    if ($current_page == 'eps_redirects') {

        return;
    }

    //  wp_enqueue_script( 'my_custom_script', plugins_url('js/file.js', __FILE__));
}

add_action('admin_enqueue_scripts', 'my_plugin_scripts');

add_filter('gform_confirmation_21', 'custom_confirmation', 10, 4);

//add_action('gform_after_submission_22', 'resetPasswordForm', 10, 2);
function custom_confirmation($confirmation, $form, $entry) {

    $email = rgar($entry, '1');

    $email = $_POST['input_1'];
    $user_login = sanitize_text_field($email);
    $result = my_retrieve_password($user_login);

    if ($result) {

        $confirmation = "<div class='msg-ok'>We've sent a password reset link to your email, please check your inbox.</div>";
    } else {
        $confirmation = "<div class='msg-error'>Whoops! We couldn't find that email address, could you have used a different one?</div>";
    }
    return $confirmation;
}

function my_retrieve_password($user_login) {
    global $wpdb, $current_site;

    if (empty($user_login)) {
        return false;
    } else if (strpos($user_login, '@')) {
        $user_data = get_user_by('email', trim($user_login));

        if (empty($user_data))
            return false;
    } else {
        $login = trim($user_login);
        $user_data = get_user_by('login', $login);
    }

    do_action('lostpassword_post');

    if (!$user_data)
        return false;

    // redefining user_login ensures we return the right case in the email
    $user_login = $user_data->user_login;
    $user_email = $user_data->user_email;

    do_action('retreive_password', $user_login);  // Misspelled and deprecated
    do_action('retrieve_password', $user_login);

    $allow = apply_filters('allow_password_reset', true, $user_data->ID);

    if (!$allow)
        return false;
    else if (is_wp_error($allow))
        return false;

    $key = $wpdb->get_var($wpdb->prepare("SELECT user_activation_key FROM $wpdb->users WHERE user_login = %s", $user_login));
    if (empty($key)) {
        // Generate something random for a key...
        $key = wp_generate_password(20, false);
        do_action('retrieve_password_key', $user_login, $key);
        // Now insert the new md5 key into the db
        $wpdb->update($wpdb->users, array('user_activation_key' => $key), array('user_login' => $user_login));
    }
    $message = __('Someone requested that the password be reset for the following account:') . "\r\n\r\n";
    $message .= network_home_url('/') . "\r\n\r\n";
    $message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
    $message .= __('If this was a mistake, just ignore this email and nothing will happen.') . "\r\n\r\n";
    $message .= __('To reset your password, visit the following address:') . "\r\n\r\n";
    $message .= '<' . network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . ">\r\n";

    if (is_multisite())
        $blogname = $GLOBALS['current_site']->site_name;
    else
    // The blogname option is escaped with esc_html on the way into the database in sanitize_option
    // we want to reverse this for the plain text arena of emails.
        $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

    $title = sprintf(__('[%s] Password Reset'), $blogname);

    $title = apply_filters('retrieve_password_title', $title);
    $message = apply_filters('retrieve_password_message', $message, $key);

    if ($message && !wp_mail($user_email, $title, $message))
        wp_die(__('The e-mail could not be sent.') . "<br />\n" . __('Possible reason: your host may have disabled the mail() function...'));

    return true;
}

function getparentID() {
    $ids = [];
    $ids[] = wp_get_post_parent_id(get_the_ID());
    if (get_the_ID() == "49728") {//exclude will page
        return 0;
    }
    //  $ids=implode(',',$ids);
    $ids = wp_get_post_parent_id(get_the_ID());
//    if(current_user_can('administrator')){
//        var_dump($ids);
//    }
    return $ids;
}

add_shortcode('parentid', 'getparentID');

function usefullPagesTop() {
    $links = "";
    $usefullLinks = get_field('usefull_pages_top');
    if ($usefullLinks) {
        $links .= "<ul class='usefull-links top-widget'>";
        foreach ($usefullLinks as $link) {

            $links .= "<li><a href='" . $link['link'] . "'>" . $link['title'] . "</a></li>";
        }
        $links .= "</ul>";
    }
    return $links;
}

add_shortcode('usefullPagesTop', 'usefullPagesTop');

function usefullPagesBottom() {
    $links = "";
    $usefullLinks = get_field('usefull_pages_down');
    if ($usefullLinks) {
        $links .= "<ul class='usefull-links bottom-widget'>";
        foreach ($usefullLinks as $link) {

            $links .= "<li><a href='" . $link['link'] . "'>" . $link['title'] . "</a></li>";
        }
        $links .= "</ul>";
    }
    return $links;
}

add_shortcode('usefullPagesBottom', 'usefullPagesBottom');

function relevantProduct() {
    $links = "";
    $usefullLinks = get_field('relevant_product');
    if ($usefullLinks) {
        $links .= "<div class='relevant-product'>";
        foreach ($usefullLinks as $link) {

            $links .= "<a href='" . $link['link'] . "'><h3>" . $link['title'] . "</h3><img src='" . $link['image']['sizes']['medium'] . "' alt=" . $link['title'] . " /></a>";
        }
        $links .= "</div>";
    }
    return $links;
}

add_shortcode('relevantProduct', 'relevantProduct');

function editlink() {
    $page_id = get_queried_object_id();

    $link = get_edit_post_link($page_id);

    if (is_tax() || is_archive()) {
        $link = get_edit_term_link($page_id);
    }
    return '<span style="display:none" id="edit-link-fix">' . $link . '</span>';
}

add_shortcode('editlink', 'editlink');

add_filter('wp_sitemaps_enabled', '__return_false');

add_filter('elementor/fonts/groups', function($font_groups) {
    $font_groups['theme_fonts'] = __('Theme Fonts', 'agespace');
    return $font_groups;
});
/**
 * Add Group Fonts to the fonts control
 */
add_filter('elementor/fonts/additional_fonts', function($additional_fonts) {
    // Key/value
    //Font name/font group
    $additional_fonts['Inter'] = 'theme_fonts';
    return $additional_fonts;
});
// Now if they are included by your theme, you are done.
// if not you can hook in to the elementor/fonts/print_font_links/{$font_type} action hook to enqueque your theme fonts, ex:
add_action('elementor/fonts/print_font_links/theme_fonts', function($font_name) {

    wp_enqueue_style('my-theme-google-fonts', '//fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
});
add_action('elementor/editor/before_enqueue_scripts', function() {
    wp_enqueue_style('my-theme-google-fonts', '//fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
});
add_action('elementor/preview/enqueue_styles', function() {
    wp_enqueue_style('my-theme-google-fonts', '//fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
});

//This code removes noreferrer from your new or updated posts
function my_targeted_link_rel($rel_values) {
    return 'noopener';
}

add_filter('wp_targeted_link_rel', 'my_targeted_link_rel', 999);

function add_elementor_widget_categories($elements_manager) {

    $elements_manager->add_category(
            'agespace',
            [
                'title' => __('Agespace', 'agespace'),
                'icon' => 'fa fa-plug',
            ]
    );
}

add_action('elementor/elements/categories_registered', 'add_elementor_widget_categories');

function my_formatter($content) {
    $replace = array(" noreferrer" => "");
    $new_content = strtr($content, $replace);
    return $new_content;
}

add_filter('the_content', 'my_formatter', 999);

add_shortcode('download-manager', 'downloadManager');

function downloadManager() {
    if (isset($_GET['download'])) {
        if ($_GET['download'] === "advertise") {
            $cnt = '<form id="download-advertise-form" action="https://www.agespace.org/wp-content/themes/Agespace-Elementor/download.php" method="post"></form>';


            return $cnt;
        }
    }
}

$combinePageCssList = [];
$combinePageCssListHEAD = [];

function isAmin() {
    //var_dump(wp_get_current_user()->data->ID);
    if (wp_get_current_user()->data->ID === "2380") {
        return true;
    }
    return false;
}

function filter_w3tc_minify_css_do_tag_minification($do_tag_minification, $style_tag, $file) {

    if ($do_tag_minification && isset($file) && strrpos($file, "elementor/css/post") >= 1) {
        return false;
    }

    return $do_tag_minification;
}

;

// add the filter
//add_filter( 'w3tc_minify_css_do_tag_minification', 'filter_w3tc_minify_css_do_tag_minification', 10, 3 );


add_theme_support('post-thumbnails');
add_filter('gform_allowable_tags', 'allow_basic_tags', 10, 3);

function allow_basic_tags($allowable_tags) {
    return '<p><a><strong><em><br></br><br />';
}

add_filter('gform_allowable_tags', '__return_true');

function externalFile($file) {
    return get_stylesheet_directory_uri() . '/externaljs.php?file=' . $file;
}

add_theme_support('title-tag');

function currentYear() {
    return date('Y');
}

add_shortcode('year', 'currentYear');

//function getUserFirstName() {
//    return date('l F dS Y');
//}
//
//add_shortcode('first-name-custom', 'getUserFirstName');

function currentDate() {
    return date('l F dS Y');
}

add_shortcode('currentdate', 'currentDate');

function header_JS() {

    if (get_the_ID() === 55739) {
        //   var_dump(get_the_ID());
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />';
    }

    $code = '<script async defer crossorigin="anonymous"  src="//jact.atdmt.com/jaction/JavaScriptTest"></script>' .
            '<script data-ad-client="ca-pub-8436806876459334" async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>' .
            '<script type="text/javascript"> window.__be = window.__be || {}; window.__be.id = "5e42c0b2cbb1860007bf6e50";</script>' .
            '<script async defer   src="//securepubads.g.doubleclick.net/tag/js/gpt.js"></script>'
    ;
    $code2 = "<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5VQHH9P');</script>
<!-- End Google Tag Manager -->
(function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src='https://www.clarity.ms/tag/'+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, 'clarity', 'script', '5z2f9o3ei2');
";



    //echo $code;

    global $paged;
    if ($paged) {
        echo '<meta name="robots" content="noindex" />', "\n";
    }
    
    echo '<script defer src="https://convertzy.com/pixel/uzkxz16mnikp8utwp2sjb84yjvuql5rg"></script>';
// 
//   echo "<script type='text/javascript'>
//  window.__be = window.__be || {};
//  window.__be.id = '5e42c0b2cbb1860007bf6e50';
// 
//</script>";
//   
// 
//  $code='
//<script>
//  window.googletag = window.googletag || {cmd: []};
//  googletag.cmd.push(function() {
//    googletag.defineSlot("/22025122300/sidebarad1", [300, 250], "div-gpt-ad-1590138460074-0").addService(googletag.pubads());
//    googletag.defineSlot("/22025122300/sidebarad2", [300, 250], "div-gpt-ad-1590658868888-0").addService(googletag.pubads());
//googletag.defineSlot("/22025122300/sidebarad3", [300, 250], "div-gpt-ad-1590658906840-0").addService(googletag.pubads());
// 
//  googletag.defineSlot("/22025122300/topbanner", [[728, 90]], "div-gpt-ad-1590747775307-0").addService(googletag.pubads());
//      googletag.defineSlot("/22025122300/topbanner", [[320, 50]], "div-gpt-ad-1590747775307-0-mobile").addService(googletag.pubads());
// googletag.defineSlot("/22025122300/bottom-banner", [728, 90], "div-gpt-ad-1590674447513-0").addService(googletag.pubads());
//    
//    googletag.pubads().enableSingleRequest();
//    googletag.enableServices();
//  });
//</script>';
//   
//echo $code2;
}

add_action('wp_head', 'header_JS');

function footer_extra_js() {

    //  wp_enqueue_script('chatbot','//cdn.chatbot.com/widget/plugin.js', array('jquery'), false, true);
//  $code= '<script async defer crossorigin="anonymous"  src="//jact.atdmt.com/jaction/JavaScriptTest"></script>' +
//                '<script data-ad-client="ca-pub-8436806876459334" async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>' +
//                '<script type="text/javascript"> window.__be = window.__be || {}; window.__be.id = "5e42c0b2cbb1860007bf6e50";</script>' +
//                '<script async defer   src="//securepubads.g.doubleclick.net/tag/js/gpt.js"></script>' +
//                '<script>' +
//                '  window.googletag = window.googletag || {cmd: []};</script>' ;
//  echo $code;
//  echo ' <script async defer crossorigin="anonymous" src="'.externalFile('https://cdn.chatbot.com/widget/plugin.js').'"></script>', "\n";
//  echo ' <script data-ad-client="ca-pub-8436806876459334" async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>', "\n";
//   echo ' <script type="text/javascript"> window.__be = window.__be || {}; window.__be.id = "5e42c0b2cbb1860007bf6e50";</script><script async defer   src="//securepubads.g.doubleclick.net/tag/js/gpt.js"></script>', "\n";
//   
//   
//   echo ' <script async defer crossorigin="anonymous" src="'.externalFile('https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v6.0&appId=194942155100100&autoLogAppEvents=1').'"></script>', "\n";
//
//  $code='<script  defer async src="'.externalFile('https://securepubads.g.doubleclick.net/tag/js/gpt.js').'"></script>
//';
//   
//echo $code;
}

//
//  add_filter( 'language_attributes', function( $attr )
//{
//      if(current_user_can('administrator')){
//          var_dump(class_exists('agespace_qa'));
//      }
//      
//      $pattern = '/<div class="class1(\s.*?)?">(.*?)<\/div>/is';
//      if (preg_match($pattern, $my_content, $img)) {
//            echo 'working';
//        }
//      if(  ){
//           return "{$attr} itemscope itemtype=\"https://schema.org/FAQPage\"";
//      }else{
//          return "{$attr}";
//      }
//   
//} );
//
//add_action( 'elementor/frontend/widget/after_render', function (   $widget ) {
//   
//   $settings= $widget->get_settings();
//   
//        if (  $widget->get_name()=="ucaddon_agespace_qa" ) {
//           // preg_replace('/<html \b[^><]*)/i>(.*?)<\/html>/', '$1' 'itemscope');
//                  
//           add_filter( 'language_attributes', function( $attr )
//{
//    return "{$attr} itemscope itemtype=\"https://schema.org/FAQPage\"";
//} );
//      do_action('language_attributes');
//		
//	}  
//        
//     
//} );


add_filter('big_image_size_threshold', '__return_false');


add_filter('document_title_parts', function($title_parts_array) {
    // var_dump('---------------->'.get_the_ID());
    if (get_the_ID() == 2055) {
        $title_parts_array['title'] = 'Custom Page Title';
    }
    return $title_parts_array;
});

// updated use
add_action('elementor/query/maincatloop', 'maincatloop', 10, 2); // sets the ID of the query


add_action('elementor/query/localslider', function($query) {



    $taxquery = array(
        array(
            'taxonomy' => 'category',
            'field' => 'id',
            'terms' => get_field('slider_cats'),
            'operator' => 'IN'
        )
    );

    $query->set('tax_query', $taxquery);
});
add_shortcode('gettitle2', 'gettitle2');

function gettitle2() {
    if (get_field('custom_title2')) {
        return get_field('custom_title2');
    } else {
        return get_the_title();
    }
}

add_shortcode('gettitle', 'gettitle');

function gettitle() {
    if (get_field('custom_title')) {
        return get_field('custom_title');
    } else {
        return get_the_title();
    }
}

//add_filter( 'gform_pre_submission_filter_10', 'downloadGuide' );

function downloadGuide() {

    $cnt = '<form id="download-guide-form" action="https://www.agespace.org/wp-content/themes/Agespace-Elementor/download.php" method="post"></form>';
    $cnt = "";
    ?> 
    <script>
        //  jQuery("#download-guide-form").submit();</script>
    <?php
    echo $cnt;
}

add_shortcode('download-guide', 'downloadGuide');


add_action('elementor/query/catquery', function($query) {

//$terms=get_the_field('catlist',get_the_ID());
//var_dump(get_query_var('customcat'));
    $taxquery = array(
        array(
            'taxonomy' => 'pagecat',
            'field' => 'id',
            //   'terms' => get_query_var('customcat'),
            'terms' => get_query_var('customcat'),
            'operator' => 'IN'
        )
    );

    $query->set('tax_query', $taxquery);
});


add_action('admin_init', function() {
    $custom_sizes['image-600'] = '600 Width';
    add_filter(
            'image_size_names_choose', function($sizes) use ($custom_sizes) {
        return array_merge($sizes, $custom_sizes);
    }
    );
});

add_action('admin_init', function() {
    $custom_sizes['thumb-into'] = '300x300';
    add_filter(
            'image_size_names_choose', function($sizes) use ($custom_sizes) {
        return array_merge($sizes, $custom_sizes);
    }
    );
});

add_image_size('image-600', 600, 99999, true);
add_image_size('related-posts', 375, 170, true);
add_image_size('thumb-into', 300, 300, true);
add_image_size('home-posts', 700, 350, true);
add_image_size('big-image', 2000, 2000);


//add_action( 'wp_enqueue_scripts', 'merge_all_scripts', 9999 );
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');
add_filter('body_class', 'add_category_to_single');

function add_category_to_single($classes) {
    if (is_single()) {
        global $post;
        foreach ((get_the_category($post->ID)) as $category) {
            // add category slug to the $classes array
            $classes[] = $category->category_nicename;
        }
    }
    // return the $classes array
    return $classes;
}

function my_login_logo() {
    ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_home_url(); ?>/wp-content/uploads/2018/07/Agespace-Logo_June18_rightalign_RGB-V2-01.png);
            height:117px;
            width:230px;
            background-size: contain;
            background-repeat: no-repeat;
            padding-bottom: 0px;
        }
    </style>
    <?php
}

add_action('login_enqueue_scripts', 'my_login_logo');

add_action('elementor/widget/render_content', function($content, $widget) {
    if ('button' === $widget->get_name()) {
        $settings = $widget->get_settings();

        if (strpos($settings['_css_classes'], 'loginlogout') !== false) {


            if (is_user_logged_in()) {
                $current_user = wp_get_current_user();


                $avatar = get_avatar($current_user->user_email, 24);
                $content = '<a href="' . wp_logout_url() . '" class="logout-link elementor-button-link elementor-button elementor-size-sm" role="button">
						<span class="elementor-button-content-wrapper">
						<span class="elementor-button-icon elementor-align-icon-left">
				<span class="circle-avatar">' . $avatar . '</span>
			</span>
						<span class="elementor-button-text">Logout</span>
		</span>
					</a>';
            } else {
                //      $content= '<a href="'.site_url('login').'"><i class="fa fa-user"></i>Login</a>';
            }
        }
    }

    return $content;
}, 10, 2);








add_filter('gform_save_field_value', 'replace_awkward_merge_tags', 10, 4);

function replace_awkward_merge_tags($value, $entry, $field, $form) {
    $value = GFCommon::replace_variables($value, $form, $entry);
    return $value;
}

// Add Shortcode
// Buddypress favorites
add_action('register_post', 'binda_register_fail_redirect', 99, 3);

function binda_register_fail_redirect($sanitized_user_login, $user_email, $errors) {
    //this line is copied from register_new_user function of wp-login.php
    $errors = apply_filters('registration_errors', $errors, $sanitized_user_login, $user_email);
    //this if check is copied from register_new_user function of wp-login.php
    if ($errors->get_error_code()) {
        //setup your custom URL for redirection
        $redirect_url = get_bloginfo('url') . '/join';
        //add error codes to custom redirection URL one by one
        foreach ($errors->errors as $e => $m) {
            $redirect_url = add_query_arg($e, '1', $redirect_url);
        }
        //add finally, redirect to your custom page with all errors in attributes
        wp_redirect($redirect_url);
        exit;
    }
}

add_action('wp_login_failed', 'custom_login_failed');

function custom_login_failed($username) {
    $referrer = wp_get_referer();
    wp_redirect(get_home_url() . '/login?checkemail=fail');
//    if ( $referrer && ! strstr($referrer, 'wp-login') && ! strstr($referrer,'wp-admin') )
//    {
//        wp_redirect( get_home_url().'/login?msg=fail' );
//        exit;
//    }
}

add_filter('bbp_user_login_redirect_to', 'bbpressloginredirect');

function bbpressloginredirect($url) {

    return get_home_url() . '/chat';
}

add_filter('bbp_user_register_redirect_to', 'scl_print_bbp_redirect');

function scl_print_bbp_redirect($url) {

    return get_home_url() . '/login?checkemail=registered';
}

if (function_exists('acf_add_options_page')) {
//	acf_add_options_page(array(
//		'page_title' 	=> 'Partner Options',
//		'menu_title'	=> 'Partner Options',
////		'parent_slug'	=> 'menu-posts-partner_section',
//	));
	
    acf_add_options_page(array(
        'page_title' => 'Theme Settings (Extended)',
        'menu_title' => 'Theme Settings (Extended)',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => true
    ));

//   acf_add_options_page(array(
//      'page_title' => 'Members',
//      'menu_title' => 'Members',
//      'menu_slug' => 'theme-members-settings',
//      'capability' => 'edit_posts',
//      'redirect' => true,
//       'position' => '25',
//       'icon_url' => 'dashicons-admin-users',
//  ));
}




register_sidebar(
        array(
            'name' => 'Pages Default Sidebar',
            'id' => 'pages-default-sidebar',
            'description' => '',
            'class' => '',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>')
);

register_sidebar(
        array(
            'name' => 'Local Sidebar COMMON WIDGETS ',
            'id' => 'local-co-default-sidebar',
            'description' => '',
            'class' => '',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>')
);

function remove_some_widgets() {

    // Unregister some of the TwentyTen sidebars
    unregister_sidebar('sidebar-3');
}

add_action('widgets_init', 'remove_some_widgets', 11);

$argsSidebarForum = array(
    'name' => 'Forum Sidebar',
    'id' => 'forum-sidebar',
    'description' => '',
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>');

register_sidebar($argsSidebarForum);

function summary($content, $limit = 200) {
    // Take the existing content and return a subset of it
    $end = '';
    if (strlen($content) > $limit) {
        $end = '...';
    }
    return strip_tags(substr($content, 0, $limit) . $end);
}

if (!function_exists('ch_hide_column_elementor_controls')) {
    add_action('elementor/element/before_section_end', 'ch_hide_column_elementor_controls', 10, 3);

    function ch_hide_column_elementor_controls($section, $section_id, $args) {
        if ($section_id == 'section_advanced') :

            $section->add_control(
                    'hide_desktop_column', [
                'label' => __('Hide On Desktop', 'elementor'),
                'type' => Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'prefix_class' => 'elementor-',
                'label_on' => __('Hide', 'elementor'),
                'label_off' => __('Show', 'elementor'),
                'return_value' => 'hidden-desktop',
                    ]
            );

            $section->add_control(
                    'hide_tablet_column', [
                'label' => __('Hide On Tablet', 'elementor'),
                'type' => Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'prefix_class' => 'elementor-',
                'label_on' => __('Hide', 'elementor'),
                'label_off' => __('Show', 'elementor'),
                'return_value' => 'hidden-tablet',
                    ]
            );

            $section->add_control(
                    'hide_mobile_column', [
                'label' => __('Hide On Mobile', 'elementor'),
                'type' => Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'prefix_class' => 'elementor-',
                'label_on' => __('Hide', 'elementor'),
                'label_off' => __('Show', 'elementor'),
                'return_value' => 'hidden-phone',
                    ]
            );
        endif;
    }

}
add_filter('body_class', 'my_class_names');

function my_class_names($classes) {
    $classes[] = 'user-id-' . get_current_user_id();
    return $classes;
}

add_action('init', 'stop_heartbeat', 1);

function stop_heartbeat() {
    wp_deregister_script('heartbeat');
}

function redirectfixer($hook) {

    if ('settings_page_eps_redirects' === $hook) {

        wp_enqueue_script('ui-dialog', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', array('jquery'));
//wp_enqueue_script( 'jquery-ui-sortable','https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js' , array('jquery') );
//wp_enqueue_script( 'jquery-ui-slider','https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js' , array('jquery') );
    }
}

add_action('admin_head', 'redirectfixer');

function load_custom_wp_admin_style($hook) {

    if ('settings_page_eps_redirects' === $hook) {

        wp_enqueue_script('ui-dialog', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', array('jquery'));
//wp_enqueue_script( 'jquery-ui-sortable','https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js' , array('jquery') );
//wp_enqueue_script( 'jquery-ui-slider','https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js' , array('jquery') );
    }


    wp_enqueue_script('myadmin-scripts', get_stylesheet_directory_uri() . '/js/myadmin-js.js', array('jquery'));
    wp_enqueue_style('admin-css', (get_stylesheet_directory_uri()) . '/css/admin-css.css');
}

add_action('admin_enqueue_scripts', 'load_custom_wp_admin_style');

function my_scripts() {
    wp_enqueue_script('prefixfree', get_stylesheet_directory_uri() . '/js/prefixfree.min.js', array('jquery'), false, true);





    wp_enqueue_script(
            'sidr', get_stylesheet_directory_uri() . '/js/jquery.sidr.min.js', array('jquery'), false, true
    );


    wp_enqueue_script('slick-js', get_stylesheet_directory_uri() . '/js/slick.min.js', array('jquery'), false, true);
    wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri() . '/css/bootstrap/js/bootstrap.min.js', array('jquery'), false, true);

    wp_enqueue_script('selectize-js', get_stylesheet_directory_uri() . '/js/selectize.min.js', array('jquery'), false, true);
    wp_enqueue_script('parallax-js', get_stylesheet_directory_uri() . '/js/parallax.js', array('jquery'), false, true);
    wp_enqueue_script('responsiveTabs-js', get_stylesheet_directory_uri() . '/js/jquery.responsiveTabs.js', array('jquery'), false, true);
    wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/js/custom-script.js', array('jquery'), false, true);


    if (is_front_page() || is_home()) { // change for is_home() if you're not using a front page
//       wp_enqueue_style(
//            'critical-style', get_template_directory_uri() . '/css/critical.css'
//    );
    }


//   wp_enqueue_style(
//            'normalize', get_template_directory_uri() . '/css/normalize.min.css'
//    );
//  wp_enqueue_script('skimresources-js',externalFile('https://s.skimresources.com/js/132802X1595414.skimlinks.js'), array('jquery'), false, true);
// 
//    wp_enqueue_script('skimresources-js',   get_stylesheet_directory_uri().'/js/external/skimlinks.js', array('jquery'), false, true);
    wp_enqueue_style('selectize-css', (get_stylesheet_directory_uri()) . '/css/selectize.css');
    wp_enqueue_style('flag-css', (get_stylesheet_directory_uri()) . '/css/flag-icon.min.css');
    wp_enqueue_style('bootstrap-css', (get_stylesheet_directory_uri()) . '/css/bootstrap/css/bootstrap.min.css');

//  wp_enqueue_style('bootstrap-theme-css', (get_stylesheet_directory_uri()) . '/css/bootstrap/css/bootstrap-theme.min.css');
    wp_enqueue_style('slick', (get_stylesheet_directory_uri()) . '/css/slick.css');
    wp_enqueue_style('slick2', (get_stylesheet_directory_uri()) . '/css/slick-theme.css');
    wp_enqueue_style('fontawesome4', (get_stylesheet_directory_uri()) . '/css/font-awesome/css/font-awesome.min.css');
    wp_enqueue_style('stylesheet', (get_stylesheet_directory_uri()) . '/css/stylesheet.css');
    wp_enqueue_style('elementorStyle', (get_stylesheet_directory_uri()) . '/css/elementor-theme.css');
    // wp_enqueue_style( 'my-theme-google-fonts', '//fonts.googleapis.com/css?family=Inter:300|400|500|600|700|800' );
}

add_action('wp_enqueue_scripts', 'my_scripts');


add_action('get_footer', 'prefix_add_footer_styles');

add_action('wp_footer', 'footer_extra_js');

function prefix_add_footer_styles() {
//      wp_enqueue_script('chatbot-js', get_stylesheet_directory_uri() . '/js/externals/plugin.js', array('jquery'), false, true);
//     wp_enqueue_script('facebookSDK-js', get_stylesheet_directory_uri() . '/js/externals/sdk.js', array('jquery'), false, true);
    wp_enqueue_style('elementorStyle', (get_stylesheet_directory_uri()) . '/css/elementor-theme.css');
    wp_enqueue_style('sidr-css', (get_stylesheet_directory_uri()) . '/css/jquery.sidr.dark.min.css');
}

register_nav_menus(array(
    'newhomemenu' => __('New Home Menu', 'agespace'),
      'topmenulocation' => __('Top Menu Locations', 'agespace'),
));



// allow shortcodes to run in widgets
add_filter('widget_text', 'do_shortcode');
// don't auto-wrap shortcode that appears on a line of it's own
add_filter('widget_text', 'shortcode_unautop');

function get_featured_image($ID, $size = 'full') {
    $post_thumbnail_id = get_post_thumbnail_id($ID);
    $attachment = wp_get_attachment_image_src($post_thumbnail_id, $size);
    $title = get_the_title(get_post_thumbnail_id($ID));
    $result = [
        'width' => $attachment[1],
        'height' => $attachment[2],
        'url' => $attachment[0],
        'title' => $title,
        'alt' => $title,
        'img' => get_the_post_thumbnail($ID, $size)
    ];
    return $result;
}

function wpseo_fix_title_buddypress($title) {
    // Check if we are in a buddypress page 
    if (function_exists('buddypress') && buddypress()->displayed_user->id || buddypress()->current_component) {
        $bp_title_parts = bp_modify_document_title_parts();

        // let's rebuild the title here
        $title = $bp_title_parts['title'] . ' ' . $title;
    }
    return $title;
}

// Hook into an action when Merge Tags are attached to Trigger.
add_action('notification/trigger/merge_tags', function($trigger) {

    // Check if registered Trigger is the one you need.
    if ('user/registered' !== $trigger->get_slug()) {
        return;
    }
// Pay attention to the Tag type you are defining.
    // If you want to output an HTML, use HtmlTag instead.
    $trigger->add_merge_tag(new BracketSpace\Notification\Defaults\MergeTag\StringTag([
                'slug' => 'user_firstname',
                'name' => __('User First Name', 'textdomain'),
                'resolver' => function($trigger) {

                    //  var_dump(get_user_meta( $trigger->user_object->ID, 'first_name', true ));

                    return get_user_meta($trigger->user_object->ID, 'first_name', true);
                },
    ]));
});


add_shortcode('testtest', function() {
    //    var_dump(get_user_meta( 5173, 'first_name', true ));
    return '';
});




add_shortcode('postslug','slugPost');

function slugPost(){
     global $post;
    $post_slug = $post->post_name;
    return $post_slug;
}
//
//function make_posts_from_taxonomy() {
//if(isset($_GET['DO'])) { //Ensure we only run function once
//
//// Get all Taxonomy
//$taxonomy = 'ag_county'; //Define Custom Taxonomy (source)
//$post_type = 'ag_county_post'; // Define Custom Post Type (target)
//
//$args = array(
//	'parent' => 0, //In my case I only wanted top level terms returned
//	'hide_empty' => false,
//    'taxonomy'=>$taxonomy
//	);
//	
//
//$post_type = 'ag_county_post'; // Define Custom Post Type (target)
//
//$terms = get_terms( array( 
//    'taxonomy' => $taxonomy,
//    'parent'   => 0
//) );
//
//
//foreach ($terms as $term) {
//	set_time_limit(20); //Attempt to prevent timeouts
//	$t_id = $term->term_id;
//	$term_meta = get_option( "taxonomy_$t_id" );
//	$name = $term->name; //Title
//	$slug = $term->slug; //Slug
//	$description = $term->description; //Description
//	
//	//Above finds all the data from Custom Taxonomy and associated metadata.
//	//We make a new post for each item, using same details from Taxonomy
//	if( null == get_page_by_title( $name ) ) { // If that post doesn't exist of course.
//		$new_post = array(
//			
//			'post_title' => $name,
//			'post_content' => $description, //Use Taxonomy description for Post Content
//			'post_name' => $slug,
//			'post_status' => 'publish',
//			'post_type' => $post_type,
//			
//	);
//	//Insert post
//	$post_id = wp_insert_post( $new_post );
//	
////	//Insert meta where it exists. Note that my meta is stored like so: http://pippinsplugins.com/adding-custom-meta-fields-to-taxonomies/
////	if (!empty($term_meta['buy_download_meta'])) : update_post_meta ($post_id, '_cmb_buy', $term_meta['buy_download_meta']); endif;
////	if (!empty($term_meta['custom_term_meta'])) : update_post_meta ($post_id, '_cmb_discogs', $term_meta['custom_term_meta']); endif;
////	if (!empty($term_meta['itunes_meta'])) : update_post_meta ($post_id, '_cmb_itunes', $term_meta['itunes_meta']); endif;
////	if (!empty($term_meta['artist_showcase_meta'])) : update_post_meta ($post_id, '_cmb_showcase', $term_meta['artist_showcase_meta']); endif;
////
////		} else { // Do sweet F.A.
////	}
//
//	
//	} //End foreach
//var_dump('DONE');
//} 
//}
//
            