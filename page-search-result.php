<?php
/**
* Template Name: Search Result Page
*/



get_header();
$isDirectory=true;

?>

<div id="search-app" class="services-page" >
     <div id="myVueData"
          data-searchradius="15"
          data-dosearchinit="true" 
          data-postcoderesultpage="true"
           data-isresultpage="true"
         data-placetype="<?php //echo get_field('page_type', get_the_ID()); ?>"
        data-placename="<?php  echo $_GET['placeName']; ?>"
        data-servicetypename="<?php echo $_GET['serviceTypeName']; ?>"
           data-lat="<?php echo $_GET['latitude']; ?>"
           data-long="<?php echo $_GET['longitude'];   ?>"
          data-servicetypeid="<?php  echo $_GET['serviceTypeID']; ?>"
        data-placeid="<?php //echo  placeInfo('id'); ?>"
          data-keyword="<?php echo $_GET['keyword']; ?>"
        
 
    ></div>
 
 
<?php 
the_content();
//echo do_shortcode('[elementor-template id="80537"]');

 
?>

    
    </div>
  <?php get_footer(); ?>

