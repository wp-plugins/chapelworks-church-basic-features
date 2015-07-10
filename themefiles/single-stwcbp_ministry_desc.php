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
<?php get_header(); 
if ( function_exists( 'stwcbp_create_announcement_postype' )  ) {
  //plugin is activated   ?>
<div id="content">


	<div id="inner-content" class="wrap clearfix">
	

		<div class="main ninepluscol last wrap clearfix" role="main">

						
			<?php 
			
			if (have_posts()) : while (have_posts()) : the_post(); ?>
			
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article">

					<header class="article-header">

						<h3><a class="article-title" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
						

					</header>

					<section class="entry-content clearfix" itemprop="articleBody">
					
					
					<?php 
						if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
						  the_post_thumbnail('medium', array('class' => 'alignleft'));
						} 
						?>
						<?php the_content(); ?>
					

					</section>

					<footer class="">
					

					</footer>


				</article>

				<?php
				$categories = get_the_terms($post->ID, 'stwcbp_ministry_category');
				$cat=array_pop($categories);
				$ministry_category=$cat->name;											
				?>
				
				

			<?php endwhile; ?>

				<?php 
				if ( function_exists( 'charis_page_navi' ) ) { ?>
					<?php charis_page_navi(); ?>
				 <?php 
				} else { ?>
					<nav class="wp-prev-next">
							<ul class="clearfix">
								<li class="prev-link"><?php next_posts_link( __( '&laquo; Older Entries', 'charistheme' )) ?></li>
								<li class="next-link"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'charistheme' )) ?></li>
							</ul>
					</nav>
				 <?php 
				} ?>

			<?php else : ?>

				<article id="post-not-found" class="hentry clearfix">
					<header class="article-header">
						<h3><?php _e( 'No Entries Found.', 'charistheme' ); ?></h3>
					</header>

				</article>

			<?php endif; ?>

		</div>
		
		<div class="main twelvecol last wrap clearfix" role="main">

	
	
			<div class="front-page-customcat-list">	
				
				<h1 class="custom-category-title">Latest News</h1>

				<?php stwcbp_list_announcements(100,$ministry_category, FALSE,TRUE); ?>
				
				<a href="<?php echo get_post_type_archive_link('stwcbp_announcements'); ?>">see all news..</a>
		
	
			</div>
			
			
		
		</div>
	</div>
</div>					

 <?php 
} 
else {
	Echo "<p>The Charis Church theme requires the <strong>ChapelWorks Basic Church Plugin</strong> to work properly. Please install and activate this plugin via the Administrator Panels</p>";
}
get_footer(); ?>