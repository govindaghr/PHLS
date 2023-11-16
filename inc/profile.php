<?php
/*
Plugin Name: Profile PHL
Plugin URI: http://www.phls.gov.bt
Description: Extensively Used For PHL Profile Post Types
Version: 1.0
Author: Ghimeray Govinda
Author URI: http://www.facebook.com/govindaghr
License: GPLv2
*/

// CREATE CUSTOM POST TYPES

add_action( 'init', 'division' );

function division() {
register_post_type( 'phl_profile',
	array(
		'labels' => array(
		'name' => 'PHL Profile',
		'singular_name' => 'PHL Profile',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New PHL Staff Profile',
		'edit' => 'Edit',
		'edit_item' => 'Edit PHL Profile',
		'new_item' => 'New PHL Profile',
		'view' => 'View',
		'view_item' => 'View PHL Profile',
		'search_items' => 'Search PHL Profile',
		'not_found' => 'No PHL Profile found',
		'not_found_in_trash' =>
		'No PHL Profile found in Trash',
		'parent' => 'Parent PHL Profile'),
		'public' => true,
		'menu_position' => 15,
		'supports' =>array( 'title', 'editor', 'excerpt', 'comments', 'thumbnail', 'page-attributes', ),
		'capability_type' => 'post',
		'publicly_queryable' => true,
		'taxonomies' => array( '' ),
		//'menu_icon' => plugins_url( 'images/image.png', __FILE__ ),
		'has_archive' => true
		)
	);


//CREATE CUSTOM TAXONOMIES

}

add_action( 'init', 'phl_taxonomies', 0 );


function phl_taxonomies(){
register_taxonomy(
          'division',
          'phl_profile', array(
                               'labels' => array(
												'name' => 'PHL Divisions',
												'add_new_item' => 'Add New Division',
												'new_item_name' => "New Division Type"
												  ),
							   'show_ui' => true,
							   'show_tagcloud' => true,
							   'hierarchical' => true
                                               )
	                           );
}




//CREATE CUSTOM META BOXES


add_action( 'admin_init', 'phl_admin' );




function phl_admin() {
add_meta_box( 'phl_profile_meta_box',
'PHL Profile Details',
'display_phl_profile_meta_box',
'phl_profile', 'normal', 'high' );
}

function display_phl_profile_meta_box( $phl_profile ) {
// Retrieve current name of the Director and Movie Rating based on review ID
$Designation =
esc_html( get_post_meta( $phl_profile->ID,
'Designation', true ) );

$Responsibility =
esc_html( get_post_meta( $phl_profile->ID,
'Responsibility', true ) );

$Contact =
esc_html( get_post_meta( $phl_profile->ID,
'Contact', true ) );

$Email =
esc_html( get_post_meta( $phl_profile->ID,
'Email', true ) );

$division_rank =
intval( get_post_meta( $phl_profile->ID,
'division_rank', true ) );
/*//changes required//
Name:(Post Title)
Bio Description: (Content)
Designation:
Responsibility:
Contact:
Email ID:*/
?>
<table>
<tr>
<td style="width: 100%">Staff Designation</td>
<td><input type="text" size="80"
name="phl_profile_Designation_name"
value="<?php echo $Designation; ?>" /></td>
</tr>
<tr>
<td style="width: 100%">Staff Responsibility</td>
<td><input type="text" size="80"
name="phl_profile_Responsibility_name"
value="<?php echo $Responsibility; ?>" /></td>
</tr>
<tr>
<td style="width: 100%">Staff Contact</td>
<td><input type="text" size="80"
name="phl_profile_contact_name"
value="<?php echo $Contact; ?>" /></td>
</tr>
<tr>
<td style="width: 100%">Staff Email</td>
<td><input type="text" size="80"
name="phl_profile_Email_name"
value="<?php echo $Email; ?>" /></td>
</tr>
<tr>
<td style="width: 150px">Staff Rank at Division</td>
<td>
<select style="width: 100px"
name="phl_profile_Rank">
<?php
// Generate all items of drop-down list
for ( $Rank = 18; $Rank >= 1; $Rank -- ) {
?>
<option value="<?php echo $Rank; ?>"
<?php echo selected( $Rank,
$division_rank ); ?>> Grade
<?php echo $Rank; ?> 
<?php } ?>
</select>
</td>
</tr>
</table>
<?php }


add_action( 'save_post',
'add_phl_profile_fields', 10, 5 );


function add_phl_profile_fields( $phl_profile_id,
$phl_profile ) {
// Check post type for movie reviews
if ( $phl_profile->post_type == 'phl_profile' ) {
// Store data in post meta table if present in post data
if ( isset( $_POST['phl_profile_Designation_name'] ) &&
$_POST['phl_profile_Designation_name'] != '' ) {
update_post_meta( $phl_profile_id, 'Designation',
$_POST['phl_profile_Designation_name'] );
}

if ( isset( $_POST['phl_profile_Responsibility_name'] ) &&
$_POST['phl_profile_Responsibility_name'] != '' ) {
update_post_meta( $phl_profile_id, 'Responsibility',
$_POST['phl_profile_Responsibility_name'] );
}

if ( isset( $_POST['phl_profile_contact_name'] ) &&
$_POST['phl_profile_contact_name'] != '' ) {
update_post_meta( $phl_profile_id, 'Contact',
$_POST['phl_profile_contact_name'] );
}

if ( isset( $_POST['phl_profile_Email_name'] ) &&
$_POST['phl_profile_Email_name'] != '' ) {
update_post_meta( $phl_profile_id, 'Email',
$_POST['phl_profile_Email_name'] );
}

if ( isset( $_POST['phl_profile_Rank'] ) &&
$_POST['phl_profile_Rank'] != '' ) {
update_post_meta( $phl_profile_id, 'division_rank',
$_POST['phl_profile_Rank'] );
}

}
}

//INCLUDE  CUSTOM TEMPLATE FILE**********************************/////
/**************************************************************************************/

// add_filter( 'template_include',
// 'include_template_function', 1 );


// function include_template_function( $template_path ) {
// if ( get_post_type() == 'phl_profile' ) {
// if ( is_single() ) {
// // checks if the file exists in the theme first,
// // otherwise serve the file from the plugin
// if ( $theme_file = locate_template( array
// ( 'single-phl_profile.php' ) ) ) {
// $template_path = $theme_file;
// } else {
// $template_path = plugin_dir_path( __FILE__ ) . '/single-phl_profile.php';
     // }
  // } 
    // elseif ( is_archive() ) {
                // if ( $theme_file = locate_template( array ( 'archive-phl_profile.php' ) ) ) {
// $template_path = $theme_file;
// }    else { $template_path = plugin_dir_path( __FILE__ ) . '/archive-phl_profile.php';

           // }
      // }
// }
// return $template_path;
// }
/**************************^^^^^^^^^^^^^^^^^^^^^^^^^^^^******************************************/

// CREATE COLUMNS IN CUSTOM POST TYPE LISTING ****************///

add_filter( 'manage_edit-phl_profile_columns', 'my_columns' );

function my_columns( $columns ) {
		  $columns['title'] = 'Name';
          $columns['phl_profile_Designation_name'] = 'Designation';          
		  $columns['phl_profile_Rank'] = 'Division Rank';
		  $columns['phl_profile_contact_name'] = 'Contact No.';
		  $columns['phl_profile_Email_name'] = 'Email ID';
		 
unset( $columns['comments'] );
return $columns;
}
add_action( 'manage_posts_custom_column', 'populate_columns' );

function populate_columns( $column ) 
{
                     if ( 'phl_profile_Designation_name' == $column ) {
                                 $Designation = esc_html( get_post_meta( get_the_ID(),'Designation', true ) );
                                 echo $Designation;
                                                                                             } 
					 elseif ( 'phl_profile_Rank' == $column ) {
                                  $division_rank = get_post_meta( get_the_ID(), 'division_rank', true );
                                 echo ' Grade - ' . $division_rank;
                                                                                                     }
					 elseif ( 'phl_profile_contact_name' == $column ) {
                                  $Contact = get_post_meta( get_the_ID(), 'Contact', true );
                                 echo $Contact;
                                                                                                     }
					 elseif ( 'phl_profile_Email_name' == $column ) {
                                  $Email = get_post_meta( get_the_ID(), 'Email', true );
                                 echo $Email;
                                                                                                     }																									 
					
}

//SORT COLUMNS
add_filter( 'manage_edit-phl_profile_sortable_columns', 'sort_profile' );


function sort_profile($columns) {

             $columns['phl_profile_Designation_name'] = 'phl_profile_Designation_name';
             $columns['phl_profile_Rank'] = 'phl_profile_Rank';
			 $columns['phl_profile_contact_name'] = 'phl_profile_contact_name';
			 $columns['phl_profile_Email_name'] = 'phl_profile_Email_name';
			 
			 
return $columns;
}


add_filter( 'request', 'column_orderby' );

function column_orderby ($vars ) {
                if ( !is_admin() )
                return $vars;
               if ( isset( $vars['orderby'] ) && 'phl_profile_Designation_name' == $vars['orderby'] ) {
                     $vars = array_merge( $vars, array( 'meta_key' => 'Designation', 'orderby' => 'meta_value' ) );
                                                                                                                                         } 
			  elseif ( isset( $vars['orderby'] ) && 'phl_profile_Rank' == $vars['orderby'] ) {
			         $vars = array_merge( $vars, array( 'meta_key' => 'division_rank', 'orderby' => 'meta_value_num' ) );
			  }
			  elseif ( isset( $vars['orderby'] ) && 'phl_profile_contact_name' == $vars['orderby'] ) {
			         $vars = array_merge( $vars, array( 'meta_key' => 'Contact', 'orderby' => 'meta_value' ) );
			  }
			  elseif ( isset( $vars['orderby'] ) && 'phl_profile_Email_name' == $vars['orderby'] ) {
			         $vars = array_merge( $vars, array( 'meta_key' => 'Email', 'orderby' => 'meta_value' ) );
}


return $vars;
}
/***************************************************************************************************/

// CREATE FILTERS WITH CUSTOM TAXONOMIES


add_action( 'restrict_manage_posts','my_filter_list' );


function my_filter_list() {
               $screen = get_current_screen();
                global $wp_query;
                if ( $screen->post_type == 'phl_profile' ) {
                          wp_dropdown_categories(array(
						'show_option_all' => 'Show All PHL Staffs',
						'taxonomy' => 'division',
						'name' => 'division',
						'orderby' => 'name',
						'selected' =>( isset( $wp_query->query['division'] ) ?
						$wp_query->query['division'] : '' ),
					  'hierarchical' => false,
					  'depth' => 3,
					  'show_count' => false,
					 'hide_empty' => true,
																								)
					);
			}
}

add_filter( 'parse_query','perform_filtering' );

function perform_filtering( $query )
 {
              $qv = &$query->query_vars;
             if (( $qv['division'] ) && is_numeric( $qv['division'] ) ) {
                    $term = get_term_by( 'id', $qv['division'], 'division' ); 
					$qv['division'] = $term->slug;
}
}

/*************************^^^^^^^^^^^^^^^^^^^^^^^*********************************/

// CREATE SHORTCODE FOR CUSTOM POST-TYPE
// create shortcode with parameters so that the user can define what's queried - default is to list all blog posts
add_shortcode( 'list-profile', 'phl_profile_listing_parameters_shortcode' );
function phl_profile_listing_parameters_shortcode( $atts ) {
	ob_start();
	extract( shortcode_atts( array (
		'type' => 'phl_profile',
		'order' => 'division',
		'orderby' => 'title',
		'posts' => -1,
		'division' => '',
		// 'fabric' => '',
		// 'category' => '',
	), $atts ) );
	$options = array(
		'post_type' => $type,
		'order' => $order,
		'orderby' => $orderby,
		'posts_per_page' => $posts,
		'division' => $division,
		// 'fabric' => $fabric,
		// 'category_name' => $category,
	);
	
	/***************ASSIGN STYLING FOR THE POST TYPES*******************/
	$query = new WP_Query( $options );
	if ( $query->have_posts() ) {
		?>
		
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				
					<div class="post-heading">
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="dottedline-green">
						</div>
					</div>
						 <?php the_post_thumbnail( array( 'class'=> "blog-img pull-left attachment-post-thumbnail",120, 120 ) ); ?>
						<div class="blog-p">
						<b>Designation:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Designation', true ) ); ?><br />
						<!--<b>Responsibility:</b> <?php //echo esc_html( get_post_meta( get_the_ID(), 'Responsibility', true ) ); ?><br />-->
						<b>Contact:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Contact', true ) ); ?><br />
						<b>Email ID:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Email', true ) ); ?><br />
						<?php the_excerpt(); ?>
						</div>
			<?php endwhile;
			wp_reset_postdata(); ?>
	<?php $myvariable = ob_get_clean();
	return $myvariable;
	}
}
//SHORTCODE USAGE EXAMPLE//
/*[list-profile type="phl_profile" division="Management" orderby="division_rank" order="ASC"]
[list-profile type="phl_profile"  orderby="division_rank" order="DESC"]
*/
?>