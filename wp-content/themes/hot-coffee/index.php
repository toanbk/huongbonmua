<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: //codex.wordpress.org/Template_Hierarchy
 *
 * @package HOT COFFEE
 * @since HOT COFFEE 1.0
 */

$hot_coffee_template = apply_filters( 'hot_coffee_filter_get_template_part', hot_coffee_blog_archive_get_template() );

if ( ! empty( $hot_coffee_template ) && 'index' != $hot_coffee_template ) {

	get_template_part( $hot_coffee_template );

} else {

	hot_coffee_storage_set( 'blog_archive', true );

	get_header();

	if ( have_posts() ) {

		// Query params
		$hot_coffee_stickies   = is_home()
								|| ( in_array( hot_coffee_get_theme_option( 'post_type' ), array( '', 'post' ) )
									&& (int) hot_coffee_get_theme_option( 'parent_cat' ) == 0
									)
										? get_option( 'sticky_posts' )
										: false;
		$hot_coffee_post_type  = hot_coffee_get_theme_option( 'post_type' );
		$hot_coffee_args       = array(
								'blog_style'     => hot_coffee_get_theme_option( 'blog_style' ),
								'post_type'      => $hot_coffee_post_type,
								'taxonomy'       => hot_coffee_get_post_type_taxonomy( $hot_coffee_post_type ),
								'parent_cat'     => hot_coffee_get_theme_option( 'parent_cat' ),
								'posts_per_page' => hot_coffee_get_theme_option( 'posts_per_page' ),
								'sticky'         => hot_coffee_get_theme_option( 'sticky_style' ) == 'columns'
															&& is_array( $hot_coffee_stickies )
															&& count( $hot_coffee_stickies ) > 0
															&& get_query_var( 'paged' ) < 1
								);

		hot_coffee_blog_archive_start();

		do_action( 'hot_coffee_action_blog_archive_start' );

		if ( is_author() ) {
			do_action( 'hot_coffee_action_before_page_author' );
			get_template_part( apply_filters( 'hot_coffee_filter_get_template_part', 'templates/author-page' ) );
			do_action( 'hot_coffee_action_after_page_author' );
		}

		if ( hot_coffee_get_theme_option( 'show_filters' ) ) {
			do_action( 'hot_coffee_action_before_page_filters' );
			hot_coffee_show_filters( $hot_coffee_args );
			do_action( 'hot_coffee_action_after_page_filters' );
		} else {
			do_action( 'hot_coffee_action_before_page_posts' );
			hot_coffee_show_posts( array_merge( $hot_coffee_args, array( 'cat' => $hot_coffee_args['parent_cat'] ) ) );
			do_action( 'hot_coffee_action_after_page_posts' );
		}

		do_action( 'hot_coffee_action_blog_archive_end' );

		hot_coffee_blog_archive_end();

	} else {

		if ( is_search() ) {
			get_template_part( apply_filters( 'hot_coffee_filter_get_template_part', 'templates/content', 'none-search' ), 'none-search' );
		} else {
			get_template_part( apply_filters( 'hot_coffee_filter_get_template_part', 'templates/content', 'none-archive' ), 'none-archive' );
		}
	}

	get_footer();
}
