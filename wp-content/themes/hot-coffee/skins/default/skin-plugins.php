<?php
/**
 * Required plugins
 *
 * @package HOT COFFEE
 * @since HOT COFFEE 1.76.0
 */

// THEME-SUPPORTED PLUGINS
// If plugin not need - remove its settings from next array
//----------------------------------------------------------
$hot_coffee_theme_required_plugins_groups = array(
	'core'          => esc_html__( 'Core', 'hot-coffee' ),
	'page_builders' => esc_html__( 'Page Builders', 'hot-coffee' ),
	'ecommerce'     => esc_html__( 'E-Commerce & Donations', 'hot-coffee' ),
	'socials'       => esc_html__( 'Socials and Communities', 'hot-coffee' ),
	'events'        => esc_html__( 'Events and Appointments', 'hot-coffee' ),
	'content'       => esc_html__( 'Content', 'hot-coffee' ),
	'other'         => esc_html__( 'Other', 'hot-coffee' ),
);
$hot_coffee_theme_required_plugins        = array(
	'trx_addons'                 => array(
		'title'       => esc_html__( 'ThemeREX Addons', 'hot-coffee' ),
		'description' => esc_html__( "Will allow you to install recommended plugins, demo content, and improve the theme's functionality overall with multiple theme options", 'hot-coffee' ),
		'required'    => true,
		'logo'        => 'trx_addons.png',
		'group'       => $hot_coffee_theme_required_plugins_groups['core'],
	),
	'elementor'                  => array(
		'title'       => esc_html__( 'Elementor', 'hot-coffee' ),
		'description' => esc_html__( "Is a beautiful PageBuilder, even the free version of which allows you to create great pages using a variety of modules.", 'hot-coffee' ),
		'required'    => false,
		'logo'        => 'elementor.png',
		'group'       => $hot_coffee_theme_required_plugins_groups['page_builders'],
	),
	'gutenberg'                  => array(
		'title'       => esc_html__( 'Gutenberg', 'hot-coffee' ),
		'description' => esc_html__( "It's a posts editor coming in place of the classic TinyMCE. Can be installed and used in parallel with Elementor", 'hot-coffee' ),
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'gutenberg.png',
		'group'       => $hot_coffee_theme_required_plugins_groups['page_builders'],
	),
	'js_composer'                => array(
		'title'       => esc_html__( 'WPBakery PageBuilder', 'hot-coffee' ),
		'description' => esc_html__( "Popular PageBuilder which allows you to create excellent pages", 'hot-coffee' ),
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'js_composer.jpg',
		'group'       => $hot_coffee_theme_required_plugins_groups['page_builders'],
	),
	'woocommerce'                => array(
		'title'       => esc_html__( 'WooCommerce', 'hot-coffee' ),
		'description' => esc_html__( "Connect the store to your website and start selling now", 'hot-coffee' ),
		'required'    => false,
		'logo'        => 'woocommerce.png',
		'group'       => $hot_coffee_theme_required_plugins_groups['ecommerce'],
	),
	'elegro-payment'             => array(
		'title'       => esc_html__( 'Elegro Crypto Payment', 'hot-coffee' ),
		'description' => esc_html__( "Extends WooCommerce Payment Gateways with an elegro Crypto Payment", 'hot-coffee' ),
		'required'    => false,
		'logo'        => 'elegro-payment.png',
		'group'       => $hot_coffee_theme_required_plugins_groups['ecommerce'],
	),
	'instagram-feed'             => array(
		'title'       => esc_html__( 'Instagram Feed', 'hot-coffee' ),
		'description' => esc_html__( "Displays the latest photos from your profile on Instagram", 'hot-coffee' ),
		'required'    => false,
		'logo'        => 'instagram-feed.png',
		'group'       => $hot_coffee_theme_required_plugins_groups['socials'],
	),
	'mailchimp-for-wp'           => array(
		'title'       => esc_html__( 'MailChimp for WP', 'hot-coffee' ),
		'description' => esc_html__( "Allows visitors to subscribe to newsletters", 'hot-coffee' ),
		'required'    => false,
		'logo'        => 'mailchimp-for-wp.png',
		'group'       => $hot_coffee_theme_required_plugins_groups['socials'],
	),
	'booked'                     => array(
		'title'       => esc_html__( 'Booked Appointments', 'hot-coffee' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => 'booked.png',
		'group'       => $hot_coffee_theme_required_plugins_groups['events'],
	),
	'quickcal'                     => array(
		'title'       => esc_html__( 'QuickCal', 'hot-coffee' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => 'quickcal.png',
		'group'       => $hot_coffee_theme_required_plugins_groups['events'],
	),
	'the-events-calendar'        => array(
		'title'       => esc_html__( 'The Events Calendar', 'hot-coffee' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => 'the-events-calendar.png',
		'group'       => $hot_coffee_theme_required_plugins_groups['events'],
	),
	'contact-form-7'             => array(
		'title'       => esc_html__( 'Contact Form 7', 'hot-coffee' ),
		'description' => esc_html__( "CF7 allows you to create an unlimited number of contact forms", 'hot-coffee' ),
		'required'    => false,
		'logo'        => 'contact-form-7.png',
		'group'       => $hot_coffee_theme_required_plugins_groups['content'],
	),

	'latepoint'                  => array(
		'title'       => esc_html__( 'LatePoint', 'hot-coffee' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => hot_coffee_get_file_url( 'plugins/latepoint/latepoint.png' ),
		'group'       => $hot_coffee_theme_required_plugins_groups['events'],
	),
	'advanced-popups'                  => array(
		'title'       => esc_html__( 'Advanced Popups', 'hot-coffee' ),
		'description' => '',
		'required'    => false,
		'logo'        => hot_coffee_get_file_url( 'plugins/advanced-popups/advanced-popups.jpg' ),
		'group'       => $hot_coffee_theme_required_plugins_groups['content'],
	),
	'devvn-image-hotspot'                  => array(
		'title'       => esc_html__( 'Image Hotspot by DevVN', 'hot-coffee' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => hot_coffee_get_file_url( 'plugins/devvn-image-hotspot/devvn-image-hotspot.png' ),
		'group'       => $hot_coffee_theme_required_plugins_groups['content'],
	),
	'ti-woocommerce-wishlist'                  => array(
		'title'       => esc_html__( 'TI WooCommerce Wishlist', 'hot-coffee' ),
		'description' => '',
		'required'    => false,
		'logo'        => hot_coffee_get_file_url( 'plugins/ti-woocommerce-wishlist/ti-woocommerce-wishlist.png' ),
		'group'       => $hot_coffee_theme_required_plugins_groups['ecommerce'],
	),
	'woo-smart-quick-view'                  => array(
		'title'       => esc_html__( 'WPC Smart Quick View for WooCommerce', 'hot-coffee' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => hot_coffee_get_file_url( 'plugins/woo-smart-quick-view/woo-smart-quick-view.png' ),
		'group'       => $hot_coffee_theme_required_plugins_groups['ecommerce'],
	),
	'twenty20'                  => array(
		'title'       => esc_html__( 'Twenty20 Image Before-After', 'hot-coffee' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => hot_coffee_get_file_url( 'plugins/twenty20/twenty20.png' ),
		'group'       => $hot_coffee_theme_required_plugins_groups['content'],
	),
	'essential-grid'             => array(
		'title'       => esc_html__( 'Essential Grid', 'hot-coffee' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => 'essential-grid.png',
		'group'       => $hot_coffee_theme_required_plugins_groups['content'],
	),
	'revslider'                  => array(
		'title'       => esc_html__( 'Revolution Slider', 'hot-coffee' ),
		'description' => '',
		'required'    => false,
		'logo'        => 'revslider.png',
		'group'       => $hot_coffee_theme_required_plugins_groups['content'],
	),
	'sitepress-multilingual-cms' => array(
		'title'       => esc_html__( 'WPML - Sitepress Multilingual CMS', 'hot-coffee' ),
		'description' => esc_html__( "Allows you to make your website multilingual", 'hot-coffee' ),
		'required'    => false,
		'install'     => false,      // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'sitepress-multilingual-cms.png',
		'group'       => $hot_coffee_theme_required_plugins_groups['content'],
	),
	'wp-gdpr-compliance'         => array(
		'title'       => esc_html__( 'Cookie Information', 'hot-coffee' ),
		'description' => esc_html__( "Allow visitors to decide for themselves what personal data they want to store on your site", 'hot-coffee' ),
		'required'    => false,
		'install'     => false,
		'logo'        => 'wp-gdpr-compliance.png',
		'group'       => $hot_coffee_theme_required_plugins_groups['other'],
	),
	'trx_updater'                => array(
		'title'       => esc_html__( 'ThemeREX Updater', 'hot-coffee' ),
		'description' => esc_html__( "Update theme and theme-specific plugins from developer's upgrade server.", 'hot-coffee' ),
		'required'    => false,
		'logo'        => 'trx_updater.png',
		'group'       => $hot_coffee_theme_required_plugins_groups['other'],
	),
);

if ( HOT_COFFEE_THEME_FREE ) {
	unset( $hot_coffee_theme_required_plugins['js_composer'] );
	unset( $hot_coffee_theme_required_plugins['booked'] );
	unset( $hot_coffee_theme_required_plugins['quickcal'] );
	unset( $hot_coffee_theme_required_plugins['the-events-calendar'] );
	unset( $hot_coffee_theme_required_plugins['calculated-fields-form'] );
	unset( $hot_coffee_theme_required_plugins['essential-grid'] );
	unset( $hot_coffee_theme_required_plugins['revslider'] );
	unset( $hot_coffee_theme_required_plugins['sitepress-multilingual-cms'] );
	unset( $hot_coffee_theme_required_plugins['trx_updater'] );
	unset( $hot_coffee_theme_required_plugins['trx_popup'] );
}

// Add plugins list to the global storage
hot_coffee_storage_set( 'required_plugins', $hot_coffee_theme_required_plugins );
