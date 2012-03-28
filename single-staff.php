<?php
/**
 * Template Name: Staff Member
 *
 * The template for display a staff member.
 *
 * @package WordPress
 * @subpackage Foursquare Two
 * @since Foursquare Two 1.0
 */

get_header(); ?>

<div class="row">
	<section id="page" class="about span7">
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<article id="post" class="staff">
				<h1><?php the_title(); ?></h1>
				<?php // Get the Church Staff Title custom taxonomy.
					$terms_as_text = get_the_term_list( $post->ID, 'church-staff-title', '<h2>', ', ', '</h2>' ) ;
					echo strip_tags($terms_as_text, '<h2>');
				?>
				<hr />
				<?php the_content(); ?>
				<?php if ( get_post_meta($post->ID, "_email", "_phone", "_facebook", "_twitter", true) ) { ?>
				<h2>Contact <?php the_title(); ?></h2>
				<div class="contact-meta row">
					<?php if ( get_post_meta($post->ID, "_email", "_phone", true) ) { ?>
					<div class="col1 span3 pull-left">
					<?php } // End check for content meta ?>
    					<?php if ( get_post_meta($post->ID, "_email", true) ) { ?>
						<div class="email">
							<p><a class="email" href="mailto:<?php echo get_post_meta($post->ID, "_email", true); ?>"><?php echo get_post_meta($post->ID, "_email", true); ?></a></p>
						</div><!--end email-->
						<?php } // End check for email ?>
						<?php if ( get_post_meta($post->ID, "_phone", true) ) { ?>
						<div class="phone">
							<p class="phone"><?php echo get_post_meta($post->ID, "_phone", true); ?></p>
						</div><!--end phone-->
						<?php } // End check for phone ?>
					</div><!--end col1-->
					<?php if ( get_post_meta($post->ID, "_facebook", "_twitter", true) ) { ?>
					<div class="col2 span3 pull-right">
					<?php } // End check for content meta ?>
						<?php if ( get_post_meta($post->ID, "_facebook", true) ) { ?>
						<div class="facebook">
							<p><a href="http://<?php echo get_post_meta($post->ID, "_facebook", true); ?>">Follow on Facebook</a></p>
						</div><!--end facebook-->
						<?php } // End check for facebook ?>
						<?php if ( get_post_meta($post->ID, "_twitter", true) ) { ?>
						<div class="twitter">
							<p><a href="http://twitter.com/<?php echo get_post_meta($post->ID, "_twitter", true); ?>" target="_black">@<?php echo get_post_meta($post->ID, "_twitter", true); ?></a></p>
							<?php } // End check for twitter ?>
						</div><!--end twitter-->
					</div><!--end col2-->
				</div><!--end contact-meta-->
				<?php } // End check for content meta ?>
			</article><!--end post-->
		<?php endwhile; // end of the loop. ?>
	</section><!--end blog-->                   
<?php include ('sidebar-about.php'); ?>
</div><!--end row-->  

<?php include ('sidebar-footer.php'); ?>

<?php get_footer(); ?>