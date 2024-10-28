<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package HOT COFFEE
 * @since HOT COFFEE 1.0
 */

$hot_coffee_template_args = get_query_var( 'hot_coffee_template_args' );

if ( is_array( $hot_coffee_template_args ) ) {
	$hot_coffee_columns    = empty( $hot_coffee_template_args['columns'] ) ? 2 : max( 1, $hot_coffee_template_args['columns'] );
	$hot_coffee_blog_style = array( $hot_coffee_template_args['type'], $hot_coffee_columns );
    $hot_coffee_columns_class = hot_coffee_get_column_class( 1, $hot_coffee_columns, ! empty( $hot_coffee_template_args['columns_tablet']) ? $hot_coffee_template_args['columns_tablet'] : '', ! empty($hot_coffee_template_args['columns_mobile']) ? $hot_coffee_template_args['columns_mobile'] : '' );
} else {
	$hot_coffee_template_args = array();
	$hot_coffee_blog_style = explode( '_', hot_coffee_get_theme_option( 'blog_style' ) );
	$hot_coffee_columns    = empty( $hot_coffee_blog_style[1] ) ? 2 : max( 1, $hot_coffee_blog_style[1] );
    $hot_coffee_columns_class = hot_coffee_get_column_class( 1, $hot_coffee_columns );
}
$hot_coffee_expanded   = ! hot_coffee_sidebar_present() && hot_coffee_get_theme_option( 'expand_content' ) == 'expand';

$hot_coffee_post_format = get_post_format();
$hot_coffee_post_format = empty( $hot_coffee_post_format ) ? 'standard' : str_replace( 'post-format-', '', $hot_coffee_post_format );

?><div class="<?php
	if ( ! empty( $hot_coffee_template_args['slider'] ) ) {
		echo ' slider-slide swiper-slide';
	} else {
		echo ( hot_coffee_is_blog_style_use_masonry( $hot_coffee_blog_style[0] ) ? 'masonry_item masonry_item-1_' . esc_attr( $hot_coffee_columns ) : esc_attr( $hot_coffee_columns_class ) );
	}
?>"><article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class(
		'post_item post_item_container post_format_' . esc_attr( $hot_coffee_post_format )
				. ' post_layout_classic post_layout_classic_' . esc_attr( $hot_coffee_columns )
				. ' post_layout_' . esc_attr( $hot_coffee_blog_style[0] )
				. ' post_layout_' . esc_attr( $hot_coffee_blog_style[0] ) . '_' . esc_attr( $hot_coffee_columns )
	);
	hot_coffee_add_blog_animation( $hot_coffee_template_args );
	?>
>
	<?php

	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}

	// Featured image
	$hot_coffee_hover      = ! empty( $hot_coffee_template_args['hover'] ) && ! hot_coffee_is_inherit( $hot_coffee_template_args['hover'] )
							? $hot_coffee_template_args['hover']
							: hot_coffee_get_theme_option( 'image_hover' );

	$hot_coffee_components = ! empty( $hot_coffee_template_args['meta_parts'] )
							? ( is_array( $hot_coffee_template_args['meta_parts'] )
								? $hot_coffee_template_args['meta_parts']
								: explode( ',', $hot_coffee_template_args['meta_parts'] )
								)
							: hot_coffee_array_get_keys_by_value( hot_coffee_get_theme_option( 'meta_parts' ) );

	hot_coffee_show_post_featured( apply_filters( 'hot_coffee_filter_args_featured',
		array(
			'thumb_size' => ! empty( $hot_coffee_template_args['thumb_size'] )
				? $hot_coffee_template_args['thumb_size']
				: hot_coffee_get_thumb_size(
				'classic' == $hot_coffee_blog_style[0]
						? ( strpos( hot_coffee_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $hot_coffee_columns > 2 ? 'big' : 'huge' )
								: ( $hot_coffee_columns > 2
									? ( $hot_coffee_expanded ? 'square' : 'square' )
									: ($hot_coffee_columns > 1 ? 'square' : ( $hot_coffee_expanded ? 'huge' : 'big' ))
									)
							)
						: ( strpos( hot_coffee_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $hot_coffee_columns > 2 ? 'masonry-big' : 'full' )
								: ($hot_coffee_columns === 1 ? ( $hot_coffee_expanded ? 'huge' : 'big' ) : ( $hot_coffee_columns <= 2 && $hot_coffee_expanded ? 'masonry-big' : 'masonry' ))
							)
			),
			'hover'      => $hot_coffee_hover,
			'meta_parts' => $hot_coffee_components,
			'no_links'   => ! empty( $hot_coffee_template_args['no_links'] ),
        ),
        'content-classic',
        $hot_coffee_template_args
    ) );

	// Title and post meta
	$hot_coffee_show_title = get_the_title() != '';
	$hot_coffee_show_meta  = count( $hot_coffee_components ) > 0 && ! in_array( $hot_coffee_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );

	if ( $hot_coffee_show_title ) {
		?>
		<div class="post_header entry-header">
			<?php

			// Post meta
			if ( apply_filters( 'hot_coffee_filter_show_blog_meta', $hot_coffee_show_meta, $hot_coffee_components, 'classic' ) ) {
				if ( count( $hot_coffee_components ) > 0 ) {
					do_action( 'hot_coffee_action_before_post_meta' );
					hot_coffee_show_post_meta(
						apply_filters(
							'hot_coffee_filter_post_meta_args', array(
							'components' => join( ',', $hot_coffee_components ),
							'seo'        => false,
							'echo'       => true,
						), $hot_coffee_blog_style[0], $hot_coffee_columns
						)
					);
					do_action( 'hot_coffee_action_after_post_meta' );
				}
			}

			// Post title
			if ( apply_filters( 'hot_coffee_filter_show_blog_title', true, 'classic' ) ) {
				do_action( 'hot_coffee_action_before_post_title' );
				if ( empty( $hot_coffee_template_args['no_links'] ) ) {
					the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
				} else {
					the_title( '<h4 class="post_title entry-title">', '</h4>' );
				}
				do_action( 'hot_coffee_action_after_post_title' );
			}

			if( !in_array( $hot_coffee_post_format, array( 'quote', 'aside', 'link', 'status' ) ) ) {
				// More button
				if ( apply_filters( 'hot_coffee_filter_show_blog_readmore', ! $hot_coffee_show_title || ! empty( $hot_coffee_template_args['more_button'] ), 'classic' ) ) {
					if ( empty( $hot_coffee_template_args['no_links'] ) ) {
						do_action( 'hot_coffee_action_before_post_readmore' );
						hot_coffee_show_post_more_link( $hot_coffee_template_args, '<div class="more-wrap">', '</div>' );
						do_action( 'hot_coffee_action_after_post_readmore' );
					}
				}
			}
			?>
		</div><!-- .entry-header -->
		<?php
	}

	// Post content
	if( in_array( $hot_coffee_post_format, array( 'quote', 'aside', 'link', 'status' ) ) ) {
		ob_start();
		if (apply_filters('hot_coffee_filter_show_blog_excerpt', empty($hot_coffee_template_args['hide_excerpt']) && hot_coffee_get_theme_option('excerpt_length') > 0, 'classic')) {
			hot_coffee_show_post_content($hot_coffee_template_args, '<div class="post_content_inner">', '</div>');
		}
		// More button
		if(! empty( $hot_coffee_template_args['more_button'] )) {
			if ( empty( $hot_coffee_template_args['no_links'] ) ) {
				do_action( 'hot_coffee_action_before_post_readmore' );
				hot_coffee_show_post_more_link( $hot_coffee_template_args, '<div class="more-wrap">', '</div>' );
				do_action( 'hot_coffee_action_after_post_readmore' );
			}
		}
		$hot_coffee_content = ob_get_contents();
		ob_end_clean();
		hot_coffee_show_layout($hot_coffee_content, '<div class="post_content entry-content">', '</div><!-- .entry-content -->');
	}
	?>

</article></div><?php
// Need opening PHP-tag above, because <div> is a inline-block element (used as column)!
