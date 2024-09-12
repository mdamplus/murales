<?php
/*
 * Plugin Name: Murales by z
 * Description: Plugin para la creación de taxonomía de artistas y murales. Conoce más y contribuye en <a href="https://github.com/mdamplus/murales" target="_blank">GitHub</a>. Colaboradores: <a href="https://github.com/jesusmartincruces" target="_blank">jesusmartincruces</a>, <a href="https://github.com/Prysthen" target="_blank">Prysthen </a>, <a href="https://github.com/mdamplus" target="_blank">MDAM zZ</a>.
 .
 * Version: 2024.09.2
 * Author: martinarnedo.com
 * Author URI: https://martinarnedo.com
 * Contributors: jesusmartincruces, Prysthen
 * Contributor URI: https://github.com/jesusmartincruces, https://github.com/Prysthen
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
require_once plugin_dir_path( __FILE__ ) . 'includes/media.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/ids.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/social.php';


//Plantillas de mural y de artistas
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

//Power by z