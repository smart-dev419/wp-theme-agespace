<?php

/**
 * Single Reply Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */

?>
<?php bbp_breadcrumb(); ?>

<?php do_action('bbp_template_before_single_topic'); ?>
<div id="bbpress-forums" class="questionspage">
<?php
$autor = get_the_author_meta('display_name', $post->post_author);
$autorURL = get_author_posts_url($post->post_author);
?>
    <section id="question" class="goto-top-breakpoint">
        <div>
            <h1 class="question-headline" itemprop="headline" >
<?php the_title(); ?>
            </h1>
            <span class="header_feedback"></span>
        </div>

        <div class="questionmeta">
            <div class="avatar">
                <div class="avatar-image-container object-fit-wrapper">
<?php

echo get_avatar(get_the_author_meta('ID'), 40); ?>
                </div>
            </div>
            <div class="communityQuestionMeta">
                <div class="askedby">
                    <div class="username">Asked by
                        <span  itemprop="author" itemscope="" itemtype="http://schema.org/Person">
                            <span itemprop="name"><?php echo $autor ?></span>
                        </span>
                    </div>
                    <div class="dateline answertime">
<?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?>
                    </div>

                </div>
            </div>
        </div>
        <div>
            <div class="readable-content questionbody" id="description2" itemprop="text" >
                <p>
<?php the_content(); ?>
                </p>
            </div>
            <span class="textarea_feedback"></span>
        </div>
        <div class="hidden-print sm-icons">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="social-bar-container hidden">
                        <div class="article-social-bar hidden-print">
                            <ul>
                                <li>
                                    <a href="http://www.facebook.com/sharer.php?u=<?php echo get_permalink() ?>" target="_blank" data-heroname="FacebookShare">
                                        <i class="fa fa-facebook fa-2x fa-fw"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/intent/tweet?text=<?php echo esc_html(get_the_title()) ?>&amp;url=<?php echo esc_url(get_permalink()); ?>" data-heroname="TwitterShare">
                                        <i class="fa fa-twitter fa-2x fa-fw"></i>
                                    </a>
                                </li>
                                <li>
                                    <a data-heroname="PinterestShare" data-pin-do="buttonPin" data-pin-custom="true" data-pin-href="https://www.pinterest.com/pin/create/button?guid=FwHLxQYsbcLr-1&amp;url=https%3A%2F%2Fwww.agingcare.com%2Fquestions%2Fdementia-sufferer-recognize-they-have-a-problem-428469.htm&amp;media=https%3A%2F%2Fac-cdn.azureedge.net%2Fresources%2FContent%2FImages%2FFavicons%2Fmstile-144x144.png&amp;description=Does%20a%20dementia%20sufferer%20recognize%20that%20they%20have%20a%20problem%3F%20-%20AgingCare.com" data-pin-description="" data-pin-log="button_pinit"> 
                                        <i class="fa fa-pinterest fa-2x fa-fw"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#email" data-toggle="modal" data-target="#emailModal" data-heroname="EmailShare">
                                        <i class="fa fa-envelope fa-2x fa-fw"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm- hidden">
                    <div class="question-actions links">
                        <a class="answer-link le-btn" href="#new-post">Reply</a>
                      <?php bbp_topic_subscription_link(); ?>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <hr />





</div>



