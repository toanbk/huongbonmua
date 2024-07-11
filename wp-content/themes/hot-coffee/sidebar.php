<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package HOT COFFEE
 * @since HOT COFFEE 1.0
 */

if ( hot_coffee_sidebar_present() ) {
	
	$hot_coffee_sidebar_type = hot_coffee_get_theme_option( 'sidebar_type' );
	if ( 'custom' == $hot_coffee_sidebar_type && ! hot_coffee_is_layouts_available() ) {
		$hot_coffee_sidebar_type = 'default';
	}
	
	// Catch output to the buffer
	ob_start();
	if ( 'default' == $hot_coffee_sidebar_type ) {
		// Default sidebar with widgets
		$hot_coffee_sidebar_name = hot_coffee_get_theme_option( 'sidebar_widgets' );
		hot_coffee_storage_set( 'current_sidebar', 'sidebar' );
		if ( is_active_sidebar( $hot_coffee_sidebar_name ) ) {
			dynamic_sidebar( $hot_coffee_sidebar_name );
		}
	} else {
		// Custom sidebar from Layouts Builder
		$hot_coffee_sidebar_id = hot_coffee_get_custom_sidebar_id();
		do_action( 'hot_coffee_action_show_layout', $hot_coffee_sidebar_id );
	}
	$hot_coffee_out = trim( ob_get_contents() );
	ob_end_clean();
	
	// If any html is present - display it
	if ( ! empty( $hot_coffee_out ) ) {
		$hot_coffee_sidebar_position    = hot_coffee_get_theme_option( 'sidebar_position' );
		$hot_coffee_sidebar_position_ss = hot_coffee_get_theme_option( 'sidebar_position_ss' );
		?>
		<div class="sidebar widget_area
			<?php
			echo ' ' . esc_attr( $hot_coffee_sidebar_position );
			echo ' sidebar_' . esc_attr( $hot_coffee_sidebar_position_ss );
			echo ' sidebar_' . esc_attr( $hot_coffee_sidebar_type );

			$hot_coffee_sidebar_scheme = apply_filters( 'hot_coffee_filter_sidebar_scheme', hot_coffee_get_theme_option( 'sidebar_scheme' ) );
			if ( ! empty( $hot_coffee_sidebar_scheme ) && ! hot_coffee_is_inherit( $hot_coffee_sidebar_scheme ) && 'custom' != $hot_coffee_sidebar_type ) {
				echo ' scheme_' . esc_attr( $hot_coffee_sidebar_scheme );
			}
			?>
		" role="complementary">
			<?php

			// Skip link anchor to fast access to the sidebar from keyboard
			?>
			<a id="sidebar_skip_link_anchor" class="hot_coffee_skip_link_anchor" href="#"></a>
			<?php

			do_action( 'hot_coffee_action_before_sidebar_wrap', 'sidebar' );

			// Button to show/hide sidebar on mobile
			if ( in_array( $hot_coffee_sidebar_position_ss, array( 'above', 'float' ) ) ) {
				$hot_coffee_title = apply_filters( 'hot_coffee_filter_sidebar_control_title', 'float' == $hot_coffee_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'hot-coffee' ) : '' );
				$hot_coffee_text  = apply_filters( 'hot_coffee_filter_sidebar_control_text', 'above' == $hot_coffee_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'hot-coffee' ) : '' );
				?>
				<a href="#" class="sidebar_control" title="<?php echo esc_attr( $hot_coffee_title ); ?>"><?php echo esc_html( $hot_coffee_text ); ?></a>
				<?php
			}
			?>
			<div class="sidebar_inner">
				<?php
				do_action( 'hot_coffee_action_before_sidebar', 'sidebar' );
				hot_coffee_show_layout( preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $hot_coffee_out ) );
				do_action( 'hot_coffee_action_after_sidebar', 'sidebar' );
				?>
			</div>
			<?php

			do_action( 'hot_coffee_action_after_sidebar_wrap', 'sidebar' );

			?>
		</div>
		<div class="clearfix"></div>
		<?php
	}
}
