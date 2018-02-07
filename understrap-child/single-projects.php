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

      $ch = curl_init( "https://api.github.com/repos/$repository?client_id=ad070b20d82f7843dd3b&client_secret=3d4a8e61c3f70b09124fcc563855a0701733fec7" );
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

      $ch = curl_init( "https://api.github.com/repos/$repository/contributors?client_id=ad070b20d82f7843dd3b&client_secret=3d4a8e61c3f70b09124fcc563855a0701733fec7" );
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
<section class="od-project-color-block" style="background-image: linear-gradient(to left, <?php the_field('gradient_color_1'); ?>, <?php the_field('gradient_color_2'); ?>);">
<?php get_header(); $container = get_theme_mod( 'understrap_container_type' );?>
</section>
<div class="wrapper" id="full-width-page-wrapper">

	<div class="container" id="content">

		<div class="row">

			<div class="col-12 col-md-8 col-lg-6 content-area" id="primary">

				<main class="site-main" id="main" role="main">

					<?php while ( have_posts() ) : the_post(); ?>

						<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

							<header class="entry-header od-project-page-header">

								<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

							</header><!-- .entry-header -->
							<?php $tags = wp_get_post_tags(get_the_ID()); ?>
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
			<div class="col-12 col-md-8 col-lg-6 col-xl-6 secondary-area">
				<div class="od-project-info-box">

			        <i class="fa fa-github" aria-hidden="true"></i>
			        <div class="github-row">
			        	<a href="<?php the_field('github_url'); ?>" target="_blank"><?php the_field('github_url'); ?></a>
			        </div>
			        <div class="github-row">
				        <strong><?= $github_repo_array->forks_count ?></strong> Forks
				        <strong><?= $github_repo_array->stargazers_count ?></strong> Stars
				        <strong><?= count($github_contributors_array) ?></strong> Contributors
				    </div>
				    <div class="github-row">
			        	Last update <strong><?= date('M d, Y ',strtotime($github_repo_array->updated_at)) ?></strong>
			        </div>


			        <div class="od-project-slack">
				        <a class="od-slack-workspace-invite" href="https://join.slack.com/t/opendigerati/shared_invite/enQtMjU4MTcwOTIxMzMwLTcyYjQ4NWEwMzBlOGIzNDgyM2U5NzExYTY3NmI0MDE4MTRmMTQ5NjNhZWEyNDY3N2IyOWZjMDIxM2MwYjEwMmQ" target="_blank">
                  <img width="24px" src="<?php echo( get_stylesheet_directory_uri() . '/img/slack.svg'); ?>" alt="slack logo">Join the Open Digerati workspace
                </a>
                <br/>
                <div></div>
                <a class="od-slack-project-invite" href="<?php echo(the_field('slack_url')); ?>" target="_blank">#<?php the_field('slack_channel'); ?></a>
			        </div>
			    </div>
			</div>
		</div>
				<!-- .row end -->		
		
	</div><!-- Container end -->


</div><!-- Wrapper end -->
  
  <div class="black-background">
    <div class="container od-more-projects">
      <div class="row">
        <div class="col-sm-12 col-md-8 col-lg-12 center-columns">
          <h2 class="od-home-project-header">More Projects</h2>
          <?php include(get_theme_root().'/understrap-child/include-projects.php');?>
        </div>
      </div>
    </div>
  </div>



<?php get_footer(); ?>