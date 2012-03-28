<?php
/**
 * The Sidebar containing the Homepage widget area.
 *
 * @package WordPress
 * @subpackage Foursquare Two
 * @since Foursquare Two 1.0
 */
?>

<aside id="sidebar" class="blog span3">

<?php
	/* When we call the dynamic_sidebar() function, it'll spit out
	 * the widgets for that widget area. If it instead returns false,
	 * then the sidebar simply doesn't exist, so we'll hard-code in
	 * some default sidebar stuff just in case.
	 */
	if ( ! dynamic_sidebar( 'blog-widget-area' ) ) : ?>
		<li>
            <h3 id="searchhead">Search For</h3>
			<?php get_search_form(); ?>
		</li>
<?php endif; // end subpage widget area ?>

</aside>

