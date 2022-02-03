<?php

/**
 * Archive Topic Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */

$preview=$_GET['preview'] || $_GET['preview_id'] ? true : false ;

?>

<div id="bbpress-forums">


  <?php 
  if(!$preview){
  get_template_part('section', 'askform'); 
  }
  ?>

	<?php do_action( 'bbp_template_before_topics_index' ); ?>

	<?php if ( bbp_has_topics() ) : ?>

		

		     <div id="forum-area" class="row no-margin">
           <?php if(!$preview){   ?>
                <div class="col-xs-12 col-sm-3 no-margin-left">
              <?php get_template_part('forum-left-sidebar');   ?>
                </div>
           <?php }   ?>
                <div id="recent-topics" class="col-xs-12 <?php if(!$preview) echo 'col-sm-9'; ?> no-margin">
                    <h1 class="alltopictitle">Questions</h1>
                <div class="bbp-body">

		<?php
//                $default = array(
//    'post_type' => bbp_get_topic_post_type(), // Narrow query down to bbPress topics
//    'post_parent' => $default_post_parent, // Forum ID
//    'meta_key' => '_bbp_last_active_time', // Make sure topic has some last activity time
//    'orderby' => 'meta_value', // 'meta_value', 'author', 'date', 'title', 'modified', 'parent', rand',
//    'order' => 'DESC', // 'ASC', 'DESC'
//    'posts_per_page' => bbp_get_topics_per_page(), // Topics per page
//    'paged' => bbp_get_paged(), // Page Number
//    's' => $default_topic_search, // Topic Search
//    'show_stickies' => $default_show_stickies, // Ignore sticky topics?
//    'max_num_pages' => false, // Maximum number of pages to show
//);
                  $bbp_loop_args = array(
                      'meta_key' => '_bbp_last_active_time',
        'orderby' => 'meta_value',
        'order' => 'ASC',
        );
                 if ( bbp_has_topics( $bbp_loop_args ) ) : 
                while ( bbp_topics() ) : bbp_the_topic(); ?>

			<?php bbp_get_template_part( 'loop', 'single-topic' ); ?>

		<?php endwhile; endif; ?>

	</div>
                      <?php bbp_get_template_part('pagination', 'topics'); ?>
                </div>


            </div>    

		

	<?php else : ?>

		<?php bbp_get_template_part( 'feedback',   'no-topics' ); ?>

	<?php endif; ?>

	<?php do_action( 'bbp_template_after_topics_index' ); ?>

</div>
