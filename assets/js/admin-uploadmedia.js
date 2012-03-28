jQuery(document).ready(function() {
 
jQuery('#upload_image_button').click(function() {
											  window.send_to_editor = function(html) {
 imgurl = jQuery('img',html).attr('src');
 jQuery('#upload_image').val(imgurl);
 tb_remove();
 
 
}
 
 
 tb_show('', 'media-upload.php?post_id=1&amp;type=image&amp;TB_iframe=true');
 return false;
});
 
 
});
 
jQuery(document).ready(function() {
 
jQuery('#upload_image_button2').click(function() {
											   window.send_to_editor = function(html) {
 imgurl = jQuery('img',html).attr('src');
 jQuery('#upload_image2').val(imgurl);
 tb_remove();
 
 
}
 
 tb_show('', 'media-upload.php?post_id=1&amp;type=image&amp;TB_iframe=true');
 return false;
});
 
 
 
});


jQuery(document).ready(function(){


jQuery('#banner_image_button').click(function() {

	window.send_to_editor = function(html) {

		//imgurl = jQuery('img', html).attr('src');

		imgurl = jQuery(html).attr('src');// || jQuery(html).find('img').attr('src') || jQuery(html).attr('href');

		jQuery('#banner_image').val(imgurl);

		//alert(imgurl);

		tb_remove();

	}

	tb_show('', 'media-upload.php?post_id=1&type=image&TB_iframe=true');

	return false;

});


});