<?php
get_header();

// Obtener el término del artista actual usando get_queried_object()
$artista = get_queried_object();



/* No puedo obtener el primero de la lista, porque si hay más artistas la lío

if (!empty($artista_terms)) {
    $artista = $artista_terms[0]; // Obtener el primer artista
    $term_id = $artista->term_id;

    */
    
if ($artista && isset($artista->term_id)) {
    $term_id = $artista->term_id;

    // Mostrar la información del artista
    $linkedin = get_term_meta($term_id, 'linkedin', true);
    $instagram = get_term_meta($term_id, 'instagram', true);
    $twitter = get_term_meta($term_id, 'twitter', true);
    $mote = get_term_meta($term_id, 'mote', true);
    $descripcionExtra = get_term_meta($term_id, 'descripcionExtra', true);
    $descripcionDetallada = get_term_meta($term_id, 'descripcionDetallada', true);
    $imagen_destacada_id = get_term_meta($term_id, 'imagenDestacada', true); // Recuperar ID de la imagen

    ?>
    <div class="artist-info">
        <h1><?php echo esc_html($artista->name); ?></h1>

        <?php if ($imagen_destacada_id) : ?>
            <div class="artist-image">
                <?php echo wp_get_attachment_image($imagen_destacada_id, 'full', false, array('class' => 'img-fluid')); ?>
            </div>
        <?php endif; ?>

        <?php if ($mote) : ?>
            <h2 class="artist-subtitle"><?php echo esc_html($mote); ?></h2>
        <?php endif; ?>

        <div class="artist-social-links">
            <?php if ($linkedin) : ?>
                <a href="<?php echo esc_url($linkedin); ?>" target="_blank">LinkedIn <?php echo esc_html($artista->name); ?></a><br>
            <?php endif; ?>
            <?php if ($instagram) : ?>
                <a href="<?php echo esc_url($instagram); ?>" target="_blank">Instagram <?php echo esc_html($artista->name); ?></a><br>
            <?php endif; ?>
            <?php if ($twitter) : ?>
                <a href="<?php echo esc_url($twitter); ?>" target="_blank">Twitter <?php echo esc_html($artista->name); ?></a>
            <?php endif; ?>
        </div>

        <?php if ($descripcionExtra) : ?>
            <div class="artist-description-extra">
                <h3>Descripción Extra</h3>
                <p><?php echo wp_kses_post($descripcionExtra); ?></p>
            </div>
        <?php endif; ?>

        <?php if ($descripcionDetallada) : ?>
            <div class="artist-description-detallada">
                <h3>Descripción Detallada</h3>
                <p><?php echo wp_kses_post($descripcionDetallada); ?></p>
            </div>
        <?php endif; ?>

        <!-- Mostrar los murales asociados -->
        <div class="artist-murales">
            <h3>Murales del Artista</h3>
            <?php
            // Consulta para obtener los murales asociados al artista
            $murales = new WP_Query(array(
                'post_type' => 'murales',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'artista',
                        'field'    => 'term_id',
                        'terms'    => $term_id,
                        'operator' => 'IN',
                    ),
                ),
            ));

            if ($murales->have_posts()) :
                while ($murales->have_posts()) : $murales->the_post(); ?>
                    <div class="mural-item">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="mural-thumbnail">
                                <?php the_post_thumbnail('thumbnail', array('class' => 'img-fluid')); ?>
                            </div>
                        <?php endif; ?>
                        <h4><?php the_title(); ?></h4>
                        <p><?php the_excerpt(); ?></p>
                        <a href="<?php the_permalink(); ?>">Leer más</a>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            else :
                echo '<p>No hay murales para mostrar.</p>';
            endif;
            ?>
        </div>

    </div>

    <?php
}
?>

<?php get_footer(); ?>
