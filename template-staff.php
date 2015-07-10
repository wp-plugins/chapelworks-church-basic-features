<?php
/*
  Staff Page
*/
?>
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

<div id="content">


	<div id="inner-content" class="wrap clearfix">
	

		<div class="main twelvecol first wrap clearfix" role="main">
		
			

			<h1 class="custom-category-title"><?php _e( 'Church Staff', 'charistheme' );?></h1>

			<?php 
			
				/*** Display the Entries ***/
				// Set up the base query args
				$staff_query_args = array(
					'post_type' => 'stwcbp_staff_desc',
					'meta_key' => '_stwcbp_staff_display_priority', 
					'orderby' => 'meta_value_num',
					'order' => 'ASC',
					'post_per_page' => -1
				);
			
			$staff_query = new WP_Query( $staff_query_args );

			if ($staff_query->have_posts()) : 
				while ($staff_query->have_posts()) : $staff_query->the_post(); 
				
				$postid = get_the_ID();?>

					
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article">

						<header class="article-header">
						
							<?php 
							if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
							  the_post_thumbnail('medium', array('class' => 'alignleft'));
							} 

							$email_addr = get_post_meta( $postid, '_stwcbp_staff_email', true ); ?>	
							<h2 class="staff-name"><?php the_title(); ?></h2>
							<h3 class="staff-position"><?php echo get_post_meta( $postid, '_stwcbp_staff_position', true ); ?></h3>
							<a class="staff-email" href="mailto:<?php echo $email_addr;?>"><?php echo $email_addr; ?></a>
							<p class="staff-phone">phone: <?php echo get_post_meta( $postid, '_stwcbp_staff_phone', true ); ?></p>
							
						</header>

						<section class="entry-content staff-bio-section" itemprop="articleBody">
							
							<p class="staff-bio"><?php echo get_post_meta( $postid, '_stwcbp_staff_bio', true ); ?> 
							
						</section>

						<footer class="article-footer">
						
							<?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'charistheme' ) . '</span> ', ', ', '</p>' ); ?>

						</footer>


					</article>

				 <?php 
				endwhile; ?>

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
					<?php } ?>

			 <?php 
			else : ?>

				<article id="post-not-found" class="hentry clearfix">
					<header class="article-header">
						<h3><?php _e( 'No entries found.', 'charistheme' ); ?></h3>
					</header>
				</article>

				<?php 
			endif; ?>

		</div>
	</div>
</div>