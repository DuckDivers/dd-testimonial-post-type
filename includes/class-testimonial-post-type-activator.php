<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.howardehrenberg.com
 * @since      1.0.0
 *
 * @package    Testimonial_Post_Type
 * @subpackage Testimonial_Post_Type/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Testimonial_Post_Type
 * @subpackage Testimonial_Post_Type/includes
 * @author     Howard Ehrenberg <howard@howardehrenberg.com>
 */
class Testimonial_Post_Type_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
        
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-testimonial-post-type-admin.php';
        
        Testimonial_Post_Type_Admin::testimonial_custom_post();
        flush_rewrite_rules();

	}

}
