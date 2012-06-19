<?php 
################################################################################
// FOURSQUARE THEME OPTIONS PANEL
// @Website Background
// @Google Map Integration
// @Church Service Times
// @Google Analytics Integration
################################################################################

// Set up the options panel
$themename = "Foursquare Theme Options";
$shortname = "nt";

$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}
array_unshift($wp_cats, "Choose a category"); 

$options = array (
 
array( "name" => $themename." Options",
	"type" => "title"),

// Website Background choices
array( "name" => "Website Background",
	"type" => "section"),
array( "type" => "open"),
	
array( "name" => "What background would you like?",
	"desc" => "Select the background of your website.",
	"id" => $shortname."_background",
	"type" => "select",
	"options" => array("burlap", "chalkboard", "linen", "wood"),
	"std" => "linen"), 

// Google Map integration
array( "type" => "close"), 
array( "name" => "Google Map",
	"type" => "section"),
array( "type" => "open"),
	
array( "name" => "Enter Map Title",
	"desc" => "<p>This is the headline above the map on the homepage.</p>",
	"id" => $shortname."_maptitle",
	"type" => "text",
	"std" => "Visit Our Church"), 
array( "name" => "Google Map URL",
	"desc" => "Enter the Google Maps link to your logo church for a map to be displayed on the homepage.",
	"id" => $shortname."_maplink",
	"type" => "text",
	"std" => ""),

// Church Service Times
array( "type" => "close"), 
array( "name" => "Service Times",
	   "type" => "section"),

array( "type" => "open"),

array( "name" => "Services on Sunday?",
    "desc" => "Check if yes. Leave unchecked if no.",
    "id" => $shortname."_map_day1",
    "type" => "checkbox",
    "std" => "false"),
array( "name" => "Sunday Service Times",
   	"desc" => "<p>Enter your service times here.</p><p><b>Example</b> 10:00 a.m.</p>",
	"id" => $shortname."_map_services1",
	"type" => "text",
	"std" => ""),	
array( "name" => "Services on Monday?",
    "desc" => "Check if yes. Leave unchecked if no.",
    "id" => $shortname."_map_day2",
    "type" => "checkbox",
    "std" => "false"),
array( "name" => "Monday Service Times",
   	"desc" => "<p>Enter your service times here.</p><p><b>Example</b> 10:00 a.m.</p>",
	"id" => $shortname."_map_services2",
	"type" => "text",
	"std" => ""),	
array( "name" => "Services on Tuesday?",
    "desc" => "Check if yes. Leave unchecked if no.",
    "id" => $shortname."_map_day3",
    "type" => "checkbox",
    "std" => "false"),
array( "name" => "Tuesday Service Times",
   	"desc" => "<p>Enter your service times here.</p><p><b>Example</b> 10:00 a.m.</p>",
	"id" => $shortname."_map_services3",
	"type" => "text",
	"std" => ""),	
array( "name" => "Services on Wednesday?",
    "desc" => "Check if yes. Leave unchecked if no.",
    "id" => $shortname."_map_day4",
    "type" => "checkbox",
    "std" => "false"),
array( "name" => "Wednesday Service Times",
   	"desc" => "<p>Enter your service times here.</p><p><b>Example</b> 10:00 a.m.</p>",
	"id" => $shortname."_map_services4",
	"type" => "text",
	"std" => ""),
array( "name" => "Services on Thursday?",
    "desc" => "Check if yes. Leave unchecked if no.",
    "id" => $shortname."_map_day5",
    "type" => "checkbox",
    "std" => "false"),
array( "name" => "Thursday Service Times",
   	"desc" => "<p>Enter your service times here.</p><p><b>Example</b> 10:00 a.m.</p>",
	"id" => $shortname."_map_services5",
	"type" => "text",
	"std" => ""),	
array( "name" => "Services on Friday?",
    "desc" => "Check if yes. Leave unchecked if no.",
    "id" => $shortname."_map_day6",
    "type" => "checkbox",
    "std" => "false"),
array( "name" => "Friday Service Times",
   	"desc" => "<p>Enter your service times here.</p><p><b>Example</b> 10:00 a.m.</p>",
	"id" => $shortname."_map_services6",
	"type" => "text",
	"std" => ""),	
array( "name" => "Services on Saturday?",
    "desc" => "Check if yes. Leave unchecked if no.",
    "id" => $shortname."_map_day7",
    "type" => "checkbox",
    "std" => "false"),
array( "name" => "Saturday Service Times",
   	"desc" => "<p>Enter your service times here.</p><p><b>Example</b> 10:00 a.m.</p>",
	"id" => $shortname."_map_services7",
	"type" => "text",
	"std" => ""),	

// Google Analytics Integration		
array( "type" => "close"),
array( "name" => "Google Analytics",
	"type" => "section"),
array( "type" => "open"),
	
array( "name" => "Google Analytics",
	"desc" => "<p>Paste your Google Analytics ID to track your site's traffic.</p><p><b>Example</b> UA-55555555-1</p>",
	"id" => $shortname."_analytics",
	"type" => "text",
	"std" => ""),
	
array( "type" => "close"),
);

function mytheme_add_admin() {
 
global $themename, $shortname, $options;
 
if ( $_GET['page'] == basename(__FILE__) ) {
 
	if ( 'save' == $_REQUEST['action'] ) {
 
		foreach ($options as $value) {
		update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
 
foreach ($options as $value) {
	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
 
	header("Location: admin.php?page=admin-theme-options.php&saved=true");
die;
 
} 
else if( 'reset' == $_REQUEST['action'] ) {
 
	foreach ($options as $value) {
		delete_option( $value['id'] ); }
 
	header("Location: admin.php?page=admin-theme-options.php&reset=true");
die;
 
}
}
 
add_menu_page($themename, $themename, 'edit_theme_options', basename(__FILE__), 'mytheme_admin');
}

function mytheme_add_init() {

$file_dir=get_bloginfo('template_directory');
wp_enqueue_style("functions", $file_dir."/assets/functions/functions.css", false, "1.0", "all");
wp_enqueue_script("rm_script", $file_dir."/assets/js/admin-rm-script-min.js", false, "1.0");

}
function mytheme_admin() {
 
global $themename, $shortname, $options;
$i=0;
 
if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
 
?>
<div class="wrap rm_wrap">
<div class="rm_wrap_logo"> <h2><?php echo $themename; ?> Settings</h2></div>
 
<div class="rm_opts">
<form method="post">
<?php foreach ($options as $value) {
switch ( $value['type'] ) {
 
case "open":
?>
 
<?php break;
 
case "close":
?>
 
</div>
</div>
<br />

 
<?php break;
 
case "title":
?>
<p>Options you can use to customize the look of your website.</p>

 
<?php break;
 
case 'text':
?>

<div class="rm_input rm_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
<?php
break;
 
case 'textarea':
?>

<div class="rm_input rm_textarea">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
  
<?php
break;
 
case 'select':
?>

<div class="rm_input rm_select">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
		<option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
</select>

	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>
<?php
break;
 
case "checkbox":
?>

<div class="rm_input rm_checkbox">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />


	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php break; 
case "section":

$i++;

?>

<div class="rm_section">
<div class="rm_title"><h3><img src="<?php bloginfo('template_directory')?>/assets/functions/images/trans.png" class="inactive" alt="""><?php echo $value['name']; ?></h3><span class="submit"><input name="save<?php echo $i; ?>" type="submit" value="Save changes" />
</span><div class="clearfix"></div></div>
<div class="rm_options">

 
<?php break;
 
}
}
?>
 
<input type="hidden" name="action" value="save" />
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>
<div style="font-size:9px; margin-bottom:10px;">Icons: <a href="http://www.woothemes.com/2009/09/woofunction/">WooFunction</a></div>
 </div> 
 

<?php
}
?>
<?php
add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');
