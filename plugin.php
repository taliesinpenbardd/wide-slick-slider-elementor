<?php
namespace WideSlickSliderElementor;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Plugin {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {
        wp_register_script( 'slick', plugins_url( '/assets/js/slick.min.js', __FILE__ ), [ 'jquery' ], null, true );
        wp_register_script( 'wide-slick-slider-elementor', plugins_url( '/assets/js/wide-slick-slider-elementor.js', __FILE__ ), [ 'jquery' ], null, true );
    }
    
    /**
     * Widget Styles
     */
    public function widget_styles() {
        wp_enqueue_style( 'slick', plugins_url( '/assets/css/slick.css', __FILE__ ) );
        wp_enqueue_style( 'wide-slick-slider-elementor', plugins_url( '/assets/css/wide-slick-slider-elementor.css', __FILE__ ) );
    }

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.2.0
	 * @access private
	 */
	private function include_widgets_files() {
        require_once( __DIR__ . '/widgets/widget-wide-slick-slider-elementor.php' );
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		// Register Widgets
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Wide_Slick_Slider_Elementor() );
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {

		// Register widget scripts
        add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );
        
        // Register widget styles
        add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
	}
}

// Instantiate Plugin Class
Plugin::instance();
