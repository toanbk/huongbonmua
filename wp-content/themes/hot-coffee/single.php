<?php
/**
 * The template to display single post
 *
 * @package HOT COFFEE
 * @since HOT COFFEE 1.0
 */

// Full post loading
$full_post_loading          = hot_coffee_get_value_gp( 'action' ) == 'full_post_loading';

// Prev post loading
$prev_post_loading          = hot_coffee_get_value_gp( 'action' ) == 'prev_post_loading';
$prev_post_loading_type     = hot_coffee_get_theme_option( 'posts_navigation_scroll_which_block' );

// Position of the related posts
$hot_coffee_related_position   = hot_coffee_get_theme_option( 'related_position' );

// Type of the prev/next post navigation
$hot_coffee_posts_navigation   = hot_coffee_get_theme_option( 'posts_navigation' );
$hot_coffee_prev_post          = false;
$hot_coffee_prev_post_same_cat = hot_coffee_get_theme_option( 'posts_navigation_scroll_same_cat' );

// Rewrite style of the single post if current post loading via AJAX and featured image and title is not in the content
if ( ( $full_post_loading 
		|| 
		( $prev_post_loading && 'article' == $prev_post_loading_type )
	) 
	&& 
	! in_array( hot_coffee_get_theme_option( 'single_style' ), array( 'style-6' ) )
) {
	hot_coffee_storage_set_array( 'options_meta', 'single_style', 'style-6' );
}

do_action( 'hot_coffee_action_prev_post_loading', $prev_post_loading, $prev_post_loading_type );

get_header();

while ( have_posts() ) {

	the_post();

	// Type of the prev/next post navigation
	if ( 'scroll' == $hot_coffee_posts_navigation ) {
		$hot_coffee_prev_post = get_previous_post( $hot_coffee_prev_post_same_cat );  // Get post from same category
		if ( ! $hot_coffee_prev_post && $hot_coffee_prev_post_same_cat ) {
			$hot_coffee_prev_post = get_previous_post( false );                    // Get post from any category
		}
		if ( ! $hot_coffee_prev_post ) {
			$hot_coffee_posts_navigation = 'links';
		}
	}

	// Override some theme options to display featured image, title and post meta in the dynamic loaded posts
	if ( $full_post_loading || ( $prev_post_loading && $hot_coffee_prev_post ) ) {
		hot_coffee_sc_layouts_showed( 'featured', false );
		hot_coffee_sc_layouts_showed( 'title', false );
		hot_coffee_sc_layouts_showed( 'postmeta', false );
	}

	// If related posts should be inside the content
	if ( strpos( $hot_coffee_related_position, 'inside' ) === 0 ) {
		ob_start();
	}

	// Display post's content
	get_template_part( apply_filters( 'hot_coffee_filter_get_template_part', 'templates/content', 'single-' . hot_coffee_get_theme_option( 'single_style' ) ), 'single-' . hot_coffee_get_theme_option( 'single_style' ) );

	// If related posts should be inside the content
	if ( strpos( $hot_coffee_related_position, 'inside' ) === 0 ) {
		$hot_coffee_content = ob_get_contents();
		ob_end_clean();

		ob_start();
		do_action( 'hot_coffee_action_related_posts' );
		$hot_coffee_related_content = ob_get_contents();
		ob_end_clean();

		if ( ! empty( $hot_coffee_related_content ) ) {
			$hot_coffee_related_position_inside = max( 0, min( 9, hot_coffee_get_theme_option( 'related_position_inside' ) ) );
			if ( 0 == $hot_coffee_related_position_inside ) {
				$hot_coffee_related_position_inside = mt_rand( 1, 9 );
			}

			$hot_coffee_p_number         = 0;
			$hot_coffee_related_inserted = false;
			$hot_coffee_in_block         = false;
			$hot_coffee_content_start    = strpos( $hot_coffee_content, '<div class="post_content' );
			$hot_coffee_content_end      = strrpos( $hot_coffee_content, '</div>' );

			for ( $i = max( 0, $hot_coffee_content_start ); $i < min( strlen( $hot_coffee_content ) - 3, $hot_coffee_content_end ); $i++ ) {
				if ( $hot_coffee_content[ $i ] != '<' ) {
					continue;
				}
				if ( $hot_coffee_in_block ) {
					if ( strtolower( substr( $hot_coffee_content, $i + 1, 12 ) ) == '/blockquote>' ) {
						$hot_coffee_in_block = false;
						$i += 12;
					}
					continue;
				} else if ( strtolower( substr( $hot_coffee_content, $i + 1, 10 ) ) == 'blockquote' && in_array( $hot_coffee_content[ $i + 11 ], array( '>', ' ' ) ) ) {
					$hot_coffee_in_block = true;
					$i += 11;
					continue;
				} else if ( 'p' == $hot_coffee_content[ $i + 1 ] && in_array( $hot_coffee_content[ $i + 2 ], array( '>', ' ' ) ) ) {
					$hot_coffee_p_number++;
					if ( $hot_coffee_related_position_inside == $hot_coffee_p_number ) {
						$hot_coffee_related_inserted = true;
						$hot_coffee_content = ( $i > 0 ? substr( $hot_coffee_content, 0, $i ) : '' )
											. $hot_coffee_related_content
											. substr( $hot_coffee_content, $i );
					}
				}
			}
			if ( ! $hot_coffee_related_inserted ) {
				if ( $hot_coffee_content_end > 0 ) {
					$hot_coffee_content = substr( $hot_coffee_content, 0, $hot_coffee_content_end ) . $hot_coffee_related_content . substr( $hot_coffee_content, $hot_coffee_content_end );
				} else {
					$hot_coffee_content .= $hot_coffee_related_content;
				}
			}
		}

		hot_coffee_show_layout( $hot_coffee_content );
	}

	// Comments
	do_action( 'hot_coffee_action_before_comments' );
	comments_template();
	do_action( 'hot_coffee_action_after_comments' );

	// Related posts
	if ( 'below_content' == $hot_coffee_related_position
		&& ( 'scroll' != $hot_coffee_posts_navigation || hot_coffee_get_theme_option( 'posts_navigation_scroll_hide_related' ) == 0 )
		&& ( ! $full_post_loading || hot_coffee_get_theme_option( 'open_full_post_hide_related' ) == 0 )
	) {
		do_action( 'hot_coffee_action_related_posts' );
	}

	// Post navigation: type 'scroll'
	if ( 'scroll' == $hot_coffee_posts_navigation && ! $full_post_loading ) {
		?>
		<div class="nav-links-single-scroll"
			data-post-id="<?php echo esc_attr( get_the_ID( $hot_coffee_prev_post ) ); ?>"
			data-post-link="<?php echo esc_attr( get_permalink( $hot_coffee_prev_post ) ); ?>"
			data-post-title="<?php the_title_attribute( array( 'post' => $hot_coffee_prev_post ) ); ?>"
			<?php do_action( 'hot_coffee_action_nav_links_single_scroll_data', $hot_coffee_prev_post ); ?>
		></div>
		<?php
	}
}

get_footer();
