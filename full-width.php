<?php
/**
 * Template Name: Full-Width Page
 *
 * @package WordPress
 * @subpackage Foursquare Two
 * @since Foursquare Two 1.0
 *
 * This file is a plain page template that utlizes the full body width. It's basically the same thing
 * as the Default Page template (page.php), minus the sidebar.
 *
 * Some plugins require using a full width, so that's what this template would be good for.
 *
 */

get_header(); ?>

<div class="row">
	<div id="page-full" class="span11">
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<h1><?php the_title(); ?></h1>
			<hr />
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>
			<?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>
		<?php endwhile; ?>
	</div><!--end page-full-->
</div><!-- end row -->

<?php include ('sidebar-fullwidth.php'); ?>

<?php get_footer(); ?>