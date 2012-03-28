<?php
/**
 * The Sidebar containing the Homepage widget area.
 *
 * @package WordPress
 * @subpackage Foursquare Two
 * @since Foursquare Two 1.0
 */
?>

</div><!--end container (from header.php)-->

<section id="footer-widgets">
	<div class="container">
		<div class="row">
			<div class="span4">
				<li class="widget-container widget-text">
					<h2 class="widget-title">Latest Sermon</h2>
					<div class-"textwidget">
						<?php // Get the latest sermon post 
						query_posts( 'post_type=sermons&showposts=1');
						while ( have_posts() ) : the_post(); ?>
    						<article class="summary">
    							<?php
								if(has_post_thumbnail()) :?>
									<a href="<?php the_permalink(); ?>"><span class="featured-image"><?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'sermons' ); } ?></span></a>
								<?php endif;?>
    		
    							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
       						</article><!--end post-->
						<?php endwhile; ?>	
					</div><!--end textwidget-->
				</li>
			</div><!--end span4-->
			<?php
			/* This tells the theme to use the Homepage Widgets specified
	 		* in Appearance > Widgets. In case no widgets are specified,
	 		* we're going to hard-code a few so the site won't be empty.
	 		*/
			if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>

			<?php endif; // end Homepage Widgets ?>
		</div><!--end row-->
		<hr />
	</div><!--end container-->
</section><!--end homepage-widgets-->