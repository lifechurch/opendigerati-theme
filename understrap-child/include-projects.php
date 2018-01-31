<div class="container-fluid od-more-projects">
	<div class="row">
		<div class="col-sm-12 col-md-8 col-lg-10 center-columns">
			<div class="card-deck od-card-deck">
				<?php
					$queryObject = new WP_Query( 'post_type=projects&posts_per_page=3' );
				// The Loop!
				if ($queryObject->have_posts()) {
				    ?>
				    <?php
				    while ($queryObject->have_posts()) {
				        $queryObject->the_post();
			        ?>
			        	
					<div class="card od-project-card"> 
						<span style="background-image: linear-gradient(to left, <?php the_field('gradient_color_1'); ?>, <?php the_field('gradient_color_2'); ?>);"></span>
						<div class="card-body">
						<h3 class="card-title"><a class="od-project-card-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p class="card-text"><?php the_field('project_teaser'); ?></p>
						</div>
						<div class="card-footer od-card-footer">
					     	<a href="<?php the_permalink(); ?>">More Info</a>
						</div>
					</div>
				    <?php
				    }
				    ?>
			</div>
		    <div>
		    	<center><button class="od-view-all-button" href="#">View all projects</button></center>
		    </div>
		    <?php } ?>
		</div>
	</div>
</div>