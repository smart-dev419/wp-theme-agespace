<?php

// Create id attribute allowing for custom "anchor" value.
$id = 'borderedbox-' . $block['id'];
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
$border_width = get_field('border_width');
$border_color = get_field('border_color');
$border_radius =get_field('border_radius');
$text = get_field('text_content');
$bgcolor=get_field('background_color');
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="agespace-block-borderedbox">
      <?php 
  
      echo '<h3>'.$title.'</h3>'
              .'<div class="box-content">'.wpautop($text).'</div>';
              ?>
      
    </div>
   
    <style type="text/css">
        #<?php echo $id; ?> .agespace-block-borderedbox {
            border: <?php echo $border_width.'px solid '.$border_color; ?>;
         border-radius: <?php echo $border_radius.'px'; ?>;
           background-color: <?php echo $bgcolor; ?>
        }
         #<?php echo $id; ?> h3{
         margin:0 0 20px 0 ;
         }
    </style>
</div>