<?php
/*
 * Plugin Name: ChapelWorks Basic Church Plugin
 * Plugin URI: http://www.chapelworks-church-themes.com
 * Description:  This plugin implements basic church Custom Post Types and Panels 
 * Version: 1.0.5
 * Author: ChapelWorks Church Theme Team
 * License: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

/* Copyright (c) StructurWorks LLC 2014  Some Rights Reserved.*/




/*****************************
  Path/URL Defines
******************************/
define( 'CD_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'CD_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Initialize custom metabox support - https://github.com/WebDevStudios/Custom-Metaboxes-and-Fields-for-WordPress 
add_action( 'init', 'wpt_initialize_cmb_meta_boxes', 9999 );  

function wpt_initialize_cmb_meta_boxes() {
 
   if ( ! class_exists( 'cmb_Meta_Box' ) )
      require_once( CD_PLUGIN_PATH . 'inc/metaboxes/init.php');
}



/************************* flexslider Init *******/

// Create Slider Post Type
require_once( CD_PLUGIN_PATH . '/inc/slider/slider_post_type.php' );
// Create Slider
require_once( CD_PLUGIN_PATH . '/inc/slider/slider.php' );

/*********************
WP_HEAD Cleanup
*********************/

function stwcbp_head_cleanup() {
	// category feeds
	// remove_action( 'wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	// remove_action( 'wp_head', 'feed_links', 2 );
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// index link
	remove_action( 'wp_head', 'index_rel_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// WP version
	remove_action( 'wp_head', 'wp_generator' );
	// remove WP version from css
	//add_filter( 'style_loader_src', 'charis_remove_wp_ver_css_js', 9999 );
	// remove Wp version from scripts
	//add_filter( 'script_loader_src', 'charis_remove_wp_ver_css_js', 9999 );

} /* end charis head cleanup */

// launching operation cleanup
add_action( 'init', 'stwcbp_head_cleanup' );


/**********************************************

Custom Post Types

***********************************************/


//  Initialize Custom Post Types - Functions are located below in this file

add_action( 'init', 'stwcbp_create_announcement_postype' );

add_action( 'init', 'stwcbp_create_ministry_decription_postype' );

add_action( 'init', 'stwcbp_create_staff_decription_postype' );




//  Custom Post Type Registration (Church Announcements)


function stwcbp_create_announcement_postype() {

$labels = array(
    'name' => _x('Church Announcements', 'post type general name','stwcbplugin'),
    'singular_name' => _x('Announcement', 'post type singular name','stwcbplugin'),
    'add_new' => _x('Add New', 'announcements','stwcbplugin'),
    'add_new_item' => __('Add New Announcement','stwcbplugin'),
    'edit_item' => __('Edit Announcement','stwcbplugin'),
    'new_item' => __('New Announcement','stwcbplugin'),
    'view_item' => __('View Announcement','stwcbplugin'),
    'search_items' => __('Search Announcements','stwcbplugin'),
    'not_found' =>  __('No announcement found','stwcbplugin'),
    'not_found_in_trash' => __('No announcements found in Trash','stwcbplugin'),
    'parent_item_colon' => '',
);

$args = array(
    'label' => __('Announcement','stwcbplugin'),
    'labels' => $labels,
    'public' => true,
    'can_export' => true,
    'show_ui' => true,
    '_builtin' => false,
    '_edit_link' => 'post.php?post=%d', // ?
    'capability_type' => 'post',
    'menu_icon' => 'dashicons-megaphone',
    'hierarchical' => false,
    'rewrite' => array( "slug" => "announcement" ),
    'supports'=> array('title', 'thumbnail', 'excerpt', 'editor') ,
    'show_in_nav_menus' => false,
	'has_archive' => true,
    'taxonomies' => array( 'stwcbp_ministry_category')
);

register_post_type( 'stwcbp_announcements', $args);

}



//  Custom Post Type Registration (Ministry Descriptions)


function stwcbp_create_ministry_decription_postype() {

$labels = array(
    'name' => _x('Church Ministry Descriptions', 'post type general name','stwcbplugin'),
    'singular_name' => _x('Ministry Description', 'post type singular name','stwcbplugin'),
    'add_new' => _x('Add New', 'Ministry Description','stwcbplugin'),
    'add_new_item' => __('Add New Ministry Description','stwcbplugin'),
    'edit_item' => __('Edit Ministry Description','stwcbplugin'),
    'new_item' => __('New Ministry Description','stwcbplugin'),
    'view_item' => __('View Ministry Description','stwcbplugin'),
    'search_items' => __('Search Ministry Description','stwcbplugin'),
    'not_found' =>  __('No ministry description found','stwcbplugin'),
    'not_found_in_trash' => __('No ministry descriptions found in Trash','stwcbplugin'),
    'parent_item_colon' => '',
);

$args = array(
    'label' => __('Church Ministry Descriptions','stwcbplugin'),
    'labels' => $labels,
    'public' => true,
    'can_export' => true,
    'show_ui' => true,
    '_builtin' => false,
    '_edit_link' => 'post.php?post=%d', // ?
    'capability_type' => 'post',
    'menu_icon' => 'dashicons-heart',
    'hierarchical' => false,
    'rewrite' => array( "slug" => "ministrydesc" ),
    'supports'=> array('title','thumbnail', 'editor') ,
    'show_in_nav_menus' => true,
	'has_archive' => false,
    'taxonomies' => array( 'stwcbp_ministry_category')
);

register_post_type( 'stwcbp_ministry_desc', $args);

}




//  Custom Post Type Registration (Church Staff)


function stwcbp_create_staff_decription_postype() {

$labels = array(
    'name' => _x('Church Staff Descriptions', 'post type general name','stwcbplugin'),
    'singular_name' => _x('Staff Description', 'post type singular name','stwcbplugin'),
    'add_new' => _x('Add New', 'Staff Description','stwcbplugin'),
    'add_new_item' => __('Add New Staff Description','stwcbplugin'),
    'edit_item' => __('Edit Staff Description','stwcbplugin'),
    'new_item' => __('New Staff Description','stwcbplugin'),
    'view_item' => __('View Staff Description','stwcbplugin'),
    'search_items' => __('Search Staff Description','stwcbplugin'),
    'not_found' =>  __('No staff description found','stwcbplugin'),
    'not_found_in_trash' => __('No staff descriptions found in Trash','stwcbplugin'),
    'parent_item_colon' => '',
);

$args = array(
    'label' => __('Church Staff Descriptions','stwcbplugin'),
    'labels' => $labels,
    'public' => true,
    'can_export' => true,
    'show_ui' => true,
    '_builtin' => false,
    '_edit_link' => 'post.php?post=%d', // ?
    'capability_type' => 'post',
    'menu_icon' => 'dashicons-id-alt',
    'hierarchical' => false,
    'rewrite' => array( "slug" => "staff-desc" ),
    'supports'=> array('title','thumbnail') ,
    'show_in_nav_menus' => false,
	'has_archive' => false,
    'taxonomies' => array( 'church_staff_category')
);

register_post_type( 'stwcbp_staff_desc', $args);

}




/**********************************************

Custom  Taxonomies

***********************************************/



//  Custom Taxonomy Registration (Ministry Types)

function stwcbp_create_ministry_category_taxonomy() {

    $labels = array(
        'name' => _x( 'Ministry Categories', 'taxonomy general name' ,'stwcbplugin'),
        'singular_name' => _x( 'Ministry Category', 'taxonomy singular name','stwcbplugin' ),
        'search_items' =>  __( 'Search Ministry Categories' ,'stwcbplugin'),
        'popular_items' => __( 'Popular Ministry Categories' ,'stwcbplugin'),
        'all_items' => __( 'All Ministry Categories' ,'stwcbplugin'),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __( 'Edit Ministry Category' ,'stwcbplugin'),
        'update_item' => __( 'Update Ministry Category' ,'stwcbplugin'),
        'add_new_item' => __( 'Add New Ministry Category' ,'stwcbplugin'),
        'new_item_name' => __( 'New Ministry Category Name','stwcbplugin' ),
        'separate_items_with_commas' => __( 'Separate ministry categories with commas','stwcbplugin' ),
        'add_or_remove_items' => __( 'Add or remove ministry categories','stwcbplugin' ),
        'choose_from_most_used' => __( 'Choose from the most used ministry categories','stwcbplugin' ),
    );

    register_taxonomy('stwcbp_ministry_category','stwcbp_events', array(
        'label' => __('Ministry Category','stwcbplugin'),
        'labels' => $labels,
        'hierarchical' => true,
        'show_ui' => true,
		'show_in_nav_menus' => false,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'ministry-category' ),
    ));

}

add_action( 'init', 'stwcbp_create_ministry_category_taxonomy', 0 );





/**********************************************

Custom Post Type ADMIN Panel UI

***********************************************/




//***********************************
//
// Display metaboxes for event input/data
//
//***********************************




/***************************************************/
/* Add the UI to the WP Admin Panel (Church Events) */
/***************************************************/
add_filter( 'cmb_meta_boxes', 'stwcbp_cpt_event_metaboxes' );
/**
 * Define the cpt metabox and field configurations.
 */
function stwcbp_cpt_event_metaboxes( array $meta_boxes ) {

    // Start with an underscore to hide fields from custom fields list
    $prefix = '_stwcbp_';

    

    $meta_boxes[] = array(
        'id'         => 'event_desc_page_metabox',
        'title'      => __('Set the Start and End Date/Time of the Event','stwcbplugin'),
        'pages'      => array( 'stwcbp_events'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
       
        'fields' => array(
		
            array(
                'name' => __('Start Date','stwcbplugin'),
                'desc' => '',
                'id'   => $prefix . 'event_start_date',
                'type' => 'text_date_timestamp',
            ),
			
			array(
                'name' => __('Start Time','stwcbplugin'),
                'desc' => '',
                'id'   => $prefix . 'event_start_time',
                'type' => 'text_time',
            ),

            array(
                'name' => __('End Date','stwcbplugin'),
                'desc' => '',
                'id'   => $prefix . 'event_end_date',
                'type' => 'text_date_timestamp',
            ),
			
			array(
                'name' => __('End Time','stwcbplugin'),
                'desc' => '',
                'id'   => $prefix . 'event_end_time',
                'type' => 'text_time',
            )


        )
    );



    return $meta_boxes;
}




//***********************************
// Display Event Start/End Dates in 
// Event CPT admin screen
//***********************************


function stwcbp_event_cpt_columns_header( $columns ) {
    unset( $columns['date'] );
	unset( $columns['tags'] );
    $columns['stwcbp_event_start_date'] = __( 'Start Date / Time', 'stwcbplugin' );
    $columns['stwcbp_event_end_date'] = __( 'End Date / Time', 'stwcbplugin' );

 
    return $columns;
}
add_filter( 'manage_edit-stwcbp_events_columns', 'stwcbp_event_cpt_columns_header', 10 );


function stwcbp_event_cpt_columns_data( $column_name, $post_id ) {
 
    if ( 'stwcbp_event_start_date' == $column_name ) {
        $start_date = get_post_meta( $post_id, '_stwcbp_event_start_date', true ); 
		$db_start_time  = get_post_meta( $post_id, '_stwcbp_event_start_time', true ); 
        echo date( 'F d, Y', $start_date ). '<br /><em>' . $db_start_time  . '</em>';
    }
 
    if ( 'stwcbp_event_end_date' == $column_name ) {
        $end_date = get_post_meta( $post_id, '_stwcbp_event_end_date', true );
		$db_end_time  = get_post_meta( $post_id, '_stwcbp_event_end_time', true ); 
        echo date( 'F d, Y', $end_date ). '<br /><em>' . $db_end_time  . '</em>';
    }
 
}
add_action( 'manage_posts_custom_column', 'stwcbp_event_cpt_columns_data', 10, 2 );



/*******************************************/
/* Admin Panel (Church Staff)             */
/*******************************************/


/***************************************************/
/* Add the UI to the WP Admin Panel (Church Staff) */
/***************************************************/
add_filter( 'cmb_meta_boxes', 'stwcbp_cpt_staff_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function stwcbp_cpt_staff_metaboxes( array $meta_boxes ) {

    // Start with an underscore to hide fields from custom fields list
    $prefix = '_stwcbp_';

    

    $meta_boxes[] = array(
        'id'         => 'staff_desc_page_metabox',
        'title'      => __('Staff Description (Use the "Set featured image" link to include a photo)','stwcbplugin'),
        'pages'      => array( 'stwcbp_staff_desc'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        
        'fields' => array(
		

            array(
                'name' => __('Position','stwcbplugin'),
                'desc' => '',
                'id'   => $prefix . 'staff_position',
                'type' => 'text_medium',
            ),

			
			array(
                'name' => __('Email Address','stwcbplugin'),
                'desc' => '',
                'id'   => $prefix . 'staff_email',
                'type' => 'text_medium',
            ),

            array(
                'name' => __('Phone Number','stwcbplugin'),
                'desc' => '',
                'id'   => $prefix . 'staff_phone',
                'type' => 'text_medium',
            ),

			
			array(
                'name' => __('Role/Biographical Information','stwcbplugin'),
                'desc' => '',
                'id'   => $prefix . 'staff_bio',
                'type' => 'textarea',
            ),
			
			array(
                'name' => __('Display Order Priority Number','stwcbplugin'),
                'desc' => __('Enter a number to control ordering on the staff display page (lower numbers will display first)','stwcbplugin'),
                'id'   => $prefix . 'staff_display_priority',
                'type' => 'text_small',
            ),


        )
    );


    // Add other metaboxes as needed

    return $meta_boxes;
}


/*************************************************

    Add Church info Admin Panel
	
 *************************************************/
class stwcpp_church_Admin {
 
 	/**
 	 * Option key, and option page slug
 	 * @var string
 	 */
	protected static $key = 'stwcpp_church_admin_options';
 
	/**
	 * Array of metaboxes/fields
	 * @var array
	 */
	protected static $theme_options = array();
 
	/**
	 * Options Page title
	 * @var string
	 */
	protected $title = '';
 
	/**
	 * Constructor
	 * @since 0.1.0
	 */
	public function __construct() {
		// Set our title
		$this->title = __( 'Church Information', 'stwcbplugin' );
 	}
 
	/**
	 * Initiate our hooks
	 * @since 0.1.0
	 */
	public function hooks() {
		add_action( 'admin_init', array( $this, 'init' ) );
		add_action( 'admin_menu', array( $this, 'add_theme_page' ) );
	}
 
	/**
	 * Register our setting to WP
	 * @since  0.1.0
	 */
	public function init() {
		register_setting( self::$key, self::$key );
	}
 
	/**
	 * Add menu options page
	 * @since 0.1.0
	 */
	public function add_theme_page() {
		$this->options_page = add_theme_page( __("Church Information (Press the Save button at the bottom of the screen after making updates)",'stwcbplugin'), $this->title, 'manage_options', self::$key, array( $this, 'admin_page_display' ) );
		}
 
	/**
	 * Admin page markup. Mostly handled by CMB
	 * @since  0.1.0
	 */
	public function admin_page_display() {
		?>
		<div class="wrap cmb_options_page <?php echo self::$key; ?>">
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
			<?php cmb_metabox_form( self::option_fields(), self::$key ); ?>
		</div>
		<?php
	}
 
	/**
	 * Defines the theme option metabox and field configuration
	 * @since  0.1.0
	 * @return array
	 */
	public static function option_fields() {
 
		// Only need to initiate the array once per page-load
		if ( ! empty( self::$theme_options ) )
			return self::$theme_options;
 
		self::$theme_options = array(
			'id'         => 'theme_options',
			'show_on'    => array( 'key' => 'options-page', 'value' => array( self::$key, ), ),
			'show_names' => true,
			'fields'     => array(
			
				array(
					'name' =>__('Church Name and Address' , 'stwcbplugin' ) ,
					'desc' => __('Enter the address of the church' , 'stwcbplugin' ),
					'type' => 'title',
					'id' => 'stwcpp_church_address_title'
				),

								
				array(
					'name' => __( 'Church Name', 'stwcbplugin' ),
					'desc' => '',
					'default' => '',
					'id' => 'stwcpp_church_name',
					'type' => 'text'
				),

				array(
					'name' => __( 'Street Address', 'stwcbplugin' ),
					'desc' => '',
					'default' => '',
					'id' => 'stwcpp_church_addr_street',
					'type' => 'text'
				),

				
				array(
					'name' => __( 'City', 'stwcbplugin' ),
					'desc' => '',
					'default' => '',
					'id' => 'stwcpp_church_addr_city',
					'type' => 'text'
				),

				
				array(
					'name' => __( 'State', 'stwcbplugin' ),
					'desc' => '',
					'default' => '',
					'id' => 'stwcpp_church_addr_state',
					'type' => 'text_small'
				),

				
				array(
					'name' => __( 'Zip Code', 'stwcbplugin' ),
					'desc' => '',
					'default' => '',
					'id' => 'stwcpp_church_addr_zip',
					'type' => 'text_medium'
				),

				array(
					'name' => __('Country', 'stwcbplugin' ),
					'desc' => '',
					'default' => '',
					'id' => 'stwcpp_church_addr_country',
					'type' => 'text_medium'
				),

				
				array(
					'name' => __( 'Church Phone Number / email Address', 'stwcbplugin' ),
					'desc' => __( 'Enter phone number', 'stwcbplugin' ),
					'type' => 'title',
					'id' => 'stwcpp_church_ph'
				),

				
				array(
					'name' => __('Phone Number' , 'stwcbplugin' ),
					'desc' => '',
					'default' => '',
					'id' => 'stwcpp_church_phone_number',
					'type' => 'text_medium'
				),	

				array(
					'name' => 'Church email Address',
					'id'   => 'stwcpp_church_email',
					'type' => 'text_email',
				),				

				
				array(
					'name' => __('Church Service Times' , 'stwcbplugin' ),
					'desc' => __('Enter text describing weekly services (Description, Day, Time, etc.) ' , 'stwcbplugin' ),
					'type' => 'title',
					'id' => 'stwcpp_church_serv'
				),

				
				array(
					'name' => __('Church Services' , 'stwcbplugin' ),
					'desc' => '',
					'default' => '',
					'id' => 'stwcpp_church_service_times', 
					'type' => 'textarea'
				),
				

				
			),
		);
		return self::$theme_options;
	}
 
	/**
	 * Make public the protected $key variable.
	 * @since  0.1.0
	 * @return string  Option key
	 */
	public static function key() {
		return self::$key;
	}
 
}
 
// Get it started
$stwcpp_church_Admin = new stwcpp_church_Admin();
$stwcpp_church_Admin->hooks();
 
/**
 * Wrapper function around cmb_get_option
 * @since  0.1.0
 * @param  string  $key Options array key
 * @return mixed        Option value
 */
function stwcpp_get_option( $key = '' ) {
	return cmb_get_option( stwcpp_church_Admin::key(), $key );
}

 
 
/*************************************************

    Change the blog name in Admin Panel
	to Pastor's Blog
	
 *************************************************/
 
 
 function customize_post_admin_menu_labels() {
	 global $menu;
	 global $submenu;
	 $menu[5][0] = __('Pastor&#39;s Blog Posts','stwcbplugin');
	 $submenu['edit.php'][5][0] = __('Pastor&#39;s Blog Posts','stwcbplugin');
	 $submenu['edit.php'][10][0] = __('Add Pastor&#39;s Blog Posts','stwcbplugin');
	 echo '';
 }
 add_action( 'admin_menu', 'customize_post_admin_menu_labels' );


/*************************************************

    Remove Posts and Comments from Admin Panel
	
 *************************************************/
 
// Disable support for comments and trackbacks in post types
function stwcbp_disable_comments_post_types_support() {
	$post_types = get_post_types();
	foreach ($post_types as $post_type) {
		if(post_type_supports($post_type, 'comments')) {
			remove_post_type_support($post_type, 'comments');
			remove_post_type_support($post_type, 'trackbacks');
		}
	}
}
add_action('admin_init', 'stwcbp_disable_comments_post_types_support');

// Close comments on the front-end
function stwcbp_disable_comments_status() {
	return false;
}
add_filter('comments_open', 'stwcbp_disable_comments_status', 20, 2);
add_filter('pings_open', 'stwcbp_disable_comments_status', 20, 2);

// Hide existing comments
function stwcbp_disable_comments_hide_existing_comments($comments) {
	$comments = array();
	return $comments;
}
add_filter('comments_array', 'stwcbp_disable_comments_hide_existing_comments', 10, 2);

// Remove comments page in menu
function stwcbp_disable_comments_admin_menu() {
	remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'stwcbp_disable_comments_admin_menu');

// Redirect any user trying to access comments page
function stwcbp_disable_comments_admin_menu_redirect() {
	global $pagenow;
	if ($pagenow === 'edit-comments.php') {
		wp_redirect(admin_url()); exit;
	}
}
add_action('admin_init', 'stwcbp_disable_comments_admin_menu_redirect');

// Remove comments metabox from dashboard
function stwcbp_disable_comments_dashboard() {
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'stwcbp_disable_comments_dashboard');

// Remove comments links from admin bar
function stwcbp_disable_comments_admin_bar() {
	if (is_admin_bar_showing()) {
		remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
	}
}
add_action('init', 'stwcbp_disable_comments_admin_bar');
 
 
// Remove Posts page in menu
/*
function stwcbp_remove_post_menu() {
	// remove Posts admin item 
	remove_menu_page( 'edit.php' );	
} 
add_action( 'admin_menu', 'stwcbp_remove_post_menu', 999 );
*/
 
 // remove unwanted dashboard widgets for relevant users
function stwcbp_remove_dashboard_widgets() {

 remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
 remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
 
}
add_action( 'wp_dashboard_setup', 'stwcbp_remove_dashboard_widgets' );
 

 
/********************************************
   Preprocessing for custom post queries
********************************************/

add_action( 'pre_get_posts', 'stwcbp_preprocess_posts');

function stwcbp_preprocess_posts( $query ){
	
	

    if ( is_home() ) {
        $query->set( 'posts_per_page', 3 );
        return;
    }
	
	if (!is_admin()){

		if ($query->is_main_query() ) {
			
			if ( is_post_type_archive( 'stwcbp_announcements' ) ) {
				$query->set('posts_per_page', 5 );
			}
			
			if ( is_post_type_archive( 'stwcbp_staff_desc' ) ) {
				$query->set('posts_per_page', 100 );
			}
			
			if ( is_post_type_archive( 'stwcbp_ministry_desc' ) ) {
				$query->set('posts_per_page', 100 );
			}

		}
		
		$this_post_type = $query->get('post_type');
		
		if ($this_post_type == 'stwcbp_staff_desc') {
			$query->query_vars['posts_per_page'] = 100;		
		}
		
		if ($this_post_type == 'stwcbp_ministry_desc') {
			$query->query_vars['posts_per_page'] = 100;		
		}

	}
}



/********************************************
   Shortcodes
********************************************/

add_shortcode("church_front_page", "stwcbp_church_front_page_shortcode");
 
function stwcbp_church_front_page_shortcode(){
	ob_start();
	include( "template-churchfrontpage.php" ); 
	return ob_get_clean();
}

add_shortcode("church_news", "stwcbp_church_news_shortcode");
 
function stwcbp_church_news_shortcode(){
	ob_start();
	include( "template-announcements.php" ); 
	return ob_get_clean();
}

add_shortcode("church_info", "stwcbp_church_info_shortcode");
 
function stwcbp_church_info_shortcode(){
	ob_start();
	include( "template-churchinfo.php" ); 
	return ob_get_clean();
}

add_shortcode("church_ministries", "stwcbp_church_ministries_shortcode");

function stwcbp_church_ministries_shortcode(){
	ob_start();
	include( "template-ministries.php" ); 
	return ob_get_clean();
}

add_shortcode("church_staff", "stwcbp_church_staff_shortcode");

function stwcbp_church_staff_shortcode(){
	ob_start();
	include( "template-staff.php" ); 
	return ob_get_clean();
}


/*************************************************

	Support Archive/Single Templates for CPTs/Taxonomies
	
 *************************************************/

add_filter('template_include', 'stwcbp_charis_template_include');

function stwcbp_charis_template_include($template) {
	if(get_query_var('post_type') == 'stwcbp_announcements') {
		if ( is_archive() || is_search() ) :
		   if(file_exists(get_stylesheet_directory() . '/archive-stwcbp_announcements.php'))
			  return get_stylesheet_directory() . '/archive-stwcbp_announcements.php';
		   return plugin_dir_path( __FILE__ ) . '/themefiles/archive-stwcbp_announcements.php';
		else :
		   if(file_exists(get_stylesheet_directory() . '/single-stwcbp_announcements.php'))
			  return get_stylesheet_directory() . '/single-stwcbp_announcements.php';
		   return plugin_dir_path( __FILE__ ) . '/themefiles/single-stwcbp_announcements.php';
		endif;
	}
	
	if(get_query_var('post_type') == 'stwcbp_ministry_desc') {
		if ( is_archive() || is_search() ) :
		   if(file_exists(get_stylesheet_directory() . '/archive-stwcbp_ministry_desc.php'))
			  return get_stylesheet_directory() . '/archive-stwcbp_ministry_desc.php';
		   return plugin_dir_path( __FILE__ ) . '/themefiles/archive-stwcbp_ministry_desc.php';
		else :
		   if(file_exists(get_stylesheet_directory() . '/single-stwcbp_stwcbp_ministry_desc.php'))
			  return get_stylesheet_directory() . '/single-stwcbp_ministry_desc.php';
		   return plugin_dir_path( __FILE__ ) . '/themefiles/single-stwcbp_ministry_desc.php';
		endif;
	}
	
	if ( is_tax( 'stwcbp_ministry_category' ) ) {
		if(file_exists(get_stylesheet_directory() . '/taxonomy-stwcbp_ministry_category.php'))
		  return get_stylesheet_directory() . '/taxonomy-stwcbp_ministry_category.php';
	   return plugin_dir_path( __FILE__ ) . '/themefiles/taxonomy-stwcbp_ministry_category.php';
	
	}		
	
	return $template;
}

/*************************************************

	Announcement Loop support for Announcements Custom post type

*************************************************/
if(file_exists(get_stylesheet_directory() . '/themefiles/announcement_loop.php')){
	//Do nothing
} else {	
	require_once( 'themefiles/announcement_loop.php' );
}

/*************************************************

	Service Functions

*************************************************/


/*
 * This is a modified the_author_posts_link() which just returns the link.
 *
 * This is necessary to allow usage of the usual l10n process with printf().
 */
function stwcbp_get_the_author_posts_link() {
	global $authordata;
	if ( !is_object( $authordata ) )
		return false;
	$link = sprintf(
		'<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
		get_author_posts_url( $authordata->ID, $authordata->user_nicename ),
		esc_attr( sprintf( __( 'Posts by %s', 'charistheme' ), get_the_author() ) ), // No further l10n needed, core will take care of this one
		get_the_author()
	);
	return $link;
}


 
?>