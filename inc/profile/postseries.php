<?php
function sitepoint_post_series_custom_post_type()
{
    register_post_type("sitepoint-postseries", array(
            "labels" => array("name" => __("Post Series"), "singular_name" => __("Post Series")),
            "public" => true, 
            "has_archive" => true,
            "rewrite" => array("slug"=> "post-series"),
            "supports" => array("editor", "title", "excerpt", "thumbnail", "comments"),
            "capability_type" => "post",
            "publicly_queryable" => true,
            "taxonomies" => array("category", "post_tag"),
        )
    );
}   
 
add_action("init", "sitepoint_post_series_custom_post_type", 2);
 
/* Flush Rewrite Rules */
 
function sitepoint_post_series_activation()
{
    sitepoint_post_series_custom_post_type();
    flush_rewrite_rules();
}
 
register_activation_hook( __FILE__, "sitepoint_post_series_activation");
register_deactivation_hook( __FILE__, "sitepoint_post_series_activation");



/* Add Custom Meta Boxes in WordPress Posts */
 
function sitepoint_post_series_meta_box_markup($object)
{
    wp_nonce_field(basename(__FILE__), "sitepoint-postseries");
 
    ?>
        <div>
            <label for="sitepoint-postseries-serial-number">Serial Number</label>
            <br>
            <input name="sitepoint-postseries-serial-number" type="text" value="<?php echo get_post_meta($object->ID, "sitepoint-postseries-serial-number", true); ?>">
 
            <br>
 
            <label for="sitepoint-postseries-id">Name</label>
            <br>
            <select name="sitepoint-postseries-id">
                <option value="">-</option>
                <?php
                    $posts = get_posts("post_type=sitepoint-postseries");
                    $selected_series = get_post_meta($object->ID, "sitepoint-postseries-id", true);
                    foreach($posts as $post) 
                    {
                        $id_post = $post->ID; 
                        if($id_post == $selected_series)
                        {
                            ?>
                                <option selected value="<?php echo $post->ID; ?>"><?php echo $post->post_title; ?></option>   
                            <?php
                        }
                        else
                        {
                            ?>
                                <option value="<?php echo $post->ID; ?>"><?php echo $post->post_title; ?></option>    
                            <?php    
                        }
                    }
                ?>   
            </select>
        </div>
    <?php
}
 
function sitepoint_post_series_custom_meta_box()
{
    add_meta_box("sitepoint-postseries", "Post Series", "sitepoint_post_series_meta_box_markup", "sitepoint-postseries", "side", "low", null);
}
 
add_action("add_meta_boxes", "sitepoint_post_series_custom_meta_box");

/* Callback to Save Meta Data */
 
function sitepoint_post_series_save_custom_meta_box($post_id, $post, $update)
{
 
    if(!isset($_POST["sitepoint-postseries"]) || !wp_verify_nonce($_POST["sitepoint-postseries"], basename(__FILE__)))
        return $post_id;
 
    if(!current_user_can("edit_post", $post_id))
        return $post_id;
 
    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;
 
    $slug = "post";
    if($slug != $post->post_type)
        return;
 
    $serial_number = null;
    if(isset($_POST["sitepoint-postseries-serial-number"]))
    {
        $serial_number = $_POST["sitepoint-postseries-serial-number"];
    }
    else
    {
        $serial_number = "";
    }
    update_post_meta($post_id, "sitepoint-postseries-serial-number", $serial_number);
 
    $series_id = null;
    if(isset($_POST["sitepoint-postseries-id"]))
    {
        $series_id = $_POST["sitepoint-postseries-id"];
    }
    else
    {
        $series_id = "";
    }
 
    $previous_series_id = get_post_meta($post_id, "sitepoint-postseries-id", true);
 
    update_post_meta($post_id, "sitepoint-postseries-id", $series_id);
 
    //no series, removing series, adding new series or changing series
 
    if($previous_series_id == "" && $series_id == "")
    {
        sitepoint_post_series_save_settings($series_id, $serial_number, $post_id);
    }
    else if($previous_series_id != "" && $series_id == "")
    {
        sitepoint_post_series_save_settings($previous_series_id, "", $post_id); 
    }
    else if($previous_series_id == "" && $series_id != "")
    {
        sitepoint_post_series_save_settings($series_id, $serial_number, $post_id);
    }
    else if($previous_series_id != "" && $series_id != "")
    {
        sitepoint_post_series_save_settings($previous_series_id, "", $post_id);
        sitepoint_post_series_save_settings($series_id, $serial_number, $post_id);  
    }    
}
 
add_action("save_post", "sitepoint_post_series_save_custom_meta_box", 10, 3);



/* Store WordPress posts and Post Series CTY relations as WordPress Settings. */
 
function sitepoint_post_series_save_settings($series_id, $serial_number, $post_id)
{
    if($series_id != "" && $serial_number != "")
    {
        $post_series_list = get_option("post_series_" . $series_id . "_ids", "");
 
        if($post_series_list == "")
        {
            $post_series_list_array = array($post_id);
            $post_series_list = implode (", ", $post_series_list_array);
 
            update_option("post_series_" . $series_id . "_ids", $post_series_list);
        }
        else
        {
            $post_series_list_array = explode(',', $post_series_list);
 
            if(in_array($post_id, $post_series_list_array))
            {
                //do nothing
            }
            else
            {
                $post_series_list_array[] = $post_id;
                $post_series_list = implode (", ", $post_series_list_array);
                update_option("post_series_" . $series_id . "_ids", $post_series_list);
            }
        }
    }
    else if($series_id == "" || $serial_number == "")
    {
        $post_series_list = get_option("post_series_" . $series_id . "_ids", "");
 
        if($post_series_list == "")
        {
        }
        else
        {
            $post_series_list_array = explode(',', $post_series_list);
 
            if(in_array($post_id, $post_series_list_array))
            {
                //here remove the post id from array.
                if(($key = array_search($post_id, $post_series_list_array)) !== false) {
                    unset($post_series_list_array[$key]);
                }
                $post_series_list = implode (", ", $post_series_list_array);
                update_option("post_series_" . $series_id . "_ids", $post_series_list);
            }
            else
            {
            }
        }
    }
}


/* Displaying Custom Post Types on Index Page */
 
function sitepoint_post_series_pre_posts($q)
{
    if(is_admin() || !$q->is_main_query() || is_page())
        return;
 
    $q->set("post_type", array("post", "sitepoint-postseries"));
}
 
add_action("pre_get_posts", "sitepoint_post_series_pre_posts");



function sitepoint_post_series_content_filter($content)
{   
    $slug = "sitepoint-postseries";
    if($slug != get_post_type())
        return $content;
 
    $post_series_list = get_option("post_series_" . get_the_ID() . "_ids", "");
    $post_series_list_array = explode(',', $post_series_list);
 
    $post_series_serial_number = array();
 
    foreach($post_series_list_array as $key => $value)
    {
        $serial_number = get_post_meta($value, "sitepoint-postseries-serial-number", true);
        $post_series_serial_number[$value] = $serial_number;
    }
 
    asort($post_series_serial_number);
 
    $html = "<ul class='sitepoint-post-series'>";
 
    foreach($post_series_serial_number as $key => $value) 
    {
 
        $post = get_post($key);
         
        $title = $post->post_title;
         
        $excerpt = $post->post_content;
        $shortcode_pattern = get_shortcode_regex();
        $excerpt = preg_replace('/' . $shortcode_pattern . '/', '', $excerpt);
        $excerpt = strip_tags($excerpt); 
        $excerpt = esc_attr(substr($excerpt, 0, 150));
 
        $img = "";
 
        if(has_post_thumbnail($key))
        {
            $temp = wp_get_attachment_image_src(get_post_thumbnail_id($key), array(150, 150));
            $img = $temp[0];
        }
        else
        {
            $img = "http://lorempixel.com/150/150/abstract";
        }
 
        $html = $html . "<li><h3><a href='" . get_permalink($key) . "'>" . $title . "</a></h3><div><div class='sitepoint-post-series-box1'><img src='" . $img . "' /></div><div class='sitepoint-post-series-box2'><p>" . $excerpt . " ...</p></div></div><div class='clear'></div></li>";
    } 
 
    $html = $html . "</ul>";
 
    return $content . $html;
}
 
add_filter("the_content", "sitepoint_post_series_content_filter");



/* Adding Content to WordPress Posts which belong to a Series */

function sitepoint_post_series_post_content_filter($content)
{   
    $slug = "sitepoint-postseries";
    if($slug != get_post_type())
        return $content;
 
    $serial_number = get_post_meta(get_the_ID(), "sitepoint-postseries-serial-number", true);    
    $series_id = get_post_meta(get_the_ID(), "sitepoint-postseries-id", true);
 
    if($serial_number != "" && $series_id != "")
    {
        //find next and previous post too.
 
        $post_series_list = get_option("post_series_" . $series_id . "_ids", "");
        $post_series_list_array = explode(',', $post_series_list);
 
        $post_series_serial_number = array();
 
        foreach($post_series_list_array as $key => $value)
        {
            $serial_number = get_post_meta($value, "sitepoint-postseries-serial-number", true);
            $post_series_serial_number[$value] = $serial_number;
        }
 
        asort($post_series_serial_number);
 
        $post_series_serial_number_reverse = array();
 
        $iii = 1;
 
        foreach($post_series_serial_number as $key => $value) 
        {
            $post_series_serial_number_reverse[$iii] = $key;
            $iii++;
        }
 
        $index = array_search(get_the_ID(), $post_series_serial_number_reverse);
 
        if($index == 1)
        {
            $html = "<div class='sitepoint-post-series-post-content'><div>This post is a part of <a href='" . get_permalink($series_id) . "'>" . get_the_title($series_id) . "</a> post series.</div><div>&#9112; Next: <a href='" . get_permalink($post_series_serial_number_reverse[$index + 1]) . "'>" . get_the_title($post_series_serial_number_reverse[$index + 1]) . "</a></div></div>";
            $content = $html . $content;
        }
        else if($index > 1 && $index < sizeof($post_series_serial_number_reverse))
        {
            $html = "<div class='sitepoint-post-series-post-content'><div>This post is a part of <a href='" . get_permalink($series_id) . "'>" . get_the_title($series_id) . "</a> post series.</div><div>&#9112; Next post in the series is <a href='" . get_permalink($post_series_serial_number_reverse[$index + 1]) . "'>" . get_the_title($post_series_serial_number_reverse[$index + 1]) . "</a></div><div>&#9111; Previous post in the series is <a href='" . get_permalink($post_series_serial_number_reverse[$index - 1]) . "'>" . get_the_title($post_series_serial_number_reverse[$index - 1]) . "</a></div></div>";
            $content = $html . $content;
        }
        else if($index == sizeof($post_series_serial_number_reverse))
        {
            $html = "<div class='sitepoint-post-series-post-content'><div>This post is a part of <a href='" . get_permalink($series_id) . "'>" . get_the_title($series_id) . "</a> post series.</div><div>&#9111; Previous: <a href='" . get_permalink($post_series_serial_number_reverse[$index - 1]) . "'>" . get_the_title($post_series_serial_number_reverse[$index - 1]) . "</a></div></div>";
            $content = $html . $content;
        }
    }
 
    return $content;
 
}

?>