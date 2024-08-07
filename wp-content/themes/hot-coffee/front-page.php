<?php
/**
 * The Front Page template file.
 *
 * @package HOT COFFEE
 * @since HOT COFFEE 1.0.31
 */

get_header();

// If front-page is a static page
if ( get_option( 'show_on_front' ) == 'page' ) {

	// If Front Page Builder is enabled - display sections
	if ( hot_coffee_is_on( hot_coffee_get_theme_option( 'front_page_enabled', false ) ) ) {

		if ( have_posts() ) {
			the_post();
		}

		$hot_coffee_sections = hot_coffee_array_get_keys_by_value( hot_coffee_get_theme_option( 'front_page_sections' ) );
		if ( is_array( $hot_coffee_sections ) ) {
			foreach ( $hot_coffee_sections as $hot_coffee_section ) {
				get_template_part( apply_filters( 'hot_coffee_filter_get_template_part', 'front-page/section', $hot_coffee_section ), $hot_coffee_section );
			}
		}

		// Else if this page is a blog archive
	} elseif ( is_page_template( 'blog.php' ) ) {
		get_template_part( apply_filters( 'hot_coffee_filter_get_template_part', 'blog' ) );

		// Else - display a native page content
	} else {
		get_template_part( apply_filters( 'hot_coffee_filter_get_template_part', 'page' ) );
	}

	// Else get the template 'index.php' to show posts
} else {
	get_template_part( apply_filters( 'hot_coffee_filter_get_template_part', 'index' ) );
}

get_footer();
