<?php
/**
 * 'Band' template to display the content
 *
 * Used for index/archive/search.
 *
 * @package HOT COFFEE
 * @since HOT COFFEE 1.71.0
 */

$hot_coffee_template_args = get_query_var( 'hot_coffee_template_args' );
if ( ! is_array( $hot_coffee_template_args ) ) {
	$hot_coffee_template_args = array(
								'type'    => 'band',
								'columns' => 1
								);
}

$hot_coffee_columns       = 1;

$hot_coffee_expanded      = ! hot_coffee_sidebar_present() && hot_coffee_get_theme_option( 'expand_content' ) == 'expand';

$hot_coffee_post_format   = get_post_format();
$hot_coffee_post_format   = empty( $hot_coffee_post_format ) ? 'standard' : str_replace( 'post-format-', '', $hot_coffee_post_format );

if ( is_array( $hot_coffee_template_args ) ) {
	$hot_coffee_columns    = empty( $hot_coffee_template_args['columns'] ) ? 1 : max( 1, $hot_coffee_template_args['columns'] );
	$hot_coffee_blog_style = array( $hot_coffee_template_args['type'], $hot_coffee_columns );
	if ( ! empty( $hot_coffee_template_args['slider'] ) ) {
		?><div class="slider-slide swiper-slide">
		<?php
	} elseif ( $hot_coffee_columns > 1 ) {
	    $hot_coffee_columns_class = hot_coffee_get_column_class( 1, $hot_coffee_columns, ! empty( $hot_coffee_template_args['columns_tablet']) ? $hot_coffee_template_args['columns_tablet'] : '', ! empty($hot_coffee_template_args['columns_mobile']) ? $hot_coffee_template_args['columns_mobile'] : '' );
				?><div class="<?php echo esc_attr( $hot_coffee_columns_class ); ?>"><?php
	}
}
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class( 'post_item post_item_container post_layout_band post_format_' . esc_attr( $hot_coffee_post_format ) );
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
								: array_map( 'trim', explode( ',', $hot_coffee_template_args['meta_parts'] ) )
								)
							: hot_coffee_array_get_keys_by_value( hot_coffee_get_theme_option( 'meta_parts' ) );
	hot_coffee_show_post_featured( apply_filters( 'hot_coffee_filter_args_featured',
		array(
			'no_links'   => ! empty( $hot_coffee_template_args['no_links'] ),
			'hover'      => $hot_coffee_hover,
			'meta_parts' => $hot_coffee_components,
			'thumb_bg'   => true,
			'thumb_ratio'   => '1:1',
			'thumb_size' => ! empty( $hot_coffee_template_args['thumb_size'] )
								? $hot_coffee_template_args['thumb_size']
								: hot_coffee_get_thumb_size( 
								in_array( $hot_coffee_post_format, array( 'gallery', 'audio', 'video' ) )
									? ( strpos( hot_coffee_get_theme_option( 'body_style' ), 'full' ) !== false
										? 'full'
										: ( $hot_coffee_expanded 
											? 'big' 
											: 'medium-square'
											)
										)
									: 'masonry-big'
								)
		),
		'content-band',
		$hot_coffee_template_args
	) );

	?><div class="post_content_wrap"><?php

		// Title and post meta
		$hot_coffee_show_title = get_the_title() != '';
		$hot_coffee_show_meta  = count( $hot_coffee_components ) > 0 && ! in_array( $hot_coffee_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );
		if ( $hot_coffee_show_title ) {
			?>
			<div class="post_header entry-header">
				<?php
				// Categories
				if ( apply_filters( 'hot_coffee_filter_show_blog_categories', $hot_coffee_show_meta && in_array( 'categories', $hot_coffee_components ), array( 'categories' ), 'band' ) ) {
					do_action( 'hot_coffee_action_before_post_category' );
					?>
					<div class="post_category">
						<?php
						hot_coffee_show_post_meta( apply_filters(
															'hot_coffee_filter_post_meta_args',
															array(
																'components' => 'categories',
																'seo'        => false,
																'echo'       => true,
																'cat_sep'    => false,
																),
															'hover_' . $hot_coffee_hover, 1
															)
											);
						?>
					</div>
					<?php
					$hot_coffee_components = hot_coffee_array_delete_by_value( $hot_coffee_components, 'categories' );
					do_action( 'hot_coffee_action_after_post_category' );
				}
				// Post title
				if ( apply_filters( 'hot_coffee_filter_show_blog_title', true, 'band' ) ) {
					do_action( 'hot_coffee_action_before_post_title' );
					if ( empty( $hot_coffee_template_args['no_links'] ) ) {
						the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
					} else {
						the_title( '<h4 class="post_title entry-title">', '</h4>' );
					}
					do_action( 'hot_coffee_action_after_post_title' );
				}
				?>
			</div><!-- .post_header -->
			<?php
		}

		// Post content
		if ( ! isset( $hot_coffee_template_args['excerpt_length'] ) && ! in_array( $hot_coffee_post_format, array( 'gallery', 'audio', 'video' ) ) ) {
			$hot_coffee_template_args['excerpt_length'] = 13;
		}
		if ( apply_filters( 'hot_coffee_filter_show_blog_excerpt', empty( $hot_coffee_template_args['hide_excerpt'] ) && hot_coffee_get_theme_option( 'excerpt_length' ) > 0, 'band' ) ) {
			?>
			<div class="post_content entry-content">
				<?php
				// Post content area
				hot_coffee_show_post_content( $hot_coffee_template_args, '<div class="post_content_inner">', '</div>' );
				?>
			</div><!-- .entry-content -->
			<?php
		}
		// Post meta
		if ( apply_filters( 'hot_coffee_filter_show_blog_meta', $hot_coffee_show_meta, $hot_coffee_components, 'band' ) ) {
			if ( count( $hot_coffee_components ) > 0 ) {
				do_action( 'hot_coffee_action_before_post_meta' );
				hot_coffee_show_post_meta(
					apply_filters(
						'hot_coffee_filter_post_meta_args', array(
							'components' => join( ',', $hot_coffee_components ),
							'seo'        => false,
							'echo'       => true,
						), 'band', 1
					)
				);
				do_action( 'hot_coffee_action_after_post_meta' );
			}
		}
		// More button
		if ( apply_filters( 'hot_coffee_filter_show_blog_readmore', ! $hot_coffee_show_title || ! empty( $hot_coffee_template_args['more_button'] ), 'band' ) ) {
			if ( empty( $hot_coffee_template_args['no_links'] ) ) {
				do_action( 'hot_coffee_action_before_post_readmore' );
				hot_coffee_show_post_more_link( $hot_coffee_template_args, '<div class="more-wrap">', '</div>' );
				do_action( 'hot_coffee_action_after_post_readmore' );
			}
		}
		?>
	</div>
</article>
<?php

if ( is_array( $hot_coffee_template_args ) ) {
	if ( ! empty( $hot_coffee_template_args['slider'] ) || $hot_coffee_columns > 1 ) {
		?>
		</div>
		<?php
	}
}
