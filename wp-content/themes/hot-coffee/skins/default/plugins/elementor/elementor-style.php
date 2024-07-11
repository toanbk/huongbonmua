<?php
// Add plugin-specific fonts to the custom CSS
if ( ! function_exists( 'hot_coffee_elm_get_css' ) ) {
    add_filter( 'hot_coffee_filter_get_css', 'hot_coffee_elm_get_css', 10, 2 );
    function hot_coffee_elm_get_css( $css, $args ) {

        if ( isset( $css['fonts'] ) && isset( $args['fonts'] ) ) {
            $fonts         = $args['fonts'];
            $css['fonts'] .= <<<CSS
.elementor-widget-progress .elementor-title,
.elementor-widget-progress .elementor-progress-percentage,
.elementor-widget-toggle .elementor-toggle-title,
.elementor-widget-toggle .elementor-toggle-title,       
.elementor-widget-counter .elementor-counter-number-wrapper {
	{$fonts['h5_font-family']}
}
.elementor-widget-tabs .elementor-tab-title,
.elementor-widget-icon-box .elementor-widget-container .elementor-icon-box-title small {
    {$fonts['p_font-family']}
}
.custom_icon_btn.elementor-widget-button .elementor-button .elementor-button-text {
	{$fonts['button_font-family']}
}

CSS;
        }

        return $css;
    }
}


// Add theme-specific CSS-animations
if ( ! function_exists( 'hot_coffee_elm_add_theme_animations' ) ) {
	add_filter( 'elementor/controls/animations/additional_animations', 'hot_coffee_elm_add_theme_animations' );
	function hot_coffee_elm_add_theme_animations( $animations ) {
		/* To add a theme-specific animations to the list:
			1) Merge to the array 'animations': array(
													esc_html__( 'Theme Specific', 'hot-coffee' ) => array(
														'ta_custom_1' => esc_html__( 'Custom 1', 'hot-coffee' )
													)
												)
			2) Add a CSS rules for the class '.ta_custom_1' to create a custom entrance animation
		*/
		$animations = array_merge(
						$animations,
						array(
							esc_html__( 'Theme Specific', 'hot-coffee' ) => array(
									'ta_under_strips' => esc_html__( 'Under the strips', 'hot-coffee' ),
									'hot-coffee-fadeinup' => esc_html__( 'Hot coffee - Fade In Up', 'hot-coffee' ),
									'hot-coffee-fadeinright' => esc_html__( 'Hot coffee - Fade In Right', 'hot-coffee' ),
									'hot-coffee-fadeinleft' => esc_html__( 'Hot coffee - Fade In Left', 'hot-coffee' ),
									'hot-coffee-fadeindown' => esc_html__( 'Hot coffee - Fade In Down', 'hot-coffee' ),
									'hot-coffee-fadein' => esc_html__( 'Hot coffee - Fade In', 'hot-coffee' ),
									'hot-coffee-infinite-rotate' => esc_html__( 'Hot coffee - Infinite Rotate', 'hot-coffee' ),
								)
							)
						);

		return $animations;
	}
}
