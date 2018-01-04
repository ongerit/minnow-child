<?php
/**
 * Minnow Child functions and definitions
 *
 * @package Minnow Child
 */

/**
 * Custom template tags for this theme.
 */
require get_theme_file_path( 'inc/template-tags.php' );
//require get_template_directory() . '/inc/template-tags.php';

// [TO] Change logo url

function jetpack_the_site_logo_new_url($html) {

    $home_url = esc_url( home_url( '/' ));
	$new_logo_url = '//www.spearhead.co/';

	$search  = sprintf('href="%1$s"', $home_url);
    $replace  = sprintf('href="%1$s"', $new_logo_url);

    return str_replace( $search, $replace, $html ); 
}

add_filter( 'jetpack_the_site_logo', 'jetpack_the_site_logo_new_url', 10, 2 );