<?php
/**
 * The Sidebar for all subpages.
 *
 * @package WordPress
 * @subpackage Foursquare Two
 * @since Foursquare Two 1.0
 */
?>
            
<aside id="sidebar-sermon" class="sermon span4">
	<div class="widget-container">
		<h2>About This Series</h2>
		<?php 
			$reating_terms = get_the_terms ($post->id, 'series');
    		foreach ($reating_terms as $term){
        	echo $term->description;
    	}
    	?>
	</div><!--end widget-container-->  
	
	<div class="widget-container">
	<h2>Latest Sermons</h2>
		<?php
		$args = array( 'post_type' => 'sermons', 'posts_per_page' => 3 );
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post();?>
    		<article class="summary">
    			<?php
				if(has_post_thumbnail()) :?>
					<a href="<?php the_permalink(); ?>"><span class="featured-image"><?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'sermons' ); } ?></span></a>
					<?php endif;?>
    			<h1><small><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></small></h1>
    			<h2><small><?php the_time('F j, Y') ?></small></h2>
       		</article><!--end post-->
		<?php endwhile; ?>
	</div><!--end widget-container-->  
</aside><!--end sidebar-sermon-->  