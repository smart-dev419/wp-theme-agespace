<?php


add_shortcode('users-table','usersTable');

function usersTable(){
 



}

add_shortcode('users-counter','usersCounter');
function usersCounter(){
   $users_count = count( get_users( array( 'fields' => array( 'ID' ), 'role__in' => ['bbp_participant','full_member'] ) ) );

 
return $users_count > 2700 ? : '2700' ;
}

add_shortcode('postcode','postcodeX');
function postcodeX(){
   
return '<span class="postcodex">'.$_GET['postcode'].'</span>';
}

add_shortcode('care-url','careURL');
function careURL(){
$url='https://www.edyn.care/find-care-at-home/'.$_GET['postcode'].'?utm_source=agespace&utm_medium=content&utm_campaign=liveincare';   
return $url;
}

add_shortcode('full-users','usersFull');
function usersFull(){
  $blogusers = get_users( [ 'role__in' => [ 'full_member' ] ] );
// Array of WP_User objects.
  echo '<ul class="admin-listed-ul">';
foreach ( $blogusers as $user ) {
   
  echo '<li class="admin-listed-members"><span>' . esc_html( $user->display_name ) . '</span><a href="user-edit.php?user_id='.$user->ID.'">Edit</a></li>';
}
  echo '</ul>';
}

add_shortcode('email-users','usersEmail');
function usersEmail(){
  $blogusers = get_users( [ 'role__in' => [ 'email_member' ] ] );
// Array of WP_User objects.
  echo '<ul class="admin-listed-ul">';
foreach ( $blogusers as $user ) {
   
    echo '<li class="admin-listed-members"><span>' . esc_html( $user->display_name ) . '</span><a href="user-edit.php?user_id='.$user->ID.'">Edit</a></li>';
}
  echo '</ul>';
}

function custom_bbpress_recent_reply_row_template($row_number) {
 
    // get the reply title
    $title = get_the_title();

    // optional title adjustments -- delete or comment out to remove
    // remove "Reply To: " from beginning of title
    $title = str_replace('Reply To: ', '', $title);

    // trim title to specific number of characters (55 characters)
    $limit=65;
    $end="";
     if (strlen($title) > $limit) {
    $end = '…';
  }
    $title = substr($title, 0, $limit);

  $title=$title.$end;

    // trim title to specific number of words (5 words)...
   // $title = wp_trim_words($title, 5, '...');

    // determine if odd of even row
    $row_class = ($row_number % 2) ? 'odd' : 'even';
    ?>

    <div class="bbpress-recent-reply-row <?php print $row_class; ?>">

        <div class="avatar-wrap hidden">
    <?php print get_avatar(get_the_author_meta('ID'), 80, '', "Avatar"); ?>
        </div>


      <div class="flex-wrap">
         <div class="title"><a rel="nofollow" href="<?php the_permalink(); ?>"><?php print $title; ?></a></div>
        <div class="meta">
            <span class="author">By: <?php echo get_the_author() ? get_the_author() : 'Guest'; ?></span><span class="date pull-right"><a rel="nofollow" href="<?php the_permalink(); ?>"><?php print human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></a></span>
        </div>
        <div class="content hidden">
    <?php
    $excerpt = get_the_excerpt();
    $excerpt = substr($excerpt, 0, 70);
    echo $excerpt . '...';
    ?>
        </div>
      </div>




    </div>
    <?php
}

function custom_bbpress_recent_replies_by_topic($atts) {
  $short_array = shortcode_atts(array('show' => 5, 'forum' => false, 'dynamic' => false, 'include_empty_topics' => true), $atts);
  extract($short_array);

  // default values
//  $post_types = array('reply');
//  $meta_key = '_bbp_last_reply_id';

  // allow for topics with no replies

  $meta_key = '_bbp_last_active_id';
  $post_types[] = 'topic';


  // get the 5 topics with the most recent replie
  $args = array(
      'posts_per_page' => $show,
      'post_type' => array('topic'),
      'post_status' => array('publish'),
      'orderby' => 'meta_value_num',
      'order' => 'DESC',
      'meta_key' => $meta_key,
  );



  $query = new WP_Query($args);
  $reply_ids = array();

  // get the reply post->IDs for these most-recently-replied-to-topics
  while ($query->have_posts()) {
    $query->the_post();

    if ($reply_post_id = get_post_meta(get_the_ID(), $meta_key, true)) {
      $reply_ids[] = $reply_post_id;
    }
  }
  wp_reset_query();

  // get the actual replies themselves
  $args = array(
      'posts_per_page' => $show,
      'post_type' => $post_types,
      'orderby' => 'date',
      'order' => 'DESC'
  );


  if ($dynamic) {
    $parentID = wp_get_post_parent_id(get_the_ID());

    $pageID = $parentID ? $parentID : get_the_ID();

    switch ($pageID) {
      case 2979: //dementia
        $forum = 27500;
        break;

      case 23334: //dementia (herbert)
        $forum = 27500;
        break;



      case 1717: //care
        $forum = 12358;
        break;

      case 1999: //care
        $forum = 12358;
        break;

      case 1148: //money
        $forum = 15135;
        break;

      case 1159: //money
        $forum = 15135;
        break;

      case 8096: //money
        $forum = 15135;
        break;

      case 1854: //money
        $forum = 15135;
        break;

      case 15392: //money
        $forum = 15135;
        break;





      case 1295: //legal
        $forum = 12375;
        break;

      case 5113: //legal
        $forum = 12375;
        break;

      case 1003: //Health
        $forum = 12360;
        break;

      case 2045: //Health
        $forum = 12360;
        break;

      case 3539: //Health
        $forum = 12360;


      case 26721: //career
        $forum = 12378;
        break;
    }
  }
  // allow for specific forum limit
  if ($forum) {
    $args['post_parent'] = (int) $forum;
  }


  $query = new WP_Query($args);
  ob_start();
  // loop through results and output our rows
  while ($query->have_posts()) {
    $query->the_post();

    // custom function for a single reply row
    custom_bbpress_recent_reply_row_template($query->current_post + 1);
  }
  wp_reset_query();

  $output = ob_get_clean();
  return $output;
}

add_shortcode('bbpress_recent_replies_by_topic', 'custom_bbpress_recent_replies_by_topic');




add_shortcode('recent-questions-title', 'recentQuestionTitleWidget');

function recentQuestionTitleWidget() {
  $dynamicText = "";
  $parentID = wp_get_post_parent_id(get_the_ID());

  $pageID = $parentID ? $parentID : get_the_ID();
  if (current_user_can('administrator')) {

    //  var_dump($pageID);
  }

  switch ($pageID) {
    case 2979: //dementia
      $dynamicText = "Dementia";
      break;
    case 23334: //dementia (herbert)
      $dynamicText = "Dementia";
      break;



    case 1717: //care
      $dynamicText = "Care";
      break;

    case 1999: //care
      $dynamicText = "Care";
      break;

    case 1148: //money
      $dynamicText = "Money";
      break;

    case 1159: //money
      $dynamicText = "Money";
      break;

    case 8096: //money
      $dynamicText = "Money";
      break;

    case 1854: //money
      $dynamicText = "Money";
      break;

    case 15392: //money
      $dynamicText = "Money";
      break;


    case 1295: //legal
      $dynamicText = "Legal";
      break;


    case 5113: //legal
      $dynamicText = "Legal";
      break;


    case 1003: //Health
      $dynamicText = "Health";
      break;

    case 3539: //Health
      $dynamicText = "Health";
      break;

    case 2045: //Health
      $dynamicText = "Health";
      break;




    case 26721: //career
      $dynamicText = "Career";
      break;
  }



  return '<h4 class="widget-title">Latest ' . $dynamicText . ' Questions</h4>';
}

add_filter('bbp_get_dynamic_roles', 'my_bbp_custom_role_names');

function my_bbp_custom_role_names() {
  return array(
      // Keymaster
      bbp_get_keymaster_role() => array(
          'name' => __('Forum Admin', 'bbpress'),
          'capabilities' => bbp_get_caps_for_role(bbp_get_keymaster_role())
      ),
      // Moderator
      bbp_get_moderator_role() => array(
          'name' => __('Forum Moderator', 'bbpress'),
          'capabilities' => bbp_get_caps_for_role(bbp_get_moderator_role())
      ),
      // Participant
      bbp_get_participant_role() => array(
          'name' => __('Forum Member', 'bbpress'),
          'capabilities' => bbp_get_caps_for_role(bbp_get_participant_role())
      ),
      // Spectator
      bbp_get_spectator_role() => array(
          'name' => __('Forum Spectator', 'bbpress'),
          'capabilities' => bbp_get_caps_for_role(bbp_get_spectator_role())
      ),
      // Blocked
      bbp_get_blocked_role() => array(
          'name' => __('Blocked', 'bbpress'),
          'capabilities' => bbp_get_caps_for_role(bbp_get_blocked_role())
      )
  );
}


function twitterwidget() {
    $out = '<div id="twitter-widget" style="margin-bottom: 30px;"><a class="twitter-timeline" href="https://twitter.com/AgeSpace" data-widget-id="660068135039606784">Tweets by @AgeSpacer</a></div>';
    if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Speed Insights') === false):
        return $out;
    endif;
}

function fbwidget() {
    $out = '<div id="fb-widget" class="fb-page" data-href="https://www.facebook.com/agespace.org" data-tabs="timeline" data-height="500" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false">
<div class="fb-xfbml-parse-ignore">
<blockquote cite="https://www.facebook.com/agespace.org"><a href="https://www.facebook.com/agespace.org">Age Space</a></blockquote>
</div>
</div>';
    if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Speed Insights') === false):
        return $out;
    endif;
}
    
function adsblock() {
    $out = '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Sidebar Ad -->
<ins class="adsbygoogle" style="display: block;" data-ad-client="ca-pub-8436806876459334" data-ad-slot="5568601408" data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>';
    if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Speed Insights') === false):
        return $out;
    endif;
}

add_shortcode('twitterwidget', 'twitterwidget');
add_shortcode('facebookwidget', 'fbwidget');
add_shortcode('adsblock', 'adsblock');


add_shortcode('box', 'box_shortcode');
function box_shortcode($atts, $content) {
  $atts = shortcode_atts(
          array(
      'width' => 'full',
          ), $atts);

  switch ($atts['width']) {
    case 'full':
      $atts['width'] = "col-xs-12";
      break;
    case '50%':
      $atts['width'] = "col-xs-12 col-sm-6";
      break;
    case '33%':
      $atts['width'] = "col-xs-12 col-sm-4";
      break;
    case '66%':
      $atts['width'] = "col-xs-12 col-sm-8";
      break;
  }

  return '<div class="ag-box ' . $atts['width'] . '"><div class="wrap">' . do_shortcode($content) . '</div></div>';
}


/*-----------------------------------------------------------------------------------*/
/*	Register Theme Sidebars
/*-----------------------------------------------------------------------------------*/
vce_register_sidebars();
function vce_register_sidebars() {
	/* Default Sidebar */


	/* Add sidebars from theme options */

	$custom_sidebars = 0;

	if ( $custom_sidebars ) {
		for ( $i = 1; $i <= $custom_sidebars; $i++ ) {
                    switch($i){
                        case 1: 
                             $name=__( 'Norfolk', 'agespace' );
                            break;
                          case 2: 
                             $name=__( 'Dorset', 'agespace' );
                            break;
                          case 3: 
                             $name=__( 'Sussex', 'agespace' );
                            break;

                         case 4: 
                             $name=__( 'Cheshire', 'agespace' );
                            break;
                         case 5: 
                             $name=__( 'Merseyside', 'agespace' );
                            break;
                        
                           case 6: 
                             $name=__( 'Hampshire & Isle of Wight', 'agespace' );
                            break;
                        
                           case 7: 
                             $name=__( 'Kent', 'agespace' );
                            break;
                        
                          case 8: 
                             $name=__( 'Suffolk', 'agespace' );
                            break;
                          case 9: 
                             $name=__( 'Cambridge', 'agespace' );
                            break;
                        
                         case 10: 
                             $name=__( 'Essex', 'agespace' );
                            break;
                        
                         case 11: 
                             $name=__( 'Surrey', 'agespace' );
                            break;
                        
                       
                    }
                  
			register_sidebar(
				array(
					'id' => 'vce_sidebar_'.$i,
					'name' => $name,
					'description' => '',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<h4 class="widget-title"><span>',
					'after_title' => '</span></h4>'
				)
			);
		}
	}

}