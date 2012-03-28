<?php
################################################################################
// Shortcodes
// @Remove Gallery Shortcode
// @Paragraph Columns
// @Buttons
// @Labels
// @Alerts
// @Block Messages
// @Tables
// @Icons
// @Google Maps
// @YouTube
// @Raw Code
################################################################################

// Gallery shortcode
// remove the standard shortcode
/* -------------------------------------------------------------------------- */
remove_shortcode('gallery', 'gallery_shortcode');
add_shortcode('gallery', 'gallery_shortcode_tbs');

function gallery_shortcode_tbs($attr) {
	global $post, $wp_locale;

	$args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $post->ID ); 
	$attachments = get_posts($args);
	if ($attachments) {
		$output = '<ul class="media-grid">';
		foreach ( $attachments as $attachment ) {
			$output .= '<li>';
			$att_title = apply_filters( 'the_title' , $attachment->post_title );
			$output .= wp_get_attachment_link( $attachment->ID , 'thumbnail', true );
			$output .= '</li>';
		}
		$output .= '</ul>';
	}

	return $output;
}

// Remove inline styles printed when the gallery shortcode is used.
function foursquare_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'foursquare_remove_gallery_css' );

// Paragraph Columns
// Style located in theme style sheet (consider changing for future)
/* -------------------------------------------------------------------------- */

// Long posts should require a higher limit, see http://core.trac.wordpress.org/ticket/8553
@ini_set('pcre.backtrack_limit', 500000);

//Thanks to TheBinaryPenguin, see http://wordpress.org/support/topic/plugin-remove-wpautop-wptexturize-with-a-shortcode
//Takes the content and splits it into pieces.
if ( !function_exists('fs_formatter') ) :

function fs_formatter($content) {
	$new_content = '';
	
	/* Matches the contents and the open and closing tags */
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	
	/* Matches just the contents */
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	
	/* Divide content into pieces */
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
	
	/* Loop over pieces */
	foreach ($pieces as $piece) {
		/* Look for presence of the shortcode */
		if (preg_match($pattern_contents, $piece, $matches)) {
			
			/* Append to content (no formatting) */
			$new_content .= $matches[1];
		} else {
			
			/* Format and append to content */
			$new_content .= wptexturize(wpautop($piece));		
		}
	}
	
	return $new_content;
}

// Remove the 2 main auto-formatters
remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');

// Before displaying for viewing, apply this function
add_filter('the_content', 'fs_formatter', 99);
add_filter('widget_text', 'fs_formatter', 99);

endif;

// Register the shortcodes
function fs_one_third( $atts, $content = null ) {
   return '<div class="one_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'fs_one_third');

function fs_one_third_last( $atts, $content = null ) {
   return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_third_last', 'fs_one_third_last');

function fs_two_third( $atts, $content = null ) {
   return '<div class="two_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_third', 'fs_two_third');

function fs_two_third_last( $atts, $content = null ) {
   return '<div class="two_third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('two_third_last', 'fs_two_third_last');

function fs_one_half( $atts, $content = null ) {
   return '<div class="one_half">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'fs_one_half');

function fs_one_half_last( $atts, $content = null ) {
   return '<div class="one_half last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_half_last', 'fs_one_half_last');

function fs_one_fourth( $atts, $content = null ) {
   return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'fs_one_fourth');

function fs_one_fourth_last( $atts, $content = null ) {
   return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_fourth_last', 'fs_one_fourth_last');

function fs_three_fourth( $atts, $content = null ) {
   return '<div class="three_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourth', 'fs_three_fourth');

function fs_three_fourth_last( $atts, $content = null ) {
   return '<div class="three_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('three_fourth_last', 'fs_three_fourth_last');

function fs_one_fifth( $atts, $content = null ) {
   return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fifth', 'fs_one_fifth');

function fs_one_fifth_last( $atts, $content = null ) {
   return '<div class="one_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_fifth_last', 'fs_one_fifth_last');

function fs_two_fifth( $atts, $content = null ) {
   return '<div class="two_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_fifth', 'fs_two_fifth');

function fs_two_fifth_last( $atts, $content = null ) {
   return '<div class="two_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('two_fifth_last', 'fs_two_fifth_last');

function fs_three_fifth( $atts, $content = null ) {
   return '<div class="three_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fifth', 'fs_three_fifth');

function fs_three_fifth_last( $atts, $content = null ) {
   return '<div class="three_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('three_fifth_last', 'fs_three_fifth_last');

function fs_four_fifth( $atts, $content = null ) {
   return '<div class="four_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('four_fifth', 'fs_four_fifth');

function fs_four_fifth_last( $atts, $content = null ) {
   return '<div class="four_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('four_fifth_last', 'fs_four_fifth_last');

function fs_one_sixth( $atts, $content = null ) {
   return '<div class="one_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 'fs_one_sixth');

function fs_one_sixth_last( $atts, $content = null ) {
   return '<div class="one_sixth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_sixth_last', 'fs_one_sixth_last');

function fs_five_sixth( $atts, $content = null ) {
   return '<div class="five_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('five_sixth', 'fs_five_sixth');

function fs_five_sixth_last( $atts, $content = null ) {
   return '<div class="five_sixth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('five_sixth_last', 'fs_five_sixth_last');

// Buttons
/* -------------------------------------------------------------------------- */
function buttons( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'default', /* primary, default, info, success, danger */
	'size' => 'medium', /* small, medium, large */
	'url'  => '',
	'text' => '', 
	), $atts ) );

	$output = '<a href="' . $url . '" class="btn '. 'btn-'.$type . ' ' . 'btn-'.$size . '">';
	$output .= $text;
	$output .= '</a>';

	return $output;
}

add_shortcode('button', 'buttons'); 

// Labels
/* -------------------------------------------------------------------------- */
function labels( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'warning', /* default, success, warning, important, info */
	'text' => '', 
	), $atts ) );

	$output = '<span class="label '. 'label-'.$type . '">';
	$output .= $text . '</span>';

	return $output;
}

add_shortcode('label', 'labels'); 

// Alerts
/* -------------------------------------------------------------------------- */
function alerts( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'warning', /* warning, info, success, error */
	'close' => 'false', /* display close link */
	'text' => '', 
	), $atts ) );

	$output = '<div class="alert '. 'alert-'.$type . '">';
	if($close == 'true') {
		$output .= '<a class="close" href="#">×</a>';
	}
	$output .= '<p>' . $text . '</p></div>';

	return $output;
}

add_shortcode('alert', 'alerts');

// Block Messages
/* -------------------------------------------------------------------------- */
function block_messages( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'warning', /* warning, info, success, error */
	'heading' => '', /* display Heading 4 */
	'text' => '', 
	), $atts ) );

	$output = '<div class="alert '. 'alert-'.$type . '">';
	$output .= '<h4 class="alert-heading">' . $heading . '</h4>';
	$output .= '<p>' . $text . '</p></div>';

	return $output;
}

add_shortcode('block-message', 'block_messages'); 

// Tables
/* -------------------------------------------------------------------------- */

// Define table class
function tables( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => '', /* bordered, striped, condensed */
	'type2' => '', /* Secondary type in case we want to combine styles (e.g. bordered and striped) */
	'type3' => '', /* Third type in case we want to combine all styles */
	), $atts ) );

	$output .= '<table class="table table-'.$type . ' table-'.$type2 . ' table-'.$type3 . '">';
	return str_replace("\r\n", '', $output);
	return $output;
}

add_shortcode('table', 'tables'); 

// End table (get it?)
function end_tables( $atts, $content = null ) {
	extract( shortcode_atts( array(
	), $atts ) );

	$output = '</table>';

	return $output;
}

add_shortcode('end_table', 'end_tables'); 

// Define table row
function rows( $atts, $content = null ) {
	extract( shortcode_atts( array(
	), $atts ) );

	$output = '<tr>';

	return $output;
}

add_shortcode('row', 'rows');

// End table row
function end_rows( $atts, $content = null ) {
	extract( shortcode_atts( array(
	), $atts ) );

	$output = '</tr>';

	return $output;
}

add_shortcode('end_row', 'end_rows'); 

// Define table column
function columns( $atts, $content = null ) {
	extract( shortcode_atts( array(
	), $atts ) );

	$output = '<td>';

	return $output;
}

add_shortcode('column', 'columns');

// End table column
function end_columns( $atts, $content = null ) {
	extract( shortcode_atts( array(
	), $atts ) );

	$output = '</td>';

	return $output;
}

add_shortcode('end_column', 'end_columns'); 

// Icons
/* -------------------------------------------------------------------------- */
function icons( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => '', /* too many to list! */
	), $atts ) );

	$output .= '<i class="icon-' . $type . '"></i>';

	return $output;
}

add_shortcode('icon', 'icons'); 


// Google Maps
/* -------------------------------------------------------------------------- */
function fn_googleMaps($atts, $content = null) {
	extract(shortcode_atts(array(
	"width" => '380',
	"height" => '185',
	"src" => ''
	), $atts));
	
	return '<iframe width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.$src.'"></iframe>';
}

add_shortcode("googlemap", "fn_googleMaps");

// YouTube
/* -------------------------------------------------------------------------- */
function fn_youtube($atts, $content = null) {
	extract(shortcode_atts(array(
	"width" => '640',
	"height" => '360',
	"id" => ''
	), $atts));
	
	return '<iframe width="'.$width.'" height="'.$height.'" frameborder="0" src="http://www.youtube.com/embed/'.$id.'?wmode=transparent"></iframe>';
}

add_shortcode("youtube", "fn_youtube");

// PayPal
/* -------------------------------------------------------------------------- */
function paypal_donate( $atts ) {
    extract(shortcode_atts(array(
        'account' => '',
        'return_page' => '',
        'purpose' => '',
        'reference' => '',
        'button' => 'https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif',
    ), $atts));  
 
    return '<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
            	<input type="hidden" name="cmd" value="_donations">
            	<input type="hidden" name="business" value="'.$account.'">
            	<input type="hidden" name="return" value="' .$return_page. '" />
            	<input type="hidden" name="item_name" value="' .$purpose. '" />
            	<input type="hidden" name="item_number" value="' .$reference. '" />
            	<input type="image" src="'.$button.'" border="0" name="submit" alt="Give Online via PayPal">
            	<img alt="" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
            </form>'; 
}

add_shortcode('donate', 'paypal_donate');


// Disable code snippets: [raw]Unformatted Code[/raw]
/* -------------------------------------------------------------------------- */
function my_formatter($content) {
	$new_content = '';
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

	foreach ($pieces as $piece) {
		if (preg_match($pattern_contents, $piece, $matches)) {
			$new_content .= $matches[1];
		} else {
			$new_content .= wptexturize(wpautop($piece));
		}
	}

	return $new_content;
}

remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');

add_filter('the_content', 'my_formatter', 99);
?>
