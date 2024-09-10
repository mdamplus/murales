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

// Plantillas para Custom Post Types y taxonomías
function cargarPlantillaCustom($template) {
    if (is_singular('murales')) {
        $plugin_template = plugin_dir_path(__FILE__) . 'templates/singleMurales.php';
        if (file_exists($plugin_template)) {
            return $plugin_template;
        }
    } elseif (is_tax('artista')) {
        $plugin_template = plugin_dir_path(__FILE__) . 'templates/singleArtista.php';
        if (file_exists($plugin_template)) {
            return $plugin_template;
        }
    }

    return $template;
}
add_filter('template_include', 'cargarPlantillaCustom');



// nueva versión
function mostrar_campos_artista($term_id) {
    // Obtener los metadatos personalizados
    $linkedin = get_term_meta($term_id, 'linkedin', true);
    $instagram = get_term_meta($term_id, 'instagram', true);
    $twitter = get_term_meta($term_id, 'twitter', true);
    $mote = get_term_meta($term_id, 'mote', true);

    // Mostrar el Mote
    if ($mote) {
        echo '<h2 class="artist-subtitle">' . esc_html($mote) . '</h2>';
    }

    // Mostrar los enlaces de redes sociales si existen
    echo '<div class="artist-social-links">';
    if ($linkedin) {
        echo '<a href="' . esc_url($linkedin) . '" target="_blank">LinkedIn</a><br>';
    }
    if ($instagram) {
        echo '<a href="' . esc_url($instagram) . '" target="_blank">Instagram</a><br>';
    }
    if ($twitter) {
        echo '<a href="' . esc_url($twitter) . '" target="_blank">Twitter</a>';
    }
    echo '</div>';
}
