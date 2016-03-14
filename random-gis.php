<?php
/**
 * Plugin Name: Random Google Image Search Widget
 * Description: This plugin displays random images from GIS as a widget.
 * Version: 0.1
 * Author: Dustin Kittelson
 * License: GPL2
 */
 
class Random_GIS_Image extends WP_Widget {

	function Random_GIS_Image() {
		$widget_ops = array(
			'classname' => 'randomgisimage',
			'description' => 'Displays a random google image search result'
		);
  
		$control_ops = array(
			'width' => 250,
			'height' => 250,
			'id_base' => 'randomgisimage-widget');

		$this->WP_Widget('randomgisimage-widget', 'Random GIS Image', $widget_ops, $control_ops);
	}
 
	function form ($instance) {
		// prints the form on the widgets page
	
	   $defaults = array('max_offset' => '100', 'title' => 'Random Image', 'searchterms' => 'smug anime face');
	   $instance = wp_parse_args( (array) $instance, $defaults ); 
	   ?>
	 
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
				<input type="text" name="<?php echo $this->get_field_name('title') ?>" id="<?php echo $this->get_field_id('title') ?> " value="<?php echo $instance['title'] ?>" size="20"> 
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('searchterms'); ?>">Search Terms:</label>
				<input type="text" name="<?php echo $this->get_field_name('searchterms') ?>" id="<?php echo $this->get_field_id('searchterms') ?> " value="<?php echo $instance['searchterms'] ?>" size="20"> 
			</p>
	
			<p>
				<label for="<?php echo $this->get_field_id('max_offset'); ?>">Max Offset (max. 100):</label>
				<input type="text" name="<?php echo $this->get_field_name('max_offset') ?>" id="<?php echo $this->get_field_id('max_offset') ?> " value="<?php echo $instance['max_offset'] ?>" size="5"> 
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('api_key'); ?>">Google API Key:</label>
				<input type="text" name="<?php echo $this->get_field_name('api_key') ?>" id="<?php echo $this->get_field_id('api_key') ?> " value="<?php echo $instance['api_key'] ?>" size="30"> 
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('cx'); ?>">Custom Search ID:</label>
				<input type="text" name="<?php echo $this->get_field_name('cx') ?>" id="<?php echo $this->get_field_id('cx') ?> " value="<?php echo $instance['cx'] ?>" size="30"> 
			</p>


		<?php
	}

	function update ($new_instance, $old_instance) {
		$instance = $old_instance;

		$instance['max_offset'] = $new_instance['max_offset'];
		$instance['title'] = $new_instance['title'];
		$instance['searchterms'] = $new_instance['searchterms'];
		$instance['api_key'] = $new_instance['api_key'];
		$instance['cx'] = $new_instance['cx'];

		return $instance;
	}

	function widget ($args,$instance) {
		extract($args);

		$title = $instance['title'];
				
		$numberofimages = $instance['max_offset'];
		$searchterms = $instance['searchterms'];

		$out = "<img id='random_gis_image' src=''>";
		
		echo $before_widget;
		echo $before_title.$title.$after_title;
		echo $out;
		echo $after_widget;
	}

}

function randomgis_widget_init() {
	register_widget('Random_GIS_Image');

	$widget = new Random_GIS_Image();

	$widget_options = get_option('widget_randomgisimage-widget');

	if ($widget_options) {
		$widget_options = array_shift($widget_options);
		
		$GIS_params = array(
			'searchterms' => $widget_options['searchterms'],
			'offset' => rand(1, $widget_options['max_offset']),
			'api_key' => $widget_options['api_key'],
			'cx' => $widget_options['cx']
		);
		
		wp_enqueue_script('jquery');
		wp_enqueue_script('random-gis-js', plugins_url( '/js/random_gis.js', __FILE__ ));	
		wp_localize_script('random-gis-js', 'random_gis_vars', $GIS_params);
	}	
}

add_action('widgets_init', 'randomgis_widget_init');