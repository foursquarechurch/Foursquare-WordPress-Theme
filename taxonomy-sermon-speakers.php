<?php
/**
 * The template for displaying archives for the Sermons custom post type.
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
	<section id="sermons" class="span11 pull-left">
		<div class="row">
			<div class="span6 pull-left">
				<h1>Sermon Speakers</h1>
				<?php // Get current category name
					$term =	$wp_query->queried_object;
					echo '<h2>'.$term->name.'</h2>';
				?>
			</div><!--end span6-->
			<nav class="sermons span3 pull-right offset2">
				<?php
					$taxonomy     = 'topics';
					$orderby      = 'name'; 
					$show_count   = 1;      // 1 for yes, 0 for no
					$pad_counts   = 0;      // 1 for yes, 0 for no
					$hierarchical = 1;      // 1 for yes, 0 for no
					$title        = '';

					$args = array(
  						'taxonomy'     => $taxonomy,
  						'orderby'      => $orderby,
  						'show_count'   => $show_count,
  						'hierarchical' => $hierarchical,
  						'title_li'     => $title
					);
				?>

				<form id="categoriesform" action="<?php bloginfo('url'); ?>" method="get">
					<div>
						<?php $cats = get_categories($args); ?>
						<select id="categories" style="width:55%">
							<option value="">Filter by Topic</option>
							<?php foreach ($cats as $cat) : ?>
    							<option value="<?php echo get_term_link($cat, $cat->taxonomy) ?>"><?php echo $cat->name ?></option>
							<?php endforeach; ?>
						</select>
						<input type="submit" class="btn btn-primary" name="submit" value="view" />
					</div>
				</form>

				<script>
					jQuery(document).ready(function()
					{
   					jQuery('#categoriesform').submit(function()
    				{
        			window.location = jQuery('#categories').val();
        			return false;
    				});
					});
				</script>			
			</nav><!--end sermons-->
		</div><!--end row-->
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
            
    <hr />
    
    	<div class="row">

		<?php
		/* Since we called the_post() above, we need to
	 	* rewind the loop back to the beginning that way
	 	* we can run the loop properly, in full.
	 	*/
		rewind_posts();
		?>
		<?php
		// The Query
		global $wp_query;
		// get the correct page var
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		// create the page argument
		$args=  array('paged'=> $paged);
		// merge the page argument array with the original query array
		$args = array_merge( $wp_query->query, array( 'post_type' => 'sermons', 'showposts' => 6 ) );
		// Re-run the query with the new arguments
		query_posts( $args );
		// The Loop
		while ( have_posts() ) : the_post(); ?>
    		<article class="summary">
    			<?php
					if(has_post_thumbnail()) :?>
						<a href="<?php the_permalink(); ?>"><span class="featured-image"><?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'sermons' ); } ?></span></a>
					<?php endif;?>
    		
    			<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
    			<h2><small><?php the_time('F j, Y') ?></small></h2>
    			<?php wpe_excerpt('wpe_excerptlength_teaser', 'wpe_excerptmore'); ?>
       		</article><!--end post-->
		<?php endwhile; ?>	
		</div><!--end row-->
		
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
	</section><!--end blog-->  
</div><!--end row-->

<?php include ('sidebar-footer.php'); ?>

<?php get_footer(); ?>