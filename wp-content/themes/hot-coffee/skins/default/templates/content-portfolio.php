<?php
/**
 * The Portfolio template to display the content
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

$hot_coffee_post_format = get_post_format();
$hot_coffee_post_format = empty( $hot_coffee_post_format ) ? 'standard' : str_replace( 'post-format-', '', $hot_coffee_post_format );

?><div class="
<?php
if ( ! empty( $hot_coffee_template_args['slider'] ) ) {
	echo ' slider-slide swiper-slide';
} else {
	echo ( hot_coffee_is_blog_style_use_masonry( $hot_coffee_blog_style[0] ) ? 'masonry_item masonry_item-1_' . esc_attr( $hot_coffee_columns ) : esc_attr( $hot_coffee_columns_class ));
}
?>
"><article id="post-<?php the_ID(); ?>" 
	<?php
	post_class(
		'post_item post_item_container post_format_' . esc_attr( $hot_coffee_post_format )
		. ' post_layout_portfolio'
		. ' post_layout_portfolio_' . esc_attr( $hot_coffee_columns )
		. ( 'portfolio' != $hot_coffee_blog_style[0] ? ' ' . esc_attr( $hot_coffee_blog_style[0] )  . '_' . esc_attr( $hot_coffee_columns ) : '' )
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

	$hot_coffee_hover   = ! empty( $hot_coffee_template_args['hover'] ) && ! hot_coffee_is_inherit( $hot_coffee_template_args['hover'] )
								? $hot_coffee_template_args['hover']
								: hot_coffee_get_theme_option( 'image_hover' );

	if ( 'dots' == $hot_coffee_hover ) {
		$hot_coffee_post_link = empty( $hot_coffee_template_args['no_links'] )
								? ( ! empty( $hot_coffee_template_args['link'] )
									? $hot_coffee_template_args['link']
									: get_permalink()
									)
								: '';
		$hot_coffee_target    = ! empty( $hot_coffee_post_link ) && false === strpos( $hot_coffee_post_link, home_url() )
								? ' target="_blank" rel="nofollow"'
								: '';
	}
	
	// Meta parts
	$hot_coffee_components = ! empty( $hot_coffee_template_args['meta_parts'] )
							? ( is_array( $hot_coffee_template_args['meta_parts'] )
								? $hot_coffee_template_args['meta_parts']
								: explode( ',', $hot_coffee_template_args['meta_parts'] )
								)
							: hot_coffee_array_get_keys_by_value( hot_coffee_get_theme_option( 'meta_parts' ) );

	// Featured image
	hot_coffee_show_post_featured( apply_filters( 'hot_coffee_filter_args_featured',
		array(
			'hover'         => $hot_coffee_hover,
			'no_links'      => ! empty( $hot_coffee_template_args['no_links'] ),
			'thumb_size'    => ! empty( $hot_coffee_template_args['thumb_size'] )
								? $hot_coffee_template_args['thumb_size']
								: hot_coffee_get_thumb_size(
									hot_coffee_is_blog_style_use_masonry( $hot_coffee_blog_style[0] )
										? (	strpos( hot_coffee_get_theme_option( 'body_style' ), 'full' ) !== false || $hot_coffee_columns < 3
											? 'masonry-big'
											: 'masonry'
											)
										: (	strpos( hot_coffee_get_theme_option( 'body_style' ), 'full' ) !== false || $hot_coffee_columns < 3
											? 'square'
											: 'square'
											)
								),
			'thumb_bg' => hot_coffee_is_blog_style_use_masonry( $hot_coffee_blog_style[0] ) ? false : true,
			'show_no_image' => true,
			'meta_parts'    => $hot_coffee_components,
			'class'         => 'dots' == $hot_coffee_hover ? 'hover_with_info' : '',
			'post_info'     => 'dots' == $hot_coffee_hover
										? '<div class="post_info"><h5 class="post_title">'
											. ( ! empty( $hot_coffee_post_link )
												? '<a href="' . esc_url( $hot_coffee_post_link ) . '"' . ( ! empty( $target ) ? $target : '' ) . '>'
												: ''
												)
												. esc_html( get_the_title() ) 
											. ( ! empty( $hot_coffee_post_link )
												? '</a>'
												: ''
												)
											. '</h5></div>'
										: '',
            'thumb_ratio'   => 'info' == $hot_coffee_hover ?  '100:102' : '',
        ),
        'content-portfolio',
        $hot_coffee_template_args
    ) );
	?>
</article></div><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!