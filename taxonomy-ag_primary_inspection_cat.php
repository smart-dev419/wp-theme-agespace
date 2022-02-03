<?php


get_header();
   
      add_filter( 'wpseo_opengraph_url', 'my_opengraph_url' );

function my_opengraph_url( $url ) {
  
        return get_site_url().$_SERVER[REQUEST_URI];
}
$isDirectory=true;

?>
 
<div id="search-app" class="services-page" >
     <div id="myVueData"
         
            data-dosearchinit="false" 
           data-isresultpage="false"
           data-postcoderesultpage="false"
           data-issearchlandingtpage="true"
            data-redirect="true"
         data-placetype="<?php echo get_field('page_type', get_the_ID()); ?>"
        data-placename="<?php echo placeInfo('name'); ?>"
        data-servicetypename="<?php echo servicetypeName(); ?>"
          data-servicetypeid="<?php echo servicetypeID(); ?>"
        data-placeid="<?php echo  placeInfo('id'); ?>"
       

    ></div>
 
    
<?php 
echo do_shortcode('[elementor-template id=212563]');
//the_content();
//var_dump(get_field('page_type',get_the_ID()) );
?>
 
    
  
   
    </div>
  <?php get_footer(); ?>

