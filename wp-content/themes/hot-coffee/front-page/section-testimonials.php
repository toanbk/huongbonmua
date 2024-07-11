<div class="front_page_section front_page_section_testimonials<?php
	$hot_coffee_scheme = hot_coffee_get_theme_option( 'front_page_testimonials_scheme' );
	if ( ! empty( $hot_coffee_scheme ) && ! hot_coffee_is_inherit( $hot_coffee_scheme ) ) {
		echo ' scheme_' . esc_attr( $hot_coffee_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( hot_coffee_get_theme_option( 'front_page_testimonials_paddings' ) );
	if ( hot_coffee_get_theme_option( 'front_page_testimonials_stack' ) ) {
		echo ' sc_stack_section_on';
	}
?>"
		<?php
		$hot_coffee_css      = '';
		$hot_coffee_bg_image = hot_coffee_get_theme_option( 'front_page_testimonials_bg_image' );
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
	$hot_coffee_anchor_icon = hot_coffee_get_theme_option( 'front_page_testimonials_anchor_icon' );
	$hot_coffee_anchor_text = hot_coffee_get_theme_option( 'front_page_testimonials_anchor_text' );
if ( ( ! empty( $hot_coffee_anchor_icon ) || ! empty( $hot_coffee_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_testimonials"'
									. ( ! empty( $hot_coffee_anchor_icon ) ? ' icon="' . esc_attr( $hot_coffee_anchor_icon ) . '"' : '' )
									. ( ! empty( $hot_coffee_anchor_text ) ? ' title="' . esc_attr( $hot_coffee_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_testimonials_inner
	<?php
	if ( hot_coffee_get_theme_option( 'front_page_testimonials_fullheight' ) ) {
		echo ' hot-coffee-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$hot_coffee_css      = '';
			$hot_coffee_bg_mask  = hot_coffee_get_theme_option( 'front_page_testimonials_bg_mask' );
			$hot_coffee_bg_color_type = hot_coffee_get_theme_option( 'front_page_testimonials_bg_color_type' );
			if ( 'custom' == $hot_coffee_bg_color_type ) {
				$hot_coffee_bg_color = hot_coffee_get_theme_option( 'front_page_testimonials_bg_color' );
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
		<div class="front_page_section_content_wrap front_page_section_testimonials_content_wrap content_wrap">
			<?php
			// Caption
			$hot_coffee_caption = hot_coffee_get_theme_option( 'front_page_testimonials_caption' );
			if ( ! empty( $hot_coffee_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<h2 class="front_page_section_caption front_page_section_testimonials_caption front_page_block_<?php echo ! empty( $hot_coffee_caption ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( $hot_coffee_caption, 'hot_coffee_kses_content' ); ?></h2>
				<?php
			}

			// Description (text)
			$hot_coffee_description = hot_coffee_get_theme_option( 'front_page_testimonials_description' );
			if ( ! empty( $hot_coffee_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_description front_page_section_testimonials_description front_page_block_<?php echo ! empty( $hot_coffee_description ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( wpautop( $hot_coffee_description ), 'hot_coffee_kses_content' ); ?></div>
				<?php
			}

			// Content (widgets)
			?>
			<div class="front_page_section_output front_page_section_testimonials_output">
				<?php
				if ( is_active_sidebar( 'front_page_testimonials_widgets' ) ) {
					dynamic_sidebar( 'front_page_testimonials_widgets' );
				} elseif ( current_user_can( 'edit_theme_options' ) ) {
					if ( ! hot_coffee_exists_trx_addons() ) {
						hot_coffee_customizer_need_trx_addons_message();
					} else {
						hot_coffee_customizer_need_widgets_message( 'front_page_testimonials_caption', 'ThemeREX Addons - Testimonials' );
					}
				}
				?>
			</div>
		</div>
	</div>
</div>
