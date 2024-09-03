<?php
// Añadir nuevas columnas a la lista de murales en el admin
function agregarColumnasMurales($columns) {
    $columns['artista'] = __('Artista', 'mdam');
    $columns['distrito'] = __('Distrito', 'mdam');
    $columns['financiacion'] = __('Financiación', 'mdam');
    return $columns;
}
add_filter('manage_murales_posts_columns', 'agregarColumnasMurales');

// Mostrar los datos en las columnas personalizadas
function mostrarDatosColumnasMurales($column, $post_id) {
    switch ($column) {
        case 'artista':
            $terms = get_the_term_list($post_id, 'artista', '', ', ', '');
            echo is_string($terms) ? $terms : __('Sin Artista', 'mdam');
            break;

        case 'distrito':
            $terms = get_the_term_list($post_id, 'distrito', '', ', ', '');
            echo is_string($terms) ? $terms : __('Sin Distrito', 'mdam');
            break;

        case 'financiacion':
            $terms = get_the_term_list($post_id, 'financiacion', '', ', ', '');
            echo is_string($terms) ? $terms : __('Sin Financiación', 'mdam');
            break;
    }
}
add_action('manage_murales_posts_custom_column', 'mostrarDatosColumnasMurales', 10, 2);

// Hacer que las columnas sean ordenables
function columnasOrdenablesMurales($columns) {
    $columns['artista'] = 'artista';
    $columns['distrito'] = 'distrito';
    $columns['financiacion'] = 'financiacion';
    return $columns;
}
add_filter('manage_edit-murales_sortable_columns', 'columnasOrdenablesMurales');
