<?php
/**
 * KSAS Simple Child functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package KSAS_Simple
 */

add_action( 'wp_enqueue_scripts', 'child_theme_enqueue_styles' );
	/**
	 * Sets up styles and scripts for this child theme
	 *
	 * Note that this function is hooked into the wp_enqueue_scripts
	 */
function child_theme_enqueue_styles() {
	$parent_style = 'ksas-simple-style';
	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/dist/css/style.css', array(), filemtime( get_template_directory() . '/resources/css' ), 'all' );
	wp_enqueue_style(
		'child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style ),
		wp_get_theme()->get( 'Version' )
	);
}

add_action( 'widgets_init', 'ksas_simple_vertical_register_sidebar' );
/**
 * Registar the sidebar for this theme
 */
function ksas_simple_vertical_register_sidebar() {
	register_sidebar(
		array(
			'id'            => 'sidebar1',
			'name'          => __( 'Global Sidebar', 'ksasacademic' ),
			'description'   => __( 'The first (primary) sidebar.' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

/**
 * Hide Parent Templates
 */
add_filter( 'theme_page_templates', 'child_theme_remove_page_template', 20, 3 );
/**
 * Remove page templates inherited from the parent theme.
 *
 * @param array $page_templates List of currently active page templates.
 *
 * @return array Modified list of page templates.
 */
function child_theme_remove_page_template( $page_templates ) {
	// Remove the template we don’t need.
	unset( $page_templates['page-templates/bulletin-board.php'] );
	unset( $page_templates['page-templates/classroom-directory.php'] );
	unset( $page_templates['page-templates/graduate-fields-of-study.php'] );
	unset( $page_templates['page-templates/people-directory-sort.php'] );
	unset( $page_templates['page-templates/profiles.php'] );
	unset( $page_templates['page-templates/research-projects.php'] );
	return $page_templates;
}

/**
 * Remove specific scripts from the parent theme.
 */
function child_theme_dequeue_script() {
	wp_dequeue_script( 'navbar' );
}
add_action( 'wp_enqueue_scripts', 'child_theme_dequeue_script', 100 );

/**
 * Inject Vite Live Reload Client & Assets during Development
 */
function ksas_child_vite_dev_reload() {
	$vite_server = 'http://localhost:5174';

	// Simple check if Vite dev server is active on port 5174
	$connection = @fsockopen( 'localhost', 5174, $errno, $errstr, 0.1 );
	if ( $connection ) {
		fclose( $connection );

		// Inject the Vite HMR websocket client and entrypoint
		add_action(
			'wp_head',
			function () use ( $vite_server ) {
				echo '<script type="module" src="' . $vite_server . '/@vite/client"></script>';
				// If you import style.css inside an entry JS file:
				// echo '<script type="module" src="' . $vite_server . '/assets/js/main.js"></script>';
			}
		);
	}
}
add_action( 'wp_enqueue_scripts', 'ksas_child_vite_dev_reload', 1 );
