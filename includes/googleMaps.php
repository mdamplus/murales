<?php
// Agregar campos adicionales para la dirección en el Custom Post Type Murales
function agregarCustomFieldsMurales($post) {
    $direccion = get_post_meta($post->ID, 'direccion_murales', true);
    wp_nonce_field('guardar_custom_fields', 'murales_nonce'); // Añadir nonce
    ?>
    <div class="form-field">
        <label for="direccion_murales"><?php _e('Dirección en Google Maps', 'mdam'); ?></label>
        <input type="text" id="direccion_murales" name="direccion_murales" value="<?php echo esc_attr($direccion); ?>" style="width: 100%;" />
        <p class="description"><?php _e('Introduce la dirección para mostrar en el mapa.', 'mdam'); ?></p>
    </div>
    <?php
}

function agregarMetaboxesMurales() {
    add_meta_box('murales_custom_fields', __('Dirección de Google Maps', 'mdam'), 'agregarCustomFieldsMurales', 'murales', 'side', 'default');
}
add_action('add_meta_boxes', 'agregarMetaboxesMurales');


// Guardar los campos personalizados al guardar el Custom Post Type Murales
function guardarCustomFieldsMurales($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Verifica el nonce de seguridad si estás usando uno (opcional)
    if (!isset($_POST['murales_nonce']) || !wp_verify_nonce($_POST['murales_nonce'], 'guardar_custom_fields')) {
        return;
    }

    // Verifica si el usuario tiene permiso para editar
    if (current_user_can('edit_post', $post_id)) {
        if (isset($_POST['direccion_murales'])) {
            update_post_meta($post_id, 'direccion_murales', sanitize_text_field($_POST['direccion_murales']));
        }
    }
}
add_action('save_post', 'guardarCustomFieldsMurales');


// Mostrar mapa de Google Maps en el frontend
function mostrarMapaGoogle($content) {
    if (is_singular('murales')) {
        $direccion = get_post_meta(get_the_ID(), 'direccion_murales', true);
        if ($direccion) {
            $api_key = 'TU_API_KEY_DE_GOOGLE_MAPS'; // Reemplaza con tu clave API
            $map_url = 'https://www.google.com/maps/embed/v1/place?key=' . esc_attr($api_key) . '&q=' . urlencode($direccion);
            $content .= '<div class="googleMap"><iframe src="' . esc_url($map_url) . '" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></div>';
        }
    }
    return $content;
}
add_filter('elFrame', 'mostrarMapaGoogle');
