<?php
/**
 * The template to display default site footer
 *
 * @package HOT COFFEE
 * @since HOT COFFEE 1.0.10
 */

$hot_coffee_footer_id = hot_coffee_get_custom_footer_id();
$hot_coffee_footer_meta = get_post_meta( $hot_coffee_footer_id, 'trx_addons_options', true );
if ( ! empty( $hot_coffee_footer_meta['margin'] ) ) {
	hot_coffee_add_inline_css( sprintf( '.page_content_wrap{padding-bottom:%s}', esc_attr( hot_coffee_prepare_css_value( $hot_coffee_footer_meta['margin'] ) ) ) );
}
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr( $hot_coffee_footer_id ); ?> footer_custom_<?php echo esc_attr( sanitize_title( get_the_title( $hot_coffee_footer_id ) ) ); ?>
						<?php
						$hot_coffee_footer_scheme = hot_coffee_get_theme_option( 'footer_scheme' );
						if ( ! empty( $hot_coffee_footer_scheme ) && ! hot_coffee_is_inherit( $hot_coffee_footer_scheme  ) ) {
							echo ' scheme_' . esc_attr( $hot_coffee_footer_scheme );
						}
						?>
						">
	<?php
	// Custom footer's layout
	do_action( 'hot_coffee_action_show_layout', $hot_coffee_footer_id );
	?>
</footer><!-- /.footer_wrap -->
