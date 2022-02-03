<?php

/**
 * Topics Loop
 *
 * @package bbPress
 * @subpackage Theme
 */


?>

<?php do_action( 'bbp_template_before_topics_loop' ); ?>


  <?php   
if(get_field('forum_intro')){
  echo '<div class="forum-intro">'.get_field('forum_intro').'</div>';
}
  ?>
           <?php   get_template_part('section', 'ask-question-new');  ?>

            <div id="forum-area" class="row no-margin">
               
                <div id="recent-topics" class="col-xs-12 no-margin">
                    
                    <h1 class="alltopictitle"><?php echo get_the_title(bbp_get_forum_id());   ?></h1>
                   <div id="bbp-forum-<?php bbp_forum_id(); ?>">
                        

	<div class="bbp-body">
 <?php 
 $default = array(
    'post_type' => bbp_get_topic_post_type(), // Narrow query down to bbPress topics
    'post_parent' => bbp_get_forum_id(), // Forum ID
    'meta_key' => '_bbp_last_active_time', // Make sure topic has some last activity time
    'orderby' => 'date', // 'meta_value', 'author', 'date', 'title', 'modified', 'parent', rand',
    'order' => 'DESC', // 'ASC', 'DESC'
    'posts_per_page' => bbp_get_topics_per_page(), // Topics per page
    'paged' => bbp_get_paged(), // Page Number
    's' => $default_topic_search, // Topic Search
    'show_stickies' => $default_show_stickies, // Ignore sticky topics?
    'max_num_pages' => false, // Maximum number of pages to show
);
 if ( bbp_has_topics( $default ) ) : ?>
		<?php while ( bbp_topics() ) : bbp_the_topic();  ?>

			<?php bbp_get_template_part( 'loop', 'single-topic' ); ?>

		<?php endwhile; ?>
 <?php endif;?>
	</div>

	

</div><!-- #bbp-forum-<?php bbp_forum_id(); ?> -->
                </div>


            </div>    




 




<?php do_action( 'bbp_template_after_topics_loop' ); ?>
