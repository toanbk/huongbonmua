<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package HOT COFFEE
 * @since HOT COFFEE 1.0
 */

							do_action( 'hot_coffee_action_page_content_end_text' );
							
							// Widgets area below the content
							hot_coffee_create_widgets_area( 'widgets_below_content' );
						
							do_action( 'hot_coffee_action_page_content_end' );
							?>
						</div>
						<?php
						
						do_action( 'hot_coffee_action_after_page_content' );

						// Show main sidebar
						get_sidebar();

						do_action( 'hot_coffee_action_content_wrap_end' );
						?>
					</div>
					<?php

					do_action( 'hot_coffee_action_after_content_wrap' );

					// Widgets area below the page and related posts below the page
					$hot_coffee_body_style = hot_coffee_get_theme_option( 'body_style' );
					$hot_coffee_widgets_name = hot_coffee_get_theme_option( 'widgets_below_page' );
					$hot_coffee_show_widgets = ! hot_coffee_is_off( $hot_coffee_widgets_name ) && is_active_sidebar( $hot_coffee_widgets_name );
					$hot_coffee_show_related = hot_coffee_is_single() && hot_coffee_get_theme_option( 'related_position' ) == 'below_page';
					if ( $hot_coffee_show_widgets || $hot_coffee_show_related ) {
						if ( 'fullscreen' != $hot_coffee_body_style ) {
							?>
							<div class="content_wrap">
							<?php
						}
						// Show related posts before footer
						if ( $hot_coffee_show_related ) {
							do_action( 'hot_coffee_action_related_posts' );
						}

						// Widgets area below page content
						if ( $hot_coffee_show_widgets ) {
							hot_coffee_create_widgets_area( 'widgets_below_page' );
						}
						if ( 'fullscreen' != $hot_coffee_body_style ) {
							?>
							</div>
							<?php
						}
					}
					do_action( 'hot_coffee_action_page_content_wrap_end' );
					?>
			</div>
			<?php
			do_action( 'hot_coffee_action_after_page_content_wrap' );

			// Don't display the footer elements while actions 'full_post_loading' and 'prev_post_loading'
			if ( ( ! hot_coffee_is_singular( 'post' ) && ! hot_coffee_is_singular( 'attachment' ) ) || ! in_array ( hot_coffee_get_value_gp( 'action' ), array( 'full_post_loading', 'prev_post_loading' ) ) ) {
				
				// Skip link anchor to fast access to the footer from keyboard
				?>
				<a id="footer_skip_link_anchor" class="hot_coffee_skip_link_anchor" href="#"></a>
				<?php

				do_action( 'hot_coffee_action_before_footer' );

				// Footer
				$hot_coffee_footer_type = hot_coffee_get_theme_option( 'footer_type' );
				if ( 'custom' == $hot_coffee_footer_type && ! hot_coffee_is_layouts_available() ) {
					$hot_coffee_footer_type = 'default';
				}
				get_template_part( apply_filters( 'hot_coffee_filter_get_template_part', "templates/footer-" . sanitize_file_name( $hot_coffee_footer_type ) ) );

				do_action( 'hot_coffee_action_after_footer' );

			}
			?>

			<?php do_action( 'hot_coffee_action_page_wrap_end' ); ?>

		</div>

		<?php do_action( 'hot_coffee_action_after_page_wrap' ); ?>

	</div>

	<?php do_action( 'hot_coffee_action_after_body' ); ?>

	<?php wp_footer(); ?>

</body>
</html>