<?php
/*
 * @author     ChapelWorks Church Theme Team <support@structurworks.com>
 * @copyright  Copyright (c) 2014, StructurWorks LLC
 * @link       http://chapelworks-church-themes.com
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */



function stwcbp_list_all_announcements() {

	if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="announcement-entry">
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article">

				<header class="article-header">

					<h3><a class="article-title" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3> 
					<p class="byline"><?php printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> <br> %4$s.', 'stwccpi' ), get_the_time( 'Y-m-j' ), get_the_time( __( 'F jS, Y', 'stwccpi' )), stwcbp_get_the_author_posts_link(), get_the_term_list( get_the_ID(), 'stwcbp_ministry_category','',' ','') );	?></p>

				</header>

				<?php 
					if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
					  the_post_thumbnail('thumbnail', array('class' => 'alignleft'));
					} 
					the_excerpt(); 
					
				?>

				<footer class="article-footer">

				</footer>

			</article>
		</div>

	 <?php 
	endwhile;  ?>
	
		 <?php 
		if ( function_exists( 'charis_page_navi' ) ) {   ?>
				<?php charis_page_navi(); ?>
		 <?php
		} else {  ?>
				<nav class="wp-prev-next">
						<ul class="clearfix">
							<li class="prev-link"><?php next_posts_link( __( '&laquo; Older Entries', 'stwccpi' )) ?></li>
							<li class="next-link"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'stwccpi' )) ?></li>
						</ul>
				</nav>
		 <?php 
		} ?>
	

	 <?php 
	else : ?>

					 <p><?php _e( 'Sorry, no news items are currently available for this category.' , 'stwccpi'); ?></p>

	 <?php 
	endif; 
	
	// clean up after the query and pagination
	wp_reset_query();

return;
}


// List announcements - ($max_entries = is the maximum number of entries to pull)
function stwcbp_list_announcements($max_entries=5, $ministry_category='', $pageit=TRUE, $showexcerpt=FALSE ) {


	global $post;
	global $wp_query;
	
	if ($max_entries == '') {
		$max_entries=5; }
	
	
	if  ($pageit == TRUE) {
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // show multiple pages
	}else{
		$paged = 1;  // Just one page
	}
	

	if ($ministry_category == 'all') {		
		/*** Display the Announcements ***/
		// Set up the base query args
		$events_query_args = array(
			'post_type' => 'stwcbp_announcements',
			'posts_per_page' => $max_entries,
			'paged' => $paged
		);
	}
	else {
			$events_query_args = array(
			'post_type' => 'stwcbp_announcements',
			'stwcbp_ministry_category' => $ministry_category, 
			'posts_per_page' => $max_entries,
			'paged' => $paged
			);
	
	}
	

	$wp_query = new WP_Query( $events_query_args );

	if ($wp_query->have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post(); 
     ?>

		<div class="announcement-entry">
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article">

				<header class="article-header">
					<?php
					
					
					if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
					  the_post_thumbnail('thumbnail', array('class' => 'alignleft news-thumbnail'));
					}  ?>
				

					<h3><a class="article-title" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3> 
					<p class="byline"><?php printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> <br> %4$s.', 'stwccpi' ), get_the_time( 'Y-m-j' ), get_the_time( __( 'F jS, Y', 'stwccpi' )), stwcbp_get_the_author_posts_link(), get_the_term_list( get_the_ID(), 'stwcbp_ministry_category','',' ','') );	?></p>

				</header>

				
				<?php 
				if ($showexcerpt) { ?>
					<div class="alignleft">
						<?php the_excerpt(); ?>
					</div>
					<?php
				}	?>

				<footer class="article-footer">

				</footer>

			</article>
		</div>
		
	 <?php 
	endwhile; 
		if ($pageit == TRUE) {
			if ( function_exists( 'charis_page_navi' ) ) { ?>
					<?php charis_page_navi(); ?>
			 <?php 
			} else { ?>
					<nav class="wp-prev-next">
							<ul class="clearfix">
								<li class="prev-link"><?php next_posts_link( __( '&laquo; Older Entries', 'stwccpi' )) ?></li>
								<li class="next-link"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'stwccpi' )) ?></li>
							</ul>
					</nav>
			 <?php 
			} 
		} ?>

	 <?php 
	else : ?>

				 <p><?php _e( 'Sorry, no news items are currently available for this category.', 'stwccpi'); ?></p>

	 <?php 
	endif; 

	// clean up after the query and pagination
	wp_reset_query(); 

return;
}

?>