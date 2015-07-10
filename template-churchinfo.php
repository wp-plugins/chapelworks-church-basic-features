<?php
/*
  Church Information Page
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
			
				<div class="left-main fourcol first clearfix">
					<header class="article-header">
						<h2 class=""custom-category-title""><?php  _e( 'Church Address', 'charistheme' );?><h2>
					</header>
					
					<section class="">									
						<div itemscope itemtype="http://schema.org/PostalAddress">						
							<span class="addr_name" itemprop="name"><?php echo cmb_get_option(stwcpp_church_Admin::key(), 'stwcpp_church_name'); ?></span><br>
							<span class="street-address" itemprop="street-address"><?php echo cmb_get_option(stwcpp_church_Admin::key(), 'stwcpp_church_addr_street'); ?></span><br>
							<span class="locality" itemprop="addressLocality"><?php echo cmb_get_option(stwcpp_church_Admin::key(), 'stwcpp_church_addr_city'); ?></span> 
							<span class="region" itemprop="addressRegion"><?php echo cmb_get_option(stwcpp_church_Admin::key(), 'stwcpp_church_addr_state'); ?></span>
							<span class="postal-code" itemprop="postalCode"><?php echo cmb_get_option(stwcpp_church_Admin::key(), 'stwcpp_church_addr_zip'); ?></span><br><br>
							<span class="postal-code" itemprop="Phone">Telephone: <?php echo cmb_get_option(stwcpp_church_Admin::key(), 'stwcpp_church_phone_number'); ?></span>						
						</div> 

					</section>
					
					<footer class="article-footer">

					</footer>					
							
				</div>
				
				<div class="right-main fourcol clearfix">
				
					<?php 
					$gmaddress = 
					cmb_get_option(stwcpp_church_Admin::key(), 'stwcpp_church_addr_street').", ".
					cmb_get_option(stwcpp_church_Admin::key(), 'stwcpp_church_addr_city').", ".
					cmb_get_option(stwcpp_church_Admin::key(), 'stwcpp_church_addr_state').", ".
					cmb_get_option(stwcpp_church_Admin::key(), 'stwcpp_church_addr_zip').", ".
					cmb_get_option(stwcpp_church_Admin::key(), 'stwcpp_church_addr_country');
					$gmaddresc = urlencode($gmaddress);
					?>
					<div class="gmap-iframe">
						<iframe
						  width="300"
						  height="225"
						  frameborder="0" style="border:0"
						  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCnxvuBv3Hj67YszUHU-jXMxNakgkwilkg
							&q=<?php echo $gmaddresc; ?>&zoom=14">
						</iframe>
					</div>
				
				</div>
							
							
				<div class="ninecol first clearfix">
					<header class="article-header">
						<h2 class="h2"><?php _e( 'Service Times', 'charistheme' );?></h2>
					</header>
					
					<section>									
						<div>
							<pre class="">
								<span class="service-times"><?php echo cmb_get_option(stwcpp_church_Admin::key(), 'stwcpp_church_service_times'); ?></span>
							</pre>
						</div> 
					</section>
					
					<footer class="article-footer">

					</footer>
				</div>

			</div>

		</div>

	</div>


