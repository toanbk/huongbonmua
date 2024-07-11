<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package HOT COFFEE
 * @since HOT COFFEE 1.0
 */

$hot_coffee_template_args = get_query_var( 'hot_coffee_template_args' );
$hot_coffee_columns = 1;
if ( is_array( $hot_coffee_template_args ) ) {
	$hot_coffee_columns    = empty( $hot_coffee_template_args['columns'] ) ? 1 : max( 1, $hot_coffee_template_args['columns'] );
	$hot_coffee_blog_style = array( $hot_coffee_template_args['type'], $hot_coffee_columns );
	if ( ! empty( $hot_coffee_template_args['slider'] ) ) {
		?><div class="slider-slide swiper-slide">
		<?php
	} elseif ( $hot_coffee_columns > 1 ) {
	    $hot_coffee_columns_class = hot_coffee_get_column_class( 1, $hot_coffee_columns, ! empty( $hot_coffee_template_args['columns_tablet']) ? $hot_coffee_template_args['columns_tablet'] : '', ! empty($hot_coffee_template_args['columns_mobile']) ? $hot_coffee_template_args['columns_mobile'] : '' );
		?>
		<div class="<?php echo esc_attr( $hot_coffee_columns_class ); ?>">
		<?php
	}
} else {
	$hot_coffee_template_args = array();
}
$hot_coffee_expanded    = ! hot_coffee_sidebar_present() && hot_coffee_get_theme_option( 'expand_content' ) == 'expand';
$hot_coffee_post_format = get_post_format();
$hot_coffee_post_format = empty( $hot_coffee_post_format ) ? 'standard' : str_replace( 'post-format-', '', $hot_coffee_post_format );
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class( 'post_item post_item_container post_layout_excerpt post_format_' . esc_attr( $hot_coffee_post_format ) );
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
			'thumb_size' => ! empty( $hot_coffee_template_args['thumb_size'] )
							? $hot_coffee_template_args['thumb_size']
							: hot_coffee_get_thumb_size( strpos( hot_coffee_get_theme_option( 'body_style' ), 'full' ) !== false
								? 'full'
								: ( $hot_coffee_expanded 
									? 'huge' 
									: 'big' 
									)
								),
		),
		'content-excerpt',
		$hot_coffee_template_args
	) );

	// Title and post meta
	$hot_coffee_show_title = get_the_title() != '';
	$hot_coffee_show_meta  = count( $hot_coffee_components ) > 0 && ! in_array( $hot_coffee_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );

	if ( $hot_coffee_show_title ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			if ( apply_filters( 'hot_coffee_filter_show_blog_title', true, 'excerpt' ) ) {
				do_action( 'hot_coffee_action_before_post_title' );
				if ( empty( $hot_coffee_template_args['no_links'] ) ) {
					the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
				} else {
					the_title( '<h3 class="post_title entry-title">', '</h3>' );
				}
				do_action( 'hot_coffee_action_after_post_title' );
			}
			?>
		</div><!-- .post_header -->
		<?php
	}

	// Post content
	if ( apply_filters( 'hot_coffee_filter_show_blog_excerpt', empty( $hot_coffee_template_args['hide_excerpt'] ) && hot_coffee_get_theme_option( 'excerpt_length' ) > 0, 'excerpt' ) ) {
		?>
		<div class="post_content entry-content">
			<?php

			// Post meta
			if ( apply_filters( 'hot_coffee_filter_show_blog_meta', $hot_coffee_show_meta, $hot_coffee_components, 'excerpt' ) ) {
				if ( count( $hot_coffee_components ) > 0 ) {
					do_action( 'hot_coffee_action_before_post_meta' );
					hot_coffee_show_post_meta(
						apply_filters(
							'hot_coffee_filter_post_meta_args', array(
								'components' => join( ',', $hot_coffee_components ),
								'seo'        => false,
								'echo'       => true,
							), 'excerpt', 1
						)
					);
					do_action( 'hot_coffee_action_after_post_meta' );
				}
			}

			if ( hot_coffee_get_theme_option( 'blog_content' ) == 'fullpost' ) {
				// Post content area
				?>
				<div class="post_content_inner">
					<?php
					do_action( 'hot_coffee_action_before_full_post_content' );
					the_content( '' );
					do_action( 'hot_coffee_action_after_full_post_content' );
					?>
				</div>
				<?php
				// Inner pages
				wp_link_pages(
					array(
						'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'hot-coffee' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'hot-coffee' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					)
				);
			} else {
				// Post content area
				hot_coffee_show_post_content( $hot_coffee_template_args, '<div class="post_content_inner">', '</div>' );
			}

			// More button
			if ( apply_filters( 'hot_coffee_filter_show_blog_readmore',  ! isset( $hot_coffee_template_args['more_button'] ) || ! empty( $hot_coffee_template_args['more_button'] ), 'excerpt' ) ) {
				if ( empty( $hot_coffee_template_args['no_links'] ) ) {
					do_action( 'hot_coffee_action_before_post_readmore' );
					if ( hot_coffee_get_theme_option( 'blog_content' ) != 'fullpost' ) {
						hot_coffee_show_post_more_link( $hot_coffee_template_args, '<p>', '</p>' );
					} else {
						hot_coffee_show_post_comments_link( $hot_coffee_template_args, '<p>', '</p>' );
					}
					do_action( 'hot_coffee_action_after_post_readmore' );
				}
			}

			?>
		</div><!-- .entry-content -->
		<?php
	}
	?>
</article>
<?php

if ( is_array( $hot_coffee_template_args ) ) {
	if ( ! empty( $hot_coffee_template_args['slider'] ) || $hot_coffee_columns > 1 ) {
		?>
		</div>
		<?php
	}
}
