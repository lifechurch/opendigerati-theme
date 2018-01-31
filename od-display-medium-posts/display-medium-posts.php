<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.acekyd.com
 * @since             1.0.0
 * @package           Display_Medium_Posts
 *
 * @wordpress-plugin
 * Plugin Name:       Display Medium Posts
 * Plugin URI:        https://github.com/acekyd/display-medium-posts
 * Description:       Display Medium Posts is a wordpress plugin that allows users display posts from medium.com on any part of their website.
 * Version:           3.5.1
 * Author:            AceKYD
 * Author URI:        http://www.acekyd.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       display-medium-posts
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-display-medium-posts-activator.php
 */
function activate_display_medium_posts() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-display-medium-posts-activator.php';
	Display_Medium_Posts_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-display-medium-posts-deactivator.php
 */
function deactivate_display_medium_posts() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-display-medium-posts-deactivator.php';
	Display_Medium_Posts_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_display_medium_posts' );
register_deactivation_hook( __FILE__, 'deactivate_display_medium_posts' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-display-medium-posts.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_display_medium_posts() {

	$plugin = new Display_Medium_Posts();
	$plugin->run();

}
run_display_medium_posts();

    // Example 1 : WP Shortcode to display form on any page or post.
    function posts_display($atts){
    	ob_start();
    	 $a = shortcode_atts(array('handle'=>'-1', 'default_image'=>'//i.imgur.com/p4juyuT.png', 'display' => 3, 'offset' => 0, 'total' => 10, 'list' => false, 'publication' => false), $atts);
        // No ID value
        if(strcmp($a['handle'], '-1') == 0){
                return "";
        }
        $handle=$a['handle'];
        $default_image = $a['default_image'];
        $display = $a['display'];
        $offset = $a['offset'];
        $total = $a['total'];
        $list = $a['list'] =='false' ? false: $a['list'];
        $publication = $a['publication'] =='false' ? false: $a['publication'];

        $data = file_get_contents("https://medium.com/".$handle."/latest?format=json");
        $data = str_replace("])}while(1);</x>", "", $data);
        if($publication) {
        	//If handle provided is specified as a publication
	        $json = json_decode($data);
			$items = array();
			$count = 0;
			if(isset($json->payload->posts))
			{
				$posts = $json->payload->posts;
				foreach($posts as $post)
				{
					$items[$count]['title'] = $post->title;
					$items[$count]['url'] = 'https://medium.com/'.$handle.'/'.$post->uniqueSlug;
					$items[$count]['subtitle'] = isset($post->virtuals->subtitle) ? $post->virtuals->subtitle : "";
					if(!empty($post->virtuals->previewImage->imageId))
					{
						$image = '//cdn-images-1.medium.com/max/500/'.$post->virtuals->previewImage->imageId;
					}
					else {
						$image = $default_image;
					}
					$items[$count]['image'] = $image;
					$items[$count]['duration'] = round($post->virtuals->readingTime);
					$items[$count]['date'] = isset($post->firstPublishedAt) ? date('Y.m.d', $post->firstPublishedAt/1000): "";

					$count++;
				}
				if($offset)
				{
					$items = array_slice($items, $offset);  
				}

				if(count($items) > $total)
				{
					$items = array_slice($items, 0, $total); 
				}
			}
        }
        else {

	        $json = json_decode($data);
			$items = array();
			$count = 0;
			if(isset($json->payload->references->Post))
			{
				$posts = $json->payload->references->Post;
				foreach($posts as $post)
				{
					$items[$count]['title'] = $post->title;
					$items[$count]['url'] = 'https://medium.com/'.$handle.'/'.$post->uniqueSlug;
					$items[$count]['subtitle'] = isset($post->content->subtitle) ? $post->content->subtitle : "";
					if(!empty($post->virtuals->previewImage->imageId))
					{
						$image = '//cdn-images-1.medium.com/max/500/'.$post->virtuals->previewImage->imageId;
					}
					else {
						$image = $default_image;
					}
					$items[$count]['image'] = $image;
					$items[$count]['duration'] = round($post->virtuals->readingTime);
					$items[$count]['date'] = isset($post->firstPublishedAt) ? date('Y.m.d', $post->firstPublishedAt/1000): "";

					$count++;
				}
				if($offset)
				{
					$items = array_slice($items, $offset);  
				}

				if(count($items) > $total)
				{
					$items = array_slice($items, 0, $total); 
				}
			}
        }
    	?>
    	<div class="card-deck od-card-deck">
	    	<?php foreach($items as $item): ?>
	    	<div class="card od-project-card"> 
				<div class="card-body">
					<h3 class="card-title"><a class="od-project-card-title" href="<?php echo $item['url']; ?>"><?php echo $item['title']; ?></a></h3>
					<p class="card-text"><?php echo $item['subtitle']; ?></p>
				</div>
				<div class="card-footer od-card-footer">
			     	<a href="<?php echo $item['url']; ?>" target="_blank">Read on</a>
				</div>
				<div class="card-image"><img src="<?php echo $item['image']; ?>" /></div>
			</div>
			<?php endforeach; ?>
		</div>
        <?php
        return ob_get_clean();
    }
    add_shortcode('display_medium_posts', 'posts_display');

