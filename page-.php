<?php get_header(); ?>
<?php
if (bbp_is_single_topic()) { //disabled this way

  $forumTitle = get_the_title(bbp_get_forum_id());
  $forumTitle = $forumTitle && bbp_is_single_forum() ? ' :: ' . $forumTitle : '';
  global $paged;

  $pagedTitle = $paged ? ' :: Page ' . $paged : '';
  
  ?>
  <div id="content" class="container site-content forum-page forum-inner-page new-style">
    <div id="forum-main-title" class="row">
      <div class="col-xs-12">
  <?php echo '<h1>Age Space Caregiver Forum' . $forumTitle . $pagedTitle . '</h1>'; ?>
      </div>
    </div>
    <div id="primary" class="vce-main-content">

      <main id="main" class="main-box main-box-single">
  <?php
  $isInside = get_field('is_this_banner_into_container') ? true : false;
  if ($isInside) {
    $bannerTop = get_field('topbanner');
    $outputImg = '<img src="%s" class="img-responsive" alt="%s" >';
    echo '<div id="inside-banner">' . sprintf($outputImg, esc_html($bannerTop['url']), esc_attr($bannerTop['title'])) . '</div>';
  }
  ?>
        <?php while (have_posts()) : the_post(); ?>

          <?php
          the_content();
          if (bbp_is_single_forum()) {
      //      bbp_get_template_part('loop', 'forums');
          }
          if (bbp_is_single_topic()) {

    //    bbp_get_template_part( 'loop', 'topics' );
          }
          ?>

        <?php endwhile; ?>
        <?php
        get_template_part('section', 'read-next');
        ?>
      </main>




    </div>

        <?php
        //if (bbp_is_topic_archive() || bbp_is_single_forum() || bbp_is_single_topic()) {
         if (bbp_is_single_topic()) {
          ?> 
      <div id="sidebar-new" class="forum-sidebar new-sidebar right">
    <?php dynamic_sidebar('forum-sidebar'); ?>
      </div>
    <?php
  } else {
    ?>
      <div id="sidebar-new" class="forum-sidebar new-sidebar right">
      <?php dynamic_sidebar('forum-sidebar'); ?>
      </div>
    <?php }
    ?>

  </div>
      <?php
    } else {
      the_content();
    }
    ?>


  <?php get_footer(); ?>