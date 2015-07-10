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
<?php get_header(); ?>

<div id="content">


	<div id="inner-content" class="wrap clearfix">
	

		<div class="main ninepluscol last wrap clearfix" role="main">
		
			
				
						<h1 class="custom-category-title"><?php  _e( 'Church Ministries', 'charistheme' );?></h1>

						
						<?php 
						
						/*** Display the Announcements ***/
						// Set up the base query args
						$events_query_args = array(
							'post_type' => 'stwcbp_ministry_desc',
							'stwcbp_ministry_category' => single_cat_title('',false), 
							'post_per_page' => 100
							
						);
						
						$events_query = new WP_Query( $events_query_args );
									
						if ($events_query->have_posts()) : while ($events_query->have_posts()) : $events_query->the_post(); ?>

						
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

							<?php endwhile; ?>

								<?php if ( function_exists( 'charis_page_navi' ) ) { ?>
										<?php charis_page_navi(); ?>
								<?php } else { ?>
										<nav class="wp-prev-next">
												<ul class="clearfix">
													<li class="prev-link"><?php next_posts_link( __( '&laquo; Older Entries', 'charistheme' )) ?></li>
													<li class="next-link"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'charistheme' )) ?></li>
												</ul>
										</nav>
								<?php } ?>

						<?php else : ?>

								<article id="post-not-found" class="hentry clearfix">
									<header class="article-header">
										<h3><?php _e( 'No Entries Found.', 'charistheme' ); ?></h3>
									</header>
							
								</article>

						<?php endif; ?>
										
		</div>
	</div>
</div>					
				
<?php get_footer(); ?>
