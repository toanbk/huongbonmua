<?php
/**
 * The template to display default site header
 *
 * @package HOT COFFEE
 * @since HOT COFFEE 1.0
 */

$hot_coffee_header_css   = '';
$hot_coffee_header_image = get_header_image();
$hot_coffee_header_video = hot_coffee_get_header_video();
if ( ! empty( $hot_coffee_header_image ) && hot_coffee_trx_addons_featured_image_override( is_singular() || hot_coffee_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$hot_coffee_header_image = hot_coffee_get_current_mode_image( $hot_coffee_header_image );
}

?><header class="top_panel top_panel_default
	<?php
	echo ! empty( $hot_coffee_header_image ) || ! empty( $hot_coffee_header_video ) ? ' with_bg_image' : ' without_bg_image';
	if ( '' != $hot_coffee_header_video ) {
		echo ' with_bg_video';
	}
	if ( '' != $hot_coffee_header_image ) {
		echo ' ' . esc_attr( hot_coffee_add_inline_css_class( 'background-image: url(' . esc_url( $hot_coffee_header_image ) . ');' ) );
	}
	if ( is_single() && has_post_thumbnail() ) {
		echo ' with_featured_image';
	}
	if ( hot_coffee_is_on( hot_coffee_get_theme_option( 'header_fullheight' ) ) ) {
		echo ' header_fullheight hot-coffee-full-height';
	}
	$hot_coffee_header_scheme = hot_coffee_get_theme_option( 'header_scheme' );
	if ( ! empty( $hot_coffee_header_scheme ) && ! hot_coffee_is_inherit( $hot_coffee_header_scheme  ) ) {
		echo ' scheme_' . esc_attr( $hot_coffee_header_scheme );
	}
	?>
">
	<?php

	// Background video
	if ( ! empty( $hot_coffee_header_video ) ) {
		get_template_part( apply_filters( 'hot_coffee_filter_get_template_part', 'templates/header-video' ) );
	}

	// Main menu
	get_template_part( apply_filters( 'hot_coffee_filter_get_template_part', 'templates/header-navi' ) );

	// Mobile header
	if ( hot_coffee_is_on( hot_coffee_get_theme_option( 'header_mobile_enabled' ) ) ) {
		get_template_part( apply_filters( 'hot_coffee_filter_get_template_part', 'templates/header-mobile' ) );
	}

	// Page title and breadcrumbs area
	if ( ! is_single() ) {
		get_template_part( apply_filters( 'hot_coffee_filter_get_template_part', 'templates/header-title' ) );
	}

	// Header widgets area
	get_template_part( apply_filters( 'hot_coffee_filter_get_template_part', 'templates/header-widgets' ) );
	?>
</header>
