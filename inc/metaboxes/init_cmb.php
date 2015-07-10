
<?php
//Initialize the meta boxes - include this in functions.php
add_action( 'init', 'wpt_initialize_cmb_meta_boxes', 9999 );  
function wpt_initialize_cmb_meta_boxes() {
 
   if ( ! class_exists( 'cmb_Meta_Box' ) )
      require_once dirname( __FILE__ ) . '/inc/metaboxes/init.php';
}
?>