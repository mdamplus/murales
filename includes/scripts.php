<?php
// Encolar scripts para el frontend
function enqueueGoogleMapsScript() {
    if (is_singular('murales')) {
        $api_key = get_option('google_maps_api_key');
        if ($api_key) {
            wp_enqueue_script('google-maps-api', 'https://maps.googleapis.com/maps/api/js?key=' . esc_attr($api_key), array(), null, true);
        }
    }
}
add_action('wp_enqueue_scripts', 'enqueueGoogleMapsScript');


// Enqueue de scripts
function murales_enqueue_media_scripts() {
    wp_enqueue_media();
    wp_enqueue_script('custom-admin-scripts', plugin_dir_url(__FILE__) . 'assets/js/imgDestacada.js', array('jquery'), null, true);
}
add_action('admin_enqueue_scripts', 'murales_enqueue_media_scripts');
