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
<p> 
<?php get_header(); ?>

<div id="content">

	<div id="inner-content" class="wrap clearfix">

		<div class="ninepluscol last wrap clearfix">
		
			<h1 class="custom-category-title"><?php  _e( 'Church Ministries', 'charistheme' );?></h1>
  	

			<?php	
			$events_query_args = array(
			'post_type' => 'stwcbp_ministry_desc',
			//'stwcbp_ministry_category' => single_cat_title('',false), 
			'tax_query' => array(
					array(
						'taxonomy' => 'stwcbp_ministry_desc',
						'field' => 'slug',
						'terms' => single_cat_title('',false) 
					)
			),
			'posts_per_page' => 20);
		
			$events_query = new WP_Query( $events_query_args );
					
			if ($events_query->have_posts()) : 
		
				while ($events_query->have_posts()) : $events_query->the_post(); ?>

	
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article">

					<header class="article-header">

						<h3><a class="article-title" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
						

					</header>

					<section class="entry-content clearfix" itemprop="articleBody">
					
					
					<?php 
						if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
						  the_post_thumbnail('thumbnail', array('class' => 'alignleft'));
						} 
						?>
						<?php the_content(); ?>
					
					
					</section>

					<footer class="article-footer">
						<?php the_tags( '<p class="tags"><span class="tags-title">' .  __( 'Tags:', 'charistheme' ) . '</span> ', ', ', '</p>' ); ?>

					</footer>


				</article>	

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article">

						<header class="article-header">

							<h3><a class="article-title" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

						</header>

						<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
							  the_post_thumbnail('thumbnail', array('class' => 'alignleft'));
							} 
							the_content();  ?>	
						

					</article>			
	
	
				<?php endwhile; ?>
 

				<?php wp_reset_postdata(); ?>

			<?php else:  ?>
				<h2><?php single_cat_title('',true); ?></h2>
			<?php endif; ?>

		</div>		
			
			
	
		<div class="main twelvecol last wrap clearfix" role="main">
	
			
			<div class="front-page-customcat-list">
				
				<?php $ministry_category = single_cat_title('',false);?>
					
				<h1 class="custom-category-title">News</h1>


				<?php stwcbp_list_announcements(100,$ministry_category,FALSE,TRUE); ?>
				
				<a href="<?php echo get_post_type_archive_link('stwcbp_announcements'); ?>">see all news..</a>
		
	
			</div>
				
		</div>


	</div>

</div>

<?php get_footer(); ?>