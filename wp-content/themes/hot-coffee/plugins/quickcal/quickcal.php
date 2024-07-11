<?php
/* QuickCal support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'hot_coffee_quickcal_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'hot_coffee_quickcal_theme_setup9', 9 );
	function hot_coffee_quickcal_theme_setup9() {
		if ( hot_coffee_exists_quickcal() ) {
			add_action( 'wp_enqueue_scripts', 'hot_coffee_quickcal_frontend_scripts', 1100 );
			add_action( 'trx_addons_action_load_scripts_front_quickcal', 'hot_coffee_quickcal_frontend_scripts', 10, 1 );
			add_action( 'wp_enqueue_scripts', 'hot_coffee_quickcal_frontend_scripts_responsive', 2000 );
			add_action( 'trx_addons_action_load_scripts_front_quickcal', 'hot_coffee_quickcal_frontend_scripts_responsive', 10, 1 );
			add_filter( 'hot_coffee_filter_merge_styles', 'hot_coffee_quickcal_merge_styles' );
			add_filter( 'hot_coffee_filter_merge_styles_responsive', 'hot_coffee_quickcal_merge_styles_responsive' );
		}
		if ( is_admin() ) {
			add_filter( 'hot_coffee_filter_tgmpa_required_plugins', 'hot_coffee_quickcal_tgmpa_required_plugins' );
			add_filter( 'hot_coffee_filter_theme_plugins', 'hot_coffee_quickcal_theme_plugins' );
		}
	}
}


// Filter to add in the required plugins list
if ( ! function_exists( 'hot_coffee_quickcal_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('hot_coffee_filter_tgmpa_required_plugins',	'hot_coffee_quickcal_tgmpa_required_plugins');
	function hot_coffee_quickcal_tgmpa_required_plugins( $list = array() ) {
		if ( hot_coffee_storage_isset( 'required_plugins', 'quickcal' ) && hot_coffee_storage_get_array( 'required_plugins', 'quickcal', 'install' ) !== false && hot_coffee_is_theme_activated() ) {
			$path = hot_coffee_get_plugin_source_path( 'plugins/quickcal/quickcal.zip' );
			if ( ! empty( $path ) || hot_coffee_get_theme_setting( 'tgmpa_upload' ) ) {
				$list[] = array(
					'name'     => hot_coffee_storage_get_array( 'required_plugins', 'quickcal', 'title' ),
					'slug'     => 'quickcal',
					'source'   => ! empty( $path ) ? $path : 'upload://quickcal.zip',
					'version'  => '1.0.6',
					'required' => false,
				);
			}
		}
		return $list;
	}
}


// Filter theme-supported plugins list
if ( ! function_exists( 'hot_coffee_quickcal_theme_plugins' ) ) {
	//Handler of the add_filter( 'hot_coffee_filter_theme_plugins', 'hot_coffee_quickcal_theme_plugins' );
	function hot_coffee_quickcal_theme_plugins( $list = array() ) {
		return hot_coffee_add_group_and_logo_to_slave( $list, 'quickcal', 'quickcal-' );
	}
}


// Check if plugin installed and activated
if ( ! function_exists( 'hot_coffee_exists_quickcal' ) ) {
	function hot_coffee_exists_quickcal() {
		return class_exists( 'quickcal_plugin' );
	}
}

// Enqueue styles for frontend
if ( ! function_exists( 'hot_coffee_quickcal_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'hot_coffee_quickcal_frontend_scripts', 1100 );
	//Handler of the add_action( 'trx_addons_action_load_scripts_front_quickcal', 'hot_coffee_quickcal_frontend_scripts', 10, 1 );
	function hot_coffee_quickcal_frontend_scripts( $force = false ) {
		hot_coffee_enqueue_optimized( 'quickcal', $force, array(
			'css' => array(
				'hot-coffee-quickcal' => array( 'src' => 'plugins/quickcal/quickcal.css' ),
			)
		) );
	}
}


// Enqueue responsive styles for frontend
if ( ! function_exists( 'hot_coffee_quickcal_frontend_scripts_responsive' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'hot_coffee_quickcal_frontend_scripts_responsive', 2000 );
	//Handler of the add_action( 'trx_addons_action_load_scripts_front_quickcal', 'hot_coffee_quickcal_frontend_scripts_responsive', 10, 1 );
	function hot_coffee_quickcal_frontend_scripts_responsive( $force = false ) {
		hot_coffee_enqueue_optimized_responsive( 'quickcal', $force, array(
			'css' => array(
				'hot-coffee-quickcal-responsive' => array( 'src' => 'plugins/quickcal/quickcal-responsive.css', 'media' => 'all' ),
			)
		) );
	}
}


// Merge custom styles
if ( ! function_exists( 'hot_coffee_quickcal_merge_styles' ) ) {
	//Handler of the add_filter('hot_coffee_filter_merge_styles', 'hot_coffee_quickcal_merge_styles');
	function hot_coffee_quickcal_merge_styles( $list ) {
		$list[ 'plugins/quickcal/quickcal.css' ] = false;
		return $list;
	}
}


// Merge responsive styles
if ( ! function_exists( 'hot_coffee_quickcal_merge_styles_responsive' ) ) {
	//Handler of the add_filter('hot_coffee_filter_merge_styles_responsive', 'hot_coffee_quickcal_merge_styles_responsive');
	function hot_coffee_quickcal_merge_styles_responsive( $list ) {
		$list[ 'plugins/quickcal/quickcal-responsive.css' ] = false;
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( hot_coffee_exists_quickcal() ) {
	$hot_coffee_fdir = hot_coffee_get_file_dir( 'plugins/quickcal/quickcal-style.php' );
	if ( ! empty( $hot_coffee_fdir ) ) {
		require_once $hot_coffee_fdir;
	}
}
