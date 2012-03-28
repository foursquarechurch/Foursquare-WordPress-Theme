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
	<section id="page" class="sermons span7">
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<article id="post" class="staff">
				<h1><?php the_title(); ?></h1>
				<div class="sermon-meta row">
					<?php
					global $post;
					$series = get_the_terms( $post->ID, 'series' );
					if ($series && !is_wp_error($series)): 
						$series_names = array();
					foreach ($series as $series)
						$series_names[] = $series->name;
						$series = implode(", ", $series_names);
					?>
						<div class="series span2">
							<h2><small><i class="icon-bookmark"></i> Series</small></h2>
							<?php echo custom_taxonomies_terms_links(); ?>
						</div><!--end series-->
					<?php endif; ?> 
					<?php
					global $post;
					$speakers = get_the_terms( $post->ID, 'sermon-speakers' );
					if ($speakers && !is_wp_error($speakers)): 
						$speaker_names = array();
					foreach ($speakers as $speaker)
						$speaker_names[] = $speaker->name;
						$speakers = implode(", ", $speaker_names);
					?>
						<div class="speaker span2">
							<h2><small><i class="icon-user"></i> Speaker</small></h2>
							<?php
								$terms_as_text = get_the_term_list( $post->ID, 'sermon-speakers', '', ', ', '' ) ;
								echo ($terms_as_text);
							?>
						</div><!--end speaker--> 
					<?php endif; ?> 
					<div class="date span2">
						<h2><small><i class="icon-calendar"></i> Date</small></h2>
						<p><?php the_time('F j, Y') ?></p>
					</div><!--end date-->  
				</div><!--end sermon-meta-->  
				<hr />
				<?php
				$video = get_post_meta($post->ID, '_video', true);
				$youtube = get_post_meta($post->ID, '_youtube', true);
				if ($video){ ?>
					<video id="sermon" class="video-js vjs-default-skin" controls
  						preload="auto" width="100%" height="300" 
  						data-setup="{}">
  						<source src="<?php echo get_post_meta($post->ID, "_video", true); ?>" type='video/mp4'>
  						<source src="my_video.webm" type='video/webm'>
					</video>
					<hr />
				<?php } 
				else if ($youtube){ 
				// Show YouTube embed instead, if no file exists in Media Library. ?>
 				 <iframe 
 				 	width="646" 
 				 	height="358" 
 				 	src="http://www.youtube.com/embed/<?php echo get_post_meta($post->ID, "_youtube", true); ?>?wmode=opaque" 
 				 	frameborder="0" 
 				 	allowfullscreen>
 				 </iframe>
 				 <hr />
				<?php }
				else {
 				 //do nothing or whatever you need when no custom field was found
				} ?>
				<h2>Summary</h2>
				<?php the_content(); ?>
				<hr />
				<?php // Get the topics
					global $post;
					$topics = get_the_terms( $post->ID, 'topics' );
					if ($topics && !is_wp_error($topics)): 
						$topics_names = array();
					foreach ($topics as $topics)
						$topics_names[] = $topics->name;
						$topics = implode(", ", $topics_names);
					?>
				<h2>Topics</h2>
				<p>
					<?php
						$terms_as_text = get_the_term_list( $post->ID, 'topics', '', ', ', '' ) ;
						echo ($terms_as_text);
					?>
				</p>
				<hr />
				<?php endif; ?> 
				<?php // Get the Bible verses
					global $post;
					$verses = get_the_terms( $post->ID, 'bible-verses' );
					if ($verses && !is_wp_error($verses)): 
						$verses_names = array();
					foreach ($verses as $verses)
						$verses_names[] = $verses->name;
						$verses = implode(", ", $verses_names);
					?>
				<h2>Bible References</h2>
				<p><?php echo $verses; ?></p>
				<hr />
				<?php endif; ?> 
				<?php // Get Sermon media files
				if(
					get_post_meta($post->ID, '_video', true) || 
 					get_post_meta($post->ID, '_audio', true) ||
 					get_post_meta($post->ID, '_notes', true)
	 			): ?>
					<h2>Download Media</h2>
					<?php if ( get_post_meta($post->ID, "_video", true) ) { ?>
						<i class="icon-film"></i> <a href="<?php echo get_post_meta($post->ID, "_video", true); ?>">Download Video</a><br />
					<?php } // End check for video file ?>
					<?php if ( get_post_meta($post->ID, "_audio", true) ) { ?>
						<i class="icon-music"></i> <a href="<?php echo get_post_meta($post->ID, "_audio", true); ?>">Download Audio</a><br />
					<?php } // End check for audio file ?>
					<?php if ( get_post_meta($post->ID, "_notes", true) ) { ?>
						<i class="icon-file"></i> <a href="<?php echo get_post_meta($post->ID, "_notes", true); ?>">Download Notes</a>
					<?php } // End check for audio file ?>
					</ul>
				<?php endif; ?>
			</article><!--end post-->
		<?php endwhile; // end of the loop. ?>
	</section><!--end blog-->                   
<?php include ('sidebar-sermons.php'); ?>
</div><!--end row-->  

<?php include ('sidebar-footer.php'); ?>

<?php get_footer(); ?>