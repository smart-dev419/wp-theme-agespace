<?php

// Create id attribute allowing for custom "anchor" value.
$id = 'alertbox-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'alertbox';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assing defaults.
$titleEmpty = get_field('title') ? false : true ;
$title = get_field('title') ? : 'Your Title...';

$noicon = get_field('no_icon') ?: false;
$icon = get_field('icon') ?: 'http://via.placeholder.com/80';
$border_width = get_field('border_width');
$border_color = get_field('border_color');

$text = get_field('text_content');
$bgcolor=get_field('background_color');
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="agespace-block-alertbox">
      <?php 
     
  echo '<div class="wrap">';
      echo $noicon ? '<div class="icon"><img width="80px" src="'.$icon.'" alt="'.$title.'" /></div>' : '';
          echo '</div>';
          
  $titleEl=$titleEmpty ? '' : '<h3>'.$title.'</h3>' ;
      echo '<div class="alert-body">'.$titleEl
              .'<div class="box-content">'.wpautop($text).'</div></div>';
              ?>
      
    </div>
   
    <style type="text/css">
        #<?php echo $id; ?> .agespace-block-alertbox {
            border-left: <?php echo $border_width.'px solid '.$border_color; ?>;
      
           background-color: <?php echo $bgcolor; ?>
        }
         #<?php echo $id; ?> h3{
         margin:0 0 20px 0 ;
         }
    </style>
</div>