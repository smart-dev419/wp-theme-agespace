<?php

//[count-term-service service="dementia"]         
//There are [count-term-service service="dementia"]  [region] home care agencies and providers that
//offer additional in-home nursing care:
//[bulleted_list_of_providers service="dementia" list="5"]
// Add Shortcode

       
add_shortcode('share-whatsapp','sharewhatsapp');

function sharewhatsapp(){
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";



return $actual_link;

} 
    

add_shortcode('providers-dropdown', 'providersDropdown');

function providersDropdown() {
    $args = array(
        'post_type' => 'ag_county_post',
        'orderby' => 'title',
        'order' => 'ASC'
    );

    $query = new WP_Query($args);
    $out = "<select class='counties-select'>";
    while ($query->have_posts()):

        $query->the_post();
        $slug = get_post_field('post_name', get_the_ID());

        $out .= '<option value="' . get_site_url() . '/services/home-care/' . $slug . '">' . get_the_title() . '</option>';

    endwhile;
    $out .= '</select>';
    return $out;
}

function countTheTermService($atts) {

    // Attributes
    $atts = shortcode_atts(
            array(
                'service' => null,
                'rating' => null,
                'regulated' => null,
                'service_category' => null,
                'list' => null
            ),
            $atts,
            'count-term-service'
    );

    $term = get_queried_object(); // Get the term
    $slug = $term->slug;
    $placeName = $term->name;

    //'ag_primary_inspection_cat' => $atts['service'],
//echo 'count: '. $term->count;
    $serviceArray = [];
    if ($atts['regulated']) {
        $serviceArray = array(
            'taxonomy' => 'regulated_activity',
            'terms' => $atts['regulated'],
            'field' => 'slug',
        );
    };
    if ($atts['service_category']) {
        $serviceArray = array(
            'taxonomy' => 'service_category',
            'terms' => $atts['service_category'],
            'field' => 'slug',
        );
    };
    if ($atts['service']) {
        $serviceArray = array(
            'taxonomy' => 'specialist_service',
            'terms' => $atts['service'],
            'field' => 'slug',
        );
    };

    if ($atts['rating']) {
        $serviceArray = array(
            'taxonomy' => 'ag_rating',
            'terms' => $atts['rating'],
            'field' => 'slug',
        );
    };

    $tax_query = array(
        'relation' => 'AND',
        $serviceArray,
        array(
            'taxonomy' => 'ag_county',
            'terms' => $slug,
            'field' => 'slug',
        ),
    );
    $perpage = -1;
    if ($atts['list']) {
        $perpage = $atts['list'];
    }
    $args = array(
        'post_type' => array('ag_location', 'service_provider'),
        'post_status' => 'published',
        'numberposts' => $perpage,
        'tax_query' => $tax_query
    );
    $posts = get_posts($args);
    $count = count($posts);
    if ($atts['list']) {
        $returnPosts = "<ul class='custom-ul shortcode-posts-list'>";
        foreach ($posts as $post) {

         //   $returnPosts .= '<li><a href="' . $post->guid . '">' . $post->post_title . '</a></li>';
             $returnPosts .= '<li>' . $post->post_title . '</li>';
        }
        $returnPosts .= "</ul>";

        return $returnPosts;
    } else {
        return $count;
    }
}

add_shortcode('count-term-service', 'countTheTermService');



add_shortcode('bulleted_list_of_providers', 'countTheTermService');

add_shortcode('region', 'regionsText');

function countTerm() {
    if (isset($_GET['placeName'])) {
        return $_GET['placeName'];
    }
    $term = get_queried_object(); // Get the term
    $slug = $term->taxonomy;
    $placeType = "";

    switch ($slug) {
        case 'ag_county': $placeType = "county";
            break;
        case 'ag_cities': $placeType = "city";
            break;
    }

    $placeName = $term->name;
    return $placeName;
}

function regionsText() {
    if (isset($_GET['placeName'])) {
        return $_GET['placeName'];
    }
    $term = get_queried_object(); // Get the term
    $slug = $term->taxonomy;
    $placeName = $term->name;
    $placeType = "";

    switch ($slug) {
        case 'ag_county': $placeType = "county";
            break;
        case 'ag_cities': $placeType = "city";
            break;
    }


    return $placeName;
}

add_shortcode('prefilledvalue', 'prefilledvalue');

function prefilledvalue() {

    if (isset($_GET['serviceTypeName'])) {
        return $_GET['serviceTypeName'];
    }


    $term = get_queried_object(); // Get the term
    $slug = $term->taxonomy;
    switch ($slug) {
        case 'ag_county': $placeType = "county";
            break;
        case 'ag_cities': $placeType = "city";
            break;
    }

    $placeName = $term->name;
    $placeID = $term->term_id;

    return $placeName;
}

//$term = get_queried_object(); // Get the term
//
//$slug=$term->taxonomy;
//$placeType="";
//
//switch ($slug){
//    case 'ag_county': $placeType="county"; break;
//    case 'ag_cities': $placeType="city"; break;
//     case 'ag_regions': $placeType="region"; break;
//}
//
//$placeName=$term->name;
// $placeID=$term->term_id;
//
// 
//    $termID=$term->term_id;
//    
//    $url=$_SERVER[REQUEST_URI];
//    $url=explode('/', $url);
//    $count=count($url);
//    $serviceTypeSlug=$url[$count-2];
//      $serviceType=get_term_by('slug',$serviceTypeSlug,'ag_primary_inspection_cat');
//      $serviceTypeID=$serviceType->term_id;
//   $servicetypename=$serviceType->name;
//



add_shortcode('servicetype', 'servicetypeName');

function servicetypeName() {
    if (isset($_GET['serviceTypeName'])) {
        return $_GET['serviceTypeName'];
    }
    $term = get_queried_object(); // Get the term

    $serviceTypeSlug = $term->taxonomy;
    if ($serviceTypeSlug) {


        $url = $_SERVER[REQUEST_URI];
        $url = explode('/', $url);
        $count = count($url);
        $serviceTypeSlug = $url[$count - 2];
        $serviceType = get_term_by('slug', $serviceTypeSlug, 'ag_primary_inspection_cat');
        $serviceTypeID = $serviceType->term_id;
        $servicetypename = $serviceType->name;

        return $servicetypename;
    } else {



        $url = $_SERVER[REQUEST_URI];
        $url = explode('/', $url);

        $count = count($url);

        if ($count == 3) {
            $serviceTypeSlug = $url[$count - 1];
        } else {
            $serviceTypeSlug = $url[$count - 3];
        }


        $serviceType = get_term_by('slug', $serviceTypeSlug, 'ag_primary_inspection_cat');


        $serviceTypeID = $serviceType->term_id;

        $servicetypename = $serviceType->name;

        return $servicetypename;
    }
}

function my_acf_google_map_api($api) {

    $api['key'] = 'AIzaSyDTQgMVRM74aZZ1KyDKGgWPC16eSYia7BU';

    return $api;
}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

function load_directory_assets() {
    //
    //     wp_enqueue_script('axios', 'https://unpkg.com/axios/dist/axios.min.js', array('jquery'));
    //   wp_enqueue_script('vue-router', 'https://unpkg.com/vue-router',array(), false, true);
    wp_enqueue_script('googlemap-api', 'https://maps.googleapis.com/maps/api/js?libraries=geometry&key=AIzaSyDze972Ns9Ooh1XsRAP-1ngmRbB68vBdNc', array(), false, true);
    wp_enqueue_script('vue-cdn', 'https://cdn.jsdelivr.net/npm/vue', array(), false, true);
  //   wp_enqueue_script('underscore-cdn', 'https://unpkg.com/underscore/underscore-esm-min.js', array(), false, true);
  
    //   wp_enqueue_script('vue2-google', 'https://xkjyeah.github.io/vue-google-maps/vue-google-maps.js', array(), false, true);
//      wp_enqueue_script('vue-map', get_stylesheet_directory_uri() . '/js/vue.js/vue-map-js.js', array(), false, true);
//    wp_enqueue_script('vue-cdn', 'https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js', array(), false, true);
    //   wp_enqueue_script('vue-select', 'https://unpkg.com/vue-select@latest', array(), false, true);
    //wp_enqueue_style('vue-select','https://unpkg.com/vue-select@latest/dist/vue-select.css');
    wp_enqueue_script('directory-scripts', get_stylesheet_directory_uri() . '/js/vuejs/script.js', array(), false, true);
    wp_enqueue_style('services-css', (get_stylesheet_directory_uri()) . '/css/services-style.css');
}

add_action('wp_enqueue_scripts', 'load_directory_assets');


function wpdocs_theme_name_scripts() {
    wp_enqueue_script( 'underscore' );
}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );
add_shortcode('search-map', 'googleMapForLocations');

function googleMapForLocations() {
    $cntnt = include('vue-search-map.html');
}

add_shortcode('searchresultbreadcrumb', 'searchresultbreadcrumb');

function searchresultbreadcrumb() {
    return 'Search results for <strong>' . $_GET['search'] . '</strong>';
}

add_shortcode('availableresults', 'availableresults');

function availableresults() {
    $cntnt = include('vue-search-available-results.html');
    //return $cntnt;
}

add_shortcode('searchformcomplete', 'searchformcomplete');

function searchformcomplete() {
    $cntnt = include('vue-search.html');
    //return $cntnt;
}

add_shortcode('search-results-pagination', 'paginationShortcode');

function paginationShortcode() {
    $cntnt = include('vue-search-pagination.html');
    //return $cntnt;
}

function placeInfo($arg) {
    $type = get_field('page_type');
    if (isset($_GET['placeName'])) {
        return $_GET['placeName'];
    }
    switch ($type) {
        case 'town': return $arg == 'name' ? get_field('prefilled_towncity')->name : get_field('prefilled_towncity')->term_id;
            break;
        case 'local': return $arg == 'name' ? get_field('prefilled_local')->name : get_field('prefilled_local')->term_id;
            break;
        case 'county':return $arg == 'name' ? get_field('prefilled_county')->name : get_field('prefilled_county')->term_id;
            break;
        case 'region':return $arg == 'name' ? get_field('prefilled_region')->name : get_field('prefilled_region')->term_id;
            break;
    }
}

function regionsTextXX() {
    $type = get_field('page_type');

    switch ($type) {
        case 'town': return "<span >Towns</span>";
            break;
        case 'local': return "<span >Local Authorities</span>";
            break;
        case 'county':return "<span >Counties</span>";
            break;
        case 'region':return "<span >Regions</span>";
            break;
    }
}

add_shortcode('serviceTypeLocation', 'serviceTypeLocation');

function serviceTypeLocation() {
//    $parentID=getProviderInfo('id');
//    var_dump($parentID);
//    $typeid = get_field('service_type',$parentID);
// 

    $term = get_the_terms(get_the_ID(), 'ag_primary_inspection_cat');

    return $term[0]->name;
}

add_shortcode('servicetypeID', 'servicetypeID');

function servicetypeID() {
    $typeid = get_field('service_type');

    if (isset($_GET['serviceTypeName'])) {
        return $_GET['serviceTypeName'];
    }

    return $typeid;
}

add_shortcode('provider-debug', 'providerDebug');

function providerDebug() {
    if (isAmin() && !is_admin()) {
        die();
    }
    //return $cntnt;
}

add_shortcode('search-form-checkboxes', 'formloadercheckboxes');

function formloadercheckboxes() {
    $cntnt = include('vue-search-form-checkboxes.html');
    //return $cntnt;
}

add_shortcode('search-form-loader', 'formloader');

function formloader() {
    $cntnt = include('vue-search-loader.html');
    //return $cntnt;
}

add_shortcode('search-form-only', 'searchformonly');

function searchformonly() {
    $cntnt = include('vue-search-form.html');
    //return $cntnt;
}

add_shortcode('search-form-place-filters2', 'searchformrplacefilters2');

function searchformrplacefilters2() {
    $cntnt = include('vue-search-place-filters_2.html');
    //return $cntnt;
}

add_shortcode('search-form-provider-filters', 'searchformrproviderfilters');

function searchformrproviderfilters() {
    $cntnt = include('vue-search-provider-filters.html');
    //return $cntnt;
}

add_shortcode('search-form-result-filters', 'searchformrresultfilters');

function searchformrresultfilters() {
    $cntnt = include('vue-search-result-filters.html');
    //return $cntnt;
}

add_shortcode('search-form-place-filters', 'searchformrplacefilters');

function searchformrplacefilters() {
    $cntnt = include('vue-search-place-filters.html');
    //return $cntnt;
}

add_shortcode('search-form-place-sorters', 'searchformrplacesorters');

function searchformrplacesorters() {
    $cntnt = include('vue-search-place-sorters.html');
    //return $cntnt;
}

add_shortcode('search-form-filters', 'searchformrfilters');

function searchformrfilters() {
    $cntnt = include('vue-search-filters.html');
    //return $cntnt;
}

add_shortcode('search-form-radius', 'searchformrradius');

function searchformrradius() {
    $cntnt = include('vue-search-radius.html');
    //return $cntnt;
}

add_shortcode('listing-is-featured', 'listingChecker');

function listingChecker() {
    $hasTerm = get_the_terms('featured_listings');
    if ($hasTerm && !is_admin()) {
        return true;
    } else {
        return false;
    }
}

add_shortcode('search-form-featured-results', 'searchformresultsfeatured');

function searchformresultsfeatured() {
    $cntnt = include('vue-search-results-featured.html');
    //return $cntnt;
}

add_shortcode('search-form-featured-results-row', 'searchformresultsfeaturedrow');

function searchformresultsfeaturedrow() {
    $cntnt = include('vue-search-results-featured-row.html');
    //return $cntnt;
}

add_shortcode('search-form-result', 'searchformresults');

function searchformresults() {
    $cntnt = include('vue-search-results-free.html');
    //return $cntnt;
}

function create_ACF_meta_in_REST() {
    $postypes_to_exclude = ['acf-field-group', 'acf-field'];
    $extra_postypes_to_include = ["ag_location", 'ag_staff'];
    $post_types = array_diff(get_post_types(["_builtin" => false], 'names'), $postypes_to_exclude);

    array_push($post_types, $extra_postypes_to_include);

    foreach ($post_types as $post_type) {
        register_rest_field($post_type, 'ACF', [
            'get_callback' => 'expose_ACF_fields',
            'schema' => null,
                ]
        );
    }
}

function expose_ACF_fields($object) {
    $ID = $object['id'];

    return get_fields($ID);
}

add_action('rest_api_init', 'create_ACF_meta_in_REST');

function getCQCLocation(WP_REST_Request $request) {
    $locationID = $request['locationID'];

    $url = 'https://api.cqc.org.uk/public/v1/locations/' . $locationID;

//  $query_fields = [
//          'autoCorrect' => 'true',
//          'pageNumber' => 1,
//          'pageSize' => 10,
//          'safeSearch' => 'false',
//          'q' => $_GET['query']
//  ];
    //$curl = curl_init($url . '?' . http_build_query($query_fields));
    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//  curl_setopt($curl, CURLOPT_HTTPHEADER, [
//          'X-RapidAPI-Host: contextualwebsearch-websearch-v1.p.rapidapi.com',
//          'X-RapidAPI-Key: 7xxxxxxxxxxxxxxxxxxxxxxxxxxxxx'
//  ]);
    $response = json_decode(curl_exec($curl), true);

    curl_close($curl);
    return $response;
}

add_action(
        'rest_api_init',
        function () {

//
//    revealTaxonomy('ag_cities');
//    revealTaxonomy('ag_staff');
//    revealTaxonomy('ag_county');
//    revealTaxonomy('ag_brand');
//
//    revealTaxonomy('ag_type_sector');
//    revealTaxonomy('ag_inspection_directorate');
//    revealTaxonomy('ag_primary_inspection_cat');
//    revealTaxonomy('ag_local_authority');
//    revealTaxonomy('ag_regions');
//
//    revealTaxonomy('cqc_location');
    register_rest_route('emin', '/cqc', array(
        'methods' => 'GET',
        'callback' => 'getCQCLocation',
    ));
    register_rest_route('emin', '/filters', array(
        'methods' => 'GET',
        'callback' => 'getFiltersData',
    ));
    register_rest_route('emin', '/postmeta', array(
        'methods' => 'GET',
        'callback' => 'getapipostmeta',
    ));

    register_rest_route('emin', '/location', array(
        'methods' => 'GET',
        'callback' => 'customEndpointAPI',
    ));

    $field = "distance_miles";
    register_rest_route('emin', '/city', array(
        'methods' => 'GET',
        'callback' => 'cityEndpoint',
    ));

    $field = "distance_miles";



//    register_rest_field(
//            'ag_location',
//            $field,
//            array(
//                'get_callback' => function ($object) use ($field) {
//
//                    $lat = (array) $object[$field];
//                    $lat = $object['ACF']['location_latitude'];
//                    $long = $object['ACF']['location_longitude'];
//                    $searchedLong = $_GET['longitude'];
//                    $searchedLat = $_GET['latitude'];
//                    $searchedDistance = $_GET['distance'];
//
//                    $distance = (int) distance($lat, $lat, $searchedLat, $searchedLong, "M");
//                    if ($distance <= $searchedDistance) {
//                        return $distance;
//                    } else {
//                        return $distance;
//                    }
//                },
//                'schema' => null
//            )
//    );
}
);

function distanceCalc() {
    $lat = (array) $object[$field];




    if ($distance <= $searchedDistance) {
        return $distance;
    } else {
        return $distance;
    }
}

function posts_where($args, $wp_query_obj) {//can deelete
    // $type = $wp_query_obj->query_vars['post_type'];
    $searchedLat = $_GET['latitude'] ?: 0;
    $searchedLong = $_GET['longitude'] ?: 0;

    //  $args .= ' AND distance_to_zero.meta_key LIKE "%32%" ';
    var_dump($where);
    return $where;
}

if (isset($_GET['emin'])) {
    //updateAllLocations();
    updateAllLocationsTax();
}

//can delete
function updateAllLocations() {
    //get all posts

    $args = [
        'posts_per_page' => 10,
        'post_type' => 'ag_location',
        'orderby' => 'distance_to_zero',
        //'meta_key' => 'distance_to_zero',
        'order' => 'DESC',
        'meta_query' =>
        array(
            array(
                'key' => 'distance_to_zero',
                'compare' => '=',
                'type' => 'numerical',
                'value' => '0',
            )
//           
//            array(
//                'key' => 'distance_to_zero',
//                'compare' => 'NOT EXISTS',
//                'value' => 'null',
//            )
        ),
    ];
    $cntr = 0;
    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) :
        while ($the_query->have_posts()) : $the_query->the_post();
            $cntr++;
            $id = get_the_ID();
            //get each location lat and long
            $lat = get_field('location_latitude', $id);
            $long = get_field('location_longitude', $id);
            //   var_dump(get_field('distance_to_zero', $id));
            // calculate distance to 0,0
            $distanceZero = (int) distance($lat, $long, 0, 0, "M");
            //  $distanceZero = get_field('distance_to_zero');

            var_dump($distanceZero);
            var_dump($id);
            //    var_dump($distanceZero);
            echo '<hr>';
        //  wp_create_term($distanceZero, 'distance_zero');
        //store in meta_field
        //update_field('distance_to_zero',(int) $distanceZero, $id);
        endwhile;
        echo '<hr>';
        var_dump('Last Updated ID is: ' . $id . ' Count:' . $cntr);
        die('<hr>The end');
    endif;
}

function updateAllLocationsTax() {
    //get all posts

    $args = [
        'posts_per_page' => 10,
        'post_type' => 'ag_location',
        'orderby' => 'attached_provider_id',
        //'meta_key' => 'distance_to_zero',
        'order' => 'ASC',
        'meta_query' =>
        array(
            array(
                'key' => 'attached_provider_id',
                'compare' => '>',
//                'type' => 'numerical',
                'value' => '0',
            )
//           
//            array(
//                'key' => 'distance_to_zero',
//                'compare' => 'NOT EXISTS',
//                'value' => 'null',
//            )
        ),
    ];
    $cntr = 0;
    $the_query = new WP_Query($args);
    // $trms= get_terms(  array('taxonomy' => 'ag_regions','hide_empty' => false) );
    $taxonomy = 'ag_provider_id';
    //$term_list = wp_get_post_terms(203443, 'ag_provider_id', array("fields" => "all"));
    $term_list = get_terms(array('post_types' => 'service_provider', 'taxonomy' => 'ag_provider_id'));
// Then you can run a foreach loop to show the taxonomy terms infront.
    var_dump($term_list);

    //    $tesrms = wp_get_post_terms( 203443, $taxonomy );
    // $trms=  wp_get_post_terms( 203443, 'ag_provider_id' );
    //var_dump($term_list);
    if ($the_query->have_posts()) :




        //      var_dump($attachedProviderID);
        //     var_dump($taxID);
        while ($the_query->have_posts()) : $the_query->the_post();
            $cntr++;
            $id = get_the_ID();
            $attachedProviderID = get_field('attached_provider_id');
            // $taxID = get_term_by('name', '1-1000401892', 'ag_provider_id');
//            var_dump($id);
//         
//              //  $rslt= wp_set_post_terms($id,$attachedProviderID, 'ag_provider_id',false);
//        //      $trms=  get_the_terms($id,'ag_regions');
//                 var_dump($trms);
            //get each location lat and long
            //  $lat = get_field('location_latitude', $id);
            //    $long = get_field('location_longitude', $id);
            //   var_dump(get_field('distance_to_zero', $id));
            // calculate distance to 0,0
            //   $distanceZero = (int) distance($lat, $long, 0, 0, "M");
            // $distanceZero = get_field('distance_to_zero');
            //  $attachedProviderID = get_field('attached_provider_id');
            //var_dump('slug',$attachedProviderID,'ag_provider_id');

            echo '<hr>';
            //   wp_create_term($attachedProviderID, 'ag_provider_id');
            //store in meta_field
            //   update_field('distance_to_zero',(int) $distanceZero, $id);
            $rslt = wp_set_post_terms($id, $attachedProviderID, 'ag_provider_id');
            var_dump($rslt);
        endwhile;
        echo '<hr>';
        var_dump('Last Updated ID is: ' . $id . ' Count:' . $cntr);
        die('<hr>The end');
    endif;
}

function getFiltersData(WP_REST_Request $request) {
    $placeName = $request['placeName'];
    $serviceTypeID = $request['serviceTypeID'];
}

function my_terms_clauses($clauses, $taxonomy, $args) {
    global $wpdb;

    if ($args['post_types']) {
        $post_types = $args['post_types'];

        // allow for arrays
        if (is_array($args['post_types'])) {
            $post_types = implode("','", $args['post_types']);
        }
        $clauses['join'] .= " INNER JOIN $wpdb->term_relationships AS r ON r.term_taxonomy_id = tt.term_taxonomy_id INNER JOIN $wpdb->posts AS p ON p.ID = r.object_id";
        $clauses['where'] .= " AND p.post_type IN ('" . esc_sql($post_types) . "') GROUP BY t.term_id";
    }
    return $clauses;
}

add_filter('terms_clauses', 'my_terms_clauses', 99999, 3);

function get_terms_by_post_type($taxonomies, $args, $post_type, $fields = 'all') {
    $args = array(
        'post_type' => (array) $post_type,
        'posts_per_page' => -1
    );
    $the_query = new WP_Query($args);
    $terms = array();
    while ($the_query->have_posts()) {
        $the_query->the_post();
        $curent_terms = wp_get_object_terms($post->ID, $taxonomy);
        foreach ($curent_terms as $t) {
            //avoid duplicates
            if (!in_array($t, $terms)) {
                $terms[] = $c;
            }
        }
    }
    wp_reset_query();
    //return array of term objects
    if ($fields == "all")
        return $terms;
    //return array of term ID's
    if ($fields == "ID") {
        foreach ($terms as $t) {
            $re[] = $t->term_id;
        }
        return $re;
    }
    //return array of term names
    if ($fields == "name") {
        foreach ($terms as $t) {
            $re[] = $t->name;
        }
        return $re;
    }
    // get terms with get_terms arguments
    if ($fields == "get_terms") {
        $terms2 = get_terms($taxonomies, $args);
        foreach ($terms as $t) {
            if (in_array($t, $terms2)) {
                $re[] = $t;
            }
        }
        return $re;
    }
}
add_shortcode('countiesulli','countiesulli');
function countiesulli(){
      $slug = array( 'ag_county');


        $terms = get_terms(array(
          
            'taxonomy' => $slug,
            'hide_empty' => true,
        ));
     
        
        $nozeroterms ='<ul>';
          foreach ($terms as $term) {

            $total=$term->count;
            $post_type = get_taxonomy( $term->taxonomy )->object_type[0];
              $nozeroterms .= '<li><a href="https://www.agespace.org/services/home-care/'.$term->slug.'"><i aria-hidden="true" class="fas fa-chevron-right"></i><span>'.$term->name.'</span></a></li>';
         
            if ($post_type =='ag_location') {
//                 var_dump($post_type);
//        
//        die();
                 }
         
        }
           $nozeroterms .='</ul>';

        return $nozeroterms;
}


function getapipostmeta(WP_REST_Request $request) {
    $id = $request['id'];
    $slug = $request['tax'];
    $temp = [
        'relation' => 'AND', //Must satisfy all taxonomy queries
        array(
            'taxonomy' => 'ag_cities',
            'field' => 'term_id',
            'terms' => $city
        ),
        array(
            'taxonomy' => 'ag_county',
            'field' => 'term_id',
            'terms' => $county,
        )
    ];

    if ($slug == 'allPlaces') {
       
        $slug = array('ag_cities', 'ag_county');


        $terms = get_terms(array(
          
            'taxonomy' => $slug,
            'hide_empty' => false,
        ));
        $nozeroterms = [];

//         // $args = array('orderby' => 'title', 'order' => 'asc',  'hide_empty' => 1);
//          $terms = get_terms_by_post_type('ag_location','','ag_location','ID');
        foreach ($terms as $term) {
//$args= array (
//          'taxonomy' => $term->taxonomy,
//        'terms' => $term->slug,
//        'field' => 'slug',
//     
//        'operator' => 'IN'
//       
//          
//        );
//    $the_query = new WP_Query( array(
//    'post_type' => 'ag_location',
//    'tax_query' => array(
//       $args
//    ),
//) );
//            $args = array(
//                'post_type' => 'ag_location',
//                'tax_query' => array(
//                    array(
//                        'taxonomy' => 'ag_county',
//                        'terms' => $term->slug,
//                        'field' => 'slug',
//                    )
//                ),
//                'orderby' => 'title',
//                'order' => 'ASC');
//            $total = query_posts($args
//            );
//
//
//            var_dump($total);
//            die();
           
//            var_dump(get_taxonomy( $term->taxonomy ));
//            die();
//            
//           
         //   $post_type = get_taxonomy( $term->taxonomy )->object_type[0];
            //  $nozeroterms[] = $term;
                $nozeroterms[] = $term;
             $total=1;
            if ($total>0) {
            
            }
            wp_reset_postdata();
        }

        return $nozeroterms;
    } else {
        $terms = get_terms(array(
            'taxonomy' => $slug,
            'hide_empty' => false,
        ));
    }




//    $allpostsQuery = new WP_Query($args2);
//    $data = [];
//
//    $allposts = $allpostsQuery->get_posts();
//    $i = 0;
//    foreach ($allposts as $post) {
//        $data[$i] = $post;
//        $i++;
//    }
    return $terms;
}

function cityEndpoint(WP_REST_Request $request) {

    $searchedDistance = $request['filter_distance'] ?: 15;
    $postsPerPage = $request['per_page'] ?: 3;
    $citySearched = $request['city'];
    $args = [
        'posts_per_page' => $postsPerPage,
        'post_type' => 'ag_location',
        'paged' => $page,
        's' => $searchKeyword,
    ];

    global $wpdb;
// 
//
    $querySQL = "SELECT * FROM `uk_towns` WHERE ( `type` = 'city' OR `type` = 'town' OR `type` = 'town' ) AND `name` LIKE '" . $citySearched . "%' ";



    $results = $wpdb->get_results($querySQL);
    $i = 0;
    $data = array();


    foreach ($results as $result) :

        $data[$i]['name'] = $result->name;
        $data[$i]['type'] = $result->type;
        $data[$i]['latitude'] = $result->latitude;
        $data[$i]['longitude'] = $result->longitude;
        $i++;
    endforeach;
    return $data;


//var_dump(isset($_COOKIE['storedsearch']));

    if ($the_query->have_posts()) :

        //    foreach($posts as $post){

        while ($the_query->have_posts()) : $the_query->the_post();
            $id = get_the_ID();
            //  var_dump('id--->'.$post);
            $lat = get_field('location_latitude', $id);
            $long = get_field('location_longitude', $id);

            $distance = (int) distance($lat, $long, $searchedLat, $searchedLong, "M");
//        if($distance>=$searchedDistance){
//            continue;
//        }
//     $totalFound++;
            $distanceKM = (int) distance($lat, $long, $searchedLat, $searchedLong, "K");

            $obj['totalresult'] = $totalPosts;
            $obj['totalpages'] = $totalpages; //round($totalPosts/$postsPerPage);
            $obj['id'] = $id;
            $obj['title'] = get_the_title($id);
            $providerID = get_field('attached_provider_id', $id);
            $obj['specialist_service'] = get_the_terms($providerID, 'specialist_service');
            $obj['distance_zero'] = (int) get_field('distance_to_zero', $id);
            $distanceObj = get_the_terms($post, 'distance_zero');
            $obj['distance_miles'] = $distance;
            $obj['distance_kilometers'] = $distanceKM;
            $obj['searched_distance_zero'] = $myZeroDistance;
            $obj['distance_zero_name'] = (int) $distanceObj[0]->name;
            $obj['distance_zero_id'] = $distanceObj[0]->term_id;


            $obj['post_date'] = get_the_date($id);
            $obj['date'] = get_the_date($id);
            //$obj['date_gmt'] = get_gmt_from_date();
            $obj['link'] = get_permalink($id);
            $obj['service_category'] = get_the_terms($id, 'ag_primary_inspection_cat');
            $obj['cqc_location'] = get_the_terms($id, 'cqc_location');

            $obj['brand'] = get_the_terms($id, 'ag_brand');
            $obj['staff'] = get_the_terms($id, 'ag_staff');
            $obj['region'] = get_the_terms($id, 'ag_regions');
            $obj['city'] = get_the_terms($id, 'ag_cities');
             $obj['town'] = $obj['city'];
            $obj['county'] = get_the_terms($id, 'ag_county');
            $obj['type_sector'] = get_the_terms($id, 'ag_type_sector');
            $obj['inspection_directorate'] = get_the_terms($id, 'ag_inspection_directorate');
            $obj['ownership_type'] = get_the_terms($id, 'ag_ownership_type');
            $obj['local_authority'] = get_the_terms($id, 'ag_local_authority');
            $obj['parliamentary_constituency'] = get_the_terms($id, 'parliamentary_constituency');
            $obj['onspd_ccg'] = get_the_terms($id, 'location_onspd_ccg');



            $obj['thumbnail'] = get_field('thumbnail', $id);
            $obj['locationId'] = get_field('locationId', $id);
            $obj['care_home'] = get_field('care_home', $id);
            $obj['location_phone_number'] = get_field('location_phone_number', $id);
            $obj['location_website'] = get_field('location_website', $id);
            $obj['attached_provider'] = get_field('attached_provider', $id);
            $obj['attached_provider_id'] = $providerID;
            $obj['uprn_id'] = get_field('location_uprn_id', $id);
            $obj['latitude'] = $lat;
            $obj['longitude'] = $long;

            $obj['paf_id'] = get_field('location_paf_id', $id);
            $obj['ods_code'] = get_field('location_ods_code', $id);


            $obj['postal_code'] = get_field('location_postal_code', $id);
            $obj['street_address'] = get_field('location_street_address', $id);
            $obj['address_line_2'] = get_field('location_address_line_2', $id);
            $obj['hsca_start_date'] = get_field('location_hsca_start_date', $id);
            $obj['inherited_rating'] = get_field('inherited_rating', $id);
            $obj['latest_overall_rating'] = get_field('location_latest_overall_rating', $id);
              $obj['rating'] =$obj['latest_overall_rating'];
            $obj['care_homes_beds'] = get_field('care_homes_beds', $id);
            $obj['keyword'] = $request['keyword'];



//
//        $temp[$i]['id'] = $post->ID;
//        $temp[$i]['latitude'] = $lat;
//        $temp[$i]['longitude'] = $long;


            $data[$i] = $obj;
            // var_dump($data,$i);
            $i++;
//};
        endwhile;
        ;
//        session_start();
//        $_SESSION["storedsearch"] = serialize($data);
    //  setcookie('storedsearch', serialize($data), time()+3600);
    endif;

//sort data based on miles
    if ($sortBy) {
        var_dump($data);
    }
    usort($data, "milessort");
    if (count($data) > 0) {
        $data[0]['mytotal'] = count($data);
    }

    wp_reset_postdata();

    // $data=fixPerPage($data,3,1);

    return $data;
}

function customEndpointAPI(WP_REST_Request $request) {
    $filtersOnly = $request['filtersOnly'] ? true : false;
    $filterName = $request['filterName'] ?: false;
    $requestedID = $request['id'] ?: false;
    $searchKeyword = $request['search'] ?: '';
    $sortBy = $request['sortby'] ? $request['sortby'] : false;
    $isFeatured = $request['featured'] ?: false;
    $serviceTypeID = $request['serviceTypeID'] ?: false;
    $region = (int) $request['region'] ?: null;
    $city = (int) $request['town'] ?: null;
    $county = (int) $request['county'] ?: null;
    $keyword = $request['keyword'] ?: '';
    $filterDistance = $request['filter_distance'] ? true : false;
    $searchedLat = (float) $request['latitude'] ?: 0;
    $searchedLong = (float) $request['longitude'] ?: 0;


    $searchedDistance = (int) $request['filter_distance'] ?: 15;
    //$myZeroDistance = (int) distance(0, 0, $searchedLat, $searchedLong, "M");
    $postsPerPage = $request['per_page'] ?: 3;
    $page = $request['page'] ?: 1;

    $meta_query = [];




    if ($filterDistance) {
//add_filter( 'posts_where' , 'posts_where', 10, 2);
//       	$meta_query=array(
//                'relation' => 'AND',
//        array(
//            'key' => 'distance_to_zero',
//            'value' => -100,
//            'compare' => ' < 3500'
//        ),
//             array(
//            'key' => 'distance_to_zero',
//            'value' => "0",
//            'compare' => '!='
//        )
//            );
    };


    if (false) {
        $inrangeDistances = [];
        for ($i = 1; $i <= $searchedDistance; $i++) {
            $inrangeDistances[] = $myZeroDistance - $i;
            $inrangeDistances[] = $myZeroDistance + $i;
        }



        $args2 = [
            'posts_per_page' => '10',
            'post_type' => 'ag_location',
            'distance_zero' => $inrangeDistances,
        ];


        $distance_miles = [];

        $allpostsQuery = new WP_Query($args2);

        $allposts = $allpostsQuery->get_posts();
        foreach ($allposts as $post) {
            $id = get_the_ID();

            $lat = get_field('location_latitude', $post);
            $long = get_field('location_longitude', $post);

            $distance = (int) distance($lat, $long, $searchedLat, $searchedLong, "M");

            $distance_miles[] = $distance;
        }
    }
//asort($inrangeDistances);
    //var_dump($inrangeDistances);
    $taxQueryArray = [];
    $args = [
        'posts_per_page' => $postsPerPage,
        'post_type' => 'ag_location',
        'paged' => $page,
        'tax_query' => array(),
        's' => $searchKeyword,
        'orderby' => 'title',
        'order' => 'ASC'
    ];

    if ($sortBy) {

        array_push($args['orderby'], $sortBy);
        array_push($args['order'], 'asc');
    }
    // var_dump($args);
    if ($serviceTypeID) {
        $temp = [
            'taxonomy' => 'ag_primary_inspection_cat',
            'field' => 'term_id',
            'terms' => $serviceTypeID,
        ];
        array_push($args['tax_query'], $temp);
    }




    if ($isFeatured) {
        $temp = [
            'taxonomy' => 'featured_listings',
            'field' => 'slug',
            'terms' => $isFeatured,
        ];
        array_push($args['tax_query'], $temp);
    }



    if ($filterDistance && false) {

        $argstemp = [
            'distance_zero' => $inrangeDistances,
            'orderby' => $inrangeDistances,
            'order' => 'DESC',
        ];
        array_push($args, $argstemp);
    }



    if ($county) {
        $temp = [
            'taxonomy' => 'ag_county',
            'field' => 'term_id',
            'terms' => $county,
        ];

        array_push($args['tax_query'], $temp);
    }

    if ($region) {

        $temp = [
            'taxonomy' => 'ag_regions',
            'field' => 'term_id',
            'terms' => $region,
        ];

        array_push($args['tax_query'], $temp);
    }
  





    if ($requestedID) {
        $args = [
            'posts_per_page' => $postsPerPage,
            'post_type' => 'ag_location',
            'paged' => $page,
            'tax_query' => array(),
            's' => $searchKeyword,
            'orderby' => 'title',
            'order' => 'ASC',
            'p' => $requestedID,
        ];
        //  array_push($args, $requestedID);
        //    var_dump($args);
    }
   
  if ($city) {

        $temp = [
   'taxonomy' => 'ag_cities',
            'field' => 'term_id',
            'terms' => $city,
        ];

        array_push($args['tax_query'], $temp);
    

 
    }
    $the_query = new WP_Query($args);
   
    $totalPosts = $the_query->found_posts;
    $totalpages = $the_query->max_num_pages;
    $data = array();
    $obj = [];
    $i = 0;

//
//    for ($i = 1; $i <= $searchedDistance; $i++) {
//        $inrangeDistances[] = $myZeroDistance - $i;
//        $inrangeDistances[] = $myZeroDistance + $i;
//    }
//    function milessort($a, $b) {
//
//        $a = $a['distance_miles'];
//        $b = $b['distance_miles'];
//
//        if ($a == $b)
//            return 0;
//        return ($a < $b) ? -1 : 1;
//    }
//sort_posts($posts,'ID','DESC',true);
    //var_dump($posts);
//$a = $posts;
//$b = $inrangeDistances; // rule indicating new key order
//$c = array();
//$cntr=0;
//foreach($b as $index) {
//    var_dump($index);
//    $c[$cntr] = $a[$index];
//    $cntr++;
//}
//$posts=$c;
//die();
    function isInRadius($searchedLat, $searchedLong, $placeLat, $placeLong) {

        return true;
    }

    function fixPerPage($vdata, $perpage, $page) {
        $tdata = [];
        $cntr = 0;
        $totalSize = count($vdata);
        $cntr = ($cntr % $perpage) + $page + 1;

        for ($i = $cntr; $i < $totalSize; $i++) {
            $tdata[$i] = $vdata[$i];
        }
        return $tdata;
    }

    $totalFound = 0;
//var_dump(isset($_COOKIE['storedsearch']));



    if ($the_query->have_posts()) :

        //    foreach($posts as $post){
        $i = 0;
        while ($the_query->have_posts()) : $post=$the_query->the_post();







            $id = get_the_ID();



            $lat = get_field('location_latitude', $id);
            $long = get_field('location_longitude', $id);

            //$distance = (int) distance($lat, $long, $searchedLat, $searchedLong, "M");
//            var_dump($lat, $long, $searchedLat, $searchedLong);
//            die();
//            if ($distance !== null && $searchedLat !== 0 && $searchedLong !== 0) {
//                if ($distance >= intval($searchedDistance)) {
//
//                    //  var_dump($distance,$searchedDistance);
//                    continue;
//                }
//            }
 //var_dump('-->',$searchedDistance,!$county,$lat,$long, get_the_title($id) );
//            if ($searchedDistance && !$county) {
//                //calc distance to 
//                $placeLat = (float) $lat;
//                $placeLong = (float) $long;
//                $distanceKM = (int) haversineGreatCircleDistance($placeLat, $placeLong, $searchedLat, $searchedLong, "K");
//                $distance = (int) haversineGreatCircleDistance($placeLat, $placeLong, $searchedLat, $searchedLong, "M");
//
//
//
//
//
//                // var_dump($isInRadius);
//                // $isInRadius=isInRadius($searchedLat,$searchedLong,$placeLat,$placeLong);
//                if ($distance > $searchedDistance) {
//                    continue;
//                }
//            }

            if ($filtersOnly) {
                if ($filterName) {
                    switch ($filterName) {
                        case 'city':
                            $tmp = get_the_terms($id, 'ag_cities');
                            ;

                            $obj['name'] = $tmp[0]->name;
                            $obj['term_id'] = $tmp[0]->term_id;
                            break;

                        case 'serviceType':
                            $tmp = get_the_terms($id, 'ag_primary_inspection_cat');

                            $obj['name'] = $tmp[0]->name;
                            $obj['term_id'] = $tmp[0]->term_id;
                            break;



                        case 'rate':
                            $tmp = get_field('location_latest_overall_rating', $id);
                            //   if($tmp!="" && $tmp !="inadequate" && $tmp !="good")
                            if ($tmp != "")
                                $obj['name'] = $tmp;
                            //    $obj['term_id'] =$tmp; 
//              $obj['term_id'] =$tmp[0]->term_id; 
                            break;
                    }
                }

//            $obj['cqc_location'] = get_the_terms($id, 'cqc_location');
//            $obj['service_category'] = get_the_terms($id, 'ag_primary_inspection_cat');
//            $obj['brand'] = get_the_terms($id, 'ag_brand');
//            
//            $obj['staff'] = get_the_terms($id, 'ag_staff');
//            $obj['region'] = get_the_terms($id, 'ag_regions');
//           
//            $obj['county'] = get_the_terms($id, 'ag_county');
//            $obj['type_sector'] = get_the_terms($id, 'ag_type_sector');
//            $obj['inspection_directorate'] = get_the_terms($id, 'ag_inspection_directorate');
//            $obj['ownership_type'] = get_the_terms($id, 'ag_ownership_type');
//            $obj['local_authority'] = get_the_terms($id, 'ag_local_authority');
//            $obj['parliamentary_constituency'] = get_the_terms($id, 'parliamentary_constituency');
//               $obj['latest_overall_rating'] = get_field('location_latest_overall_rating', $id);
//            $obj['care_homes_beds'] = get_field('care_homes_beds', $id);

                $data[$i] = $obj;
                // var_dump($data,$i);
                $i++;
                continue;
            }


//     $totalFound++;


            $obj['totalresult'] = $totalPosts;
            $obj['totalpages'] = $totalpages; //round($totalPosts/$postsPerPage);
            $obj['id'] = $id;
            $obj['keyword'] = $keyword;
            $obj['title'] = get_the_title($id);


            $providerID = get_field('attached_provider_id', $id);
            //get provider REAL ID , those posts (provider) inside this cateogory

            $tmpargs = array(
                'post_type' => 'service_provider',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'ag_provider_id',
                        'field' => 'slug',
                        'terms' => $providerID,
                    ),
                ),
            );
            $servicetypes = [];
            $specialists = [];

            $regulatedProvider = [];
            $locationRelatedActivity = get_the_terms($id, 'regulated_activity');
            $locationRelatedActivityArray = [];
            $locationRelatedActivityArrayID = [];
            $mergedArrayArray = [];
            $specialistsID = [];
            $servicetypesID = [];
            $specialistsLocation = [];
            $specialistsLocation = get_the_terms($id, 'specialist_service');
            $postsx = new WP_Query($tmpargs);
            $specialCount = $postsx->found_posts;
            if ($postsx->have_posts()) :
                while ($postsx->have_posts()) : $post = $postsx->the_post();
                    $attachedProvider = $post;

                    $regulatedProvider = get_the_terms($post->ID, 'regulated_activity');

                    $specialists = get_the_terms($post->ID, 'specialist_service');
                    $servicetypes = get_the_terms($post->ID, 'service_category');
                    $servicetypesID[] = array_values($servicetypes)[0]->term_id;
                    $specialistsID[] = array_values($specialists)[0]->term_id;

                    $locationRelatedActivityArrayID[] = array_values($regulatedProvider)[0]->term_id;
                    $mergedArrayArray = array_merge($specialistsID, $servicetypesID, $locationRelatedActivityArrayID);


                endwhile;
                if ($specialistsLocation == NULL) {
                    $specialistsLocation = [];
                }

                $mergedArray = array_merge($specialists, $servicetypes, $regulatedProvider, $specialistsLocation);


                $mergedArray = array_unique($mergedArray, SORT_REGULAR);
            endif;

            if ($county) {

                $visibleServicesFiltersData = array(8335, 8339, 12145, 13271);


                ;
                $isThere = array_intersect($visibleServicesFiltersData, $mergedArrayArray);

                if (intval(count($isThere)) == 0) {


                    continue;
                }
            }
            wp_reset_postdata();



            //    foreach($posts as $post){
            //$datax=$posts->setup_postdata();
            //  get_the_terms($post, 'distance_zero');
            $obj['specialist_service_and_type_ID'] = count($isThere);
            $obj['service_type'] = $servicetypes; //get_field($providerID, 'specialist_service');
            $obj['specialist_service_count'] = $specialCount;
            $obj['specialist_service'] = $specialists; //get_field($providerID, 'specialist_service');
            $obj['specialist_service_and_type'] = $mergedArray;
            $obj['specialist_service_location'] = $specialistsLocation;
            $obj['provider_regulated_activity'] = $regulatedProvider; //get_field($providerID, 'specialist_service');
            $obj['location_regulated_activity'] = $locationRelatedActivity;
            $specialists = [];
             
            
            $regulatedProvider = [];
            $obj['distance_zero'] = (int) get_field('distance_to_zero', $id);
            $distanceObj = get_the_terms($post, 'distance_zero');
            $obj['distance_miles'] = $distance;
            $obj['distance_kilometers'] = $distanceKM;
//            $obj['searched_distance_zero'] = $myZeroDistance;
//            $obj['distance_zero_name'] = (int) $distanceObj[0]->name;
//            $obj['distance_zero_id'] = $distanceObj[0]->term_id;


            $obj['post_date'] = get_the_date('Y/m/d', $id);
            $obj['date'] = get_the_date('Y/m/d', $id);
            //$obj['date_gmt'] = get_gmt_from_date();
           

            $obj['cqc_location'] = get_the_terms($id, 'cqc_location');
            $obj['service_category'] = get_the_terms($id, 'ag_primary_inspection_cat');
            $obj['brand'] = get_the_terms($id, 'ag_brand');
            $obj['staff'] = get_the_terms($id, 'ag_staff');
            $obj['region'] = get_the_terms($id, 'ag_regions');
            $obj['city'] = get_the_terms($id, 'ag_cities');
            $obj['county'] = get_the_terms($id, 'ag_county');
            $slug = get_post_field( 'post_name', $ID );
         
             $obj['link'] = get_site_url().'/services/'.$obj['service_category'][0]->slug.'/'.$obj['county'][0]->slug.'/'.$slug;
            $obj['type_sector'] = get_the_terms($id, 'ag_type_sector');
            $obj['inspection_directorate'] = get_the_terms($id, 'ag_inspection_directorate');
            $obj['ownership_type'] = get_the_terms($id, 'ag_ownership_type');
            $obj['local_authority'] = get_the_terms($id, 'ag_local_authority');
            $obj['parliamentary_constituency'] = get_the_terms($id, 'parliamentary_constituency');
            $obj['onspd_ccg'] = get_the_terms($id, 'location_onspd_ccg');



            $obj['thumbnail'] = get_field('thumbnail', $id);
            $obj['locationId'] = get_field('locationId', $id);
            $obj['care_home'] = get_field('care_home', $id);
            $obj['location_phone_number'] = get_field('location_phone_number', $id);
            $obj['location_website'] = get_field('location_website', $id);
            //$obj['attached_provider'] = $attachedProvider;
            $obj['attached_provider_id'] = $providerID;
            $obj['uprn_id'] = get_field('location_uprn_id', $id);
            $obj['latitude'] = $lat;
            $obj['longitude'] = $long;
            $position['lat'] = (float) $lat;
            $position['lng'] = (float) $long;

          
            $obj['position'] = (object) $position;
            $obj['paf_id'] = get_field('location_paf_id', $id);
            $obj['ods_code'] = get_field('location_ods_code', $id);


            $obj['postal_code'] = get_field('location_postal_code', $id);
            $obj['street_address'] = get_field('location_street_address', $id);
            $obj['address_line_2'] = get_field('location_address_line_2', $id);
              $obj['infoText'] = "<b>" . $obj['title'] . "</b>"
                    . "<br>"
                    . "<small><b>Address: </b>" . $obj['street_address'].' '.$obj['address_line_2'].' '.$obj['postal_code'].'</small>';
            $obj['hsca_start_date'] = get_field('location_hsca_start_date', $id);
            $obj['inherited_rating'] = get_field('inherited_rating', $id);
            $obj['latest_overall_rating'] = get_field('location_latest_overall_rating', $id);
               $obj['rating'] =$obj['latest_overall_rating'];
            $obj['care_homes_beds'] = get_field('care_homes_beds', $id);
            $obj['keyword'] = $request['keyword'];
         
$address=( $obj['city'][0]->name  ? $obj['city'][0]->name  :  $obj['local_authority'][0]->name );
$address=($address);
$tel= ($obj['location_phone_number']) ;
$title=($obj['title']);
$url=get_site_url().'/upgrade-listing?title='.$title.'&address='.$address.'&postcode='.$obj['postal_code'].'&tel='.$tel;
  $obj['upgradeListingURL'] =($url) ;
                        
//
//        $temp[$i]['id'] = $post->ID;
//        $temp[$i]['latitude'] = $lat;
//        $temp[$i]['longitude'] = $long;


            $data[$i] = $obj;
            // var_dump($data,$i);
            $i++;
//};
        endwhile;
        ;
//        session_start();
//        $_SESSION["storedsearch"] = serialize($data);
    //  setcookie('storedsearch', serialize($data), time()+3600);
    endif;

//sort data based on miles
    if ($filtersOnly) {

        $unique = array_map('unserialize', (array_unique(array_map('serialize', $data))));
        // $unique=array_unique( array_map( 'serialize', $data ),SORT_REGULAR  )  ;
        return $unique;
    }
    if ($sortBy) {
        //var_dump($data);
        wp_reset_postdata();
        return $data;
    } else {
        usort($data, "milessort");
        if (count($data) > 0) {
            $data[0]['mytotal'] = count($data);
        }



        wp_reset_postdata();

        // $data=fixPerPage($data,3,1);

        return $data;
    }
}

function revealTaxonomy($field) {
    if ($field === 'cqc_location') {
        register_rest_field(
                'ag_location',
                'cqc_location',
                array(
                    'get_callback' => function ($object) use ($field) {

                        $ids = (array) $object['ACF']['location_onspd_ccg'];

                        foreach ($ids as $id) {
                            $term[] = get_term_by('id', $id, 'cqc_location'); //get_field($field, $id);
                        }

                        return $term;
                    },
                    'schema' => null
                )
        );
        return;
    }



    register_rest_field(
            'ag_location',
            $field,
            array(
                'get_callback' => function ($object) use ($field) {

                    $ids = (array) $object[$field];
                    foreach ($ids as $id) {
                        $term[] = get_term_by('id', $id, $field);
                    }

                    return $term;
                },
                'schema' => null
            )
    );
}

// Register a REST route
add_action('rest_api_init', function () {
    //Path to meta query route
    register_rest_route('agespace/v2', '/my_meta_query/', array(
        'methods' => 'GET',
        'callback' => 'restcustom_meta_query'
    ));
});

// Do the actual query and return the data
function restcustom_meta_query() {
    if (isset($_GET['meta_query'])) {
        $query = $_GET['meta_query'];
        // Set the arguments based on our get parameters
        $args = array(
            'relation' => $query[0]['relation'],
            array(
                'key' => $query[0]['key'],
                'value' => $query[0]['value'],
                'compare' => '=',
            ),
        );
        // Run a custom query
        $meta_query = new WP_Query($args);
        if ($meta_query->have_posts()) {
            //Define and empty array
            $data = array();
            // Store each post's title in the array
            while ($meta_query->have_posts()) {
                $meta_query->the_post();
                $data[] = get_the_title();
            }
            // Return the data
            return $data;
        } else {
            // If there is no post
            return 'No post to show';
        }
    }
}

function haversineGreatCircleDistance(
        $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $unit) {
    if ($unit == "K") {
        $earthRadius = 63710;
    } else if ($unit == "M") {
        $earthRadius = 3959;
    } else {
        $earthRadius = 3959;
    }
    // convert from degrees to radians
    $latFrom = deg2rad($latitudeFrom);
    $lonFrom = deg2rad($longitudeFrom);
    $latTo = deg2rad($latitudeTo);
    $lonTo = deg2rad($longitudeTo);

    $latDelta = $latTo - $latFrom;
    $lonDelta = $lonTo - $lonFrom;

    $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));



    return $angle * $earthRadius;
}

function distance($lat1, $lon1, $lat2, $lon2, $unit) {
    if (($lat1 == $lat2) && ($lon1 == $lon2)) {
        return 0;
    } else {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }
}

function sort_posts($posts, $orderby, $order = 'ASC', $unique = true) {
    if (!is_array($posts)) {
        return false;
    }

    usort($posts, array(new Sort_Posts($orderby, $order), 'sort'));

    // use post ids as the array keys
    if ($unique && count($posts)) {
        $posts = array_combine(wp_list_pluck($posts, 'ID'), $posts);
    }

    return $posts;
}

class Sort_Posts {

    var $order, $orderby;

    function __construct($orderby, $order) {
        $this->orderby = $orderby;
        $this->order = ( 'desc' == strtolower($order) ) ? 'DESC' : 'ASC';
    }

    function sort($a, $b) {
        if ($a->{$this->orderby} == $b->{$this->orderby}) {
            return 0;
        }

        if ($a->{$this->orderby} < $b->{$this->orderby}) {
            return ( 'ASC' == $this->order ) ? -1 : 1;
        } else {
            return ( 'ASC' == $this->order ) ? 1 : -1;
        }
    }

}

add_action('elementor/query/featuredServiceProviderQuery', function($query) {


    $ids = get_post_custom_values('featured_locations', get_the_ID());
    $ids = (maybe_unserialize($ids[0]));

    $query->set("post_type", array('ag_location'));
    $query->set("suppress_filters", true);


    $query->set("post__in", $ids);
    $query->set("orderby", 'post__in');
});
add_action('elementor/query/featuredLocationsQuery', function($query) {


    $ids = get_post_custom_values('featured_locations', get_the_ID());
    $ids = (maybe_unserialize($ids[0]));

    $query->set("post_type", array('ag_location'));
    $query->set("suppress_filters", true);


    $query->set("post__in", $ids);
    $query->set("orderby", 'post__in');
});


add_shortcode('listing-contact-details', 'listingcontactdetails');
add_shortcode('listing-staffs', 'listingstaffs');
add_shortcode('listing-services', 'listingservices');
add_shortcode('listing-accreditations', 'listingaccreditations');
add_shortcode('listing-provider-link', 'listingproviderlinks');
add_shortcode('listing-group-link', 'listinggrouplink');

add_shortcode('listing-servicetype', 'listingservicetype');
add_shortcode('listing-region', 'listingregion');
add_shortcode('listing-serviceprovidername', 'serviceprovidername');
add_shortcode('listing-title', 'listingtitle');
add_shortcode('listing-rating', 'listingrating');

$providerName;
$specialistsGlobal;
$regulatedProviderGlobal;
$providerID;

function getProviderInfo($flag) {
    $providerID = get_field('attached_provider_id');
    $tmpargs = array(
        'post_type' => 'service_provider',
        'tax_query' => array(
            array(
                'taxonomy' => 'ag_provider_id',
                'field' => 'slug',
                'terms' => $providerID,
            ),
        ),
    );


    $postsx = new WP_Query($tmpargs);
    $specialCount = $postsx->found_posts;
    if ($postsx->have_posts()) :
        while ($postsx->have_posts()) : $post = $postsx->the_post();
            $attachedProvider = $post;
            $providerName = get_the_title();
            $providerID = $post->ID;
            $specialistsGlobal = get_the_terms($post->ID, 'specialist_service');
            $regulatedProviderGlobal = get_the_terms($post->ID, 'regulated_activity');

        endwhile;
        wp_reset_query();
    endif;

    switch ($flag) {
        case 'title': return $providerName;
            break;
        case 'ID': return $providerID;
            break;
        case 'id': return $providerID;
            break;
        case 'specialist': return $specialistsGlobal;
            break;
        case 'provider': return $regulatedProviderGlobal;
            break;
    }
}


if(isAmin()){
      // $county=get_the_terms(get_queried_object_id(), 'ag_county');
  //     $county = (get_field('location_county'));
  //  var_dump(get_queried_object_id());
 //   die();
}

add_shortcode('countylink','countylink');
function countylink() {

    //  $region=get_term_by('ID',get_field('location_county'),'ag_county');

 
    $county=get_the_terms(get_the_ID(), 'ag_county');
  //  var_dump($county);
    //get provider REAL ID , those posts (provider) inside this cateogory

 $url='https://www.agespace.org/services/home-care/'.$county->name;
    return $url;
}

add_shortcode('county2','county2');
function county2() {

    //  $region=get_term_by('ID',get_field('location_county'),'ag_county');
    $county = (get_field('location_county'));

    //get provider REAL ID , those posts (provider) inside this cateogory

    $providerName = get_the_title();//getProviderInfo('title');
    if ($county) {
        $county = ", " . $county->name;
    }
    return $county->name;
}
function listingtitle() {

    //  $region=get_term_by('ID',get_field('location_county'),'ag_county');
    $county = (get_field('location_county'));

    //get provider REAL ID , those posts (provider) inside this cateogory

    $providerName = get_the_title();//getProviderInfo('title');
     return $providerName;
//    if ($county) {
//        $county = ", " . $county->name;
//    }
//    return $providerName . ' ' . $county;
}

function listingaccreditations() {
    $ID = get_the_ID();
    $fieldsArray = array('location_phone_number');
    $fields = [];
    if (get_field('location_uprn_id', $ID))
        $fields[] = "<label>UPRN ID:</label>" . get_field('location_uprn_id', $ID);

    if (get_field('location_paf_id', $ID))
        $fields[] = "<label>PAF ID:</label>" . get_field('location_paf_id', $ID);
    if (get_field('location_ods_code', $ID))
        $fields[] = "<label>ODS Code:</label>" . get_field('location_ods_code', $ID);
    if (get_field('location_onspd_ccg', $ID))
        $fields[] = "<label>ONSPD CCG:</label>" . get_field('location_onspd_ccg', $ID);



    $out = '<ul class="custom-ul no-bullet">';
    foreach ($fields as $field) {
        $out .= '<li>' . $field . '</li>';
    }





    $out .= '</ul>';

    return $out;
}

    
    
add_shortcode('whatsappShare', 'whatsappShare');

function whatsappShare() {
    
    $cont='https://api.whatsapp.com/send/?phone&text='.$_SERVER['REQUEST_URI'];
 return $cont;
}


add_shortcode('listingAddress', 'listingAddress');

function listingAddress() {
    $ID = get_the_ID();
    return get_field('location_street_address', $ID) . " " . get_field('location_address_line_2', $ID) . " " . get_field('location_county', $ID)->name . " " . get_field('location_region', $ID)->name . " " . get_field('location_postal_code', $ID);
}

add_shortcode('listingWebsite', 'listingWebsite');

function listingWebsite() {
    $ID = get_the_ID();
    return get_field('location_website', $ID);
}

add_shortcode('listingWebsite2', 'listingWebsite2');

function listingWebsite2() {
    $ID = get_the_ID();
    $url='http://'.get_field('location_website', $ID);
        $out='<a href="'.$url.'">Visit Website</a >';
    return $out;
}

add_shortcode('directionLink', 'directionLink');

function directionLink() {
    $ID = get_the_ID();

    $out='<a target="_blank" class="direction-btn" href="https://www.google.com/maps/dir/?api=1&destination='.listingAddress().'">Get Directions</a>';
    return $out;
}



add_shortcode('listingHours', 'listingHours');

function listingHours() {
    $ID = get_the_ID();
    $out="<ul class='opening-hours'>"
            . "<li><span>Monday</span> 9:00 - 17:30</li>"
             . "<li><span>Tuesday</span> 9:00 - 17:30</li>"
             . "<li><span>Wednesday</span> 9:00 - 17:30</li>"
             . "<li><span>Thursday</span> 9:00 - 17:30</li>"
             . "<li><span>Friday</span> 9:00 - 17:30</li>"
             . "<li><span>Saturday</span> Closed</li>"
             . "<li><span>Sunday</span> Closed</li>"
           
            . "</ul>";
    return $out;
}

add_shortcode('listingPhone', 'listingPhone');

function listingPhone() {
    $ID = get_the_ID();
    return get_field('location_phone_number', $ID);
}





function listingcontactdetails() {
    $ID = get_the_ID();
    $fieldsArray = array('location_phone_number');

    $address = "<span class='ag-icon-address'></span>" . get_field('location_street_address', $ID) . " " . get_field('location_address_line_2', $ID) . " " . get_field('location_county', $ID)->name . " " . get_field('location_region', $ID)->name . " " . get_field('location_postal_code', $ID);
//$phone="<label>Tel:</label>".get_field('location_phone_number', $ID);
    $website = "<span class='ag-icon-website'></span>" . get_field('location_website', $ID);
    $out = '<ul class="custom-ul no-bullet">
        

        <li>' . $address . '</li>
      
        <li>' . $website . '</li>
      
                        
                              
    </ul>';

    return $out;
}

function listingservices() {
    $datas = getProviderInfo('specialist');


    if ($datas)
        $data = '<ul class="custom-ul">';

    foreach ($datas as $item) {
        $data .= '<li>' . $item->name . '</li>';
    }

    if ($datas)
        $data .= "</ul>";



    return $data;
}

function listingstaffs() {
    $ID = get_the_ID();
    $fieldsArray = array('location_phone_number');
    $staffs = get_the_terms($ID, 'ag_staff');


//if($staffs)
//$staff='<ul class="custom-ul">';
//
//foreach($staffs as $item){
//   $staff.= '<li>'.$item->name.'</li>';
//}
//
//if($staffs)
//$staff.="</ul>";

    if ($staffs)
        $staff = '<ul class="staff-ul">';

    foreach ($staffs as $item) {
        $staff .= '<li>'
                . '<div class="avatar"><img src="https://via.placeholder.com/150" /></div>'
                . '<div class="name"><h4>' . $item->name . '</h4></div>'
                . '<div class="position">Position Goes Here</div>'
                . '</li>';
    }

    if ($staffs)
        $staff .= "</ul>";




    return $staff;
}

//
//function metaListMaker($label,$iconClass, $field, $ID) {
//    $label = $label ? : '' ;
//    $fieldValue = get_field($field, $ID);
//    //var_dump($fieldValue);
//    if($fieldValue->name)
//    $fieldValue=$fieldValue->name;
//  
//         if(!$iconClass){
//          return '<span class="value">' . $fieldValue . '</span>';
//    }
//        return '<span class="' . $iconClass . '"></span><span class="value">' . $fieldValue . '</span>';
//    
//}

function listingservicetype() {
    return 'Home care';
}

function listingregion() {
    $ID = get_field('location_region');
    ;
    $regions = get_term_by('id', $ID, 'ag_regions');
    //  var_dump($regions);
    return $regions->name;
}

function serviceprovidername() {

  //  $providerName = getProviderInfo('title');

    $providerName = get_the_title();

    return $providerName;
}

function listingrating() {
    $rating = get_field('location_latest_overall_rating');
    $class = strtolower($rating . preg_replace("/\s/g", ""));
    $ratingOut = '<span class="' . $class . ' rate-badge">' . $rating . '</span>';

    return $ratingOut;
}

add_action('init', 'make_posts_from_taxonomy');

function make_posts_from_taxonomy() {
    if (!isset($_GET['DOIT'])) {
        return;
    }
// Get all Taxonomy
    $args = array(
        'parent' => 0, //In my case I only wanted top level terms returned
        'hide_empty' => false,
    );

    $taxonomy = 'ag_county'; //Define Custom Taxonomy (source)
    $post_type = 'ag_county_post'; // Define Custom Post Type (target)

    $terms = get_terms($taxonomy, $args);

    foreach ($terms as $term) {
        set_time_limit(20); //Attempt to prevent timeouts
        $t_id = $term->term_id;
        $term_meta = get_option("taxonomy_$t_id");
        $name = $term->name; //Title
        $slug = $term->slug; //Slug
        $description = $term->description; //Description
        //Above finds all the data from Custom Taxonomy and associated metadata.
        //We make a new post for each item, using same details from Taxonomy
        if (null == get_page_by_title($name)) { // If that post doesn't exist of course.
            $new_post = array(
                'post_title' => $name,
                'post_content' => $description, //Use Taxonomy description for Post Content
                'post_name' => $slug,
                'post_status' => 'publish',
                'post_type' => $post_type,
            );
            //Insert post
            $post_id = wp_insert_post($new_post);
        }
    } //End foreach


    var_dump('DONE');
    die();
}
