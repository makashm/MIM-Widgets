<?php
/*
Plugin Name: MIM Widgets
Description: Simple Widgets
Plugin URI: http://codebanyan.com
Author: Al Imran Akash
Author URI: http://im.medhabi.com
Version: 1.0
License: GPL2
Text Domain: mim_widgets
Domain Path: mim_widgets
*/

/**
 * register widget
 */
function reg_widgets_function() {
	register_widget( 'mim_widget_class' );
}
add_action( 'widgets_init', 'reg_widgets_function' );

/**
 * MIM admin panel custom scripts.
 */
function mim_custom_widgets_scripts() {
	wp_enqueue_media();
	wp_enqueue_script( 'mim_custom_script', plugins_url( '/assets/js/mim_widgets.js', __FILE__ ), array( 'jquery' ), '1.0', true );
}
add_action( 'admin_enqueue_scripts', 'mim_custom_widgets_scripts' );

/**
* Class Name 'mim_widget_class'
*/
class mim_widget_class extends WP_Widget {
	
	public function __construct() {
		parent::__construct( 'mim_widget_id', 'MIM Widgets', array(
			'description' => 'My MIM Widgets',
		) );
	}
	public function widget( $args, $instance ) {
		
		echo $args[ 'before_widget' ]; 
		echo $args[ 'before_title' ] .$instance[ 'title' ].  $args[ 'after_title' ]; ?>
		<img src="<?php echo $instance[ 'upload_img' ] ?>" alt="<?php echo $instance['title']; ?>">
		<p><?php echo $instance[ 'message' ] ?></p> <?php
		echo $args[ 'after_widget' ]; 
	}
	public function form( $instance )
	{
		?>
			<div>
				<p>
					<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title</label>
					<input type="text" name="<?php echo $this->get_field_name( 'title' ) ?>" value="<?php echo $instance['title']; ?>" id="<?php echo $this->get_field_id( 'title' ); ?>" class="widefat">
				</p>
				<p>
					<button class="button" id="mim_widgets_img_id">Upload Image</button>
					<input type="hidden" class="mim_widgets_img_link" name="<?php echo $this->get_field_name( 'upload_img' ) ?>" value="<?php echo $instance[ 'upload_img' ] ?>">
					<div class="upload_img_class">
						<img src="<?php echo $instance[ 'upload_img' ] ?>" width="100%" height="auto" alt="">
					</div>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'message' ); ?>">Message</label>
					<textarea name="<?php echo $this->get_field_name( 'message' ) ?>"  value="<?php echo $instance['message']; ?>" id="<?php echo $this->get_field_id( 'message' ); ?>" class="widefat"></textarea>
				</p>
			</div>
		<?php
	}
}