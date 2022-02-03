<div id="side-topics">
                        <h5>Choose a Topic:</h5>
                        <ul>
                            <?php
                           $args = array('posts_per_page' => -1, 'post_type' => 'forum','post_parent' => 0);
                                   $recent_posts = new WP_Query($args);


                                   while ($recent_posts->have_posts()) : $recent_posts->the_post();
                           
                         
                   
                                $class="";
                                $ID=$recent_posts->id;
                                if($ID===get_the_ID()){
                                    $class.="current";
                                }
                                echo '<li class="'.$class.'"><a href="' . get_permalink($ID) . '" title="Look ' . esc_attr(get_the_title()) . '" >' . get_the_title() . '</a> </li> ';
                            endwhile;
                            ?>
                        </ul>
                    </div>

