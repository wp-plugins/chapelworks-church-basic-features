<?php


/* Register a Custom Post Type (Slide) */
add_action('init', 'stwcbp_slider_init');
function stwcbp_slider_init() {
	$labels = array(
		'name' => _x('Slides', 'post type general name','stwcbplugin'),
		'singular_name' => _x('Slide', 'post type singular name','stwcbplugin'),
		'add_new' => _x('Add New', 'stwcbp_slider','stwcbplugin'), //This is our post_type, we'll display the metaboxes only on this post_type!
		'add_new_item' => __('Add New Slide','stwcbplugin'),
		'edit_item' => __('Edit Slide','stwcbplugin'),
		'new_item' => __('New Slide','stwcbplugin'),
		'view_item' => __('View Slide','stwcbplugin'),
		'search_items' => __('Search Slides','stwcbplugin'),
		'not_found' => __('No slides found', 'stwcbplugin'),
		'not_found_in_trash' => __('No slides found in Trash','stwcbplugin'),
		'parent_item_colon' => '',
		'menu_name' => 'Slides (Front Page)'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,	
		'show_in_menu' => true,
		'show_in_nav_menus' => false,
		'menu_icon' => 'dashicons-images-alt2',
		'menu_position' => 5,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'supports' => array('title', 'thumbnail')
	);
	register_post_type('stwcbp_slider', $args);
}


add_action('do_meta_boxes', 'customposttype_slider_image_box');

function customposttype_slider_image_box() {

	remove_meta_box( 'postimagediv', 'stwcbp_slider', 'side' );

	add_meta_box('postimagediv', __('Slider Image','stwcbplugin'), 'post_thumbnail_meta_box', 'stwcbp_slider', 'normal', 'low');

}

/* Update Slide Admin Messages */
add_filter('post_updated_messages', 'stwcbp_slider_updated_messages');
function stwcbp_slider_updated_messages($messages) {
	global $post, $post_ID;
	$messages['stwcbp_slider'] = array(
		0 => '',
		1 => sprintf(__('Slide updated.','stwcbplugin'), esc_url(get_permalink($post_ID))),
		2 => __('Custom field updated.','stwcbplugin'),
		3 => __('Custom field deleted.','stwcbplugin'),
		4 => __('Slide updated.','stwcbplugin'),
		5 => isset($_GET['revision']) ? sprintf(__('Slide restored to revision from %s','stwcbplugin'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
		6 => sprintf(__('Slide published.','stwcbplugin'), esc_url(get_permalink($post_ID))),
		7 => __('Slide saved.','stwcbplugin'),
		8 => sprintf(__('Slide submitted.','stwcbplugin'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
		9 => sprintf(__('Slide scheduled for:','stwcbplugin').' <strong>%1$s</strong>. ', date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
		10 => sprintf(__('Slide draft updated.','stwcbplugin'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
	);
	return $messages;
}


/* Update Slide Help */
add_action('contextual_help', 'stwcbp_slider_help_text', 10, 3);
function stwcbp_slider_help_text($contextual_help, $screen_id, $screen) {
	if ('stwcbp_slider' == $screen->id) {
		$contextual_help =
		'<p>' . __('Things to remember when adding a slide:','stwcbplugin') . '</p>' .
		'<ul>' .
		'<li>' . __('Give the slide a title. The title will be used as the slide\'s headline.','stwcbplugin') . '</li>' .
		'<li>' . __('Attach a Featured Image to give the slide its background.','stwcbplugin') . '</li>' .
		'</ul>';
	}
	elseif ('edit-stwcbp_slider' == $screen->id) {
		$contextual_help = '<p>' . __('A list of all slides appears below. To edit a slide, click on the slide\'s title.','stwcbplugin') . '</p>';
	}
	return $contextual_help;
}



//add custom fields
add_filter( 'cmb_meta_boxes' , 'stwcbp_create_slider_metaboxes' );
function stwcbp_create_slider_metaboxes( $meta_boxes ) {
	$instructions = "'<ol>	<li>"  . __("Enter your title (will not be displayed - It should be something to identify the slide).",'stwcbplugin') . "</li>
										<li>" . __("Select an image that you want to appear in the front page slide show in the Slider Image box below.",'stwcbplugin') . "</li>
										<li>" . __("Optional - Add a link (http://...) - clicking on the image will link to that page",'stwcbplugin') . "</li>
								</ol>'";

	//PROMOTION SLIDER
	$meta_boxes[] = array(
		'id' => 'stwcbp_slider_contents',
		'title' => 'Slider Image Instuctions',
		'pages' => array('stwcbp_slider'),//Add our post_type() we created earlier.
		'context' => 'normal',
		'priority' => 'low',
		'show_names' => true,
		'fields' => array(
		
			array(
				'name' => 'Instructions',
				'desc' =>  $instructions,
				'type' => 'title',
				'id' => 'stwcbp_slider_instructions'
			) ,
			
			array(
				'name' => __( 'Link URL (Optional)', 'stwcpplugin)' ),
				'desc' => '',
				'default' => '',
				'id' => 'stwcbp_slider_link_url',
				'type' => 'text'
			),

	 
		),
	);
return $meta_boxes;
}




?>