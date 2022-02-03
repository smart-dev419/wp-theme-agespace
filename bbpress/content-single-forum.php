<?php

/**
 * Single Forum Content Part
 *
 * @package bbPress
 * @subpackage Theme
 * 
 * agespace/forum/agespace-forum/
 */

?>
<div id="bbpress-forums">




	<?php do_action( 'bbp_template_before_topics_index' ); ?>
                
	<?php 
        
        $args1 = array(
	'post_parent' => bbp_get_forum_id(),
	'post_type'   => 'forum', 
	'numberposts' => -1,
	'post_status' => 'any' 
);
$children = get_children( $args1 );

       $pageids = array();
    
    foreach($children as $page){
     $pageids[] = $page->ID;
}



      
     

        if ( bbp_has_topics() ) : ?>

		
    <?php  //bbp_get_template_part('pagination', 'topics'); ?>

        <?php bbp_get_template_part('loop', 'topics'); ?>

        <?php bbp_get_template_part('pagination', 'topics'); ?>
		

	<?php else :
            
            if($pageids){
                echo '<div class="p25"><h4>This is a parent forum, please choose a forum here:</h4>';
                $args=array (
      'before'              => '<div class="bbp-forums-list">',
        'after'               => '</div>',
        'link_before'         => '<div class="bbp-forum">',
        'link_after'          => '</div>',
        'count_before'        => ' (',
        'count_after'         => ')',
        'count_sep'           => ', ',
        'separator'           => ', ',
        'forum_id'            => bbp_get_forum_id(),
        'show_topic_count'    => true,
        'show_reply_count'    => false,
    
);
                
                bbp_list_forums($args);
                echo '</div>';
            }else{
                bbp_get_template_part( 'feedback',   'no-topics' );
            }
            ?>

		

	<?php endif; ?>

	<?php do_action( 'bbp_template_after_topics_index' ); ?>

</div>
