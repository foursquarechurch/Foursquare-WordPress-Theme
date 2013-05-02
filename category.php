<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Foursquare Two
 * @since Foursquare Two 1.0
 */

get_header(); ?>

<div class="row">
	<section id="blog" class="span7">
		<h1><?php printf( __( '%s', 'twentyten' ), '' . single_cat_title( '', false ) . '' );?></h1>
    	<hr />
		<?php
		$category_description = category_description();
		if ( ! empty( $category_description ) )
		echo '' . $category_description . '';
		/* Run the loop for the category page to output the posts.
		* If you want to overload this in a child theme then include a file
		* called loop-category.php and that will be used instead.
		*/
		?>
		<?php // The Loop
		while ( have_posts() ) : the_post(); ?>
    		<article class="post">
    		<?php
			if(has_post_thumbnail()) :?>
				<a href="<?php the_permalink(); ?>"><span class="featured-image alignleft"><?php echo get_the_post_thumbnail( $id, 'thumbnail' ); ?></span></a>
				<?php endif;?>
    		
    		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    		<h3><small>Posted in: &nbsp;<a href="<?php bloginfo('url'); ?>/category/<?php $category = get_the_category(); echo $category[0]->category_nicename; ?>" title="<?php echo $category[0]->category_nicename; ?>"><?php $category = get_the_category(); echo $category[0]->cat_name;?></a></small></h3>
    		<?php the_excerpt(); ?>
       	</article>
            <hr class="clearboth"/>
            <!--end post-->
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
