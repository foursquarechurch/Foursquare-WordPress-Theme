<?php
/**
 * The Sidebar for all pages using the Full-Width template.
 *
 * @package WordPress
 * @subpackage Foursquare Two
 * @since Foursquare Two 1.0
 */
?>

</div><!--end container (from header.php)-->

<section id="footer-widgets">
	<div class="container">
		<div class="row">
			<?php
			/* This tells the theme to use the Full-Width Page Widgets specified in Appearance > Widgets. */
			if ( ! dynamic_sidebar( 'fullwidth-widget-area' ) ) : ?>
			<?php endif; // end Homepage Widgets ?>
		</div><!--end row-->
		<hr />
	</div><!--end container-->
</section><!--end homepage-buckets-->
