<?php
/**
 * Skin Demo importer
 *
 * @package HOT COFFEE
 * @since HOT COFFEE 1.76.0
 */


// Theme storage
//-------------------------------------------------------------------------

hot_coffee_storage_set( 'theme_demo_url', '//hotcoffee.themerex.net' );


//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( ! function_exists( 'hot_coffee_skin_importer_set_options' ) ) {
	add_filter( 'trx_addons_filter_importer_options', 'hot_coffee_skin_importer_set_options', 9 );
	function hot_coffee_skin_importer_set_options( $options = array() ) {
		if ( is_array( $options ) ) {
			$demo_type = function_exists( 'hot_coffee_skins_get_current_skin_name' ) ? hot_coffee_skins_get_current_skin_name() : 'default';
			if ( 'default' != $demo_type ) {
				$options['demo_type'] = $demo_type;
				$options['files'][ $demo_type ] = $options['files']['default'];
				unset($options['files']['default']);
			}
			$options['files'][ $demo_type ]['title']       = esc_html__( 'Hot Coffee Demo', 'hot-coffee' );
			$options['files'][ $demo_type ]['domain_dev']  = hot_coffee_get_protocol() . '//hot-coffee.dv.themerex.net';  // Developers domain
			$options['files'][ $demo_type ]['domain_demo'] = hot_coffee_storage_get( 'theme_demo_url' ); // Demo-site domain
			if ( substr( $options['files'][ $demo_type ]['domain_demo'], 0, 2 ) === '//' ) {
				$options['files'][ $demo_type ]['domain_demo'] = hot_coffee_get_protocol() . ':' . $options['files'][ $demo_type ]['domain_demo'];
			}
		}
		return $options;
	}
}


//------------------------------------------------------------------------
// OCDI support
//------------------------------------------------------------------------

// Set theme specific OCDI options
if ( ! function_exists( 'hot_coffee_skin_ocdi_set_options' ) ) {
	add_filter( 'trx_addons_filter_ocdi_options', 'hot_coffee_skin_ocdi_set_options', 9 );
	function hot_coffee_skin_ocdi_set_options( $options = array() ) {
		if ( is_array( $options ) ) {
			// Demo-site domain
			$options['files']['ocdi']['title']       = esc_html__( 'Hot Coffee OCDI Demo', 'hot-coffee' );
			$options['files']['ocdi']['domain_demo'] = hot_coffee_storage_get( 'theme_demo_url' );
			if ( substr( $options['files']['ocdi']['domain_demo'], 0, 2 ) === '//' ) {
				$options['files']['ocdi']['domain_demo'] = hot_coffee_get_protocol() . ':' . $options['files']['ocdi']['domain_demo'];
			}
			// If theme need more demo - just copy 'default' and change required parameters
		}
		return $options;
	}
}
