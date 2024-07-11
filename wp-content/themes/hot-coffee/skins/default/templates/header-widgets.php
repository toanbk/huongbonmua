<?php
/**
 * The template to display the widgets area in the header
 *
 * @package HOT COFFEE
 * @since HOT COFFEE 1.0
 */

// Header sidebar
$hot_coffee_header_name    = hot_coffee_get_theme_option( 'header_widgets' );
$hot_coffee_header_present = ! hot_coffee_is_off( $hot_coffee_header_name ) && is_active_sidebar( $hot_coffee_header_name );
if ( $hot_coffee_header_present ) {
	hot_coffee_storage_set( 'current_sidebar', 'header' );
	$hot_coffee_header_wide = hot_coffee_get_theme_option( 'header_wide' );
	ob_start();
	if ( is_active_sidebar( $hot_coffee_header_name ) ) {
		dynamic_sidebar( $hot_coffee_header_name );
	}
	$hot_coffee_widgets_output = ob_get_contents();
	ob_end_clean();
	if ( ! empty( $hot_coffee_widgets_output ) ) {
		$hot_coffee_widgets_output = preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $hot_coffee_widgets_output );
		$hot_coffee_need_columns   = strpos( $hot_coffee_widgets_output, 'columns_wrap' ) === false;
		if ( $hot_coffee_need_columns ) {
			$hot_coffee_columns = max( 0, (int) hot_coffee_get_theme_option( 'header_columns' ) );
			if ( 0 == $hot_coffee_columns ) {
				$hot_coffee_columns = min( 6, max( 1, hot_coffee_tags_count( $hot_coffee_widgets_output, 'aside' ) ) );
			}
			if ( $hot_coffee_columns > 1 ) {
				$hot_coffee_widgets_output = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $hot_coffee_columns ) . ' widget', $hot_coffee_widgets_output );
			} else {
				$hot_coffee_need_columns = false;
			}
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo ! empty( $hot_coffee_header_wide ) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<?php do_action( 'hot_coffee_action_before_sidebar_wrap', 'header' ); ?>
			<div class="header_widgets_inner widget_area_inner">
				<?php
				if ( ! $hot_coffee_header_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $hot_coffee_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'hot_coffee_action_before_sidebar', 'header' );
				hot_coffee_show_layout( $hot_coffee_widgets_output );
				do_action( 'hot_coffee_action_after_sidebar', 'header' );
				if ( $hot_coffee_need_columns ) {
					?>
					</div>	<!-- /.columns_wrap -->
					<?php
				}
				if ( ! $hot_coffee_header_wide ) {
					?>
					</div>	<!-- /.content_wrap -->
					<?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
			<?php do_action( 'hot_coffee_action_after_sidebar_wrap', 'header' ); ?>
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
