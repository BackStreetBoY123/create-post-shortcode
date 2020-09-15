<?php

function shortcode_display_post($attr, $content = null){
 
    global $post;
 
    // Defining Shortcode's Attributes
    $shortcode_args = shortcode_atts(
                        array(
                                'cat'     => $attr["category"],
                                'num'     => $attr["limit"],
                                'order'  => $attr["order"]
                        ), $attr);    
     
   // print_r($attr);

   global $gloal_cat;
   $gloal_cat = $shortcode_args["cat"];
 
    // array with parameter to query post based o category, and order. 
   $paged = (get_query_var('paged'))? get_query_var('paged'):1;

    $args = array(
                    'cat'            => $shortcode_args['cat'],
                    'posts_per_page' => $shortcode_args['num'],
                    'order'          => $shortcode_args['order'],
                    'paged'          => $paged,
                     
                 );
 
        $query = query_posts($args);

    // print_r($query);

    
    
    if($query){

        foreach ($query as $post) {

             $data = setup_postdata($post);
                // echo "<pre>";
                
                $cat_name=get_cat_name($category=$gloal_cat); //get category_name
                $category_link = get_category_link( $gloal_cat ); //get category link

                echo "<article style='margin-bottom:30px'>";
                echo "<div class='title' style='margin-bottom:10px;'><a href=".get_permalink()."><h3>".get_the_title()."</h3></div>";
                echo "<div class='content' style='margin-bottom:10px;'>".the_author_posts_link($post->post_author)."</div>";
                echo "<div class='content' style='margin-bottom:10px;'> <a href='".get_permalink()."'><b style='color:#753d3d'>".get_the_date()."</b></a></div>";
                echo "<div class='content' style='margin-bottom:10px;'> <a href='".get_permalink()."'>".get_the_content()."</a></div>"; 
                echo "<div class='category' style='margin-bottom:10px;color:#222'> <a href='".$category_link."'>".$cat_name."</a></div>";   
                echo "</article>";
                
        }

        echo "<a class='navigation'>".next_posts_link('next Post &#8594')."</a>";
        echo "<a class='navigation'>".previous_posts_link('previous Post &#8592')."</a>";

        wp_reset_postdata();

    }else{


            while(have_posts()){

                $cat_name=get_cat_name($category=$gloal_cat); //get category_name
                $category_link = get_category_link( $gloal_cat ); //get category link

                echo "<article style='margin-bottom:30px'>";
                echo "<div class='title' style='margin-bottom:10px;'><a href=".get_permalink()."><h3>".get_the_title()."</h3></div>";
                echo "<div class='content' style='margin-bottom:10px;'>".the_author_posts_link($post->post_author)."</div>";
                echo "<div class='content' style='margin-bottom:10px;'> <a href='".get_permalink()."'><b style='color:#753d3d'>".get_the_date()."</b></a></div>";
                echo "<div class='content' style='margin-bottom:10px;'> <a href='".get_permalink()."'>".get_the_content()."</a></div>"; 
                echo "</article>";
                echo "<div class='category' style='margin-bottom:10px;color:#222'> <a href='".$category_link."'>".$cat_name."</a></div>";   
                echo "</article>";
            }

            wp_reset_postdata();

            echo "<a class='navigation'>".next_posts_link('next Post &#8594')."</a>";
        echo "<a class='navigation'>".previous_posts_link('previous Post &#8592')."</a>";
    }
}
 
add_shortcode( 'post_by_category', 'shortcode_display_post' );


?>