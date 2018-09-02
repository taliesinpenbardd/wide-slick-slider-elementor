<?php
/**
 * Plugin Name:       Wide Slick Slider Elementor
 * Plugin URI:        https://arthos.fr
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Arthos
 * Author URI:        https://arthos.fr
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wide-slick-slider-elementor
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Main class
 */

class Wide_Slick_Slider_Elementor {

    /**
     * Plugin version
     */
    const VERSION = '1.0.0';

    /**
     * Minimum Elementor Version
     */
    const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

    /**
     * Minimum PHP Version
     */
    const MINIMUM_PHP_VERSION = '7.0';

    /**
     * Constructor
     */
    public function __construct() {

        // Load translation
        add_action( 'init', [ $this, 'i18n' ] );

        // Init Plugin
        add_action( 'plugins_loaded', [ $this, 'init' ] );
        
    }

    /**
     * Load textdomain
     */
    public function i18n() {

        load_plugin_textdomain( 'wide-slick-slider-elementor' );
        
    }

    /**
     * Initialize the plugin
     */
    public function init() {

        // Check if Elementor is installed and running
        if( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
            return;
        }

        // Check for required Elementor version
        if( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
            return;
        }

        // Check for required PHP version
        if( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
            return;
        }

        // All validation checks passed, ignition!
        require_once( 'plugin.php' );
        
    }

    /**
     * Admin notice
     * Warning when the site doesn't have Elementor installed or activated
     */
    public function admin_notice_missing_main_plugin() {

        if( isset( $_GET['activate'] ) )
            unset( $_GET['activate'] );

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor */
            esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'wide-slick-slider-elementor' ),
            '<strong>' . esc_html__( 'Wide Slick Slider Elementor', 'wide-slick-slider-elementor' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'wide-slick-slider-elmentor' ) . '</strong>'
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
        
    }

    /**
     * Admin notice
     * Warning when the site doesn't have a minimum required Elementor version
     */
    public function admin_notice_minimum_elementor_version() {

        if( isset( $_GET['activate'] ) )
            unset( $_GET['activate'] );

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'wide-slick-slider-elementor' ),
            '<strong>' . esc_html__( 'Wide Slick Slider Elementor', 'wide-slick-slider-elementor' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'wide-slick-slider-elementor' ) . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
        
    }

    /**
     * Admin notice
     * Warning when the site doesn't have a minimum required PHP version
     */
    public function admin_notice_minimum_php_version() {

        if( isset( $_GET['activate'] ) )
            unset( $_GET['activate'] );
        
        $message = sprintf(
            /* translator: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'wide-slick-slider-elementor' ),
            '<strong>' . esc_html__( 'Wide Slick Slider Elementor', 'wide-slick-slider-elementor' ) . '</strong>',
            '<strong>' . esc_html__( 'PHP', 'wide-slick-slider-elementor' ) . '</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
        
    }
    
}

// Instantiate Wide_Slick_Slider_Elementor
new Wide_Slick_Slider_Elementor();