<?php
/**
 * The template to display the site logo in the footer
 *
 * @package HOT COFFEE
 * @since HOT COFFEE 1.0.10
 */

// Logo
if ( hot_coffee_is_on( hot_coffee_get_theme_option( 'logo_in_footer' ) ) ) {
	$hot_coffee_logo_image = hot_coffee_get_logo_image( 'footer' );
	$hot_coffee_logo_text  = get_bloginfo( 'name' );
	if ( ! empty( $hot_coffee_logo_image['logo'] ) || ! empty( $hot_coffee_logo_text ) ) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if ( ! empty( $hot_coffee_logo_image['logo'] ) ) {
					$hot_coffee_attr = hot_coffee_getimagesize( $hot_coffee_logo_image['logo'] );
					echo '<a href="' . esc_url( home_url( '/' ) ) . '">'
							. '<img src="' . esc_url( $hot_coffee_logo_image['logo'] ) . '"'
								. ( ! empty( $hot_coffee_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $hot_coffee_logo_image['logo_retina'] ) . ' 2x"' : '' )
								. ' class="logo_footer_image"'
								. ' alt="' . esc_attr__( 'Site logo', 'hot-coffee' ) . '"'
								. ( ! empty( $hot_coffee_attr[3] ) ? ' ' . wp_kses_data( $hot_coffee_attr[3] ) : '' )
							. '>'
						. '</a>';
				} elseif ( ! empty( $hot_coffee_logo_text ) ) {
					echo '<h1 class="logo_footer_text">'
							. '<a href="' . esc_url( home_url( '/' ) ) . '">'
								. esc_html( $hot_coffee_logo_text )
							. '</a>'
						. '</h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
