<?php
/* Essential Grid support functions
------------------------------------------------------------------------------- */


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'hot_coffee_essential_grid_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'hot_coffee_essential_grid_theme_setup9', 9 );
	function hot_coffee_essential_grid_theme_setup9() {
		if ( hot_coffee_exists_essential_grid() ) {
			add_action( 'wp_enqueue_scripts', 'hot_coffee_essential_grid_frontend_scripts', 1100 );
			add_action( 'trx_addons_action_load_scripts_front_essential_grid', 'hot_coffee_essential_grid_frontend_scripts', 10, 1 );
			add_filter( 'hot_coffee_filter_merge_styles', 'hot_coffee_essential_grid_merge_styles' );
		}
		if ( is_admin() ) {
			add_filter( 'hot_coffee_filter_tgmpa_required_plugins', 'hot_coffee_essential_grid_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'hot_coffee_essential_grid_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('hot_coffee_filter_tgmpa_required_plugins',	'hot_coffee_essential_grid_tgmpa_required_plugins');
	function hot_coffee_essential_grid_tgmpa_required_plugins( $list = array() ) {
		if ( hot_coffee_storage_isset( 'required_plugins', 'essential-grid' ) && hot_coffee_storage_get_array( 'required_plugins', 'essential-grid', 'install' ) !== false && hot_coffee_is_theme_activated() ) {
			$path = hot_coffee_get_plugin_source_path( 'plugins/essential-grid/essential-grid.zip' );
			if ( ! empty( $path ) || hot_coffee_get_theme_setting( 'tgmpa_upload' ) ) {
				$list[] = array(
					'name'     => hot_coffee_storage_get_array( 'required_plugins', 'essential-grid', 'title' ),
					'slug'     => 'essential-grid',
					'source'   => ! empty( $path ) ? $path : 'upload://essential-grid.zip',
					'version'  => '2.2.4.2',
					'required' => false,
				);
			}
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( ! function_exists( 'hot_coffee_exists_essential_grid' ) ) {
	function hot_coffee_exists_essential_grid() {
		return defined( 'EG_PLUGIN_PATH' ) || defined( 'ESG_PLUGIN_PATH' );
	}
}

// Enqueue styles for frontend
if ( ! function_exists( 'hot_coffee_essential_grid_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'hot_coffee_essential_grid_frontend_scripts', 1100 );
	//Handler of the add_action( 'trx_addons_action_load_scripts_front_essential_grid', 'hot_coffee_essential_grid_frontend_scripts', 10, 1 );
	function hot_coffee_essential_grid_frontend_scripts( $force = false ) {
		hot_coffee_enqueue_optimized( 'essential_grid', $force, array(
			'css' => array(
				'hot-coffee-essential-grid' => array( 'src' => 'plugins/essential-grid/essential-grid.css' ),
			)
		) );
	}
}

// Merge custom styles
if ( ! function_exists( 'hot_coffee_essential_grid_merge_styles' ) ) {
	//Handler of the add_filter('hot_coffee_filter_merge_styles', 'hot_coffee_essential_grid_merge_styles');
	function hot_coffee_essential_grid_merge_styles( $list ) {
		$list[ 'plugins/essential-grid/essential-grid.css' ] = false;
		return $list;
	}
}
