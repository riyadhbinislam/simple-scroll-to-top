<?php
/*
Plugin Name:        Simple Scroll To Top
Plugin URI:         https://riyadhbin.com
Description:        Simple Scroll to Top is a lightweight and user-friendly WordPress plugin that adds a “Back to Top” button to your website. This plugin improves user experience by enabling visitors to effortlessly scroll back to the top of any page. With intuitive customization options, you can easily modify the button’s appearance to suit your site’s design.
Version:            1.0.0
Requires at Least:  6.1
Requires PHP:       7.2
Author:             Riyadh Bin Islam
Author URI:         https://riyadhbin.com
License:            GNU General Public License v2 or later
License URI:        http://www.gnu.org/licenses/gpl-2.0.html
Update URI:         https://github.com/riyadhbinislam
Text Domain:        sstt
*/



// Including CSS And Plugin Js

function sstt_enqueue_style(){
    wp_enqueue_style('sstt-style', plugins_url('css/sstt-style.css', __FILE__), array(), '1.0.0', 'all');
}

function sstt_enqueue_scripts(){
    wp_enqueue_script('jquery');
    wp_enqueue_script('sstt-plugin-script', plugins_url('js/sstt-plugin.js', __FILE__), array(), '1.0.0', true);
}

add_action( "wp_enqueue_scripts", "sstt_enqueue_style");
add_action( "wp_enqueue_scripts", "sstt_enqueue_scripts");

// Plugun Activation Settings

function sstt_scroll_script(){?>
<script>
    jQuery(document).ready(function() {
        jQuery.scrollUp();
    })
</script>
<?php }

add_action( "wp_footer", "sstt_scroll_script");


//Plugin Customization Settings


add_action( "customize_register", "sstt_scroll_to_top" );

function sstt_scroll_to_top($wp_customize){
    $wp_customize->add_section('sstt_scroll_top_section', [
        'title'    => __('Scroll To Top Settings', 'sstt'),
        'description' => 'Simple Scroll to top plugin will help you to enable Back to Top Button for your website.',
        'priority' => 60,
    ]);

    // Add setting for Scroll Button Background Color
    $wp_customize->add_setting('sstt_scroll_button_bg_color', [
        'default'           => '#262626',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);

    $wp_customize->add_control('sstt_scroll_button_bg_color', [
        'label'    => __('Background Color', 'sstt'),
        'section'  => 'sstt_scroll_top_section',
        'settings' => 'sstt_scroll_button_bg_color',
        'type'     => 'color',

    ]);

    // Add setting for Border Radius Background Color

    $wp_customize->add_setting('sstt_scroll_button_radius', [
        'default'           => '5px',
        'sanitize_callback' => 'sanitize_text_field', // Use appropriate sanitization for text
    ]);

    $wp_customize->add_control('sstt_scroll_button_radius', [
        'label'    => __('Border Radius', 'sstt'),
        'section'  => 'sstt_scroll_top_section',
        'settings' => 'sstt_scroll_button_radius',
        'type'     => 'text',

    ]);
}

function sstt_color_customization() {
    // Get settings via get_theme_mod
    $color = get_theme_mod('sstt_scroll_button_bg_color', '#262626'); // Default fallback value
    $radius = get_theme_mod('sstt_scroll_button_radius', '5px'); // Default fallback value
    ?>
    <style>
        #scrollUp {
            background-color: <?php echo esc_attr($color); ?> !important;
            border-radius: <?php echo esc_attr($radius); ?> !important;
        }
    </style>
    <?php
}

add_action('wp_head', 'sstt_color_customization');
?>








?>