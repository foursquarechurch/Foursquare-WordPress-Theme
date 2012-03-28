<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Foursquare Two
 * @since Foursquare Two 1.0
 */

get_header(); ?>

<div class="row">
	<section id="blog" class="span7">
		<?php
		/* Queue the first post, that way we know
		* what date we're dealing with (if that is the case).
	 	*
	 	* We reset this later so we can run the loop
	 	* properly with a call to rewind_posts().
	 	*/
		if ( have_posts() )
			the_post();
		?>

		<h5>
			<?php if ( is_day() ) : ?>
				<?php printf( __( 'Daily archives for %s', 'twentyten' ), get_the_date() ); ?>
			<?php elseif ( is_month() ) : ?>
				<?php printf( __( 'Monthly archives for %s', 'twentyten' ), get_the_date('F Y') ); ?>
			<?php elseif ( is_year() ) : ?>
				<?php printf( __( 'Yearly archives for %s', 'twentyten' ), get_the_date('Y') ); ?>
			<?php else : ?>
				<?php _e( 'Blog Archives', 'twentyten' ); ?>
			<?php endif; ?>
		</h5>
            
    <hr />

		<?php
		/* Since we called the_post() above, we need to
	 	* rewind the loop back to the beginning that way
	 	* we can run the loop properly, in full.
	 	*/
		rewind_posts();
		?>
		<?php
		// The Query
		query_posts( 'showposts=4&posts_per_page=4&paged=' .$paged );
		// The Loop
		while ( have_posts() ) : the_post(); ?>
    	<article class="post">
    		<?php
			if(has_post_thumbnail()) :?>
				<a href="<?php the_permalink(); ?>"><span class="featured-image alignleft"><?php echo get_the_post_thumbnail( $id, 'thumbnail' ); ?></span></a>
				<?php endif;?>
    		
    		<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
    		<h2><small>Posted in: &nbsp;<a href="<?php bloginfo('url'); ?>/category/<?php $category = get_the_category(); echo $category[0]->category_nicename; ?>" title="<?php echo $category[0]->category_nicename; ?>"><?php $category = get_the_category(); echo $category[0]->cat_name;?></a></small></h2>
    		<?php the_excerpt(); ?>
       		<hr />
       	</article><!--end post-->
		<?php endwhile; ?>
	
		<?php /* Display pagination */ ?>
		<div class="pagination">
		<?php echo paginate_links( $args ) ?>
		<?php
		global $wp_query;
		$big = 999999999; // need an unlikely integer
		echo paginate_links( array(
			'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'type' => 'list',
			'total' => $wp_query->max_num_pages
		) );
		?>
		</div><!--end pagination-->
		
		<?php // Reset Query ?>
		<?php wp_reset_query(); ?>
	</section><!--end blog-->  

	<?php include ('sidebar-blog.php'); ?>
</div><!--end row-->

<?php include ('sidebar-footer.php'); ?>

<?php get_footer(); ?>