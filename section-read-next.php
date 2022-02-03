<?php

if(!get_field('what_to_read_next_disable')){
$tax = get_the_category( get_the_ID());

//$catSlug=$tax[0]->slug;

$acticlesDefault = get_field('what_to_read_next_default_articles', 'options');
$args = array( 
    'orderby' => 'rand',
    'posts_per_page' => '3', 
    'post_type' => 'post'
);

$acticlesRandom=get_posts($args);



    if( current_user_can('administrator') ){
    //  var_dump($acticlesRandom);
}
$acticlesPage = get_field('what_to_read_next_articles');

$acticles =  $acticlesPage ? $acticlesPage : $acticlesRandom ;


           //         $args = array('posts_per_page' => 3, 'post_type' => 'post', 'orderby' => "rand",'category_name'=>$catSlug);
                 //   var_dump($args);
                //    $acticles = get_posts( $args );
            
                    
$sectionTitle = get_field('what_to_read_next_title', 'options');
if ($acticles) {
    echo '<section id="related-articles" >'
    . '<div class="row"><div class="col-xs-12"><h4 class="title">' . $sectionTitle . '</h4></div><div class="row p-15-h">';
 
    
    foreach ($acticles as $article) {
 setup_postdata($article);
        $title = $article->post_title;
        $ID = $article->ID;
        $image = get_featured_image($ID,'thumb-into');
        
        $out = '<div class="col-xs-12 col-sm-6"><div class="read-next-item">'
                
                . '<div class="image">'
                . '<a href="' . get_permalink($ID) . '"><img src="' . $image['url'] . '" alt="' . $image['title'] . '" /></a>'
                . '</div>'
                . '<h4 class="title"><a href="' . get_permalink($ID) . '">' .summary($title,100). '</a></h4>'
                .'<div class="text hidden"><p>'.summary(get_the_content(),110).'</p></div>'
                .'<a class="le-btn hidden" href="'.get_permalink($ID).'">Read more</a>'
                . '</div></div>'
        ;
      echo $out;
    }
    echo '</div></div></section>';
}
}
?>