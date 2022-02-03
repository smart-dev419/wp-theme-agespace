<?php




get_header();
$isDirectory=true;

?>

<div id="search-app" class="services-page" >
     <div id="myVueData"
          data-dosearchinit="false" 
          data-postcoderesultpage="false"
           data-isresultpage="false"
         data-placetype="<?php //echo get_field('page_type', get_the_ID()); ?>"
        data-placename="<?php  echo $_GET['placeName']; ?>"
        data-servicetypename="<?php echo $_GET['serviceTypeName']; ?>"
          data-servicetypeid="<?php  echo $_GET['serviceTypeID']; ?>"
        data-placeid="<?php //echo  placeInfo('id'); ?>"
          data-keyword="<?php echo $_GET['keyword']; ?>"
        

    ></div>
 
 
<?php 

echo do_shortcode('[elementor-template id="207753"]');

 
?>

    
    </div>
  <?php get_footer(); ?>

