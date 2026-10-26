<?php
/**
 * Template Name: People Directory
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Simple
 *
 * The Loop is split before and after People CPT query!
 */

get_header();
?>

	<div class="flex flex-wrap md:flex-row-reverse">
		<main id="site-content" class="site-main page-with-sidebar w-full lg:w-4/5 prose sm:prose lg:prose-lg mx-auto">
		<?php
		if ( function_exists( 'bcn_display' ) ) :
			?>
		<div class="breadcrumbs my-4" typeof="BreadcrumbList" vocab="https://schema.org/">
			<?php bcn_display(); ?>
		</div>
		<?php endif; ?>

		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				?>
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .page-header -->
				<?php
		endwhile;
		endif;
		?>
			<?php
			$positions      = get_terms(
				array(
					'taxonomy'   => 'role',
					'orderby'    => 'slug',
					'order'      => 'ASC',
					'hide_empty' => true,
				)
			);
			$position_slugs = array();
			foreach ( $positions as $position ) {
				$position_slugs[] = $position->slug;
			}
			$position_classes = implode( ' ', $position_slugs );
			?>

			<?php foreach ( $positions as $position ) : ?>
				<?php
				$position_slug    = $position->slug;
				$position_name    = $position->name;
					$people_query = new WP_Query(
						array(
							'post_type'      => 'people',
							'role'           => $position_slug,
							'meta_key'       => 'ecpt_people_alpha',
							'orderby'        => 'meta_value',
							'order'          => 'ASC',
							'posts_per_page' => '100',
						)
					);

				if ( $people_query->have_posts() ) :
					?>
					<div class="pt-2 role-title <?php echo esc_html( $position->slug ); ?>">
						<h2 class="uppercase"><?php echo esc_html( $position_name ); ?></h2>
					</div>
					<?php
					while ( $people_query->have_posts() ) :
						$people_query->the_post();
						get_template_part( 'template-parts/content', 'people-excerpt' );
					endwhile;
				endif;
			endforeach;
			wp_reset_postdata();
			?>

<?php
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ksas-simple' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

		<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
					<?php
					edit_post_link(
						sprintf(
							wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
								__( 'Edit <span class="screen-reader-text">%s</span>', 'ksas-simple' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							wp_kses_post( get_the_title() )
						),
						'<span class="edit-link">',
						'</span>'
					);
					?>
		</footer><!-- .entry-footer -->
			<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->

			<?php
			endwhile; // End of the loop.
		endif;
?>

		</main><!-- #main -->

<?php
get_sidebar();
?>
</div>

<?php
get_footer();
