<?php
/**
 * The template to display Admin notices
 *
 * @package HOT COFFEE
 * @since HOT COFFEE 1.0.1
 */

$hot_coffee_theme_slug = get_option( 'template' );
$hot_coffee_theme_obj  = wp_get_theme( $hot_coffee_theme_slug );
?>
<div class="hot_coffee_admin_notice hot_coffee_welcome_notice notice notice-info is-dismissible" data-notice="admin">
	<?php
	// Theme image
	$hot_coffee_theme_img = hot_coffee_get_file_url( 'screenshot.jpg' );
	if ( '' != $hot_coffee_theme_img ) {
		?>
		<div class="hot_coffee_notice_image"><img src="<?php echo esc_url( $hot_coffee_theme_img ); ?>" alt="<?php esc_attr_e( 'Theme screenshot', 'hot-coffee' ); ?>"></div>
		<?php
	}

	// Title
	?>
	<h3 class="hot_coffee_notice_title">
		<?php
		echo esc_html(
			sprintf(
				// Translators: Add theme name and version to the 'Welcome' message
				__( 'Welcome to %1$s v.%2$s', 'hot-coffee' ),
				$hot_coffee_theme_obj->get( 'Name' ) . ( HOT_COFFEE_THEME_FREE ? ' ' . __( 'Free', 'hot-coffee' ) : '' ),
				$hot_coffee_theme_obj->get( 'Version' )
			)
		);
		?>
	</h3>
	<?php

	// Description
	?>
	<div class="hot_coffee_notice_text">
		<p class="hot_coffee_notice_text_description">
			<?php
			echo str_replace( '. ', '.<br>', wp_kses_data( $hot_coffee_theme_obj->description ) );
			?>
		</p>
		<p class="hot_coffee_notice_text_info">
			<?php
			echo wp_kses_data( __( 'Attention! Plugin "ThemeREX Addons" is required! Please, install and activate it!', 'hot-coffee' ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="hot_coffee_notice_buttons">
		<?php
		// Link to the page 'About Theme'
		?>
		<a href="<?php echo esc_url( admin_url() . 'themes.php?page=hot_coffee_about' ); ?>" class="button button-primary"><i class="dashicons dashicons-nametag"></i> 
			<?php
			echo esc_html__( 'Install plugin "ThemeREX Addons"', 'hot-coffee' );
			?>
		</a>
	</div>
</div>
