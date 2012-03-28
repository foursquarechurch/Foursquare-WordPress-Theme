<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Foursquare Two
 * @since Foursquare Two 1.0
 */

get_header(); ?>

<div class="row">
	<section id="blog" class="span7">
	<?php if ( have_posts() ) : ?><h5><?php $search_count = 0; $search = new WP_Query("s=$s & showposts=-1"); if($search->have_posts()) : while($search->have_posts()) : $search->the_post(); $search_count++; endwhile; endif; echo $search_count;?> <?php printf( __( 'results found for: %s', 'twentyten' ), '' . get_search_query() . '' ); ?></h5>
    <hr />
	
	<?php
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
	<hr />
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
	
	<?php else : ?>
		<h2><?php _e( 'No Results for: ', 'twentyten' ); ?> &nbsp;<?php the_search_query(); ?> </h2>
		<hr />
		<p><?php _e( 'Sorry, but nothing matched your search criteria. Perhaps searching again with different keywords will do the trick.', 'twentyten' ); ?></p>
		<hr />
		<?php get_search_form(); ?>
	<?php endif; ?>
	</section><!--end blog-->                   

<?php include ('sidebar-blog.php'); ?>
</div><!--end row-->  

<?php include ('sidebar-footer.php'); ?>

<?php get_footer(); ?>
