<?php
/**
 * Independence Theme functions and definitions.
 *
 * @package Independence
 * @since Independence 1.0
 */

/**
 * Set up supported theme features.
 */
	function independence_setup() {

	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );

	add_image_size( 'latest-article-home', 880, 322, array( 'center', 'center' ) );

	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

}

add_action( 'after_setup_theme', 'independence_setup' );
/**
 * Enqueue scripts.
 */
function independence_scripts() {
	wp_enqueue_style( 'independence-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_script( 'fontfaceobserver', get_template_directory_uri() . '/assets/js/fontfaceobserver.js', array(), '2.0.9', true );
	wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/js/main.js', array( 'fontfaceobserver' ), '', true );
	//wp_deregister_style( 'kind' );
	//wp_dequeue_style( 'kind' );
	//wp_deregister_style( 'indieweb' );
	//wp_dequeue_style( 'indieweb' );
	if (
				is_singular()
				&& get_option( 'thread_comments' )
		)
				wp_enqueue_script( 'comment-reply' );
}

add_action( 'wp_enqueue_scripts', 'independence_scripts' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Image specific functions.
 */
//require get_template_directory() . '/inc/images/php';

add_filter( 'xmlrpc_enabled', '__return_false' );

remove_action( 'wp_head', 'rsd_link' );

function independence_extract_domain_name( $url ) {
	$parse = wp_parse_url( $url, PHP_URL_HOST );
	return preg_replace( '/^www\./', '', $parse );
}
