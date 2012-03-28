<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package WordPress
 * @subpackage Foursquare Twp
 * @since Foursquare Two 1.0
 */

get_header(); ?>

<div class="row">
	<section id="blog" class="span7">
		<?php
		/* Queue the first post, that way we know who
	 	* the author is when we try to get their name,
	 	* URL, description, avatar, etc.
	 	*
	 	* We reset this later so we can run the loop
	 	* properly with a call to rewind_posts().
	 	*/
		if ( have_posts() )
			the_post();
		?>
		<h5><?php printf( __( 'Author Archives: %s', 'twentyten' ), "<a class='url fn n' href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a>" ); ?></h5>
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