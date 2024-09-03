<?php
// Registrar la taxonomía Artista
function artistaTaxonomy() {
    $labels = array(
        'name'              => __( 'Artistas', 'mdam' ),
        // Otras etiquetas... ??
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'artista' ),
    );

    register_taxonomy( 'artista', array( 'murales' ), $args );
}
add_action( 'init', 'artistaTaxonomy' );



// Registrar la taxonomía Distrito
function distritoTaxonomy() {
    $labels = array(
        'name'              => __( 'Distritos', 'mdam' ),
        'singular_name'     => __( 'Distrito', 'mdam' ),
        'search_items'      => __( 'Buscar Distritos', 'mdam' ),
        'all_items'         => __( 'Todos los Distritos', 'mdam' ),
        'parent_item'       => __( 'Distrito Padre', 'mdam' ),
        'parent_item_colon' => __( 'Distrito Padre:', 'mdam' ),
        'edit_item'         => __( 'Editar Distrito', 'mdam' ),
        'update_item'       => __( 'Actualizar Distrito', 'mdam' ),
        'add_new_item'      => __( 'Agregar Nuevo Distrito', 'mdam' ),
        'new_item_name'     => __( 'Nuevo Nombre de Distrito', 'mdam' ),
        'menu_name'         => __( 'Distrito', 'mdam' ),
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'distrito' ),
    );

    register_taxonomy( 'distrito', array( 'murales' ), $args );
}
add_action( 'init', 'distritoTaxonomy' );


// Registrar la taxonomía Financiación
function financiacionTaxonomy() {
    $labels = array(
        'name'              => __( 'Financiaciones', 'mdam' ),
        'singular_name'     => __( 'Financiación', 'mdam' ),
        'search_items'      => __( 'Buscar Financiaciones', 'mdam' ),
        'all_items'         => __( 'Todas las Financiaciones', 'mdam' ),
        'parent_item'       => __( 'Financiación Padre', 'mdam' ),
        'parent_item_colon' => __( 'Financiación Padre:', 'mdam' ),
        'edit_item'         => __( 'Editar Financiación', 'mdam' ),
        'update_item'       => __( 'Actualizar Financiación', 'mdam' ),
        'add_new_item'      => __( 'Agregar Nueva Financiación', 'mdam' ),
        'new_item_name'     => __( 'Nuevo Nombre de Financiación', 'mdam' ),
        'menu_name'         => __( 'Financiación', 'mdam' ),
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'financiacion' ),
    );

    register_taxonomy( 'financiacion', array( 'murales' ), $args );
}

//add_action( 'init', 'distritoTaxonomy' );
add_action( 'init', 'financiacionTaxonomy' );
