<div id="askcommunityform" >
       <?php 
            $image=get_field('askform_image','options');
            ?>
            <img id="formimage" src="<?php echo $image['url'];  ?>" alt="<?php echo $image['title'];  ?>" />
            
    <div id="form-title" class="row">
   
         <div class="col-xs-12">
             <h4 class="title"><?php echo get_field('ask_form_header','options');   ?></h4>
            <div class="media hidden">
                <div class="media-body"></div>
            
            </div>
           
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-12">
            <div id="ask-question-form" >
                <div id="bbpress-forums">
                    <?php get_template_part('section', 'ask-question'); ?>
                </div>
            </div>
        </div>
    </div>


</div>