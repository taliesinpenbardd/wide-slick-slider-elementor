<?php
namespace WideSlickSliderElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if( ! defined( 'ABSPATH' ) ) exit;

/**
 * Wide Slick Slider Elementor
 * 
 * Allows for a slider to be full width
 */
class Wide_Slick_Slider_Elementor extends Widget_Base {

    /**
     * Retrieve the widget name
     */
    public function get_name() {
        return 'wide-slick-slider-elementor';
    }

    /**
     * Retrieve the widget title
     */
    public function get_title() {
        return __( 'Wide Slick Slider Elementor', 'wide-slick-slider-elementor' );
    }

    /**
     * Retrieve the widget icon
     */
    public function get_icon() {
        return 'eicon-slider-album';
    }

    /**
     * Retrieve the list of categories the widget belongs to
     */
    public function get_categories() {
        return [ 'general' ];
    }

    /**
     * Retrieve the list of scripts the widget depends on
     */
    public function get_script_depends() {
        return [ 'jquery', 'wide-slick-slider-elementor', 'slick' ];
    }

    /**
     * Register the widget controls
     */
    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'wide-slick-slider-elementor' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'image_url',
            [
                'label'     => __( 'Choose an image.', 'wide-slick-slider-elementor' ),
                'type'      => \Elementor\Controls_Manager::MEDIA,
                'default'   => [
                    'url'   => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'images',
            [
                'label'         => __( 'Images', 'wide-slick-slider-elementor' ),
                'type'          => \Elementor\Controls_Manager::REPEATER,
                'fields'        => $repeater->get_controls(),
                'default'       => [
                    [
                        'image_url'     => __( 'Image URL', 'wide-slick-slider-elementor' ),
                    ]
                ],
                'title_field'   => 'Image'
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'     => __( 'Autoplay ?', 'wide-slick-slider-elementor' ),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'label_on'  => __( 'Yes', 'wide-slick-slider-elementor' ),
                'label_off' => __( 'No', 'wide-slick-slider-elementor' ),
                'return_value'  => 'yes',
                'default'   => 'yes'
            ]
        );

        $this->add_control(
            'slide_timing',
            [
                'label'     => __( 'Choose the duration of animation', 'wide-slick-slider-elementor' ),
                'type'      => \Elementor\Controls_Manager::NUMBER,
                'default'   => '3000',
                'step'      => '100',
            ]
        );

        $this->add_control(
            'show_arrows',
            [
                'label'         => __( 'Displays navigation arrows ?', 'wide-slick-slider-elementor' ),
                'type'          => \Elementor\Controls_Manager::SWITCHER,
                'label_on'      => __( 'Show', 'wide-slick-slider-elementor' ),
                'label_off'     => __( 'Hide', 'wide-slick-slider-elementor' ),
                'return_value'  => 'yes',
                'default'       => 'no',
            ]
        );

        $this->add_control(
            'fade',
            [
                'label'         => __( 'Fade or slide ?', 'wide-slick-slider-elementor' ),
                'type'          => \Elementor\Controls_Manager::SWITCHER,
                'label_on'      => __( 'Fade', 'wide-slick-slider-elementor' ),
                'label_off'     => __( 'Slide', 'wide-slick-slider-elementor' ),
                'return_value'  => 'yes',
                'default'       => 'yes'
            ]
        );

        $this->add_control(
            'speed',
            [
                'label'         => __( 'Speed of transition', 'wide-slick-slider-elementor' ),
                'type'          => \Elementor\Controls_Manager::NUMBER,
                'default'       => '2000',
                'step'          => '100'
            ]
        );

        $this->add_control(
            'infinite',
            [
                'label'         => __( 'Infinite loop ?', 'wide-slick-slider-elementor' ),
                'type'          => \Elementor\Controls_Manager::SWITCHER,
                'label_on'      => __( 'Yes', 'wide-slick-slider-elementor' ),
                'label_off'     => __( 'No', 'wide-slick-slider-elementor' ),
                'return_value'  => 'yes',
                'default'       => 'yes'
            ]
        );

        $this->add_control(
			'min_height',
			[
				'label'         => __( 'Size', 'plugin-name' ),
				'type'          => \Elementor\Controls_Manager::SLIDER,
				'size_units'    => [ 'px', 'vh' ],
				'range'         => [
					'px'    => [
						'min' => 1,
                    ],
                    'vh'    => [
                        'min'   => 1,
                        'max'   => 100,
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .wide-slick-slider-elementor' => 'min-height: {{SIZE}}{{UNIT}};',
                ]
			]
		);

        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend
     */
    protected function render() {
        $settings   = $this->get_settings_for_display();
        $autoplay   = ( 'yes' === $settings['autoplay'] ) ? 'true' : 'false';
        $arrows     = ( 'yes' === $settings['show_arrows'] ) ? 'true' : 'false';
        $fade       = ( 'yes' === $settings['fade'] ) ? 'true' : 'false';
        $infinite   = ( 'yes' === $settings['infinite'] ) ? 'true' : 'false';

        // echo '<pre>' . print_r( $settings['min_height'], true ) . '</pre>';

        echo '<div class="wide-slick-slider-elementor" data-slick=\'{
            "autoplay":' . $autoplay . ',
            "autoplaySpeed":"' . $settings['slide_timing'] . '",
            "fade":' . $fade . ',
            "arrows":' . $arrows . ',
            "speed":"' . $settings['speed'] . '",
            "infinite":' . $infinite . '
        }\' style="min-height: ' . $settings['min_height']['size'] . $settings['min_height']['unit'] . ';">';

        foreach( $settings['images'] as $image ) {
            echo '<div class="bgslider-image" style="background-image: url(' . $image['image_url']['url'] . ');"></div>';
        }
        
        echo '</div>';
    }

    /**
     * Render the widget output in the editor
     */
    protected function _content_template() {
        ?>
        <#
        if( 'yes' === settings.autoplay ) { settings.autoplay = 'true' } else { settings.autoplay = 'false' };
        if( 'yes' === settings.arrows ) { settings.arrows = 'true' } else { settings.arrows = 'false' };
        if( 'yes' === settings.fade ) { settings.fade = 'true' } else { settings.fade = 'false' };
        if( 'yes' === settings.infinite ) { settings.infinite = 'true' } else { settings.infinite = 'false' };
        #>
        <div class="wide-slick-slider-elementor bgslider" data-slick='{"autoplay": {{{ settings.autoplay }}}, "autoplaySpeed": "{{{ settings.autoplaySpeed }}}", "fade": {{{ settings.fade }}}, "arrows": {{{ settings.arrows }}}, "speed": "{{{ settings.speed }}}", "infinite": {{{ settings.infinite }}},}' >
            <#
            if( settings.images ) {
                _.each( settings.images, function( image, index ) {
                    #>
                        <div class="bgslider-image" style="background-image: url( {{{ image.image_url.url }}} );"></div>
                    <#
                });
            }
            #>
        </div>
        <?php 
    }
    
}