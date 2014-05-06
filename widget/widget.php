<?php 
//This page is to add Plugin widget

// Register and load the widget
function wpb_load_widget() {
	register_widget( 'wpb_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );

// Creating the widget 
class wpb_widget extends WP_Widget {
	function __construct() {
	parent::__construct(
		// Base ID of your widget
		'btcal_widget', 
		
		// Widget name will appear in UI
		__('Bhutanese Calendar Widget', 'btcal_widget_domain'), 
		
		// Widget description
		array( 'description' => __( 'A widget to display monthly Bhutanese Calendar', 'btcal_widget_domain' ), ) 
		);
	}
	
	// Creating widget front-end
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		
		$display_year_title = $instance['display_year_title'] ? 'true' : 'false';
		$display_month_title = $instance['display_month_title'] ? 'true' : 'false';
		$display_monthyear_dropdown = $instance['display_monthyear_dropdown'] ? 'true' : 'false';
		$display_link = $instance['display_link'] ? 'true' : 'false';
		
		// This is where you run the code and display the output
		//echo __( 'Hello, World!', 'btcal_widget_domain' );
		bhutanese_calendar_month ($display_year_title,$display_month_title,$display_monthyear_dropdown,$display_link);
		//if($display_link=="true") echo "Hello";
		echo $args['after_widget'];
	}
				
	// Widget Backend 
	public function form( $instance ) {
		?>
		<p><input class="checkbox" type="checkbox" <?php checked($instance['display_year_title'], 'on'); ?> id="<?php echo $this->get_field_id('display_year_title'); ?>" name="<?php echo $this->get_field_name('display_year_title'); ?>" /> 
		Display Year <br /><br />
		<input class="checkbox" type="checkbox" <?php checked($instance['display_month_title'], 'on'); ?> id="<?php echo $this->get_field_id('display_month_title'); ?>" name="<?php echo $this->get_field_name('display_month_title'); ?>" /> 
		Display Month<br /><br />
		
		<input class="checkbox" type="checkbox" <?php checked($instance['display_monthyear_dropdown'], 'on'); ?> id="<?php echo $this->get_field_id('display_monthyear_dropdown'); ?>" name="<?php echo $this->get_field_name('display_monthyear_dropdown'); ?>" /> Display month and year dropdown <br /><br />
		
		<input class="checkbox" type="checkbox" <?php checked($instance['display_link'], 'on'); ?> id="<?php echo $this->get_field_id('display_link'); ?>" name="<?php echo $this->get_field_name('display_link'); ?>" /> Display plugin link <br />	</p>
	<?php 
	}
		
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		
		$instance['display_year_title'] = $new_instance['display_year_title'];
		$instance['display_month_title'] = $new_instance['display_month_title'];
		$instance['display_monthyear_dropdown'] = $new_instance['display_monthyear_dropdown'];
		$instance['display_link'] = $new_instance['display_link'];
		return $instance;
	}
} // Class end


