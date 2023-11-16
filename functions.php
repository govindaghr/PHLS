<?php



function theme_style() {

	wp_enqueue_style( 'bootstrap_css', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'fancybox_css', get_template_directory_uri() . '/css/fancybox/jquery.fancybox.css' );
	//wp_enqueue_style( 'jcarousel_css', get_template_directory_uri() . '/css/jcarousel.css' );
	wp_enqueue_style( 'flexslide_css', get_template_directory_uri() . '/css/flexslider.css' );
	wp_enqueue_style( 'main_css', get_template_directory_uri() . '/css/style.css' );
	wp_enqueue_style( 'theme_css', get_template_directory_uri() . '/css/theme.css' );

}
add_action( 'wp_enqueue_scripts', 'theme_style' );

function theme_js() {

	global $wp_scripts;

	wp_register_script( 'html5_shiv', 'https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js', '', '', false );
	wp_register_script( 'respond_js', 'https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js', '', '', false );

	$wp_scripts->add_data( 'html5_shiv', 'conditional', 'lt IE 9' );
	$wp_scripts->add_data( 'respond_js', 'conditional', 'lt IE 9' );

	// wp_enqueue_script( 'jquery_js', get_template_directory_uri() . '/js/jquery.js', array('jquery'), '', true );
	// //wp_enqueue_script( 'easing_js', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array('jquery'), '', true );
	// wp_enqueue_script( 'bootstrap_js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', true );
	// wp_enqueue_script( 'fancybox_pack_js', get_template_directory_uri() . '/js/jquery.fancybox.pack.js', array('jquery'), '', true );
	// wp_enqueue_script( 'fancybox_media_js', get_template_directory_uri() . '/js/jquery.fancybox-media.js', array('jquery'), '', true );
	// wp_enqueue_script( 'prettify_js', get_template_directory_uri() . '/js/google-code-prettify/prettify.js', array('jquery'), '', true );//for prettyfying
	// wp_enqueue_script( 'quicksand_js', get_template_directory_uri() . '/js/portfolio/jquery.quicksand.js', array('jquery'), '', true );//for portfolio tabs
	// wp_enqueue_script( 'setting_js', get_template_directory_uri() . '/js/portfolio/setting.js', array('jquery'), '', true );//for portfopio tabs
	// wp_enqueue_script( 'flexslider_js', get_template_directory_uri() . '/js/jquery.flexslider.js', array('jquery'), '', true );
	// //wp_enqueue_script( 'animate_js', get_template_directory_uri() . '/js/animate.js', array('jquery'), '', true );
	// wp_enqueue_script( 'custom_js', get_template_directory_uri() . '/js/custom.js', array('jquery'), '', true );
	// //wp_enqueue_script( 'validate_js', get_template_directory_uri() . '/js/validate.js', array('jquery'), '', true );

}
add_action( 'wp_enqueue_scripts', 'theme_js' );

//remove_action('wp_head', '_admin_bar_bump_cb');

add_theme_support( 'menus' );
// bootstrap menu support
add_action( 'after_setup_theme', 'wpt_setup' );
    if ( ! function_exists( 'wpt_setup' ) ):
        function wpt_setup() {
            register_nav_menu( 'primary', __( 'Primary navigation', 'wptuts' ) );
        } endif;
		
		require_once('inc/wp_bootstrap_navwalker.php');
		
		// thumbnail attachment support
add_theme_support( 'post-thumbnails' );


/**
 * Make Private Posts visible to Subscribers*
 */
function be_private_posts_subscribers() {
  $subRole = get_role( 'subscriber' );
	$subRole->add_cap( 'read_private_posts' );
}
add_action( 'init', 'be_private_posts_subscribers' );




function create_widget( $name, $id, $description ) {

	register_sidebar(array(
		'name' => __( $name ),	 
		'id' => $id, 
		'description' => __( $description ),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));

}

// Replaces the excerpt "more" text by a link
function new_excerpt_more($more) {
       global $post;
  return '... <a class="moretag" href="'. get_permalink($post->ID) . '">[Read more]</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');



create_widget( 'Front Page Left', 'front-left', 'Displays on the left of the homepage' );
create_widget( 'Front Page Center', 'front-center', 'Displays in the center of the homepage' );
create_widget( 'Front Page Right', 'front-right', 'Displays on the right of the homepage' );


create_widget( 'Page Sidebar', 'page', 'Displays on the side of pages with a sidebar' );
create_widget( 'Blog Sidebar', 'blog', 'Displays on the side of pages in the blog section' );



/***Pagination***/
function pagination($pages = '', $range = 4)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div id=\"pagination\"><span class='all'>Page ".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         echo "</div>\n";
     }
}
//Popular Tags Function

function top_tags() {
        $tags = get_tags();

        if (empty($tags))
                return;

        $counts = $tag_links = array();
        foreach ( (array) $tags as $tag ) {
                $counts[$tag->name] = $tag->count;
                $tag_links[$tag->name] = get_tag_link( $tag->term_id );
        }

        asort($counts);
        $counts = array_reverse( $counts, true );

        $i = 0;
        foreach ( $counts as $tag => $count ) {
                $i++;
                $tag_link = clean_url($tag_links[$tag]);
                $tag = str_replace(' ', '&nbsp;', wp_specialchars( $tag ));
                if($i < 11){
                        print "<li><a href=\"$tag_link\">$tag ($count)</a></li>";
                }
        }
}

//Category Function

function category() {
        $cat = get_categories();

        if (empty($cat))
                return;

        $counts = $tag_links = array();
        foreach ( (array) $cat as $category ) {
                $counts[$category->name] = $category->count;
                $tag_links[$category->name] = get_tag_link( $category->term_id );
        }

        asort($counts);
        $counts = array_reverse( $counts, true );

        $i = 0;
        foreach ( $counts as $category => $count ) {
                $i++;
                $tag_link = clean_url($tag_links[$category]);
                $category = str_replace(' ', '&nbsp;', wp_specialchars( $category ));
                if($i < 100){
                        print "<li><a href=\"$tag_link\">$category ($count)</a></li>";
                }
        }
}


//function phls_change_search_widget( $html ) {
    //ob_start(); ?>
    <!--<form role="search" method="get" action="<?php //bloginfo('siteurl'); ?>" class="search-form form-inline">
        <div class="form-group">
            <input type="text" value="<?php //echo get_search_query(); ?>" name="s" placeholder="<?php //_e( 'Search on this site', 'phls' ); ?>" class="form-control" required />
            <button class="btn btn-success" type="submit">
				<span class="fa fa-search fa-lg">
						<span class="sr-only"><?php //_e( 'Search', 'phls' ); ?></span>
				</span>
			</button>
        </div>
    </form>-->
    <?php //return ob_get_clean();
//}
//add_filter( 'get_search_form', 'phls_change_search_widget' );


/*====================================================================================================*/
function rcdc_change_search_widget( $html ) {
    ob_start(); ?>
	<form role="search" method="get" action="<?php bloginfo('siteurl'); ?>" class="navbar-form navbar-right">
		<div class="input-group">
			<input type="search" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php _e( 'Search on this site', 'rcdc' ); ?>"class="form-control pull-right" style="background-color: #e5e5e5;" placeholder="Search">
			<span class="input-group-btn">
				<button type="submit" class="btn btn-primary">
					<span class="fa fa-search fa-lg">
						<span class="sr-only"><?php _e( 'Search', 'rcdc' ); ?></span>
					</span>
				</button>
			</span>
		</div>
	</form>
	<?php return ob_get_clean();
}
add_filter( 'get_search_form', 'rcdc_change_search_widget' );
/*====================================================================================================*/

/**Staff Profile**/
require_once('inc/profile.php');



/**Custom Login**/
// WordPress to load this CSS file
function my_custom_login() {
echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/login/custom-login-styles.css" />';
}
add_action('login_head', 'my_custom_login');

// // Change the Login Logo URL
// function my_login_logo_url() {
// return get_bloginfo( 'url' );
// }
// add_filter( 'login_headerurl', 'my_login_logo_url' );

// function my_login_logo_url_title() {
// return 'Your Site Name and Info';
// }
// add_filter( 'login_headertitle', 'my_login_logo_url_title' );


// Hide the Login Error Message
function login_error_override()
{
    return 'Incorrect login details.';
}
add_filter('login_errors', 'login_error_override');

// Remove the Login Page Shake
function my_login_head() {
remove_action('login_head', 'wp_shake_js', 12);
}
add_action('login_head', 'my_login_head');


// Change the Redirect URL
function admin_login_redirect( $redirect_to, $request, $user )
{
global $user;
if( isset( $user->roles ) && is_array( $user->roles ) ) {
if( in_array( "administrator", $user->roles ) ) {
return $redirect_to;
} else {
return home_url();
}
}
else
{
return $redirect_to;
}
}
add_filter("login_redirect", "admin_login_redirect", 10, 3);


// Set “Remember Me” To Checked
function login_checked_remember_me() {
add_filter( 'login_footer', 'rememberme_checked' );
}
add_action( 'init', 'login_checked_remember_me' );

function rememberme_checked() {
echo "<script>document.getElementById('rememberme').checked = true;</script>";
}




// function jgallery_sc() {
    // wp_enqueue_script('colorbox-js', get_template_directory_uri().'/colorbox/colorbox.min.js',array('jquery'));
    // wp_enqueue_style('colorbox-css', get_template_directory_uri().'/colorbox/colorbox.css');
    // return do_shortcode('[gallery link="file"]');
// }
// add_shortcode('jgallery','jgallery_sc');




// /* ------------------------------------------------------------------*/
// /* ADD PRETTYPHOTO REL ATTRIBUTE FOR LIGHTBOX */
// /* ------------------------------------------------------------------*/

// add_filter('wp_get_attachment_link', 'rc_add_rel_attribute');
// function rc_add_rel_attribute($link) {
	// global $post;
	// return str_replace('<a href', '<a rel="prettyPhoto[pp_gal]" href', $link);

	
	// }
	
function my_login_logo() { ?>
<style type="text/css">
	#login h1 a, .login h1 a {
		background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png);
		height:65px;
		width:320px;
		background-size: 100px 100%;
		background-repeat: no-repeat;
		padding-bottom: 30px;
	}
</style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );


function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

// function my_login_logo_url_title() {
    // return 'Royal Centre for Disease Control';
// }
// add_filter( 'login_headertitle', 'my_login_logo_url_title' );
?>