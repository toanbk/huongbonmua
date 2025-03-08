<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package HOT COFFEE
 * @since HOT COFFEE 1.0
 */

// Page (category, tag, archive, author) title

if ( hot_coffee_need_page_title() ) {
	hot_coffee_sc_layouts_showed( 'title', true );
	hot_coffee_sc_layouts_showed( 'postmeta', true );
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Post meta on the single post
						if ( is_single() ) {
							?>
							<div class="sc_layouts_title_meta">
							<?php
								hot_coffee_show_post_meta(
									apply_filters(
										'hot_coffee_filter_post_meta_args', array(
											'components' => join( ',', hot_coffee_array_get_keys_by_value( hot_coffee_get_theme_option( 'meta_parts' ) ) ),
											'counters'   => join( ',', hot_coffee_array_get_keys_by_value( hot_coffee_get_theme_option( 'counters' ) ) ),
											'seo'        => hot_coffee_is_on( hot_coffee_get_theme_option( 'seo_snippets' ) ),
										), 'header', 1
									)
								);
							?>
							</div>
							<?php
						}

						// Blog/Post title
						?>
						<div class="sc_layouts_title_title">
							<?php
							$hot_coffee_blog_title           = hot_coffee_get_blog_title();
							$hot_coffee_blog_title_text      = '';
							$hot_coffee_blog_title_class     = '';
							$hot_coffee_blog_title_link      = '';
							$hot_coffee_blog_title_link_text = '';
							if ( is_array( $hot_coffee_blog_title ) ) {
								$hot_coffee_blog_title_text      = $hot_coffee_blog_title['text'];
								$hot_coffee_blog_title_class     = ! empty( $hot_coffee_blog_title['class'] ) ? ' ' . $hot_coffee_blog_title['class'] : '';
								$hot_coffee_blog_title_link      = ! empty( $hot_coffee_blog_title['link'] ) ? $hot_coffee_blog_title['link'] : '';
								$hot_coffee_blog_title_link_text = ! empty( $hot_coffee_blog_title['link_text'] ) ? $hot_coffee_blog_title['link_text'] : '';
							} else {
								$hot_coffee_blog_title_text = $hot_coffee_blog_title;
							}
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr( $hot_coffee_blog_title_class ); ?>">
								<?php
								$hot_coffee_top_icon = hot_coffee_get_term_image_small();
								if ( ! empty( $hot_coffee_top_icon ) ) {
									$hot_coffee_attr = hot_coffee_getimagesize( $hot_coffee_top_icon );
									?>
									<img src="<?php echo esc_url( $hot_coffee_top_icon ); ?>" alt="<?php esc_attr_e( 'Site icon', 'hot-coffee' ); ?>"
										<?php
										if ( ! empty( $hot_coffee_attr[3] ) ) {
											hot_coffee_show_layout( $hot_coffee_attr[3] );
										}
										?>
									>
									<?php
								}
								echo wp_kses_data( $hot_coffee_blog_title_text );
								?>
							</h1>
							<?php
							if ( ! empty( $hot_coffee_blog_title_link ) && ! empty( $hot_coffee_blog_title_link_text ) ) {
								?>
								<a href="<?php echo esc_url( $hot_coffee_blog_title_link ); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html( $hot_coffee_blog_title_link_text ); ?></a>
								<?php
							}

							// Category/Tag description
							if ( ! is_paged() && ( is_category() || is_tag() || is_tax() ) ) {
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
							}

							?>
						</div>
						<?php

						// Breadcrumbs
						ob_start();
						do_action( 'hot_coffee_action_breadcrumbs' );
						$hot_coffee_breadcrumbs = ob_get_contents();
						ob_end_clean();
						hot_coffee_show_layout( $hot_coffee_breadcrumbs, '<div class="sc_layouts_title_breadcrumbs">', '</div>' );
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
