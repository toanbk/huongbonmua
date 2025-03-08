<?php
/**
 * The template to display the socials in the footer
 *
 * @package HOT COFFEE
 * @since HOT COFFEE 1.0.10
 */


// Socials
if ( hot_coffee_is_on( hot_coffee_get_theme_option( 'socials_in_footer' ) ) ) {
	$hot_coffee_output = hot_coffee_get_socials_links();
	if ( '' != $hot_coffee_output ) {
		?>
		<div class="footer_socials_wrap socials_wrap">
			<div class="footer_socials_inner">
				<?php hot_coffee_show_layout( $hot_coffee_output ); ?>
			</div>
		</div>
		<?php
	}
}
