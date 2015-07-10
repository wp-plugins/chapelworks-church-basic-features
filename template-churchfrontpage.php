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



<div class="flex-container ninepluscol last wrap clearfix">
  <?php 
  
  stwcbp_slider_template(); ?>
</div>	



<div id="content">

	<div id="inner-content" class="wrap clearfix">

		<div class="main twelvecol last wrap clearfix" role="main">
		
			
			<div class="left-main sixcol first clearfix">
			
			
				<div class="front-page-customcat-list">
						
					<h2 class="custom-category-title"><?php _e( 'Latest News', 'charistheme' );?></h2>
					
					<?php 
					stwcbp_list_announcements(3,'all',FALSE,FALSE); ?>
					
					<p><a href="<?php echo get_post_type_archive_link('stwcbp_announcements'); ?>"><?php _e( 'See all news..', 'charistheme' );?></a></p>

					<footer class="article-footer">
					</footer>
					
				</div>
				
			
			</div>
		
			<div class="right-main sixcol last clearfix">
			
				<div class="front-page-customcat-list">
					<h2 class="custom-category-title"><?php _e( "Pastor's Notes", 'charistheme' );?></h2>
					

					<?php 
					$wp_query = new WP_Query(); $wp_query->query('showposts=3');
					while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
					
						<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
							<header class="article-header">

								<?php 
								if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
								  the_post_thumbnail('thumbnail', array('class' => 'alignleft'));
								} ?>

								<h3 class="article-title"><a  class="article-title" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
								<p class="byline vcard"><?php
									printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span> <span class="amp">&</span> filed under %4$s.', 'charistheme' ), get_the_time('Y-m-j'), get_the_time(get_option('date_format')), stwcbp_get_the_author_posts_link(), get_the_category_list(', '));
								?></p>

							</header>

							<footer class="article-footer">
							</footer>
					
						</article>
					
					 <?php 
					endwhile; ?>

					
					<p><a href="<?php echo site_url().'/?post_type=post'; ?>"><?php _e( 'See all blog entries..', 'charistheme' );?></a></p>
					<footer class="article-footer">	</footer>
					
					<?php
					wp_reset_postdata(); ?>

				</div>
				
				<div class="frontpage-sidebar-area lower-right-sidebar">
					<?php get_sidebar('sidebar1'); ?>
				</div>

			</div>
			
		</div>

	</div>

</div>