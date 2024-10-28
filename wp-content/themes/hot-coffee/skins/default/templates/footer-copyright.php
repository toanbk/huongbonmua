<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package HOT COFFEE
 * @since HOT COFFEE 1.0.10
 */

// Copyright area
?> 
<div class="footer_copyright_wrap
<?php
$hot_coffee_copyright_scheme = hot_coffee_get_theme_option( 'copyright_scheme' );
if ( ! empty( $hot_coffee_copyright_scheme ) && ! hot_coffee_is_inherit( $hot_coffee_copyright_scheme  ) ) {
	echo ' scheme_' . esc_attr( $hot_coffee_copyright_scheme );
}
?>
				">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text">
			<?php
				$hot_coffee_copyright = hot_coffee_get_theme_option( 'copyright' );
			if ( ! empty( $hot_coffee_copyright ) ) {
				// Replace {{Y}} or {Y} with the current year
				$hot_coffee_copyright = str_replace( array( '{{Y}}', '{Y}' ), date( 'Y' ), $hot_coffee_copyright );
				// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
				$hot_coffee_copyright = hot_coffee_prepare_macros( $hot_coffee_copyright );
				// Display copyright
				echo wp_kses( nl2br( $hot_coffee_copyright ), 'hot_coffee_kses_content' );
			}
			?>
			</div>
		</div>
	</div>
</div>
