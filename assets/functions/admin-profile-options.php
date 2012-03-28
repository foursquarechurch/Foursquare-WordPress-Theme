<?php
################################################################################
// ADMIN FUNCTIONS
################################################################################
 
// Additional User Profile Options
// Additional user options for Social Network information. 
// Used in the theme footer for displaying social icons.
/*----------------------------------------------------------------------------*/

add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user ) { ?>
	<h3>Extra profile information</h3>
	<table class="form-table"> 
        <tr>
			<th><label for="title">Title</label></th>
			<td>
				<input type="text" name="job" id="job" value="<?php echo esc_attr( get_the_author_meta( 'job', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your job title.</span>
			</td>
		</tr>
		<tr>
			<th><label for="twitter">Twitter</label></th>
			<td>
				<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Twitter username.</span>
			</td>
		</tr>       
        <tr>
			<th><label for="twitter">Facebook</label></th>
			<td>
				<input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Facebook URL.</span>
			</td>
		</tr>
			<th><label for="twitter">Google+</label></th>
			<td>
				<input type="text" name="googleplus" id="googleplus" value="<?php echo esc_attr( get_the_author_meta( 'googleplus', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Google+ URL.</span>
			</td>
		</tr>
	</table>
<?php }
?>
<?php 

/*  Adds Title, Twitter and Facebook options to User Profile. */
add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) )
	return false;
/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
update_usermeta( $user_id, 'job', $_POST['job'] );
update_usermeta( $user_id, 'twitter', $_POST['twitter'] );
update_usermeta( $user_id, 'facebook', $_POST['facebook'] );
update_usermeta( $user_id, 'googleplus', $_POST['googleplus'] );
}
?>