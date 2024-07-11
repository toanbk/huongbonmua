<?php
$hot_coffee_woocommerce_sc = hot_coffee_get_theme_option( 'front_page_woocommerce_products' );
if ( ! empty( $hot_coffee_woocommerce_sc ) ) {
	?><div class="front_page_section front_page_section_woocommerce<?php
		$hot_coffee_scheme = hot_coffee_get_theme_option( 'front_page_woocommerce_scheme' );
		if ( ! empty( $hot_coffee_scheme ) && ! hot_coffee_is_inherit( $hot_coffee_scheme ) ) {
			echo ' scheme_' . esc_attr( $hot_coffee_scheme );
		}
		echo ' front_page_section_paddings_' . esc_attr( hot_coffee_get_theme_option( 'front_page_woocommerce_paddings' ) );
		if ( hot_coffee_get_theme_option( 'front_page_woocommerce_stack' ) ) {
			echo ' sc_stack_section_on';
		}
	?>"
			<?php
			$hot_coffee_css      = '';
			$hot_coffee_bg_image = hot_coffee_get_theme_option( 'front_page_woocommerce_bg_image' );
			if ( ! empty( $hot_coffee_bg_image ) ) {
				$hot_coffee_css .= 'background-image: url(' . esc_url( hot_coffee_get_attachment_url( $hot_coffee_bg_image ) ) . ');';
			}
			if ( ! empty( $hot_coffee_css ) ) {
				echo ' style="' . esc_attr( $hot_coffee_css ) . '"';
			}
			?>
	>
	<?php
		// Add anchor
		$hot_coffee_anchor_icon = hot_coffee_get_theme_option( 'front_page_woocommerce_anchor_icon' );
		$hot_coffee_anchor_text = hot_coffee_get_theme_option( 'front_page_woocommerce_anchor_text' );
		if ( ( ! empty( $hot_coffee_anchor_icon ) || ! empty( $hot_coffee_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
			echo do_shortcode(
				'[trx_sc_anchor id="front_page_section_woocommerce"'
											. ( ! empty( $hot_coffee_anchor_icon ) ? ' icon="' . esc_attr( $hot_coffee_anchor_icon ) . '"' : '' )
											. ( ! empty( $hot_coffee_anchor_text ) ? ' title="' . esc_attr( $hot_coffee_anchor_text ) . '"' : '' )
											. ']'
			);
		}
	?>
		<div class="front_page_section_inner front_page_section_woocommerce_inner
			<?php
			if ( hot_coffee_get_theme_option( 'front_page_woocommerce_fullheight' ) ) {
				echo ' hot-coffee-full-height sc_layouts_flex sc_layouts_columns_middle';
			}
			?>
				"
				<?php
				$hot_coffee_css      = '';
				$hot_coffee_bg_mask  = hot_coffee_get_theme_option( 'front_page_woocommerce_bg_mask' );
				$hot_coffee_bg_color_type = hot_coffee_get_theme_option( 'front_page_woocommerce_bg_color_type' );
				if ( 'custom' == $hot_coffee_bg_color_type ) {
					$hot_coffee_bg_color = hot_coffee_get_theme_option( 'front_page_woocommerce_bg_color' );
				} elseif ( 'scheme_bg_color' == $hot_coffee_bg_color_type ) {
					$hot_coffee_bg_color = hot_coffee_get_scheme_color( 'bg_color', $hot_coffee_scheme );
				} else {
					$hot_coffee_bg_color = '';
				}
				if ( ! empty( $hot_coffee_bg_color ) && $hot_coffee_bg_mask > 0 ) {
					$hot_coffee_css .= 'background-color: ' . esc_attr(
						1 == $hot_coffee_bg_mask ? $hot_coffee_bg_color : hot_coffee_hex2rgba( $hot_coffee_bg_color, $hot_coffee_bg_mask )
					) . ';';
				}
				if ( ! empty( $hot_coffee_css ) ) {
					echo ' style="' . esc_attr( $hot_coffee_css ) . '"';
				}
				?>
		>
			<div class="front_page_section_content_wrap front_page_section_woocommerce_content_wrap content_wrap woocommerce">
				<?php
				// Content wrap with title and description
				$hot_coffee_caption     = hot_coffee_get_theme_option( 'front_page_woocommerce_caption' );
				$hot_coffee_description = hot_coffee_get_theme_option( 'front_page_woocommerce_description' );
				if ( ! empty( $hot_coffee_caption ) || ! empty( $hot_coffee_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					// Caption
					if ( ! empty( $hot_coffee_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
						?>
						<h2 class="front_page_section_caption front_page_section_woocommerce_caption front_page_block_<?php echo ! empty( $hot_coffee_caption ) ? 'filled' : 'empty'; ?>">
						<?php
							echo wp_kses( $hot_coffee_caption, 'hot_coffee_kses_content' );
						?>
						</h2>
						<?php
					}

					// Description (text)
					if ( ! empty( $hot_coffee_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
						?>
						<div class="front_page_section_description front_page_section_woocommerce_description front_page_block_<?php echo ! empty( $hot_coffee_description ) ? 'filled' : 'empty'; ?>">
						<?php
							echo wp_kses( wpautop( $hot_coffee_description ), 'hot_coffee_kses_content' );
						?>
						</div>
						<?php
					}
				}

				// Content (widgets)
				?>
				<div class="front_page_section_output front_page_section_woocommerce_output list_products shop_mode_thumbs">
					<?php
					if ( 'products' == $hot_coffee_woocommerce_sc ) {
						$hot_coffee_woocommerce_sc_ids      = hot_coffee_get_theme_option( 'front_page_woocommerce_products_per_page' );
						$hot_coffee_woocommerce_sc_per_page = count( explode( ',', $hot_coffee_woocommerce_sc_ids ) );
					} else {
						$hot_coffee_woocommerce_sc_per_page = max( 1, (int) hot_coffee_get_theme_option( 'front_page_woocommerce_products_per_page' ) );
					}
					$hot_coffee_woocommerce_sc_columns = max( 1, min( $hot_coffee_woocommerce_sc_per_page, (int) hot_coffee_get_theme_option( 'front_page_woocommerce_products_columns' ) ) );
					echo do_shortcode(
						"[{$hot_coffee_woocommerce_sc}"
										. ( 'products' == $hot_coffee_woocommerce_sc
												? ' ids="' . esc_attr( $hot_coffee_woocommerce_sc_ids ) . '"'
												: '' )
										. ( 'product_category' == $hot_coffee_woocommerce_sc
												? ' category="' . esc_attr( hot_coffee_get_theme_option( 'front_page_woocommerce_products_categories' ) ) . '"'
												: '' )
										. ( 'best_selling_products' != $hot_coffee_woocommerce_sc
												? ' orderby="' . esc_attr( hot_coffee_get_theme_option( 'front_page_woocommerce_products_orderby' ) ) . '"'
													. ' order="' . esc_attr( hot_coffee_get_theme_option( 'front_page_woocommerce_products_order' ) ) . '"'
												: '' )
										. ' per_page="' . esc_attr( $hot_coffee_woocommerce_sc_per_page ) . '"'
										. ' columns="' . esc_attr( $hot_coffee_woocommerce_sc_columns ) . '"'
						. ']'
					);
					?>
				</div>
			</div>
		</div>
	</div>
	<?php
}
