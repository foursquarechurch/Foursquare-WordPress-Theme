<?php
/**
 * The Header for our theme.
 *
 * @package WordPress
 * @subpackage Foursquare Two
 * @since Foursquare Two 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php
		wp_title( '|', true, 'right' );
	?></title>
	
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">
    <meta name="author" content="The Foursquare Church">

    <link rel="profile" href="http://gmpg.org/xfn/11" />


    <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    
    <!-- Styles -->
    <link href="http://vjs.zencdn.net/c/video-js.css" rel="stylesheet">

    <!-- Fav and Touch Icons -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico">
    <link rel="apple-touch-icon" href="/assets/images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/assets/images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/assets/images/apple-touch-icon-114x114.png">
    
    <!-- Modernizr -->
    <script src="<?php echo home_url( '/' ) ?>/wp-content/themes/Foursquare_Two/assets/js/modernizr.custom.js"></script>
    
    <!-- jQuery -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    
    <!-- Google Analytics -->
    <script type="text/javascript">

  	var _gaq = _gaq || [];
 	 _gaq.push(['_setAccount', '<?php echo get_option('nt_analytics'); ?>']);
 	 _gaq.push(['_trackPageview']);

  	(function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  	})();

</script>
    
    <?php wp_head(); ?>
    
</head>

<body <?php body_class(); ?>  onload="prettyPrint()">

<nav class="navbar navbar-fixed-top">
	<div class="navbar-inner">
        <div class="container">
        	<?php // Custom header
			// Check for custom header and hide brand name if there is one
			if ( $img_src = get_header_image () ) : ?>
			<?php else: ?>
        		<a class="brand" href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
        	<?php endif; ?>
       		<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        		<span class="icon-bar"></span>
        		<span class="icon-bar"></span>
        		<span class="icon-bar"></span>
     		</a>
      		<div class="nav-collapse">
				<?php wp_nav_menu( array( 'menu' => 'main-menu', 'container' => false, 'menu_class' => 'nav', 'menu_id' => 'main-menu') ); ?>
				<form method="get" action="<?php echo home_url( '/' ); ?>" id="search-form" class=" navbar-search pull-right">
            		<input class="search-query" name="s" type="text" placeholder="Search">
				</form>
			</div><!--End nav-collapse-->
		</div><!--End container-->
	</div><!--End navbar-inner-->
</nav><!--End primary-->

<div class="container">

<header class="row">
	<?php // Custom header
		// Check if a custom header exists
		if ( $img_src = get_header_image () ) : ?>
			<div class="logo-custom span6">
				<a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php header_image(400,88); ?>" alt="<?php bloginfo('name'); ?>" usemap="#Map" /></a>
			</div><!--End logo-->
		<?php else: ?>
			<div class="logo span6">
				<h1><a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			</div><!--End logo-->
		<?php endif; ?>
		
	<div class="slogan span6">
		Jesus Christ, the same yesterday, and today, and forever.<br />
		<span>Hebrews 13:8</span>
	</div><!--End slogan-->
</header>