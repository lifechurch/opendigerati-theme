<?php
/**
 * Template Name: Single Project
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

// GRAB GITHUB INFO
      

    function get_repo( $repo_url ) {

      $repository = trim( $repo_url, '/' );
      $userAgent = 'WordPress Github oEmbed plugin - https://github.com/leewillis77/wp-github-oembed';

      $ch = curl_init(); 


      // set url 

      $ch = curl_init( "https://api.github.com/repos/$repository?access_token=d69c06a01b44169f861ffe2471d0fe6a4ea4c7be" );
      curl_setopt( $ch, CURLOPT_USERAGENT, $userAgent );

      //return the transfer as a string 
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

      // $output contains the output string 
      $results = curl_exec($ch); 

      // close curl resource to free up system resources 
      curl_close($ch);

      return json_decode( $results );

    }

    $github_url = str_replace('https://github.com/', '', get_field('github_url'));

    $github_repo_array = (get_repo($github_url));


    function get_contributors( $repo_url ) {

      $repository = trim( $repo_url, '/' );
      $userAgent = 'WordPress Github oEmbed plugin - https://github.com/leewillis77/wp-github-oembed';

      $ch = curl_init(); 


      // set url 

      $ch = curl_init( "https://api.github.com/repos/$repository/contributors?access_token=d69c06a01b44169f861ffe2471d0fe6a4ea4c7be" );
      curl_setopt( $ch, CURLOPT_USERAGENT, $userAgent );

      //return the transfer as a string 
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

      // $output contains the output string 
      $results = curl_exec($ch); 

      // close curl resource to free up system resources 
      curl_close($ch);

      return json_decode( $results );

    }

    $github_url = str_replace('https://github.com/', '', get_field('github_url'));

    $github_contributors_array = (get_contributors($github_url));

?>

<!-- END OF GRAB GITHUB INFO -->
<section style="height: 20vw;min-height: 200px;background-image: linear-gradient(to left, <?php the_field('gradient_color_1'); ?>, <?php the_field('gradient_color_2'); ?>);">
<?php get_header(); $container = get_theme_mod( 'understrap_container_type' );?>
</section>
<div class="wrapper" id="full-width-page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row">

			<div class="col-xs-12 col-lg-8 content-area" id="primary">

				<main class="site-main" id="main" role="main">

					<?php while ( have_posts() ) : the_post(); ?>

						<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

							<header class="entry-header">

								<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

							</header><!-- .entry-header -->
							<?php $tags = get_tags(); ?>
								<div class="tags">
								<?php foreach ( $tags as $tag ) { ?>
								    <a href="<?php echo get_tag_link( $tag->term_id ); ?> " rel="tag"><?php echo $tag->name; ?></a>
								<?php } ?>
								</div>

							<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

							<div class="entry-content">

								<?php the_content(); ?>

								<?php
								wp_link_pages( array(
									'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
									'after'  => '</div>',
								) );
								?>

							</div><!-- .entry-content -->

							<footer class="entry-footer">

								<?php understrap_entry_footer(); ?>

							</footer><!-- .entry-footer -->

						</article><!-- #post-## -->

						<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :

							comments_template();

						endif;
						?>

					<?php endwhile; // end of the loop. ?>

				</main><!-- #main -->

			</div><!-- #primary -->
			<div class="col-xs-12 col-lg-4">
		<div class="od-project-info-box">

	        <i class="fa fa-github" aria-hidden="true"></i>
	        <a href="<?php the_field('github_url'); ?>" target="_blank"><?php the_field('github_url'); ?></a> <br>
	        <strong><?= $github_repo_array->forks_count ?></strong> Forks
	        <strong><?= $github_repo_array->stargazers_count ?></strong> Stars
	        <strong><?= count($github_contributors_array) ?></strong> Contributors
	        Last update <strong><?= date('M d, Y ',strtotime($github_repo_array->updated_at)) ?></strong>


	        <div class="od-project-slack">
	        <img width="24px" src="<?php echo( get_stylesheet_directory_uri() . '/img/slack.svg'); ?>" alt="slack logo">
	        <a href="<?php the_field('slack_url'); ?>" target="_blank"><?php the_field('slack_channel'); ?></a>
	        </div>
	    </div>
		</div>
		</div>
		<?php include(get_theme_root().'/understrap-child/include-projects.php');?>
				<!-- .row end -->		
		
	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>