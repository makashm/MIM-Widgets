<?php

/**
 * Plugin Name: 		MIM Widgets
 * Plugin URI:        	https://github.com/makashm/MIM-Widgets
 * Description:       	Widgets Plugin for WordPress
 * Version:           	1.0.0
 * Author:            	Al Imran Akash
 * Author URI:        	http://im.medhabi.com
 * Text Domain:       	preloader
 * Domain Path:       	/languages
 */


/**
 * Registers a Widget
 *
 * @link       http://im.medhabi.com
 * @since      1.0.0
 * @package    MIM Widgets
 * @author     Al Imran Akash
 */

class mim_widget_class extends WP_Widget {
	
	public function __construct() {
		parent::__construct( 'mim_widget_id', 'MIM Widgets', array(
			'description' => 'My MIM Widgets',
		) );
	}

	/**
	 * Creating widget front-end
	 */
	public function widget( $args, $instance ) {
		
		echo $args[ 'before_widget' ]; 
		echo $args[ 'before_title' ] .$instance[ 'title' ].  $args[ 'after_title' ]; ?>
		<img src="<?php echo $instance[ 'upload_img' ] ?>" alt="<?php echo $instance['title']; ?>">
		<p><?php echo $instance[ 'message' ] ?></p> <?php
		echo $args[ 'after_widget' ]; 
	}

	/**
	 * Widget Backend 
	 */
	public function form( $instance ) {
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

	/**
	 * Updating widget replacing old instances with new
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['upload_img'] = ( ! empty( $new_instance['upload_img'] ) ) ? strip_tags( $new_instance['upload_img'] ) : '';
		$instance['message'] = ( ! empty( $new_instance['message'] ) ) ? strip_tags( $new_instance['message'] ) : '';
		return $instance;
	}
}

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
