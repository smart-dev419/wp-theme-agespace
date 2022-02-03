<?php
/**
 * Replies Loop - Single Reply
 *
 * @package bbPress
 * @subpackage Theme
 */
?>
<?php

$autor = get_the_author_meta('display_name', $post->post_author);
$autorURL = get_author_posts_url($post->post_author);

?>
<div id="post-<?php bbp_reply_id(); ?>"  <?php bbp_reply_class()  ?>>

    <div class="questionmeta">
        <div class="avatar">
            <div class="avatar-image-container object-fit-wrapper">
                <?php echo get_avatar(get_the_author_meta('ID'), 40); ?>
            </div>
        </div>
        <div class="communityQuestionMeta">
            <div class="askedby">
                <div class="userinfo">
                   <span  itemprop="author" itemscope="" itemtype="http://schema.org/Person">
                        <span itemprop="name"><?php echo $autor ?></span>
                  </span>
                    <div class="clearfix"></div>
                </div>
                <div class="dateline answertime">
                    <?php echo human_time_diff(get_the_time('U', bbp_get_reply_id()), current_time('timestamp')) . ' ago'; ?>
                </div>
            </div>
        </div>
        <div class="buttons hidden">
            <ul>
                <li>  <a href="<?php bbp_reply_url(); ?>" class="bbp-reply-permalink "><i class="fa fa-link"></i></a> </li>
               
            </ul>
       
        </div>
        
    </div>

  
        <div class="reply-content">

            <?php do_action('bbp_theme_before_reply_content'); ?>

            <?php bbp_reply_content(); ?>

            <?php do_action('bbp_theme_after_reply_content'); ?>

        </div><!-- .bbp-reply-content -->

  
    <div class="like-btn hidden">
        <?php //wp_ulike_bbpress('get'); ?>
    </div>

</div><!-- #post-<?php bbp_reply_id(); ?> -->