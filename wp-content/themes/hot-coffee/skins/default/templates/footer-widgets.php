<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package HOT COFFEE
 * @since HOT COFFEE 1.0.10
 */

// Footer sidebar
$hot_coffee_footer_name    = hot_coffee_get_theme_option( 'footer_widgets' );
$hot_coffee_footer_present = ! hot_coffee_is_off( $hot_coffee_footer_name ) && is_active_sidebar( $hot_coffee_footer_name );
if ( $hot_coffee_footer_present ) {
	hot_coffee_storage_set( 'current_sidebar', 'footer' );
	$hot_coffee_footer_wide = hot_coffee_get_theme_option( 'footer_wide' );
	ob_start();
	if ( is_active_sidebar( $hot_coffee_footer_name ) ) {
		dynamic_sidebar( $hot_coffee_footer_name );
	}
	$hot_coffee_out = trim( ob_get_contents() );
	ob_end_clean();
	if ( ! empty( $hot_coffee_out ) ) {
		$hot_coffee_out          = preg_replace( "/<\\/aside>[\r\n\s]*<aside/", '</aside><aside', $hot_coffee_out );
		$hot_coffee_need_columns = true;   //or check: strpos($hot_coffee_out, 'columns_wrap')===false;
		if ( $hot_coffee_need_columns ) {
			$hot_coffee_columns = max( 0, (int) hot_coffee_get_theme_option( 'footer_columns' ) );			
			if ( 0 == $hot_coffee_columns ) {
				$hot_coffee_columns = min( 4, max( 1, hot_coffee_tags_count( $hot_coffee_out, 'aside' ) ) );
			}
			if ( $hot_coffee_columns > 1 ) {
				$hot_coffee_out = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $hot_coffee_columns ) . ' widget', $hot_coffee_out );
			} else {
				$hot_coffee_need_columns = false;
			}
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo ! empty( $hot_coffee_footer_wide ) ? ' footer_fullwidth' : ''; ?> sc_layouts_row sc_layouts_row_type_normal">
			<?php do_action( 'hot_coffee_action_before_sidebar_wrap', 'footer' ); ?>
			<div class="footer_widgets_inner widget_area_inner">
				<?php
				if ( ! $hot_coffee_footer_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $hot_coffee_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'hot_coffee_action_before_sidebar', 'footer' );
				hot_coffee_show_layout( $hot_coffee_out );
				do_action( 'hot_coffee_action_after_sidebar', 'footer' );
				if ( $hot_coffee_need_columns ) {
					?>
					</div><!-- /.columns_wrap -->
					<?php
				}
				if ( ! $hot_coffee_footer_wide ) {
					?>
					</div><!-- /.content_wrap -->
					<?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
			<?php do_action( 'hot_coffee_action_after_sidebar_wrap', 'footer' ); ?>
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
