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
  //plugin is activated ?>
<div id="content">


	<div id="inner-content" class="wrap clearfix">
	

		<div class="main ninepluscol last wrap clearfix" role="main">
		
			
			<div class="archive-customcat-list">	
				<h1 class="custom-category-title"><?php _e( 'News', 'charistheme' );?></h1>
				<?php stwcbp_list_all_announcements(); ?>
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