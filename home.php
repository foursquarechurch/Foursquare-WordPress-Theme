<?php
/**
 * Template Name: Home
 *
 * The homepage template for the theme
 *
 * @package WordPress
 * @subpackage Foursquare Two
 * @since Foursquare Two 1.0
 */

get_header(); ?>

<section id="hero" class="masthead">
	<?php echo do_shortcode("[flexslider]"); ?>
</section>

<section id="content" class="row">
	<div class="news span5">
		<h1>From the Blog</h1>
		<?php
		// The Query
		query_posts( 'showposts=3&posts_per_page=4&paged=' .$paged );
		// The Loop
		while ( have_posts() ) : the_post(); ?>
    
    	<article>
    		<a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail( $id, 'thumbnail' ); ?></a>
    		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    		<?php wpe_excerpt('wpe_excerptlength_teaser', 'wpe_excerptmore'); ?>
    		<hr />
    	</article>
	<?php endwhile; ?>
	</div><!--end news-->
	<div class="info span6">
		<? /* This code retrieves our admin options from Maps and Services. */ ?>
		<?
			global $options;
			foreach ($options as $value) {
    			if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
			}
		?>	
		<h1><?php echo get_option('nt_maptitle'); ?></h1>
		<iframe width="570" height="240" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo get_option('nt_maplink'); ?>&output=embed"></iframe>
		<h2>Service Times</h2>
		<table class="table table-striped table-condensed">
			<? /* Check for Sunday */
			if ($nt_map_day1 == "true") { ?>
				<tr>
					<td><b>Sunday</b></td>
				<td><?php echo get_option('nt_map_services1'); ?></td>	
				</tr>
    		<? } ?>
    		<? /* Check for Monday */
			if ($nt_map_day2 == "true") { ?>
				<tr>
					<td><b>Monday</b></td>
					<td><?php echo get_option('nt_map_services2'); ?></td>	
				</tr>
    		<? } ?>
    		<? /* Check for Tuesday */
			if ($nt_map_day3 == "true") { ?>
				<tr>
					<td><b>Tuesday</b></td>
					<td><?php echo get_option('nt_map_services3'); ?></td>	
				</tr>
    		<? } ?>
    		<? /* Check for Wednesday */
			if ($nt_map_day4 == "true") { ?>
				<tr>
					<td><b>Wednesday</b></td>
					<td><?php echo get_option('nt_map_services4'); ?></td>	
				</tr>
    		<? } ?>
    		<? /* Check for Thursday */
			if ($nt_map_day5 == "true") { ?>
				<tr>
					<td><b>Thursday</b></td>
					<td><?php echo get_option('nt_map_services5'); ?></td>	
				</tr>
    		<? } ?>
    		<? /* Check for Friday */
			if ($nt_map_day6 == "true") { ?>
				<tr>
					<td><b>Friday</b></td>
					<td><?php echo get_option('nt_map_services6'); ?></td>	
				</tr>
    		<? } ?>
    		<? /* Check for Saturday */
			if ($nt_map_day7 == "true") { ?>
				<tr>
					<td><b>Saturday</b></td>
					<td><?php echo get_option('nt_map_services7'); ?></td>	
				</tr>
    		<? } ?>
    	</table>
	</div><!--end info-->
</div><!--end content-->
<?php include ('sidebar-footer.php'); ?>
</div><!--end container (in header.php)-->
<?php get_footer(); ?>