<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package KSAS_Simple
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="date" content="<?php the_modified_date(); ?>" />
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<meta name="msapplication-config" content="<?php echo esc_url( get_template_directory_uri() ); ?>/dist/images/favicons/browserconfig.xml" />
	<?php wp_head(); ?>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-40512757-1');
		<?php
		$analytics_id = get_field( 'google_analytics_id', 'option' );
		$default_id   = 'UA-100553583-1';
		?>
		<?php if ( $analytics_id ) : ?>
		gtag('config', '<?php echo $analytics_id; ?>');
		<?php else : ?>
		gtag('config', '<?php echo $default_id; ?>');
		<?php endif; ?>
	</script>
	<!-- End Google Analytics -->
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-PDL5K37');</script>
	<!-- End Google Tag Manager -->
</head>

<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PDL5K37"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<a class="skip-link screen-reader-text" href="#site-content"><?php esc_html_e( 'Skip to content', 'ksas-simple' ); ?></a>
<?php wp_body_open(); ?>
	<header id="site-header" class="flex-col content-center w-full text-center shadow header-footer-group sm:flex-row lg:text-left sm:justify-between sm:items-baseline bg-blue" role="banner">
	<div class="header-titles-wrapper">
			<div class="header-inner">
				<div class="grid grid-cols-1 header-titles lg:grid-cols-3 gap-x-12">
					<div class="h-auto mx-auto shield">
						<?php if ( get_field( 'shield', 'option' ) == 'jhu' ) : ?>
						<a href="https://www.jhu.edu/" title="Johns Hopkins University">
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/dist/images/university.shield.svg" class="w-full h-auto p-2 lg:p-0 hover:opacity-75" alt="JHU Shield">
						</a>
						<?php else : ?>
						<a href="https://krieger.jhu.edu" rel="home">
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/dist/images/krieger.shield.svg" class="w-full h-auto p-2 lg:p-0 hover:opacity-75" alt="KSAS Shield">
						</a>	
						<?php endif; ?>
					</div>
					<div class="lg:col-span-2">
						<h1 class="mt-4 font-serif-bold font-weight-bold site-title">
						<a class="text-white hover:text-grey" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<?php bloginfo( 'name' ); ?>
							<?php
								$ksas_simple_description = get_bloginfo( 'description', 'display' );
							if (
								$ksas_simple_description || is_customize_preview() ) :
								$ksas_simple_description = get_bloginfo( 'description', 'display' );
								echo '<span class="block pt-1 text-lg font-normal lg:text-xl">' . $ksas_simple_description . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
								?>
								<?php endif; ?>
						</a>
						</h1>
					</div>
				</div><!-- .header-titles -->
				<button class="toggle search-toggle mobile-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
					<span class="toggle-inner">
						<span class="toggle-icon">
							<?php twentytwenty_the_theme_svg( 'search' ); ?>
						</span>
						<span class="toggle-text"><?php _ex( 'Search', 'toggle text', 'ksas-simple' ); ?></span>
					</span>
				</button><!-- .search-toggle -->
				<button class="toggle nav-toggle mobile-nav-toggle" data-toggle-target=".menu-modal"  data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
					<span class="toggle-inner">
						<span class="toggle-icon">
							<?php twentytwenty_the_theme_svg( 'ellipsis' ); ?>
						</span>
						<span class="toggle-text"><?php _e( 'Menu', 'ksas-simple' ); ?></span>
					</span>
				</button><!-- .nav-toggle -->
			</div><!-- .header-inner -->
		</div><!-- .header-titles-wrapper -->

		<?php
			get_template_part( 'inc/modal-search' );
		?>
	</header><!-- #site-header -->
	<?php
	get_template_part( 'inc/modal-menu' );
