<?php
/**
 * The template 'Style 1' to displaying related posts
 *
 * @package HOT COFFEE
 * @since HOT COFFEE 1.0
 */

$hot_coffee_link        = get_permalink();
$hot_coffee_post_format = get_post_format();
$hot_coffee_post_format = empty( $hot_coffee_post_format ) ? 'standard' : str_replace( 'post-format-', '', $hot_coffee_post_format );
?><div id="post-<?php the_ID(); ?>" <?php post_class( 'related_item post_format_' . esc_attr( $hot_coffee_post_format ) ); ?> data-post-id="<?php the_ID(); ?>">
	<?php
	hot_coffee_show_post_featured(
		array(
			'thumb_size'    => apply_filters( 'hot_coffee_filter_related_thumb_size', hot_coffee_get_thumb_size( (int) hot_coffee_get_theme_option( 'related_posts' ) == 1 ? 'huge' : 'big' ) ),
			'post_info'     => '<div class="post_header entry-header">'
									. '<div class="post_categories">' . wp_kses( hot_coffee_get_post_categories( '' ), 'hot_coffee_kses_content' ) . '</div>'
									. '<h6 class="post_title entry-title"><a href="' . esc_url( $hot_coffee_link ) . '">'
										. wp_kses_data( '' == get_the_title() ? esc_html__( '- No title -', 'hot-coffee' ) : get_the_title() )
									. '</a></h6>'
									. ( in_array( get_post_type(), array( 'post', 'attachment' ) )
											? '<div class="post_meta"><a href="' . esc_url( $hot_coffee_link ) . '" class="post_meta_item post_date">' . wp_kses_data( hot_coffee_get_date() ) . '</a></div>'
											: '' )
								. '</div>',
		)
	);
	?>
</div>
