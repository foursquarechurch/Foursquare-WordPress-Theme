<?php
/**
 * Template Name: About
 *
 * @package WordPress
 * @subpackage Foursquare Two
 * @since Foursquare Two 1.0
 *
 * The template for displaying all church staff members.
 *
 */

get_header(); ?>

<div class="row">
	<section id="page" class="about span7">
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<h1><?php the_title(); ?></h1>
			<hr />
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>
		<?php endwhile; ?>
	</section><!--end page-->                   

<?php include ('sidebar-about.php'); ?>
</div><!--end row-->  

<?php include ('sidebar-footer.php'); ?>

<?php get_footer(); ?>