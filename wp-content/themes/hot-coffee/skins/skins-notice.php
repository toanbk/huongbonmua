<?php
/**
 * The template to display Admin notices
 *
 * @package HOT COFFEE
 * @since HOT COFFEE 1.0.64
 */

$hot_coffee_skins_url  = get_admin_url( null, 'admin.php?page=trx_addons_theme_panel#trx_addons_theme_panel_section_skins' );
$hot_coffee_skins_args = get_query_var( 'hot_coffee_skins_notice_args' );
?>
<div class="hot_coffee_admin_notice hot_coffee_skins_notice notice notice-info is-dismissible" data-notice="skins">
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
		<?php esc_html_e( 'New skins are available', 'hot-coffee' ); ?>
	</h3>
	<?php

	// Description
	$hot_coffee_total      = $hot_coffee_skins_args['update'];	// Store value to the separate variable to avoid warnings from ThemeCheck plugin!
	$hot_coffee_skins_msg  = $hot_coffee_total > 0
							// Translators: Add new skins number
							? '<strong>' . sprintf( _n( '%d new version', '%d new versions', $hot_coffee_total, 'hot-coffee' ), $hot_coffee_total ) . '</strong>'
							: '';
	$hot_coffee_total      = $hot_coffee_skins_args['free'];
	$hot_coffee_skins_msg .= $hot_coffee_total > 0
							? ( ! empty( $hot_coffee_skins_msg ) ? ' ' . esc_html__( 'and', 'hot-coffee' ) . ' ' : '' )
								// Translators: Add new skins number
								. '<strong>' . sprintf( _n( '%d free skin', '%d free skins', $hot_coffee_total, 'hot-coffee' ), $hot_coffee_total ) . '</strong>'
							: '';
	$hot_coffee_total      = $hot_coffee_skins_args['pay'];
	$hot_coffee_skins_msg .= $hot_coffee_skins_args['pay'] > 0
							? ( ! empty( $hot_coffee_skins_msg ) ? ' ' . esc_html__( 'and', 'hot-coffee' ) . ' ' : '' )
								// Translators: Add new skins number
								. '<strong>' . sprintf( _n( '%d paid skin', '%d paid skins', $hot_coffee_total, 'hot-coffee' ), $hot_coffee_total ) . '</strong>'
							: '';
	?>
	<div class="hot_coffee_notice_text">
		<p>
			<?php
			// Translators: Add new skins info
			echo wp_kses_data( sprintf( __( "We are pleased to announce that %s are available for your theme", 'hot-coffee' ), $hot_coffee_skins_msg ) );
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
