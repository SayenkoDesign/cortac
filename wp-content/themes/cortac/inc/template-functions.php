<?php
/**
 * Additional features to allow styling of the templates
 *
 * @package WordPress
 * @subpackage Cortac
 * @since 1.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function cortac_body_classes( $classes ) {
	// Add class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Add class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add class if we're viewing the Customizer for easier styling of theme options.
	if ( is_customize_preview() ) {
		$classes[] = 'cortac-customizer';
	}

	// Add class on front page.
	if ( is_front_page() && 'posts' !== get_option( 'show_on_front' ) ) {
		$classes[] = 'cortac-front-page';
	}

	// Add a class if there is a custom header.
	if ( has_header_image() ) {
		$classes[] = 'has-header-image';
	}

	// Add class if sidebar is used.
	if ( is_active_sidebar( 'sidebar-1' ) && ! is_page() ) {
		$classes[] = 'has-sidebar';
	}

	// Add class for one or two column page layouts.
	if ( is_page() || is_archive() ) {
		if ( 'one-column' === get_theme_mod( 'page_layout' ) ) {
			$classes[] = 'page-one-column';
		} else {
			$classes[] = 'page-two-column';
		}
	}

	// Add class if the site title and tagline is hidden.
	if ( 'blank' === get_header_textcolor() ) {
		$classes[] = 'title-tagline-hidden';
	}

	// Get the colorscheme or the default if there isn't one.
	$colors = cortac_sanitize_colorscheme( get_theme_mod( 'colorscheme', 'light' ) );
	$classes[] = 'colors-' . $colors;

	return $classes;
}
add_filter( 'body_class', 'cortac_body_classes' );

/**
 * Count our number of active panels.
 *
 * Primarily used to see if we have any panels active, duh.
 */
function cortac_panel_count() {

	$panel_count = 0;

	/**
	 * Filter number of front page sections in Cortac.
	 *
	 * @since Cortac 1.0
	 *
	 * @param $num_sections integer
	 */
	$num_sections = apply_filters( 'cortac_front_page_sections', 4 );

	// Create a setting and control for each of the sections available in the theme.
	for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
		if ( get_theme_mod( 'panel_' . $i ) ) {
			$panel_count++;
		}
	}

	return $panel_count;
}

/**
 * Checks to see if we're on the homepage or not.
 */
function cortac_is_frontpage() {
	return ( is_front_page() && ! is_home() );
}

/**
 * Checks to see if we're on the blogpage or not.
 */

function is_blog() {
    return ( is_author() || is_category() || is_tag() || is_date() || is_home() || is_single() ) && 'post' == get_post_type();
}


if ( defined( 'WPSEO_VERSION' ) ) {
	/**
	 * Move Yoast to bottom, below all elements
	 *
	 * @return string 'low' set value.
	 * @author jomurgel <jo@webdevstudios.com>
	 * @since  NEXT
	 */
	function _s_move_yoast_to_bottom() {
		return 'low';
	}
	add_filter( 'wpseo_metabox_prio', '_s_move_yoast_to_bottom' );
}
