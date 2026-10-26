<?php
/**
 * The template for displaying front page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Blocks
 */

get_header();
?>

<div class="flex flex-wrap md:flex-row-reverse">
	<main id="site-content" class="site-main page-with-sidebar w-full lg:w-4/5 prose sm:prose lg:prose-lg mx-auto">

	<?php
	while ( have_posts() ) :
		the_post()
		?>
		<?php
		get_template_part( 'template-parts/content', 'front' );

	endwhile; // End of the loop.
	?>

		<?php

		if ( get_field( 'show_homepage_news_feed', 'option' ) ) :
			// If ACF Conditional is YES, display news feed.
			$heading       = get_field( 'homepage_news_header', 'option' );
			$news_quantity = get_field( 'homepage_news_posts', 'option' );
			?>
		<div class="news-section">
			<div class="front prose sm:prose lg:prose-lg mx-auto">
				<div class="flex justify-between">
					<div>
						<h2><?php echo esc_html( $heading ); ?>
					</div>
					<div>
						<a class="button" href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>">
							View All Posts&nbsp;<span class="fa-solid fa-circle-chevron-right" aria-hidden="true"></span></a>
					</div>
				</div>
			</div>
			<?php
			$news_query = new WP_Query(
				array(
					'post_type'      => 'post',
					'posts_per_page' => $news_quantity,
				)
			);
			if ( $news_query->have_posts() ) :
				while ( $news_query->have_posts() ) :
					$news_query->the_post();
					get_template_part( 'template-parts/content', 'front-post-excerpt' );
				endwhile;
			endif;

			// Restore the $post global to the current post in the main query!
			wp_reset_postdata();
			?>
		</div>
		<?php else : // show_homepage_news_feed returned false. ?>

		<?php endif; // end of if show_homepage_news_feed logic. ?>

		<?php
		if ( function_exists( 'get_field' ) && get_field( 'custom_sidebar' ) ) :
			?>
		<!-- ACF Custom Widget Sidebar -->
			<?php
			$custom_sidebar_widget = get_field( 'custom_sidebar', false, false );
			if ( is_active_sidebar( $custom_sidebar_widget ) ) :
				?>
				<div class="front-widget-area">
					<?php dynamic_sidebar( $custom_sidebar_widget ); ?>
				</div>
			<?php endif; ?>
			<?php
		endif;
		?>

	</main><!-- #main -->

	<?php
	get_sidebar();
	?>
</div>
<?php
get_footer();
