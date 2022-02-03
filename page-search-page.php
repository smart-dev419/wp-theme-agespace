<?php
/**
* Template Name: Search Landing Page
*/



get_header();
$isDirectory=true;

?>

<div id="search-app"  class="services-page" >
 
 
    
<?php 
echo do_shortcode('[elementor-template id=212189]');
//the_content();
//var_dump(get_field('page_type',get_the_ID()) );
?>
  
  
    
  
   
    </div>
  <?php get_footer(); ?>

