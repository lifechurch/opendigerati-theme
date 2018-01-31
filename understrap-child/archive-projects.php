<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */

get_header();
?>

<?php
$container   = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="archive-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main col-12 col-lg-8 center-columns" id="main">

				<?php if ( have_posts() ) : ?>
					<header class="page-header">
						<h1>Projects</h1>
					</header><!-- .page-header -->

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<style>
							#post-<?php the_ID(); ?> {
								border-image: linear-gradient(to bottom, <?php the_field('gradient_color_1'); ?>, <?php the_field('gradient_color_2'); ?>) 1 100%;
							}
						</style>
						<article <?php post_class('project'); ?> id="post-<?php the_ID(); ?>">

						<header class="entry-header">

							<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
							'</a></h2>' ); ?>

							<?php if ( 'post' == get_post_type() ) : ?>

								<div class="entry-meta">
									<?php understrap_posted_on(); ?>
								</div><!-- .entry-meta -->

							<?php endif; ?>

						</header><!-- .entry-header -->

						<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

						<div class="entry-content">

							<?php the_field('project_teaser'); ?>

						

						</div><!-- .entry-content -->

						<footer class="entry-footer">
							<a href="<?php the_permalink(); ?>">More Info</a>
							<?php understrap_entry_footer(); ?>

						</footer><!-- .entry-footer -->

					</article>

					<?php endwhile; ?>

				<?php else : ?>

					<?php get_template_part( 'loop-templates/content', 'none' ); ?>

				<?php endif; ?>

			</main><!-- #main -->

			<!-- The pagination component -->
			<?php understrap_pagination(); ?>

		</div><!-- #primary -->

		<!-- Do the right sidebar check -->
		<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

	</div> <!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
