<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to twentyten_comment which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Foursquare Two
 * @since Foursquare Two 1.0
 */
?>

<article id="comments" class="span7">
	<?php if ( post_password_required() ) : ?>
		<p><?php _e( 'This post is password protected. Enter the password to view any comments.', 'twentyten' ); ?></p>
	<?php
	/* Stop the rest of comments.php from being processed,
	 * but don't kill the script entirely -- we still have
	 * to fully load the template.
	 */
	return;
	endif;
	?>

	<?php // You can start editing here -- including this comment!?>

	<?php if ( have_comments() ) : ?>
	<div id="comments-title">
    	<h3 id="comments-title">
    	<?php
		printf( _n( 'One Response to %2$s', '%1$s Comments on "%2$s"', get_comments_number(), 'twentyten' ),
		number_format_i18n( get_comments_number() ), '' . get_the_title() . '' );
		?></h3>
	</div>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to 	navigate through? ?>
		<?php previous_comments_link( __( '&larr; Older Comments', 'twentyten' ) ); ?>
		<?php next_comments_link( __( 'Newer Comments &rarr;', 'twentyten' ) ); ?>
	<?php endif; // check for comment navigation ?>
		<ul>
			<?php
			/* Loop through and list the comments. Tell wp_list_comments()
			 * to use twentyten_comment() to format the comments.
			 * If you want to overload this in a child theme then you can
			 * define twentyten_comment() and that will be used instead.
			 * See twentyten_comment() in twentyten/functions.php for more.
			*/
			wp_list_comments( array( 'callback' => 'twentyten_comment' ) );
			?>
		</ul>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<?php previous_comments_link( __( '&larr; Older Comments', 'twentyten' ) ); ?>
			<?php next_comments_link( __( 'Newer Comments &rarr;', 'twentyten' ) ); ?>
		<?php endif; // check for comment navigation ?>

	<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
	?>
		<p><?php _e( 'Comments are closed.', 'twentyten' ); ?></p>
	<?php endif; // end ! comments_open() ?>

	<?php endif; // end have_comments() ?>

<?php $comment_args = array( 'fields' => apply_filters( 'comment_form_default_fields', array(
    'author' => '<p class="comment-form-author">' .
    			'<label for="author">' . __( 'Your Name' ) . ( $req ? '<span class="required"> *</span>' : '' ) . '</label> ' .
                '<input id="author" name="author" type="text" value="' .
                esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />' .
                '</p><!-- #form-section-author .form-section -->',
    'email'  => '<p class="comment-form-email">' .
    			'<label for="email">' . __( 'Your Email' ) . ( $req ? '<span class="required"> *</span>' : '' ) . '</label> ' .
                '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />' .
		'</p><!-- #form-section-email .form-section -->',
    'url'    => '' ) ),
    'comment_field' => '<p class="comment-form-comment">' .
    					'<label for="comment">' . __( 'Your Comment' ) . '</label>' .
                		'<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>' .
                		'</p><!-- #form-section-comment .form-section -->',
    'comment_notes_after' => '',
	'id_submit' => 'submit',
	'label_submit' => __( 'Submit' ),


);
comment_form($comment_args); ?>
</article><!--end comments-->