<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

$the_theme = wp_get_theme();
$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_sidebar( 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_attr( $container ); ?>">

		<div class="row">

			<div class="col-sm-12 col-md-10 col-lg-6 center-columns">

				<footer class="site-footer" id="colophon">

					<div class="site-info">
						<p>Open Digerati is an open source community from <a href="<?php  echo esc_url( __( 'https://www.life.church' ) ); ?>">Life.Church</a>, <a href="<?php  echo esc_url( __( 'https://www.youversion.com' ) ); ?>">YouVersion</a> & partnered organizations and churches around the world.</p>
					</div><!-- .site-info -->

				</footer><!-- #colophon -->

			</div><!--col end -->
			
		</div><!-- row end -->
		<div class="row">
			<div class="col-sm-6 col-sm-2 center-columns">
				<a href="https://join.slack.com/t/opendigerati/shared_invite/enQtMjU4MTcwOTIxMzMwLTcyYjQ4NWEwMzBlOGIzNDgyM2U5NzExYTY3NmI0MDE4MTRmMTQ5NjNhZWEyNDY3N2IyOWZjMDIxM2MwYjEwMmQ" target="_blank"><img class="od-footer-social" src="<?php echo( get_stylesheet_directory_uri() . '/img/slack@3x.png'); ?>" alt=""></a>
				<a href="https://twitter.com/opendigerati" target="_blank"><img class="od-footer-social" src="<?php echo( get_stylesheet_directory_uri() . '/img/twitter@3x.png'); ?>" alt=""></a>
				<a href="https://blog.opendigerati.com" target="_blank"><img class="od-footer-social" src="<?php echo( get_stylesheet_directory_uri() . '/img/medium@3x.png'); ?>" alt=""></a>
			</div>
		</div>

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

