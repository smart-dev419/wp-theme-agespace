<?php
/**
 * Topics Loop - Single
 *
 * @package bbPress
 * @subpackage Theme
 */
$autor = get_the_author_meta('display_name', $post->post_author);
$autorURL = get_author_posts_url($post->post_author);

$preview=true ? true : false ;

if ($post->post_parent) {
    $parentID = $post->post_parent;
    $parent_post = get_post($parentID);
    $parent_post_title = $parent_post->post_title;
    $ancestors = get_ancestors($post->ID, 'topic');

    $args = array(
        'post_parent' => $post->ID,
        'post_type' => 'reply',
        'numberposts' => -1,
    );

    $children = get_children($args);
}
//  var_dump(bbp_get_forum_id(),$parentID);
// if($parentID===bbp_get_forum_id()){}

$new_args = array(
    'post_type'=> 'reply'
);

$new_args['post_parent'] = bbp_get_topic_id();
$new_args['orderby'] = 'date';
$new_args['order'] = 'DESC';
$new_args['posts_per_page'] = 1;
 

$new_query = new WP_Query( $new_args );

if ( $new_query->have_posts() ) : while ( $new_query->have_posts() ) : $new_query->the_post();

     $reply_id=$post->ID;
     $reply_title= get_the_title();
     $reply_date= get_the_time('U');
//     $reply_content= the_content(); 
     $reply_permalink= get_the_permalink(); 
   
 

	?>

 
                     
   <?php endwhile; ?>   
   <?php endif; 

?>
<div id="bbp-topic-<?php bbp_topic_id(); ?>"  class="singlequestionbox">
    <div class="questiontext">
        <?php do_action('bbp_theme_before_topic_title'); ?>

        <a class="bbp-topic-permalink" href="<?php bbp_topic_permalink(); ?>"><?php bbp_topic_title(); ?></a>

        <?php do_action('bbp_theme_after_topic_title'); ?>

        <?php bbp_topic_pagination(); ?>

        <?php do_action('bbp_theme_before_topic_meta'); ?>
    </div>
    <?php if($preview){   ?>
    <div class="answermeta">
                <div class="answercount">
                    <a href="<?php echo get_permalink() ?>">  <?php echo(count($children)); ?> Answers</a><a class="hidden" href="<?php echo get_permalink() ?>"><small>Add Answer</small></a></div>
                    <span class="sep">|</span>
                <div class="parent-cat">
                    <a href="<?php echo get_permalink($parentID) ?>"><?php echo $parent_post_title; ?></a>
                </div>
            </div>
      <?php   }   ?>
    <div class="questionexcerpt <?php if($preview){ echo 'hidden'; }  ?>">
        <p>
            <?php
            $tid = bbp_get_forum_id();
            $excerpt = bbp_get_topic_content($topic_id);
            $length = 100;
            $excerpt = trim(strip_tags($excerpt));

            if (!empty($length) && strlen($excerpt) > $length) {
                $excerpt = substr($excerpt, 0, $length - 1);
                $excerpt .= '&hellip;';
            }
            echo $excerpt;
            ?>
        </p>
    </div>
    <div class="questionmeta">

        <div class="avatar">
            <div class="avatar-image-container object-fit-wrapper">
                <?php echo get_avatar(get_the_author_meta('ID'), 40); ?>
            </div>
        </div>
        <div class="communityQuestionMeta">
            <div class="askedby">
                <div class="username"> 
                     <span  itemprop="author" itemscope="" itemtype="http://schema.org/Person">
                        <span itemprop="name"><?php echo $autor ?></span>
                    </span>
                </div>
                <div class="answertime">
                  <?php 
                            
                 
                  if($reply_date>0){
                    echo 'Answered '.human_time_diff($reply_date, current_time('timestamp')) . ' ago';
                  }else{
                   echo 'Asked '.human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago';
                  }
                  ?>
                   

                </div>
                <div class="calltoaction hidden-lg hidden-md hidden-sm">
                    <a href="<?php echo $parent_post_url; ?>"> <?php echo $parent_post_title ?> </a>
                </div>
            </div>

            <?php if(!$preview){   ?>
    <div class="answermeta">
                <div class="answercount">
                    <i class="fa fa-comment" aria-hidden="true"></i>
                    <a href="<?php echo get_permalink() ?>">  <?php echo(count($children)); ?> Answers</a>
                    <br />
                    <a class="hidden" href="<?php echo get_permalink() ?>"><small>Add Answer</small></a>


                </div>
                <div class="parent-cat">
                    <a href="<?php echo get_permalink($parentID) ?>"><?php echo $parent_post_title; ?></a>

                </div>
            </div>
    <?php   }   ?>
        </div>
    </div>
</div>
