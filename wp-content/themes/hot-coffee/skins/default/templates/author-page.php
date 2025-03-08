<?php
/**
 * The template to display the user's avatar, bio and socials on the Author page
 *
 * @package HOT COFFEE
 * @since HOT COFFEE 1.71.0
 */
?>

<div class="author_page author vcard" itemprop="author" itemscope="itemscope" itemtype="<?php echo esc_attr( hot_coffee_get_protocol( true ) ); ?>//schema.org/Person">

	<div class="author_avatar" itemprop="image">
		<?php
		$hot_coffee_mult = hot_coffee_get_retina_multiplier();
		echo get_avatar( get_the_author_meta( 'user_email' ), 120 * $hot_coffee_mult );
		?>
	</div><!-- .author_avatar -->

	<h4 class="author_title" itemprop="name"><span class="fn"><?php the_author(); ?></span></h4>

	<?php
	$hot_coffee_author_description = get_the_author_meta( 'description' );
	if ( ! empty( $hot_coffee_author_description ) ) {
		?>
		<div class="author_bio" itemprop="description"><?php echo wp_kses( wpautop( $hot_coffee_author_description ), 'hot_coffee_kses_content' ); ?></div>
		<?php
	}
	?>

	<div class="author_details">
		<span class="author_posts_total">
			<?php
			$hot_coffee_posts_total = count_user_posts( get_the_author_meta('ID'), 'post' );
			if ( $hot_coffee_posts_total > 0 ) {
				// Translators: Add the author's posts number to the message
				echo wp_kses( sprintf( _n( '%s article published', '%s articles published', $hot_coffee_posts_total, 'hot-coffee' ),
										'<span class="author_posts_total_value">' . number_format_i18n( $hot_coffee_posts_total ) . '</span>'
								 		),
							'hot_coffee_kses_content'
							);
			} else {
				esc_html_e( 'No posts published.', 'hot-coffee' );
			}
			?>
		</span><?php
			ob_start();
			do_action( 'hot_coffee_action_user_meta', 'author-page' );
			$hot_coffee_socials = ob_get_contents();
			ob_end_clean();
			hot_coffee_show_layout( $hot_coffee_socials,
				'<span class="author_socials"><span class="author_socials_caption">' . esc_html__( 'Follow:', 'hot-coffee' ) . '</span>',
				'</span>'
			);
		?>
	</div><!-- .author_details -->

</div><!-- .author_page -->
