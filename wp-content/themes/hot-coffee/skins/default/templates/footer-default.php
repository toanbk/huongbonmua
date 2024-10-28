<?php
/**
 * The template to display default site footer
 *
 * @package HOT COFFEE
 * @since HOT COFFEE 1.0.10
 */

?>
<footer class="footer_wrap footer_default
<?php
$hot_coffee_footer_scheme = hot_coffee_get_theme_option( 'footer_scheme' );
if ( ! empty( $hot_coffee_footer_scheme ) && ! hot_coffee_is_inherit( $hot_coffee_footer_scheme  ) ) {
	echo ' scheme_' . esc_attr( $hot_coffee_footer_scheme );
}
?>
				">
	<?php

	// Footer widgets area
	get_template_part( apply_filters( 'hot_coffee_filter_get_template_part', 'templates/footer-widgets' ) );

	// Logo
	get_template_part( apply_filters( 'hot_coffee_filter_get_template_part', 'templates/footer-logo' ) );

	// Socials
	get_template_part( apply_filters( 'hot_coffee_filter_get_template_part', 'templates/footer-socials' ) );

	// Copyright area
	get_template_part( apply_filters( 'hot_coffee_filter_get_template_part', 'templates/footer-copyright' ) );

	?>
</footer><!-- /.footer_wrap -->
