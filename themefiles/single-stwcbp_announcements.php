<?php
/*
 * @package    CharisChurchTheme
 * @subpackage ThemeCode
 * @author     ChapelWorks Church Theme Team <support@structurworks.com>
 * @copyright  Copyright (c) 2014, StructurWorks LLC
 * @link       http://chapelworks-church-themes.com
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
?>



 <?php 
get_header(); 
if ( function_exists( 'stwcbp_create_announcement_postype' )  ) {
  //plugin is activated   ?>
	<div id="content">

		<div id="inner-content" class="wrap clearfix">

			<div id="main" class="ninepluscol last clearfix" role="main">
			
				 <?php 
				if (have_posts()) : while (have_posts()) : the_post(); ?>

				
					<div class="announcement-entry">
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article">

							<header class="article-header">

								<h3><a class="article-title" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3> 
								<p class="byline"><?php printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> <br> %4$s.', 'charistheme' ), get_the_time( 'Y-m-j' ), get_the_time( __( 'F jS, Y', 'charistheme' )), stwcbp_get_the_author_posts_link(), get_the_term_list( get_the_ID(), 'stwcbp_ministry_category','',' ','') );	?></p>

							</header>

							 <?php 
							if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
							  the_post_thumbnail('thumbnail', array('class' => 'alignleft'));
							} 
							the_content(); ?>

							<footer class="article-footer">

							</footer>

						</article>
					</div>
				 <?php 
				endwhile; ?>

				 <?php 
				else : ?>

					<article id="post-not-found" class="hentry clearfix">
							<header class="article-header">
								<h1><?php _e( 'Event Not Found!', 'charistheme' ); ?></h1>
							</header>
							<section class="entry-content">
								<p><?php _e( 'Event is missing.', 'charistheme' ); ?></p>
							</section>
							<footer class="article-footer">
									<p><?php _e( 'single-stwcbp_events.php template.', 'charistheme' ); ?></p>
							</footer>
					</article>

				 <?php 
				endif; ?>

			</div>

		</div>

	</div>

 <?php 
} 
else {
	Echo "<p>The Charis Church theme requires the <strong>ChapelWorks Basic Church Plugin</strong> to work properly. Please install and activate this plugin via the Administrator Panels</p>";
}
get_footer(); ?>