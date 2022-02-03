<?php
function headerAdAdvance( $atts ) {
     $cntnt= get_ad_placement('header-ad');

//var_dump(get_field('hide_sidebar_ad'));
if(get_field('hide_header_ad')){
    return '';
}else{
   
     return $cntnt;
}
      

}
add_shortcode( 'header-ads-advanced', 'headerAdAdvance' );


         function adslot1sidebar1( $atts ) {
     $cntnt= get_ad_placement('sidebar-1');
   

//var_dump(get_field('hide_sidebar_ad'));
if(get_field('hide_sidebar_ad')){
    return '';
}else{
   
     return $cntnt;
}
      

}
add_shortcode( 'adslot1sidebar1', 'adslot1sidebar1' );

function sidebarAdsAdvanced( $atts ) {
     $cntnt='<div class="sidebar-placement-widget">'.
  get_ad_placement('sidebar-1').
   get_ad_placement('sidebar-2').
    get_ad_placement('sidebar-3').
   '</div>';

//var_dump(get_field('hide_sidebar_ad'));
if(get_field('hide_sidebar_ad')){
    return '';
}else{
   
     return $cntnt;
}
      

}
add_shortcode( 'sidebar-ads-advanced', 'sidebarAdsAdvanced' );

function adWidget1( $atts ) {
$code="<div id='div-gpt-ad-1590138460074-0' class='sidebar-google-widget'>

</div>";
        return $code;

}

add_shortcode( 'ad-widget1', 'adWidget1' );

function adWidget2 ($atts) {
$code="<div id='div-gpt-ad-1590658868888-0' class='sidebar-google-widget'>


";
        return $code;

}

add_shortcode( 'ad-widget2', 'adWidget2' );


function adWidget3 ($atts) {
$code="<div id='div-gpt-ad-1590658906840-0' class='sidebar-google-widget'>

</div>

";
        return $code;

}

add_shortcode( 'ad-widget3', 'adWidget3' );

function adHeader ($atts) {
    $code="<!-- /22025122300/topbanner -->
        <div id='google-widget-header-desktop'>
<div id='div-gpt-ad-1590747775307-0' class='google-widget-header'>
 
</div></div>
";
  
        return $code;

}

add_shortcode( 'adwidget-header', 'adHeader' );

function adHeaderMobile ($atts) {
    $code="<!-- /22025122300/topbanner -->
<div id='div-gpt-ad-1590747775307-0-mobile' class='google-widget-header'>
 
</div>
";
  
        return $code;

}

add_shortcode( 'adwidget-header-mobile', 'adHeaderMobile' );


function adFooter ($atts) {
    $code="
<div id='div-gpt-ad-1590674447513-0' class='google-widget-bottom'>
 
</div>
";
  
        return $code;

}

add_shortcode( 'adwidget-bottom', 'adFooter' );



function adsWidget ($atts) {
$code="
<div class='sidebar-google-widgets-holder'>   
<div id='div-gpt-ad-1590138460074-0' class='sidebar-google-widget'>

</div>
<div id='div-gpt-ad-1590658868888-0' class='sidebar-google-widget'>

</div>
<div id='div-gpt-ad-1590658906840-0' class='sidebar-google-widget'>


</div>
</div> 
";
        return $code;

}
add_shortcode( 'ads-widget', 'adsWidget' );


// Add Shortcode
function anchorShortcode( $atts ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'id' => '',
		),
		$atts
	);
        return '<span id="'.$atts['id'].'" class="anchor-placeholder"></span>';

}
add_shortcode( 'anchor', 'anchorShortcode' );

function pageParents( $atts ) {

	//  $cntnt=wp_get_post_parents_id(get_the_ID());
          $parents = get_post_ancestors( $post->ID );
/* Get the ID of the 'top most' Page if not return current page ID */
$id = ($parents) ? $parents[count($parents)-1]: $post->ID;
$parentsSlug=array();
foreach($parents as $parent){
    $slug = get_post_field( 'post_name', $parent );
    $parentsSlug[]=$slug;
}

        return $parentsSlug;

} 
 
add_shortcode( 'parents-slugs', 'pageParents' );


function mapSVG( $atts ) {

	$svg_file = '<div id="interatcive-uk-map">'.file_get_contents(get_template_directory().'/images/drawing.svg').'</div>';
      

        return $svg_file;

}

add_shortcode( 'svg-map', 'mapSVG' );

// Add Shortcode
function ribbonfn( $atts ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'color' => 'purple',
			'text' => 'Text',
		),
		$atts,
		'ribbon'
	);
         $cntnt='<div class="ribbon ribbon-top-left '.$atts['color'].'"><span>'.$atts['text'].'</span></div>';
        return $cntnt;

}

add_shortcode( 'ribbon', 'ribbonfn' );


function parentID( $atts ) {

	
	
         $cntnt=wp_get_post_parent_id(get_the_ID());
        return $cntnt;

}

add_shortcode( 'parent-id', 'parentID' );


   
function easyCount() {


$out=do_shortcode('[easy-total-shares url="'.get_permalink($post->ID).'" fullnumber="yes" align="left" networks="facebook,twitter"]');

 
  return $out;
}

add_shortcode('share-count', 'easyCount');
           
function shareFacebook() {
$out='https://www.facebook.com/sharer/sharer.php?u='.get_permalink();

 
  return $out;
}

add_shortcode('share-facebook', 'shareFacebook');

function shareTwitter() {
$out='http://twitter.com/share?text='.get_the_title().'&url='.get_permalink();

  return $out;
}

add_shortcode('share-twitter', 'shareTwitter');


//function addthiswidget() {
//$out='<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5dd6782833429f0f"></script>';
//$out.='<div class="addthis_inline_share_toolbox"></div>';
// 
//  return $out;
//}
//
//add_shortcode('share-buttons', 'addthiswidget');
function hasChildPage() {
    global $post;
   
    $children = get_pages('child_of='.$post->ID);
  
    if( count( $children ) > 0 ) {
        $parent = true;
    }

    return $parent;
}
add_shortcode('smart-local-partners', 'partnerlogos');
function partnerlogos() {

$parent_slug = get_post_ancestors(get_the_ID());



 $slug1 = basename( get_permalink($parent_slug[0]) );//parent ,norfolk sussex etc.
    $slug2 = basename( get_permalink($parent_slug[1]) );
    $slug3 = basename( get_permalink($parent_slug[2]) );
$comparePage=array($slug1, $slug2,$slug3);

  //var_dump(join(', ', array($slug1, $slug2,$slug3)));
   if( current_user_can( 'administrator' ) ){
     //  var_dump($comparePage);

} // only if administrator

      $args = array(
      'post_type' => 'localpartners',
      'posts_per_page' => -1,
  'orderby' => 'menu_order', 
    'order' => 'ASC',
          
      'meta_query' => array(
           'relation' => 'OR', /* <-- here */
          array(
              'key' => 'localcat',
       'value'     => $slug1,
 
              'compare' => "LIKE"
          ),
           array(
              'key' => 'localcat',
       'value'     => $slug2,
 
              'compare' => "LIKE"
          )
          ,
           array(
              'key' => 'localcat',
       'value'     => $slug3,
 
              'compare' => "LIKE"
          )
      )
  );



  $the_query = new WP_Query($args);
  // The Loop
  $out="";
  if ($the_query->have_posts()) {
    $out.= '<div class="local-partners">'
    . '<ul>';
    while ($the_query->have_posts()) {
      $post = $the_query->the_post();
      $image = get_field('image', get_the_ID());
       $link = get_field('link', get_the_ID());
   if( current_user_can( 'administrator' ) ){
  // $localcat=get_field('localcat', get_the_ID());
//var_dump($localcat);
} // only if administrator
         // var_dump($image['sizes']['related-posts'] );

 $out.= $link ? '<li><a target="_blank" href="' . $link . '"><img src="' . $image['sizes']['medium_large'] . '" alt="' . get_the_title() . '" /></a></li>' : '<li><span><img src="' . $image['sizes']['medium_large'] . '" alt="' . get_the_title() . '" /></span></li>' ;
      
    }
     $out.= '</div>'
    . '</ul>';
  } else {
    // no posts found
  }
  /* Restore original Post Data */
  wp_reset_postdata();
  return $out;
  
  



}



function registerbutton() {

  if (!is_user_logged_in()) {
    $btn = '<a href="' . home_url("/join-us") . '">Register</a>';
  } else {
    $btn = '';
  }
  return $btn;
}

add_shortcode('register-button', 'registerbutton');
function loginlogoutTitle() {

  if (is_user_logged_in()) {
    $btn = 'Logout';
  } else {
    $btn = 'Login';
  }
  return $btn;
}

add_shortcode('loginlogout', 'loginlogoutTitle');

function loginlogoutlink() {

if (is_user_logged_in()) {
    $btn = wp_logout_url();
  } else {
    $btn = home_url("/login") ;
  }
  return $btn;
}

add_shortcode('loginlogoutlink', 'loginlogoutlink');



function loginlogoutbtn() {

  if (is_user_logged_in()) {
    $btn = '<a href="' . wp_logout_url() . '">Logout</a>';
  } else {
    $btn = '<a href="' . home_url("/login") . '">Login</a>';
  }
  return $btn;
}

add_shortcode('login-logout-button', 'loginlogoutbtn');

function loginRedirectFN() {
  if (is_user_logged_in()) {
      if( current_user_can( 'administrator' ) ){
    
    echo "You can see this page because you are 'Administrator'";
}else{
  wp_redirect(home_url('/chat'));
}
  
  }
}

add_shortcode('login-redirect', 'loginRedirectFN');


add_shortcode('local-pages', 'localpages');

function localpages() {
  $gridPosts = get_field('grid_posts');
  if ($gridPosts):
    echo '<div class="local-grid-wrap row">';
    foreach ($gridPosts as $item):
      //  var_dump( $item['image']['sizes']['medium']);
      //$item['image']['sizes']['thumb-into']
      ?> 

      <div class=" col-xs-12 col-sm-6">
        <div class="local-grid-post">
          <a class="post-image" target="_self" href="<?php echo $item['link']['url']; ?>">
            <img src="<?php echo $item['image']['url']; ?>" alt="<?php echo $item['title'] ?>" />
          </a>



          <h4><a target="_self" href="<?php echo $item['link']['url']; ?>"><?php echo $item['title'] ?></a></h4>

          <?php echo '<div class="excerpt">' . $item['excerpt'] . '</div>'; ?> 
        </div>

      </div>

      <?php
    endforeach;
    echo '</div>';
  endif;
}

add_shortcode('listed-content', 'listedcontent');

function listedcontent() {
  $listedContent = CFS()->Get('listed_content', get_the_ID());
  if ($listedContent):
    foreach ($listedContent as $item):
      ?> 
      <div class="listed-content row">
        <div class="col-xs-12 col-sm-3">
          <a target="_self" href="<?php echo $item['link']; ?>">
            <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title'] ?>" />
          </a>
        </div>
        <div class="col-xs-12 col-sm-9">

          <h4><a target="_self" href="<?php echo $item['link']; ?>"><?php echo $item['title'] ?></a></h4>

          <?php echo $item['body_text']; ?> 

        </div>
      </div>

      <?php
    endforeach;
    ?>
    <div id="after-list">
      <?php echo CFS()->Get('content_after_list', get_the_ID()); ?>
    </div>
    <?php
  endif;
}

add_shortcode('short-title', 'shorttitle');

function shorttitle() {
  $title = str_replace('&#8230;', '', get_the_title());
  $title = summary(($title), 50);

  return html_entity_decode($title);
}

add_shortcode('joinwidget', 'joinwidget');

function joinwidget($atts) {
  $a = shortcode_atts(array(
      'img' => '',
          ), $atts);

  $content = '<div class="widget-join">
<h4>Join the Conversation</h4>
<div class="widget-body">
<img src="' . $atts['img'] . '" alt="Join us" />At Age Space’s heart is a <a href="https://agespace.org/chat">friendly forum</a> where you can ask questions, find creative answers, say the ‘unspeakable’, and read about the creative solutions others have come up with.
<div class="btn-row" align="center"><a class="btn login-btn"  href="https://agespace.org/chat/login/">Login</a>
<a class="btn register-btn" href="https://agespace.org/join-us">Register</a></div>
</div>
</div>';
  return $content;
}

add_shortcode('cathook', 'cathook');

function cathook() {




  //  set_query_var('customcat', get_field('listpagescat'));
}

add_shortcode('readnext', 'readnext');

function readnext() {
  return get_template_part('section', 'read-next');
}

add_shortcode('askform', 'askform');

function askform() {
  return get_template_part('section', 'ask-question-new');
}

add_shortcode('question', 'question_shortcode');

function question_shortcode($atts, $content = null) {

  return '<div class="question">' . do_shortcode($content) . '</div>';
}

add_shortcode('answer', 'answer_shortcode');

function answer_shortcode($atts, $content = null) {
  return '<div class="answer">' . do_shortcode($content) . '</div>';
}

function checkLoggedIn($params, $content = null) {
  //check tha the user is logged in
  if (is_user_logged_in()) {

    //user is logged in so show the content
    return true;
  } else {

    //user is not logged in so hide the content
    return false;
  }
}

//add a shortcode which calls the above function
add_shortcode('is-logged-in', 'checkLoggedIn');

function check_user($params, $content = null) {
  //check tha the user is logged in
  if (is_user_logged_in()) {

    //user is logged in so show the content
    return do_shortcode($content);
  } else {

    //user is not logged in so hide the content
    return;
  }
}

//add a shortcode which calls the above function
add_shortcode('loggedin', 'check_user');

function check_user_new($params, $content = null) {
  //check tha the user is logged in
  if (!is_user_logged_in()) {

    //user is logged in so show the content
    return do_shortcode($content);
  } else {

    //user is not logged in so hide the content
    return;
  }
}

//add a shortcode which calls the above function
add_shortcode('newuser', 'check_user_new');

function parentpage() {

  global $post;
  if (is_page() && $post->post_parent) {
    return 'In <a href="' . get_permalink($post->post_parent) . '">' . get_the_title($post->post_parent) . '</a>';
  } else {
    // This is not a subpage
  }
}

add_shortcode('parentpage', 'parentpage');
