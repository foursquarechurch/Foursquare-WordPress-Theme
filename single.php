<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Foursquare Two
 * @since Foursquare Two 1.0
 */

get_header(); ?>

<div class="row">
	<section id="blog" class="span7">
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<article id="post">
				<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
				<h2><small><?php foursquare_posted_on(); ?></small></h2>
				<hr />
				<?php
				if(has_post_thumbnail()) :?>
					<a data-toggle="modal" data-target="#featuredImage" href="#featuredImage"><span class="post-image alignleft"><?php echo get_the_post_thumbnail( $id, 'thumbnail' ); ?></span></a>
					<div class="modal hide fade" id="featuredImage">     
    					<div class="modal-header"> 
        					<a class="close" data-dismiss="modal">×</a> 
        					<h3>Featured Image</h3>         
   						</div>     
    					<div class="modal-body">         
       						<?php echo get_the_post_thumbnail( $id, '' ); ?>
    					</div>   
   						<div class="modal-footer"></div> 
					</div> 				
				<?php endif;?>
				<?php the_content(); ?>
			</article><!--end post-->
			<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'foursquare' ), 'after' => '' ) ); ?>
			<p class="tags">
				<?php foursquare_posted_in(); ?>
				<?php edit_post_link( __( 'Edit', 'foursquare' ), '', '' ); ?>
    		</p>
    		<hr />
			<div class="bottom-nav">
				<?php if (get_adjacent_post(false, '', true)): // if there are older posts ?>
    				<div class="btn btn-primary pull-left">
    					<?php previous_post_link( '%link', '' . _x( '« ', 'Older Post', 'foursquare' ) . 'Older Post' ); ?>
   					</div>
				<?php endif; ?>
				<?php if (get_adjacent_post(false, '', false)): // if there are newer posts ?>
    				<div class="btn btn-primary pull-right">
    					<?php next_post_link( '%link', 'Newer Post ' . _x( ' »', 'Next post link', 'foursquare' ) . '' ); ?>
    				</div> <!--end btn btn-primary-->
				<?php endif; ?>
			</div><!--end bottom-nav-->
		<?php endwhile; // end of the loop. ?>
	</section><!--end blog-->

<?php include ('sidebar-blog.php'); ?>

<?php comments_template( '', true ); ?>
</div><!--end row-->

<?php include ('sidebar-footer.php'); ?>

<?php get_footer(); ?>