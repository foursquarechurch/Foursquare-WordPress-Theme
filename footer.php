<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Foursquare Two
 * @since Foursquare Two 1.0
 */
?>

<footer>
	<div class="container">
	<div class="copyright span6">
		<img src="/wp-content/themes/Foursquare_Two/assets/images/logo-footer.png"><br />
		&copy; 
		<script type="text/javascript"> 
			now = new Date
			theYear=now.getYear()
			if (theYear < 1900)
			theYear=theYear+1900
			document.write(theYear)
        </script>
		<a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a><br />
        <span><a href="http://www.foursquare.org" alt="The Foursquare Church">The Foursquare Church</a></span>
	</div><!--End copyright-->
	
	<div class="social">
    	<?php /*Checks to see if primary admin has a Twitter or Facebook account. If so, it will display the icons next to the RSS icon in the main menu.  */ ?>
    	<?php if ( get_the_author_meta( 'facebook',1) ) { ?>
    	<div class="facebook">
        	<a href="<?php the_author_meta( 'facebook',1); ?>">Facebook</a>
    	</div>
    	<?php } // End check for facebook ?>

    	<?php if ( get_the_author_meta( 'googleplus',1) ) { ?>
    	<div class="googleplus">
        	<a href="<?php the_author_meta( 'googleplus',1); ?>">Google+</a>
    	</div>
    	<?php } // End check for google ?>
    	
    	<?php if ( get_the_author_meta( 'twitter',1) ) { ?>
    	<div class="twitter">
        	<a href="http://twitter.com/<?php the_author_meta( 'twitter',1); ?>">Twitter</a>
    	</div>
    	<?php } // End check for twitter ?>
    	
    	<?php if ( get_the_author_meta( 'pinterest',1) ) { ?>
    	<div class="pinterest">
        	<a href="http://pinterest.com/<?php the_author_meta( 'pinterest',1); ?>">Pinterest</a>
    	</div>
    	<?php } // End check for interest ?>
	</div><!--end social-->
	</div>
</footer>

<!-- JAVASCRIPT (located at page bottom for fast load)
*********************************************************************** -->
<script src="<?php echo home_url( '/' ) ?>/wp-content/themes/Foursquare_Two/assets/js/bootstrap-collapse-min.js"></script>
<script src="<?php echo home_url( '/' ) ?>/wp-content/themes/Foursquare_Two/assets/js/bootstrap-transition-min.js"></script>
<script src="<?php echo home_url( '/' ) ?>/wp-content/themes/Foursquare_Two/assets/js/bootstrap-modal-min.js"></script>
<script src="<?php echo home_url( '/' ) ?>/wp-content/themes/Foursquare_Two/assets/js/bootstrap-dropdown-min.js"></script>

<!-- Video.js: http://videojs.com/ -->
<script src="http://vjs.zencdn.net/c/video.js"></script>

<!-- RefTagger from Logos. Visit http://www.logos.com/reftagger. This code should appear directly before the </body> tag. -->
<script src="http://bible.logos.com/jsapi/referencetagging.js" type="text/javascript"></script>
<script type="text/javascript">
    Logos.ReferenceTagging.lbsBibleVersion = "NKJV";
    Logos.ReferenceTagging.lbsLinksOpenNewWindow = true;
    Logos.ReferenceTagging.lbsLogosLinkIcon = "dark";
    Logos.ReferenceTagging.lbsNoSearchTagNames = [ "h2", "h3", "h3", "h4", "h5", "h6", "span" ];
    Logos.ReferenceTagging.lbsTargetSite = "biblia";
    Logos.ReferenceTagging.tag();
    Logos.ReferenceTagging.lbsCssOverride = true;
</script>

<script type="text/javascript">
// Adding the class selected background class to the body  //	
jQuery(document).ready(function(){
jQuery("body").addClass("<?php echo get_option('nt_background'); ?>");
  });
</script>

<script type="text/javascript">
// Adding the class "dropdown" to li elements with submenus  //	
jQuery(document).ready(function(){
jQuery("ul.sub-menu").parent().addClass("dropdown");
jQuery("ul#main-menu li.dropdown a").addClass("");
jQuery("ul.sub-menu li a").removeClass("dropdown-toggle"); 
  });
</script>

<script type="text/javascript">
jQuery(document).ready(function(){
 // Don't FORGET: replace all $ with jQuery to prevent conflicts //
jQuery('a.dropdown-toggle')
.attr('data-toggle', 'dropdown');
  });
</script>

<script type="text/javascript">
jQuery(document).ready(function(){
 // Don't FORGET: replace all $ with jQuery to prevent conflicts //
 jQuery(function () {
        jQuery(".tablesorter-example").tablesorter({ sortList: [[1,0]] });
        jQuery('.dropdown-toggle').dropdown();
      })
  });
</script>

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>

</body>
</html>