<?php

// Enqueue Flexslider Files

	function stwcbp_slider_scripts() {
		wp_enqueue_script( 'jquery' );
		$file = __FILE__;
		$content_url = untrailingslashit( dirname( dirname( get_stylesheet_directory_uri() ) ) );
		$content_dir = untrailingslashit( dirname( dirname( get_stylesheet_directory() ) ) );
		$file = str_replace( '\\', '/', $file );
		$content_dir = str_replace( '\\', '/', $content_dir );
		$url = str_replace( $content_dir, $content_url, $file );
		$url = str_replace('/slider.php','/',$url);		
		wp_enqueue_style( 'flex-style', $url . 'css/flexslider.css' );	
		wp_enqueue_script( 'flex-script', $url .  'js/jquery.flexslider-min.js', array( 'jquery' ), false, true );
	}
	add_action( 'wp_enqueue_scripts', 'stwcbp_slider_scripts' );


// Initialize Slider
	
	function stwcbp_slider_initialize() { ?>
		<script type="text/javascript" charset="utf-8">
			jQuery(window).load(function() {
			  jQuery('.flexslider').flexslider({
			    animation: "fade",
			    direction: "horizontal",
		    	slideshowSpeed: 7000,
		    	animationSpeed: 600
			  });
			});
		</script>
	<?php }
	add_action( 'wp_head', 'stwcbp_slider_initialize' );
	
	
// Create Slider
	function stwcbp_slider_template() {
		global $post;
		// Query Arguments
		$args = array(
					'post_type' => 'stwcbp_slider',
					'posts_per_page'	=> 5
				);	
		
		// The Query
		$the_query = new WP_Query( $args );
		
		// Check if the Query returns any posts
		if ( $the_query->have_posts() ) {
		
			// Start the Slider ?>
			<div class="flexslider">
				<ul class="slides">
				
					<?php		
					// The Loop
					while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<li>
						
							<?php 
							if ( has_post_thumbnail()) {
							
								$slider_link_url = esc_url(get_post_meta( $post->ID, 'stwcbp_slider_link_url', true )); 
								$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
								if($slider_link_url == ''){
									
									echo '<img src="' . $large_image_url[0] . '" />';
								}
								else{
									echo '<a href="'.$slider_link_url.'">'.'<img src="' . $large_image_url[0] . '" /></a>'; // <a href="myurl_1"><img src="../myimage_1.jpg" alt="" /></a>
								}
								//echo '</a>';
								
							}
							?>				
						
						
						
						</li>
						
						

					<?php endwhile; ?>
			
				</ul><!-- .slides -->
			</div><!-- .flexslider -->
		
		<?php }
		
		// Reset Post Data
		wp_reset_postdata();
	}

// Slider Shortcode

	function stwcbp_slider_shortcode() {
		ob_start();
		stwcbp_slider_template();
		$slider = ob_get_clean();
		return $slider;
	}
	add_shortcode( 'slider', 'stwcbp_slider_shortcode' );