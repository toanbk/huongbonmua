<?php
/**
 * The template to display the background video in the header
 *
 * @package HOT COFFEE
 * @since HOT COFFEE 1.0.14
 */
$hot_coffee_header_video = hot_coffee_get_header_video();
$hot_coffee_embed_video  = '';
if ( ! empty( $hot_coffee_header_video ) && ! hot_coffee_is_from_uploads( $hot_coffee_header_video ) ) {
	if ( hot_coffee_is_youtube_url( $hot_coffee_header_video ) && preg_match( '/[=\/]([^=\/]*)$/', $hot_coffee_header_video, $matches ) && ! empty( $matches[1] ) ) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr( $matches[1] ); ?>"></div>
		<?php
	} else {
		?>
		<div id="background_video"><?php hot_coffee_show_layout( hot_coffee_get_embed_video( $hot_coffee_header_video ) ); ?></div>
		<?php
	}
}
