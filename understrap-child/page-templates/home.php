<?php
/**
 * Template Name: Home Page
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

	<?php while ( have_posts() ) : the_post(); ?>

		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

			<header class="entry-header">

			</header><!-- .entry-header -->
			<div class="container od-homepage-header">
				<div class="row">
					<div class="col-xs-12 col-lg-7 col-xl-6 center-columns">
						<h1>Design. Develop. Build the Kingdom.</h1>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-lg-7 col-xl-6 center-columns">
						<p>
							Contribute your tech and design skills to a community that’s building a better world.
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-lg-6 offset-lg-3">
						<!--[if lte IE 8]>
						<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
						<![endif]-->
						<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
						<script>
						  hbspt.forms.create({ 
						    css: '',
						    portalId: '1715485',
						    formId: '397b5fa4-3773-4bdb-95c2-535126df17d5'
						  });
						</script>
					</div>
				</div>
			</div>


			<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

			<div class="entry-content">

				<?php //the_content(); ?>

				<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
					'after'  => '</div>',
				) );
				?>
				<div class="container-fluid">
					<div class="row">
						<div class="col-xs-12">
							<h2 class="od-home-project-header">Projects</h2>
							<?php include(get_theme_root().'/understrap-child/include-projects.php');?>
						</div>
					</div>
				</div>

			</div><!-- .entry-content -->

			<footer class="entry-footer">

				<?php edit_post_link( __( 'Edit', 'understrap' ), '<span class="edit-link">', '</span>' ); ?>

			</footer><!-- .entry-footer -->

		</article><!-- #post-## -->


		<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :

			comments_template();

		endif;
		?>
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<h2 class="od-home-project-header">Latest Posts</h2>
					<?php echo do_shortcode('[display_medium_posts handle="open-digerati" publication=true default_image="#" display=3 offset=0 total=3 list=true]'); ?>
				</div>
			</div>
		</div>
	<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
