<?php

// Create id attribute allowing for custom "anchor" value.
$id = 'careblock-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'borderedbox';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assing defaults.
$title = get_field('title') ?: 'Your Title...';
$subtitle = get_field('subtitle') ?: 'Your Sub Title...';
$items = get_field('items');

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="agespace-block-careblock">
      <?php 
      $out="";
      if($items){
         $out.="<ul>";
  foreach ($items as $item){
    $out.= $item['link'] ? '<li><a href="'.$item['link']['url'].'">'.$item['title'].'</a></li>' : '<li>'.$item['title'].'</li>' ;
  }
  $out.="</ul>";
  }
      echo '<h2>'.$title.'</h2>'
              .'<h3 class="subtitle">'.$subtitle.'</h3>'
              .'<div class="items">'
              .$out
              .'</div>';
              ?>
      
    </div>
   
</div>