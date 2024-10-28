<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package HOT COFFEE
 * @since HOT COFFEE 1.0
 */

$hot_coffee_args = get_query_var( 'hot_coffee_logo_args' );

// Site logo
$hot_coffee_logo_type   = isset( $hot_coffee_args['type'] ) ? $hot_coffee_args['type'] : '';
$hot_coffee_logo_image  = hot_coffee_get_logo_image( $hot_coffee_logo_type );
$hot_coffee_logo_text   = hot_coffee_is_on( hot_coffee_get_theme_option( 'logo_text' ) ) ? get_bloginfo( 'name' ) : '';
$hot_coffee_logo_slogan = get_bloginfo( 'description', 'display' );
if ( ! empty( $hot_coffee_logo_image['logo'] ) || ! empty( $hot_coffee_logo_text ) ) {
	?><a class="sc_layouts_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php
		if ( ! empty( $hot_coffee_logo_image['logo'] ) ) {
			if ( empty( $hot_coffee_logo_type ) && function_exists( 'the_custom_logo' ) && is_numeric($hot_coffee_logo_image['logo']) && (int) $hot_coffee_logo_image['logo'] > 0 ) {
				the_custom_logo();
			} else {
				$hot_coffee_attr = hot_coffee_getimagesize( $hot_coffee_logo_image['logo'] );
				echo '<img src="' . esc_url( $hot_coffee_logo_image['logo'] ) . '"'
						. ( ! empty( $hot_coffee_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $hot_coffee_logo_image['logo_retina'] ) . ' 2x"' : '' )
						. ' alt="' . esc_attr( $hot_coffee_logo_text ) . '"'
						. ( ! empty( $hot_coffee_attr[3] ) ? ' ' . wp_kses_data( $hot_coffee_attr[3] ) : '' )
						. '>';
			}
		} else {
			hot_coffee_show_layout( hot_coffee_prepare_macros( $hot_coffee_logo_text ), '<span class="logo_text">', '</span>' );
			hot_coffee_show_layout( hot_coffee_prepare_macros( $hot_coffee_logo_slogan ), '<span class="logo_slogan">', '</span>' );
		}
		?>
	</a>
	<?php
}
