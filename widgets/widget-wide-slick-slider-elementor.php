<?php
namespace WideSlickSliderElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

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
            'images_section',
            [
                'label' => __( 'Images', 'wide-slick-slider-elementor' ),
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

        $this->start_controls_section(
            'text_section',
            [
                'label'     => __( 'Text', 'wide-slick-slider-elementor' ),
                'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'display_legend',
            [
                'label'         => __( 'Display legend ?', 'wide-slick-slider-elementor' ),
                'type'          => \Elementor\Controls_Manager::SWITCHER,
                'label_on'      => __( 'Yes', 'wide-slick-slider-elementor' ),
                'label_off'     => __( 'No', 'wide-slick-slider-elementor' ),
                'return_value'  => 'yes',
                'default'       => 'no'
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label'         => __( 'Text caption color.', 'wide-slick-slider-elementor' ),
                'type'          => \Elementor\Controls_Manager::COLOR,
                'default'       => '#FFFFFF',
                'selectors'     => [ '{{WRAPPER}} .wide-slick-slider-elementor .caption' => 'color: {{VALUE}};']
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'text_typography',
                'label'         => __( 'Text', 'wide-slick-slider-elementor' ),
                'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                'selector'      => '{{WRAPPER}} .wide-slick-slider-elementor .caption',
            ]
        );

        $this->add_control(
            'bg_color',
            [
                'label'         => __( 'Caption BG color.', 'wide-slick-slider-elementor' ),
                'type'          => \Elementor\Controls_Manager::COLOR,
                'default'       => 'rgba(0,0,0,0.5)',
                'selectors'     => [ '{{WRAPPER}} .wide-slick-slider-elementor .caption' => 'background-color: {{VALUE}};']
            ]
        );

        $this->add_control(
            'caption_vertical_position',
            [
                'label'         => __( 'Choose the vertical position of the caption.', 'wide-slick-slider-elementor' ),
                'type'          => \Elementor\Controls_Manager::CHOOSE,
                'options'       => [
                    'flex-start'    => [
                        'title' => __( 'Top', 'wide-slick-slider-elementor' ),
                        'icon'  => 'fa fa-long-arrow-up'
                    ],
                    'center'        => [
                        'title' => __( 'Center', 'wide-slick-slider-elementor' ),
                        'icon'  => 'fa fa-arrows-v'
                    ],
                    'flex-end'      => [
                        'title' => __( 'Bottom', 'wide-slick-slider-elementor' ),
                        'icon'  => 'fa fa-long-arrow-down'
                    ]
                ]
            ]
        );

        $this->add_control(
            'caption_horizontal_position',
            [
                'label'         => __( 'Choose the horizontal position of the caption.', 'wide-slick-slider-elementor' ),
                'type'          => \Elementor\Controls_Manager::CHOOSE,
                'options'       => [
                    'flex-start'    => [
                        'title' => __( 'Left', 'wide-slick-slider-elementor' ),
                        'icon'  => 'fa fa-align-left'
                    ],
                    'center'        => [
                        'title' => __( 'Center', 'wide-slick-slider-elementor' ),
                        'icon'  => 'fa fa-align-center'
                    ],
                    'flex-end'      => [
                        'title' => __( 'Right', 'wide-slick-slider-elementor' ),
                        'icon'  => 'fa fa-align-right'
                    ]
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
        $showLegend = ( 'yes' === $settings['display_legend'] ) ? 'true' : 'false';

        // echo '<pre>' . print_r( $settings['min_height'], true ) . '</pre>';

        echo '<div class="wide-slick-slider-elementor" data-slick=\'{
            "autoplay":' . $autoplay . ',
            "autoplaySpeed":"' . $settings['slide_timing'] . '",
            "fade":' . $fade . ',
            "arrows":' . $arrows . ',
            "speed":"' . $settings['speed'] . '",
            "infinite":' . $infinite . '
        }\' style="
            min-height: ' . $settings['min_height']['size'] . $settings['min_height']['unit'] . ';
        ">';

        foreach( $settings['images'] as $image ) {
            echo '<div class="bgslider-image" style="
                background-image: url(' . $image['image_url']['url'] . '); 
                justify-content: ' . $settings['caption_horizontal_position'] . '; 
                align-items: ' . $settings['caption_vertical_position'] . '; 
            ">';
            if( $showLegend === 'true' ) {
                $media_meta = $this->wp_get_attachment( $image['image_url']['id'] );
                echo '<span class="caption" style="color: ' . $settings['text_color'] . '; background-color: ' . $settings['bg_color'] . ';">' . $media_meta['description'] . '</span>';
            }
            echo '</div>';
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
                        <div class="bgslider-image" style="background-image: url( {{{ image.image_url.url }}} ); justify-content: {{{ settings.caption_vertical_position }}}; align-items: {{{ settings.caption_vertical_position }}};">
                            <#
                            if( settings.display_legend === 'yes' ) {
                                var image_id = String( image.image_url.id );
                                var media_meta = <?php echo $this->wp_get_attachment( 'image_id' ); ?>
                                #>
                                <span class="caption" style="color: {{{ settings.text_color }}}; background-color: {{{ settings.bg_color }}};">{{{ media_meta.description }}}</span>
                                <#
                            }
                            #>
                        </div>
                    <#
                });
            }
            #>
        </div>
        <?php 
    }

    /**
     * Get the media meta
     */
    protected function wp_get_attachment( $attachment_id ) {

        $attachment     = get_post( $attachment_id );
        $alt            = ( get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ) ) ? get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ) : '';
        $caption        = ( $attachment->post_excerpt ) ? $attachment->post_excerpt : '';
        $description    = ( $attachment->post_content ) ? $attachment->post_content : '';
        $href           = ( get_permalink( $attachment->ID ) ) ? get_permalink( $attachment->ID ) : '';
        $src            = ( $attachment->guid ) ? $attachment->guid : '';
        $title          = ( $attachment->post_title ) ? $attachment->post_title : '';

        return [
            'alt'           => $alt,
            'caption'       => $caption,
            'description'   => $description,
            'href'          => $href,
            'src'           => $src,
            'title'         => $title
        ];
        
    }
    
}