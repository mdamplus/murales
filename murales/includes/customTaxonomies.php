<?php
// Registrar la taxonomía Artista
function artistaTaxonomy() {
    $labels = array(
        'name'              => __( 'Artistas', 'mdam' ),
        // Otras etiquetas...
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'artista' ),
    );

    // Asociar la taxonomía tanto a 'murales' como a 'artista'
    register_taxonomy( 'artista', array( 'murales', 'artista' ), $args );
}
add_action( 'init', 'artistaTaxonomy' );

// Agregar los campos personalizados a la taxonomía Artista
function agregar_campos_artista_extra($term) {
    // Obtener los valores actuales de los metadatos
    $linkedin = get_term_meta($term->term_id, 'linkedin', true);
    $instagram = get_term_meta($term->term_id, 'instagram', true);
    $twitter = get_term_meta($term->term_id, 'twitter', true);
    $mote = get_term_meta($term->term_id, 'mote', true);
    ?>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="mote"><?php _e('Mote (Subtítulo)', 'mdam'); ?></label>
        </th>
        <td>
            <input type="text" name="mote" id="mote" value="<?php echo esc_attr($mote); ?>" />
            <p class="description"><?php _e('Subtítulo o apodo del artista.', 'mdam'); ?></p>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="linkedin"><?php _e('LinkedIn', 'mdam'); ?></label>
        </th>
        <td>
            <input type="url" name="linkedin" id="linkedin" value="<?php echo esc_attr($linkedin); ?>" />
            <p class="description"><?php _e('URL del perfil de LinkedIn del artista.', 'mdam'); ?></p>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="instagram"><?php _e('Instagram', 'mdam'); ?></label>
        </th>
        <td>
            <input type="url" name="instagram" id="instagram" value="<?php echo esc_attr($instagram); ?>" />
            <p class="description"><?php _e('URL del perfil de Instagram del artista.', 'mdam'); ?></p>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="twitter"><?php _e('Twitter', 'mdam'); ?></label>
        </th>
        <td>
            <input type="url" name="twitter" id="twitter" value="<?php echo esc_attr($twitter); ?>" />
            <p class="description"><?php _e('URL del perfil de Twitter del artista.', 'mdam'); ?></p>
        </td>
    </tr>
    <?php
}
add_action('artista_edit_form_fields', 'agregar_campos_artista_extra', 10, 2);

// Guardar los campos personalizados
function guardar_campos_artista_extra($term_id) {
    if (isset($_POST['linkedin'])) {
        update_term_meta($term_id, 'linkedin', esc_url($_POST['linkedin']));
    }
    if (isset($_POST['instagram'])) {
        update_term_meta($term_id, 'instagram', esc_url($_POST['instagram']));
    }
    if (isset($_POST['twitter'])) {
        update_term_meta($term_id, 'twitter', esc_url($_POST['twitter']));
    }
    if (isset($_POST['mote'])) {
        update_term_meta($term_id, 'mote', sanitize_text_field($_POST['mote']));
    }
}
add_action('edited_artista', 'guardar_campos_artista_extra', 10, 2);
add_action('create_artista', 'guardar_campos_artista_extra', 10, 2);


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
