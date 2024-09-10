<?php
// Agregar campos personalizados para la taxonomía 'artista' y 'financiacion'
function agregarCustomFieldsTaxonomy($term) {
    if (!is_object($term) || !property_exists($term, 'term_id')) {
        return;
    }

    $term_id = $term->term_id;
    $image_id = get_term_meta($term_id, 'imagenDestacada', true);
    $description = get_term_meta($term_id, 'descripcionExtra', true);

    echo '<tr class="form-field term-group-wrap">';
    echo '<th scope="row"><label for="imagenDestacada">' . __('Imagen Destacada', 'mdam') . '</label></th>';
    echo '<td>';
    echo '<input type="hidden" id="imagenDestacada" name="imagenDestacada" value="' . esc_attr($image_id) . '" />';
    echo '<img id="imagenDestacadaPreview" src="' . esc_url(wp_get_attachment_url($image_id)) . '" style="max-width:150px; max-height:150px;" />';
    echo '<input type="button" class="button" id="subirImagen" value="' . __('Subir Imagen', 'mdam') . '" />';
    echo '<input type="button" class="button" id="borrarImagen" value="' . __('Quitar Imagen', 'mdam') . '" />';
    echo '</td></tr>';

    echo '<tr class="form-field term-group-wrap">';
    echo '<th scope="row"><label for="descripcionExtra">' . __('Descripción Extra', 'mdam') . '</label></th>';
    echo '<td>';
    echo '<textarea id="descripcionExtra" name="descripcionExtra" rows="5" cols="40">' . esc_textarea($description) . '</textarea>';
    echo '</td></tr>';
}

function guardarCustomTaxonomyFields($term_id) {
    if (isset($_POST['imagenDestacada'])) {
        update_term_meta($term_id, 'imagenDestacada', sanitize_text_field($_POST['imagenDestacada']));
    }
    if (isset($_POST['descripcionExtra'])) {
        update_term_meta($term_id, 'descripcionExtra', sanitize_textarea_field($_POST['descripcionExtra']));
    }
}

function agregarMetaboxesTaxonomies() {
    add_action('artista_edit_form_fields', 'agregarCustomFieldsTaxonomy');
    add_action('artista_add_form_fields', 'agregarCustomFieldsTaxonomy');
    add_action('financiacion_edit_form_fields', 'agregarCustomFieldsTaxonomy');
    add_action('financiacion_add_form_fields', 'agregarCustomFieldsTaxonomy');
}
add_action('init', 'agregarMetaboxesTaxonomies');

add_action('edited_artista', 'guardarCustomTaxonomyFields');
add_action('create_artista', 'guardarCustomTaxonomyFields');
add_action('edited_financiacion', 'guardarCustomTaxonomyFields');
add_action('create_financiacion', 'guardarCustomTaxonomyFields');

function agregarCustomFieldsArtista($post) {
    $descripcion_extra = get_post_meta($post->ID, 'descripcion_extra', true);
    $descripcion_detallada = get_post_meta($post->ID, 'descripcion_detallada', true);
    wp_nonce_field('guardar_custom_fields', 'artista_nonce');
    ?>
    <div class="form-field">
        <label for="descripcion_extra"><?php _e('Descripción Extra', 'mdam'); ?></label>
        <textarea id="descripcion_extra" name="descripcion_extra" rows="5" style="width: 100%;"><?php echo esc_textarea($descripcion_extra); ?></textarea>
        <p class="description"><?php _e('Introduce una descripción adicional del artista.', 'mdam'); ?></p>
    </div>
    <div class="form-field">
        <label for="descripcion_detallada"><?php _e('Descripción Detallada', 'mdam'); ?></label>
        <textarea id="descripcion_detallada" name="descripcion_detallada" rows="10" style="width: 100%;"><?php echo esc_textarea($descripcion_detallada); ?></textarea>
        <p class="description"><?php _e('Introduce una descripción detallada del artista.', 'mdam'); ?></p>
    </div>
    <?php
}

function guardarCustomFieldsArtista($post_id) {
    if (!isset($_POST['artista_nonce']) || !wp_verify_nonce($_POST['artista_nonce'], 'guardar_custom_fields')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (current_user_can('edit_post', $post_id)) {
        if (isset($_POST['descripcion_extra'])) {
            update_post_meta($post_id, 'descripcion_extra', sanitize_textarea_field($_POST['descripcion_extra']));
        }
        if (isset($_POST['descripcion_detallada'])) {
            update_post_meta($post_id, 'descripcion_detallada', sanitize_textarea_field($_POST['descripcion_detallada']));
        }
    }
}

function agregarMetaboxesArtista() {
    add_meta_box('artista_custom_fields', __('Campos Personalizados del Artista', 'mdam'), 'agregarCustomFieldsArtista', 'artista', 'normal', 'default');
}
add_action('add_meta_boxes', 'agregarMetaboxesArtista');
