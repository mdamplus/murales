<?php
// Añadir una nueva columna para el ID en la lista de publicaciones
function IDsWordpress($columns) {
    $columns['post_id'] = 'ID';
    return $columns;
}
add_filter('manage_posts_columns', 'IDsWordpress');

// Rellenar la columna de ID con los datos correspondientes
function IDsWordpressColumnContent($column_name, $post_id) {
    if ($column_name == 'post_id') {
        echo $post_id;
    }
}
add_action('manage_posts_custom_column', 'IDsWordpressColumnContent', 10, 2);

// Añadir estilos para que la columna no sea tan estrecha
function IDsWordpressCustomStyle() {
    echo '<style>
        .column-post_id { width: 50px; }
    </style>';
}
add_action('admin_head', 'IDsWordpressCustomStyle');
