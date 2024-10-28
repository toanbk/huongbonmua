<?php
/**
 * The custom template to display the content
 *
 * Used for index/archive/search.
 *
 * @package HOT COFFEE
 * @since HOT COFFEE 1.0.50
 */

$hot_coffee_template_args = get_query_var( 'hot_coffee_template_args' );
if ( is_array( $hot_coffee_template_args ) ) {
	$hot_coffee_columns    = empty( $hot_coffee_template_args['columns'] ) ? 2 : max( 1, $hot_coffee_template_args['columns'] );
	$hot_coffee_blog_style = array( $hot_coffee_template_args['type'], $hot_coffee_columns );
} else {
	$hot_coffee_template_args = array();
	$hot_coffee_blog_style = explode( '_', hot_coffee_get_theme_option( 'blog_style' ) );
	$hot_coffee_columns    = empty( $hot_coffee_blog_style[1] ) ? 2 : max( 1, $hot_coffee_blog_style[1] );
}
$hot_coffee_blog_id       = hot_coffee_get_custom_blog_id( join( '_', $hot_coffee_blog_style ) );
$hot_coffee_blog_style[0] = str_replace( 'blog-custom-', '', $hot_coffee_blog_style[0] );
$hot_coffee_expanded      = ! hot_coffee_sidebar_present() && hot_coffee_get_theme_option( 'expand_content' ) == 'expand';
$hot_coffee_components    = ! empty( $hot_coffee_template_args['meta_parts'] )
							? ( is_array( $hot_coffee_template_args['meta_parts'] )
								? join( ',', $hot_coffee_template_args['meta_parts'] )
								: $hot_coffee_template_args['meta_parts']
								)
							: hot_coffee_array_get_keys_by_value( hot_coffee_get_theme_option( 'meta_parts' ) );
$hot_coffee_post_format   = get_post_format();
$hot_coffee_post_format   = empty( $hot_coffee_post_format ) ? 'standard' : str_replace( 'post-format-', '', $hot_coffee_post_format );

$hot_coffee_blog_meta     = hot_coffee_get_custom_layout_meta( $hot_coffee_blog_id );
$hot_coffee_custom_style  = ! empty( $hot_coffee_blog_meta['scripts_required'] ) ? $hot_coffee_blog_meta['scripts_required'] : 'none';

if ( ! empty( $hot_coffee_template_args['slider'] ) || $hot_coffee_columns > 1 || ! hot_coffee_is_off( $hot_coffee_custom_style ) ) {
	?><div class="
		<?php
		if ( ! empty( $hot_coffee_template_args['slider'] ) ) {
			echo 'slider-slide swiper-slide';
		} else {
			echo esc_attr( ( hot_coffee_is_off( $hot_coffee_custom_style ) ? 'column' : sprintf( '%1$s_item %1$s_item', $hot_coffee_custom_style ) ) . "-1_{$hot_coffee_columns}" );
		}
		?>
	">
	<?php
}
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class(
			'post_item post_item_container post_format_' . esc_attr( $hot_coffee_post_format )
					. ' post_layout_custom post_layout_custom_' . esc_attr( $hot_coffee_columns )
					. ' post_layout_' . esc_attr( $hot_coffee_blog_style[0] )
					. ' post_layout_' . esc_attr( $hot_coffee_blog_style[0] ) . '_' . esc_attr( $hot_coffee_columns )
					. ( ! hot_coffee_is_off( $hot_coffee_custom_style )
						? ' post_layout_' . esc_attr( $hot_coffee_custom_style )
							. ' post_layout_' . esc_attr( $hot_coffee_custom_style ) . '_' . esc_attr( $hot_coffee_columns )
						: ''
						)
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
	// Custom layout
	do_action( 'hot_coffee_action_show_layout', $hot_coffee_blog_id, get_the_ID() );
	?>
</article><?php
if ( ! empty( $hot_coffee_template_args['slider'] ) || $hot_coffee_columns > 1 || ! hot_coffee_is_off( $hot_coffee_custom_style ) ) {
	?></div><?php
	// Need opening PHP-tag above just after </div>, because <div> is a inline-block element (used as column)!
}
