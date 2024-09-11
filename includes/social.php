<?php

// nueva versión
function mostrar_campos_artista($term_id) {
    // Obtener los metadatos personalizados
    $linkedin = get_term_meta($term_id, 'linkedin', true);
    $instagram = get_term_meta($term_id, 'instagram', true);
    $twitter = get_term_meta($term_id, 'twitter', true);
    $mote = get_term_meta($term_id, 'mote', true);

    // Mostrar el Mote
    if ($mote) {
        echo '<h2 class="artist-subtitle">' . esc_html($mote) . '</h2>';
    }

    // Mostrar los enlaces de redes sociales si existen
    echo '<div class="artist-social-links">';
    if ($linkedin) {
        echo '<a href="' . esc_url($linkedin) . '" target="_blank">LinkedIn</a><br>';
    }
    if ($instagram) {
        echo '<a href="' . esc_url($instagram) . '" target="_blank">Instagram</a><br>';
    }
    if ($twitter) {
        echo '<a href="' . esc_url($twitter) . '" target="_blank">Twitter</a>';
    }
    echo '</div>';
}
