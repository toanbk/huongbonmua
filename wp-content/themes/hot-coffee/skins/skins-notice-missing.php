<?php
/**
 * The template to display Admin notices
 *
 * @package HOT COFFEE
 * @since HOT COFFEE 1.98.0
 */

$hot_coffee_skins_url   = get_admin_url( null, 'admin.php?page=trx_addons_theme_panel#trx_addons_theme_panel_section_skins' );
$hot_coffee_active_skin = hot_coffee_skins_get_active_skin_name();
?>
<div class="hot_coffee_admin_notice hot_coffee_skins_notice notice notice-error">
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
		<?php esc_html_e( 'Active skin is missing!', 'hot-coffee' ); ?>
	</h3>
	<div class="hot_coffee_notice_text">
		<p>
			<?php
			// Translators: Add a current skin name to the message
			echo wp_kses_data( sprintf( __( "Your active skin <b>'%s'</b> is missing. Usually this happens when the theme is updated directly through the server or FTP.", 'hot-coffee' ), ucfirst( $hot_coffee_active_skin ) ) );
			?>
		</p>
		<p>
			<?php
			echo wp_kses_data( __( "Please use only <b>'ThemeREX Updater v.1.6.0+'</b> plugin for your future updates.", 'hot-coffee' ) );
			?>
		</p>
		<p>
			<?php
			echo wp_kses_data( __( "But no worries! You can re-download the skin via 'Skins Manager' ( Theme Panel - Theme Dashboard - Skins ).", 'hot-coffee' ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="hot_coffee_notice_buttons">
		<?php
		// Link to the theme dashboard page
		?>
		<a href="<?php echo esc_url( $hot_coffee_skins_url ); ?>" class="button button-primary"><i class="dashicons dashicons-update"></i> 
			<?php
			// Translators: Add theme name
			esc_html_e( 'Go to Skins manager', 'hot-coffee' );
			?>
		</a>
	</div>
</div>
