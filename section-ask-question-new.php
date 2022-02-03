<div id="ask-question-part">
  <div class="background-overlay"></div>
<h4>Ask a Question</h4>

<div id="new-topic-<?php bbp_topic_id(); ?>" class="bbp-topic-form new-style">

    <form id="new-post" name="new-post" method="post" action="<?php the_permalink(); ?>">

        <?php do_action('bbp_theme_before_topic_form'); ?>

        <fieldset class="bbp-form askform">


            <div class="askform-holder">
<div class="row">
                <div class="askform-visible col-xs-12">
                    <?php do_action('bbp_template_notices'); ?>
                    <?php do_action('bbp_theme_before_topic_form_title'); ?>

                 
                  <div class="flex-wrap">
                        <input class="askform-questionfield" type="text" placeholder="Type your question here" id="bbp_topic_title" value="<?php bbp_form_topic_title(); ?>" tabindex="<?php bbp_tab_index(); ?>" size="40" name="bbp_topic_title" maxlength="<?php bbp_title_max_length(); ?>" />
                        <div class="fake-btn">Post Question</div> 
                  </div>
                        <small class="max-char hidden"><?php printf(__('(Maximum Length: %d)', 'bbpress'), bbp_get_title_max_length()); ?></small>
                

                    <?php do_action('bbp_theme_after_topic_form_title'); ?>

                </div>
                </div>
                
                <div class="askform-invisible hidden">
                                        <?php if ( is_user_logged_in() ) : ?>
                    <?php do_action('bbp_theme_before_topic_form_content'); ?>

                    <?php // bbp_the_content(array('context' => 'topic')); ?>
<div class="bbp-the-content-wrapper"><div id="wp-bbp_topic_content-wrap" class="wp-core-ui wp-editor-wrap html-active">
<div id="wp-bbp_topic_content-editor-container" class="wp-editor-container">

    <textarea class="bbp-the-content wp-editor-area" placeholder="Add more details..." rows="12" tabindex="102" cols="40" name="bbp_topic_content" id="bbp_topic_content"></textarea>
</div>
</div>

</div>
                    <?php do_action('bbp_theme_after_topic_form_content'); ?>
                    
                       
                    <div class="row">
                        
                
                    <div class="col-xs-12">
                           <?php //if (!bbp_is_single_forum()) : ?>

                        <?php do_action('bbp_theme_before_topic_form_forum'); ?>
<label for="">Which topic should this go in?</label>
                            <?php
                            $args=array(
                                'post_type' => bbp_get_forum_post_type(), 
                                'selected' => -1, 
                                'numberposts' => -1, 
                           
                              
                            
                      
                               
                                'disable_categories' => false,
			'disabled'           => false
                                );
                          bbp_dropdown($args);
    
                            ?>
                    
                        <?php do_action('bbp_theme_after_topic_form_forum'); ?>

                    <?php //endif; ?>
                        
                    </div>
                    <div  class="col-xs-12 notify-me">
                        
                                 <?php if (bbp_is_subscriptions_active() && !bbp_is_anonymous() && (!bbp_is_topic_edit() || ( bbp_is_topic_edit() && !bbp_is_topic_anonymous() ) )) : ?>

                        <?php do_action('bbp_theme_before_topic_form_subscriptions'); ?>

                        <p>
                            <input name="bbp_topic_subscription" id="bbp_topic_subscription" type="checkbox" value="bbp_subscribe" <?php bbp_form_topic_subscribed(); ?> tabindex="<?php bbp_tab_index(); ?>" />

                            <?php if (bbp_is_topic_edit() && ( bbp_get_topic_author_id() !== bbp_get_current_user_id() )) : ?>

                                <label for="bbp_topic_subscription"><?php _e('Notify the author of follow-up replies via email', 'bbpress'); ?></label>

                            <?php else : ?>

                                <label for="bbp_topic_subscription"><?php _e('Notify me of follow-up replies via email', 'bbpress'); ?></label>

                            <?php endif; ?>
                        </p>

                        <?php do_action('bbp_theme_after_topic_form_subscriptions'); ?>

                    <?php endif; ?>


                    </div>
           
    </div>
                    <?php do_action('bbp_theme_before_topic_form_submit_wrapper'); ?>

                    <div class="bbp-submit-wrapper">

                        <?php do_action('bbp_theme_before_topic_form_submit_button'); ?>

                        <button type="submit" tabindex="<?php bbp_tab_index(); ?>" id="bbp_topic_submit" name="bbp_topic_submit" class="button submit"><?php _e('Post', 'bbpress'); ?></button>

                        <?php do_action('bbp_theme_after_topic_form_submit_button'); ?>

                    </div>

                    <?php do_action('bbp_theme_after_topic_form_submit_wrapper'); ?>
                                        <?php else:  ?> 
                                                <div class="login-alert">
                                                    ​You need to be <a href="<?php echo site_url('login');   ?>">logged in</a> to ask a question.
		</div>
                                                <?php    endif;  ?>


              
                </div>
            </div>

            <?php bbp_topic_form_fields(); ?>

        </fieldset>

        <?php do_action('bbp_theme_after_topic_form'); ?>

    </form>
</div>
  
  </div>