<?php
/*
Announcements (News) Page
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
	

		<div class="main twelvecol last wrap clearfix" role="main">
		
			
			<div class="archive-customcat-list">	
				<h1 class="custom-category-title"><?php _e('News', 'charistheme');?></h1>
				<?php stwcbp_list_announcements(5,'all',TRUE, TRUE, TRUE); ?>
			</div>
			

		</div>
	</div>
</div>