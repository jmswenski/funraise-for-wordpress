<?php
/**
 * Funraise for WordPress Widget 
 *
 * This widget makes it easier for you to add a Funraise form to your Wordpress site.
 *
 * @package   Funraise_For_Wordpress
 * @author    Jason Swenski <jason@funraise.io>
 * @license   GPL-2.0+
 * @link      https://funraise.io
 * @copyright 2016 Funraise Inc
 *
 * @wordpress-plugin
 * Plugin Name:       Funraise for Wordpress
 * Plugin URI:        https://funraise.io
 * Description:       This widget makes it easier for you to add a Funraise form to your Wordpress site.
 * Version:           1.0.0
 * Author:            Funraise Team
 * Author URI:        https://funraise.io
 * Text Domain:       funraise-for-wordpress
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /lang
 * GitHub Plugin URI: https://github.com/<owner>/<repo>
 */

 // Prevent direct file access
if ( ! defined ( 'ABSPATH' ) ) {
	exit;
}

class Funraise_For_Wordpress extends WP_Widget {

    /**
     *
     * Unique identifier for widget.
     *
     *
     * The variable name is used as the text domain when internationalizing strings
     * of text. Its value should match the Text Domain file header in the main
     * widget file.
     *
     * @since    1.0.0
     *
     * @var      string
     */
    protected $widget_slug = 'funraise_for_wordpress';

	/*--------------------------------------------------*/
	/* Constructor
	/*--------------------------------------------------*/

	/**
	 * Specifies the classname and description, instantiates the widget,
	 * loads localization files, and includes necessary stylesheets and JavaScript.
	 */
	public function __construct() {

		// load plugin text domain
		add_action( 'init', array( $this, 'funraise_for_wordpress' ) );

		// Hooks fired when the Widget is activated and deactivated
		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );
		parent::__construct(
			$this->get_widget_slug(),
			__( 'Funraise for Wordpress', $this->get_widget_slug() ),
			array(
				'classname'  => $this->get_widget_slug().'-class',
				'description' => __( 'This widget makes it easier for you to add a Funraise form to your Wordpress site', $this->get_widget_slug() )
			)
		);

		// Register admin styles and scripts
		add_action( 'admin_print_styles', array( $this, 'register_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );

		// Register site styles and scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'register_widget_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_widget_scripts' ) );


		// Refreshing the widget's cached output with each new post
		add_action( 'save_post',    array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );

	} // end constructor


    /**
     * Return the widget slug.
     *
     * @since    1.0.0
     *
     * @return    Plugin slug variable.
     */
    public function get_widget_slug() {
        return $this->widget_slug;
    }

	/*--------------------------------------------------*/
	/* Widget API Functions
	/*--------------------------------------------------*/

	/**
	 * Outputs the content of the widget.
	 *
	 * @param array args  The array of form elements
	 * @param array instance The current instance of the widget
	 */
	public function widget( $args, $instance ) {

		
		// Check if there is a cached output
		$cache = wp_cache_get( $this->get_widget_slug(), 'widget' );

		if ( !is_array( $cache ) )
			$cache = array();

		if ( ! isset ( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset ( $cache[ $args['widget_id'] ] ) )
			return print $cache[ $args['widget_id'] ];
		
		// go on with your widget logic, put everything into a string and …


		extract( $args, EXTR_SKIP );

		$widget_string = $before_widget;

		// TODO: Here is where you manipulate your widget's values based on their input fields
		ob_start();
		include( plugin_dir_path( __FILE__ ) . 'views/widget.php' );
		$widget_string .= ob_get_clean();
		$widget_string .= $after_widget;


		$cache[ $args['widget_id'] ] = $widget_string;

		wp_cache_set( $this->get_widget_slug(), $cache, 'widget' );

		print $widget_string;

	} // end widget
	
	
	public function flush_widget_cache() 
	{
    	wp_cache_delete( $this->get_widget_slug(), 'widget' );
	}
	/**
	 * Processes the widget's options to be saved.
	 *
	 * @param array new_instance The new instance of values to be generated via the update.
	 * @param array old_instance The previous instance of values before the update.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance = array();
		$instance['form_id'] = ( ! empty( $new_instance['form_id'] ) ) ? strip_tags( $new_instance['form_id'] ) : '';
	
		return $instance;


	} // end widget

	/**
	 * Generates the administration form for the widget.
	 *
	 * @param array instance The array of keys and values for the widget.
	 */
	public function form( $instance ) {

		// TODO: Define default values for your variables
		$instance = wp_parse_args(
			(array) $instance
		);

		$form_id = ( isset ($instance['form_id'] ) ) ? esc_attr($instance['form_id']) : '';

		// Display the admin form
		include( plugin_dir_path(__FILE__) . 'views/admin.php' );

	} // end form

	/*--------------------------------------------------*/
	/* Public Functions
	/*--------------------------------------------------*/

	/**
	 * Loads the Widget's text domain for localization and translation.
	 */
	public function widget_textdomain() {

		load_plugin_textdomain( $this->get_widget_slug(), false, plugin_dir_path( __FILE__ ) . 'lang/' );

	} // end widget_textdomain

	public function funraise_for_wordpress() {
		//TODO - text domain
	}

	/**
	 * Fired when the plugin is activated.
	 *
	 * @param  boolean $network_wide True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog.
	 */
	public function activate( $network_wide ) {
		// TODO define activation functionality here
	} // end activate

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @param boolean $network_wide True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog
	 */
	public function deactivate( $network_wide ) {
		// TODO define deactivation functionality here
	} // end deactivate

	/**
	 * Registers and enqueues admin-specific styles.
	 */
	public function register_admin_styles() {

		wp_enqueue_style( $this->get_widget_slug().'-admin-styles', plugins_url( 'css/admin.css', __FILE__ ) );

	} // end register_admin_styles

	/**
	 * Registers and enqueues admin-specific JavaScript.
	 */
	public function register_admin_scripts() {

		wp_enqueue_script( $this->get_widget_slug().'-admin-script', plugins_url( 'js/admin.js', __FILE__ ), array('jquery') );

	} // end register_admin_scripts

	/**
	 * Registers and enqueues widget-specific styles.
	 */
	public function register_widget_styles() {

		wp_enqueue_style( $this->get_widget_slug().'-widget-styles', plugins_url( 'css/widget.css', __FILE__ ) );

	} // end register_widget_styles

	/**
	 * Registers and enqueues widget-specific scripts.
	 */
	public function register_widget_scripts() {

		wp_enqueue_script( 'funraise', 'https://d2n4tvy2wsd0oo.cloudfront.net/widget/common/1.3/funraise.js');
		wp_enqueue_script( $this->get_widget_slug().'-script', plugins_url( 'js/widget.js', __FILE__ ), array('jquery') );

	} // end register_widget_scripts

    /**
	 * Generates widget shortocde
	 */
	public static function funraise_widget_by_shortcode($atts) {
    
	    global $wp_widget_factory;
	    
	    extract(shortcode_atts(array(
	        'form_id' => FALSE
	    ), $atts));
	    
	    $widget_name = 'Funraise_For_Wordpress';
	    
	    if (!is_a($wp_widget_factory->widgets[$widget_name], 'WP_Widget')):
	        $wp_class = 'WP_Widget_'.ucwords(strtolower($class));
	        
	        if (!is_a($wp_widget_factory->widgets[$wp_class], 'WP_Widget')):
	            return '<p>'.sprintf(__("%s: Widget class not found. Make sure this widget exists and the class name is correct"),'<strong>'.$class.'</strong>').'</p>';
	        else:
	            $class = $wp_class;
	        endif;
	    endif;
	    
	    ob_start();
	    the_widget($widget_name, $atts, array('widget_id'=>'arbitrary-instance-'.$id,
	        'before_widget' => '',
	        'after_widget' => '',
	        'before_title' => '',
	        'after_title' => ''
	    ));
	    $output = ob_get_contents();
	    ob_end_clean();
   		return $output;
    
	}

    /**
	 * Creates global settings menu page for plugin
	 */
	public static function funraise_plugin_create_menu() {
		//create new top-level menu
		add_menu_page('Funraise For Wordpress', 'Funraise', 'administrator', __FILE__, 
			'Funraise_For_Wordpress::funraise_plugin_settings_page' , plugins_url('/images/icon.png', __FILE__) );
		
		//call register settings function
		add_action( 'admin_init', 'Funraise_For_Wordpress::register_funraise_plugin_settings' );
    }

    /**
	 * Registers settings available on plugin setup page
	 */
	public static function register_funraise_settings() {
		//register our settings
		register_setting( 'funraise-plugin-settings-group', 'organization_uuid' );

	}

    /**
	 * Outputs settings page from settings.php
	 */
	public static function funraise_plugin_settings_page() {
	    ob_start();
		include( plugin_dir_path( __FILE__ ) . 'views/settings.php' );
		$widget_settings .= ob_get_clean();
		print $widget_settings;
	}

} // end class

add_shortcode('funraise-button','Funraise_For_Wordpress::funraise_button_by_shortcode'); 
add_shortcode('funraise','Funraise_For_Wordpress::funraise_widget_by_shortcode'); 
add_action('admin_menu', 'Funraise_For_Wordpress::funraise_plugin_create_menu');
add_action( 'widgets_init', create_function( '', 'register_widget("Funraise_For_Wordpress");' ) );

