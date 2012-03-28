<?php
/**
 * Template Name: Blog
 *
 * @package WordPress
 * @subpackage Foursquare Two
 * @since Foursquare Two 1.0
 *
 * The template for the main blog index.
 *
 */

get_header(); ?>

<div class="row">
	<section id="blog" class="span7">
		<?php
		// The Query
		query_posts( 'showposts=4&posts_per_page=4&paged=' .$paged );
		// The Loop
		while ( have_posts() ) : the_post(); ?>
    
    	<article class="summary">
    		<?php
			if(has_post_thumbnail()) :?>
				<a href="<?php the_permalink(); ?>"><span class="featured-image alignleft"><?php echo get_the_post_thumbnail( $id, 'thumbnail' ); ?></span></a>
			<?php endif;?>
    		
    		<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
    		<h2><small>Posted in: &nbsp;<a href="<?php bloginfo('url'); ?>/category/<?php $category = get_the_category(); echo $category[0]->category_nicename; ?>" title="<?php echo $category[0]->category_nicename; ?>"><?php $category = get_the_category(); echo $category[0]->cat_name;?></a></small></h2>
    		<?php the_excerpt(); ?>
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