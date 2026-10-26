<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package KSAS_Simple
 */

?>

<aside id="secondary" class="sidebar widget-area w-full lg:w-1/5 bg-grey-lightest">
	<div class="menu hidden lg:block">
		<nav id="site-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Main Navigation', 'ksas-simple' ); ?>">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'main-nav',
				'menu_id'        => 'primary-menu',
				'menu_class'     => 'sidenav',
				'container'      => false,
			)
		);
		?>
		</nav>
		<hr class="w-3/4 mx-auto text-grey-cool">
		<?php
			get_search_form(
				array(
					'label' => __( 'Search for:', 'ksas-simple' ),
				)
			);
			?>
	</div>

</aside><!-- #secondary -->
