<?php

$term = get_queried_object(); // Get the term

$slug=$term->taxonomy;
$placeType="";

switch ($slug){
    case 'ag_county': $placeType="county"; break;
    case 'ag_cities': $placeType="city"; break;
     case 'ag_regions': $placeType="region"; break;
}

$placeName=$term->name;
 $placeID=$term->term_id;

 
    $termID=$term->term_id;
    
    $url=$_SERVER[REQUEST_URI];
    $url=explode('/', $url);
    $count=count($url);
    $serviceTypeSlug=$url[$count-2];
      $serviceType=get_term_by('slug',$serviceTypeSlug,'ag_primary_inspection_cat');
      $serviceTypeID=$serviceType->term_id;
   $servicetypename=$serviceType->name;



      $isDirectory=true;
      
      add_filter( 'wpseo_opengraph_url', 'my_opengraph_url' );

function my_opengraph_url( $url ) {
  
        return get_site_url().$_SERVER[REQUEST_URI];
}

get_header();

?>

<div id="search-app" class="services-page" >
     <div id="myVueData"
          data-postcoderesultpage="false"
         data-placetype="county"
       
        data-placename="<?php echo $placeName; ?>"
        data-servicetypename="<?php echo $servicetypename; ?>"
          data-servicetypeid="<?php echo $serviceTypeID; ?>"
        data-placeid="<?php echo  $placeID; ?>"
           data-dosearchinit="true" 
    
           data-isresultpage="true"
           data-redirect="false"
        

    ></div>
   
    
<?php 
echo do_shortcode('[elementor-template id=212189]');
//the_content();
//var_dump(get_field('page_type',get_the_ID()) );
?>
   
  
    
  
   
    </div>
<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDze972Ns9Ooh1XsRAP-1ngmRbB68vBdNc" async ></script>-->
  <?php get_footer(); ?>

