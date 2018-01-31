<div class="container-fluid od-more-projects">
	<div class="row">
		<div class="col-xs-12 col-lg-12 center-columns">
			<div class="card-deck">
				<?php
					$queryObject = new WP_Query( 'post_type=projects&posts_per_page=3' );
				// The Loop!
				if ($queryObject->have_posts()) {
				    ?>
				    <?php
				    while ($queryObject->have_posts()) {
				        $queryObject->the_post();
			        ?>
			        	
					<div class="card">
						<span class="card-img-top" style="height: 88px;background-image: linear-gradient(to left, <?php the_field('gradient_color_1'); ?>, <?php the_field('gradient_color_2'); ?>);"></span>
						<div class="card-body">
						<h3 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p class="card-text"><?php the_field('project_teaser'); ?></p>
						</div>
						<div class="card-footer">
					     	<a href="<?php the_permalink(); ?>">More Info</a>
						</div>
					</div>
				    <?php
				    }
				    ?>
			</div>
		    <div>
		    	<a class="od-view-all-button" href="#">View all projects</a>
		    </div>
		    <?php } ?>
		</div>
	</div>
</div>