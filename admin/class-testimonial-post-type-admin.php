<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.howardehrenberg.com
 * @since      1.0.0
 *
 * @package    Testimonial_Post_Type
 * @subpackage Testimonial_Post_Type/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Testimonial_Post_Type
 * @subpackage Testimonial_Post_Type/admin
 * @author     Howard Ehrenberg <howard@howardehrenberg.com>
 */
class Testimonial_Post_Type_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
        $this->load_metaboxes();

	}
    
    /**
     * Add the metaboxes
     *
     * @since    1.0.0
     */
    private function load_metaboxes(){
        $plugin_meta = new Testimonial_Post_Type_Meta;
    }
    
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/testimonial-post-type-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the Custom Post Type
	 *
	 * @since    1.0.0
	 */
    
    public static function testimonial_custom_post() {

	$labels = array(
		'name'                  => _x( 'Testimonials', 'Post Type General Name', 'dd_theme' ),
		'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'dd_theme' ),
		'menu_name'             => __( 'Testimonials', 'dd_theme' ),
		'name_admin_bar'        => __( 'Testimonials', 'dd_theme' ),
		'archives'              => __( 'Testimonial Archives', 'dd_theme' ),
		'attributes'            => __( 'Item Attributes', 'dd_theme' ),
		'parent_item_colon'     => __( 'Parent Item:', 'dd_theme' ),
		'all_items'             => __( 'All Testimonials', 'dd_theme' ),
		'add_new_item'          => __( 'Add New Testimonial', 'dd_theme' ),
		'add_new'               => __( 'Add New', 'dd_theme' ),
		'new_item'              => __( 'New Item', 'dd_theme' ),
		'edit_item'             => __( 'Edit Item', 'dd_theme' ),
		'update_item'           => __( 'Update Item', 'dd_theme' ),
		'view_item'             => __( 'View Item', 'dd_theme' ),
		'view_items'            => __( 'View Items', 'dd_theme' ),
		'search_items'          => __( 'Search Item', 'dd_theme' ),
		'not_found'             => __( 'Not found', 'dd_theme' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'dd_theme' ),
		'featured_image'        => __( 'Featured Image', 'dd_theme' ),
		'set_featured_image'    => __( 'Set featured image', 'dd_theme' ),
		'remove_featured_image' => __( 'Remove featured image', 'dd_theme' ),
		'use_featured_image'    => __( 'Use as featured image', 'dd_theme' ),
		'insert_into_item'      => __( 'Insert into item', 'dd_theme' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'dd_theme' ),
		'items_list'            => __( 'Items list', 'dd_theme' ),
		'items_list_navigation' => __( 'Items list navigation', 'dd_theme' ),
		'filter_items_list'     => __( 'Filter items list', 'dd_theme' ),
	);
        
    $rewrite = array(
		'slug'                  => 'testimonial',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
        
		$args = array(
		'label'                 => __( 'Testimonial', 'dd_theme' ),
		'description'           => __( 'Testimonial', 'dd_theme' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-megaphone',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
	       );
	   register_post_type( 'testi', $args );
        
    }
    

}
