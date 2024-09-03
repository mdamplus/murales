<?php
// Registrar el Custom Post Type Murales
function muralZz() {
    $labels = array(
        'name'                  => __( 'Murales', 'mdam' ),
        'singular_name'         => __( 'Mural', 'mdam' ),
        // Otras etiquetas...
    );

    $args = array(
        'label'                 => __( 'Murales', 'mdam' ),
        'supports'              => array( 'title', 'editor', 'thumbnail' ),
        'public'                => true,
        'show_ui'               => true,
        'menu_icon'             => 'dashicons-art',
        'has_archive'           => true,
        'rewrite'               => array( 'slug' => 'murales' ),
        'show_in_rest'          => true,
    );

    register_post_type( 'murales', $args );
}
add_action( 'init', 'muralZz' );
