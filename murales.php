<?php
/*
 * Plugin Name: Murales by z
 * Description: Plugin para la creación de taxonomía de artistas y murales.
 * Version: 2024.09.2
 * Author: martinarnedo.com
 * Author URI: https://martinarnedo.com
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Evita el acceso directo
}

// Incluir archivos necesarios
require_once plugin_dir_path( __FILE__ ) . 'includes/customPostTypes.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/customTaxonomies.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/customFields.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/adminColumns.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/adminSettings.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/googleMaps.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/scripts.php';

// Enqueue de scripts
function murales_enqueue_media_scripts() {
    wp_enqueue_media();
    wp_enqueue_script('custom-admin-scripts', plugin_dir_url(__FILE__) . 'assets/js/imgDestacada.js', array('jquery'), null, true);
}
add_action('admin_enqueue_scripts', 'murales_enqueue_media_scripts');

// Plantillas de Custom Post Types
function cargarPlantillaSingle($template) {
    if (is_singular('murales')) {
        $plugin_template = plugin_dir_path(__FILE__) . 'templates/singleMurales.php';
        if (file_exists($plugin_template)) {
            return $plugin_template;
        }
    }
    
    if (is_singular('artista')) {
        $plugin_template = plugin_dir_path(__FILE__) . 'templates/singleArtista.php';
        if (file_exists($plugin_template)) {
            return $plugin_template;
        }
    }

    return $template;
}
add_filter('single_template', 'cargarPlantillaSingle');
