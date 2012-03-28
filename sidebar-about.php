<?php
/**
 * The Sidebar for all subpages.
 *
 * @package WordPress
 * @subpackage Foursquare Two
 * @since Foursquare Two 1.0
 */
?>
            
<aside id="sidebar-about" class="about span4">
	<div class="widget-container">
	<h2>Meet Our Staff</h2>
	<?php
	// The Query for Staff custom post type
	$args = array( 'post_type' => 'staff', 'hierarchical' => true, 'orderby' => 'menu_order', 'order' => 'ASC', 'showposts' => 5000 );
	// The Loop
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post(); ?>
    
    	<article class="staff">
    		<?php
			if(has_post_thumbnail()) :?>
				<a href="<?php the_permalink(); ?>">
					<span class="alignleft">
						<?php echo get_the_post_thumbnail( $id, 'thumbnail' ); ?>
					</span>
				</a>
			<?php endif;?>		
    		<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
    		<?php // Get the Church Staff Title custom taxonomy.
				$terms_as_text = get_the_term_list( $post->ID, 'church-staff-title', '<h2>', ', ', '</h2>' ) ;
					echo strip_tags($terms_as_text, '<h2>');
			?>
       	</article><!--end staff-->
       	
	<?php endwhile; ?>
	</div>
</aside>