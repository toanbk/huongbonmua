<?php
/**
 * The Header: Logo and main menu
 *
 * @package HOT COFFEE
 * @since HOT COFFEE 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js<?php
	// Class scheme_xxx need in the <html> as context for the <body>!
	echo ' scheme_' . esc_attr( hot_coffee_get_theme_option( 'color_scheme' ) );
?>">

<head>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
	do_action( 'hot_coffee_action_before_body' );
	?>

	<div class="<?php echo esc_attr( apply_filters( 'hot_coffee_filter_body_wrap_class', 'body_wrap' ) ); ?>" <?php do_action('hot_coffee_action_body_wrap_attributes'); ?>>

		<?php do_action( 'hot_coffee_action_before_page_wrap' ); ?>

		<div class="<?php echo esc_attr( apply_filters( 'hot_coffee_filter_page_wrap_class', 'page_wrap' ) ); ?>" <?php do_action('hot_coffee_action_page_wrap_attributes'); ?>>

			<?php do_action( 'hot_coffee_action_page_wrap_start' ); ?>

			<?php
			$hot_coffee_full_post_loading = ( hot_coffee_is_singular( 'post' ) || hot_coffee_is_singular( 'attachment' ) ) && hot_coffee_get_value_gp( 'action' ) == 'full_post_loading';
			$hot_coffee_prev_post_loading = ( hot_coffee_is_singular( 'post' ) || hot_coffee_is_singular( 'attachment' ) ) && hot_coffee_get_value_gp( 'action' ) == 'prev_post_loading';

			// Don't display the header elements while actions 'full_post_loading' and 'prev_post_loading'
			if ( ! $hot_coffee_full_post_loading && ! $hot_coffee_prev_post_loading ) {

				// Short links to fast access to the content, sidebar and footer from the keyboard
				?>
				<a class="hot_coffee_skip_link skip_to_content_link" href="#content_skip_link_anchor" tabindex="<?php echo esc_attr( apply_filters( 'hot_coffee_filter_skip_links_tabindex', 1 ) ); ?>"><?php esc_html_e( "Skip to content", 'hot-coffee' ); ?></a>
				<?php if ( hot_coffee_sidebar_present() ) { ?>
				<a class="hot_coffee_skip_link skip_to_sidebar_link" href="#sidebar_skip_link_anchor" tabindex="<?php echo esc_attr( apply_filters( 'hot_coffee_filter_skip_links_tabindex', 1 ) ); ?>"><?php esc_html_e( "Skip to sidebar", 'hot-coffee' ); ?></a>
				<?php } ?>
				<a class="hot_coffee_skip_link skip_to_footer_link" href="#footer_skip_link_anchor" tabindex="<?php echo esc_attr( apply_filters( 'hot_coffee_filter_skip_links_tabindex', 1 ) ); ?>"><?php esc_html_e( "Skip to footer", 'hot-coffee' ); ?></a>

				<?php
				do_action( 'hot_coffee_action_before_header' );

				// Header
				$hot_coffee_header_type = hot_coffee_get_theme_option( 'header_type' );
				if ( 'custom' == $hot_coffee_header_type && ! hot_coffee_is_layouts_available() ) {
					$hot_coffee_header_type = 'default';
				}
				get_template_part( apply_filters( 'hot_coffee_filter_get_template_part', "templates/header-" . sanitize_file_name( $hot_coffee_header_type ) ) );

				// Side menu
				if ( in_array( hot_coffee_get_theme_option( 'menu_side' ), array( 'left', 'right' ) ) ) {
					get_template_part( apply_filters( 'hot_coffee_filter_get_template_part', 'templates/header-navi-side' ) );
				}

				// Mobile menu
				get_template_part( apply_filters( 'hot_coffee_filter_get_template_part', 'templates/header-navi-mobile' ) );

				do_action( 'hot_coffee_action_after_header' );

			}
			?>

			<?php do_action( 'hot_coffee_action_before_page_content_wrap' ); ?>

			<div class="page_content_wrap<?php
				if ( hot_coffee_is_off( hot_coffee_get_theme_option( 'remove_margins' ) ) ) {
					if ( empty( $hot_coffee_header_type ) ) {
						$hot_coffee_header_type = hot_coffee_get_theme_option( 'header_type' );
					}
					if ( 'custom' == $hot_coffee_header_type && hot_coffee_is_layouts_available() ) {
						$hot_coffee_header_id = hot_coffee_get_custom_header_id();
						if ( $hot_coffee_header_id > 0 ) {
							$hot_coffee_header_meta = hot_coffee_get_custom_layout_meta( $hot_coffee_header_id );
							if ( ! empty( $hot_coffee_header_meta['margin'] ) ) {
								?> page_content_wrap_custom_header_margin<?php
							}
						}
					}
					$hot_coffee_footer_type = hot_coffee_get_theme_option( 'footer_type' );
					if ( 'custom' == $hot_coffee_footer_type && hot_coffee_is_layouts_available() ) {
						$hot_coffee_footer_id = hot_coffee_get_custom_footer_id();
						if ( $hot_coffee_footer_id ) {
							$hot_coffee_footer_meta = hot_coffee_get_custom_layout_meta( $hot_coffee_footer_id );
							if ( ! empty( $hot_coffee_footer_meta['margin'] ) ) {
								?> page_content_wrap_custom_footer_margin<?php
							}
						}
					}
				}
				do_action( 'hot_coffee_action_page_content_wrap_class', $hot_coffee_prev_post_loading );
				?>"<?php
				if ( apply_filters( 'hot_coffee_filter_is_prev_post_loading', $hot_coffee_prev_post_loading ) ) {
					?> data-single-style="<?php echo esc_attr( hot_coffee_get_theme_option( 'single_style' ) ); ?>"<?php
				}
				do_action( 'hot_coffee_action_page_content_wrap_data', $hot_coffee_prev_post_loading );
			?>>
				<?php
				do_action( 'hot_coffee_action_page_content_wrap', $hot_coffee_full_post_loading || $hot_coffee_prev_post_loading );

				// Single posts banner
				if ( apply_filters( 'hot_coffee_filter_single_post_header', hot_coffee_is_singular( 'post' ) || hot_coffee_is_singular( 'attachment' ) ) ) {
					if ( $hot_coffee_prev_post_loading ) {
						if ( hot_coffee_get_theme_option( 'posts_navigation_scroll_which_block' ) != 'article' ) {
							do_action( 'hot_coffee_action_between_posts' );
						}
					}
					// Single post thumbnail and title
					$hot_coffee_path = apply_filters( 'hot_coffee_filter_get_template_part', 'templates/single-styles/' . hot_coffee_get_theme_option( 'single_style' ) );
					if ( hot_coffee_get_file_dir( $hot_coffee_path . '.php' ) != '' ) {
						get_template_part( $hot_coffee_path );
					}
				}

				// Widgets area above page
				$hot_coffee_body_style   = hot_coffee_get_theme_option( 'body_style' );
				$hot_coffee_widgets_name = hot_coffee_get_theme_option( 'widgets_above_page' );
				$hot_coffee_show_widgets = ! hot_coffee_is_off( $hot_coffee_widgets_name ) && is_active_sidebar( $hot_coffee_widgets_name );
				if ( $hot_coffee_show_widgets ) {
					if ( 'fullscreen' != $hot_coffee_body_style ) {
						?>
						<div class="content_wrap">
							<?php
					}
					hot_coffee_create_widgets_area( 'widgets_above_page' );
					if ( 'fullscreen' != $hot_coffee_body_style ) {
						?>
						</div>
						<?php
					}
				}

				// Content area
				do_action( 'hot_coffee_action_before_content_wrap' );
				?>
				<div class="content_wrap<?php echo 'fullscreen' == $hot_coffee_body_style ? '_fullscreen' : ''; ?>">

					<?php do_action( 'hot_coffee_action_content_wrap_start' ); ?>

					<div class="content">
						<?php
						do_action( 'hot_coffee_action_page_content_start' );

						// Skip link anchor to fast access to the content from keyboard
						?>
						<a id="content_skip_link_anchor" class="hot_coffee_skip_link_anchor" href="#"></a>
						<?php
						// Single posts banner between prev/next posts
						if ( ( hot_coffee_is_singular( 'post' ) || hot_coffee_is_singular( 'attachment' ) )
							&& $hot_coffee_prev_post_loading 
							&& hot_coffee_get_theme_option( 'posts_navigation_scroll_which_block' ) == 'article'
						) {
							do_action( 'hot_coffee_action_between_posts' );
						}

						// Widgets area above content
						hot_coffee_create_widgets_area( 'widgets_above_content' );

						do_action( 'hot_coffee_action_page_content_start_text' );
