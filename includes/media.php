<?php
// Enqueue media uploader<?php
// Enqueue media uploader
function enqueue_media_uploader() {
    wp_enqueue_media();
    wp_enqueue_script('mediaUpload', plugin_dir_url(__FILE__) . '../assets/js/imgDestacada.js', array('jquery'), null, true);
}
add_action('admin_enqueue_scripts', 'enqueue_media_uploader');
