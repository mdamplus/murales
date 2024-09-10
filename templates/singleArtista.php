<?php
get_header();

// Obtener el término del artista
$artista_terms = wp_get_post_terms(get_the_ID(), 'artista');
if (!empty($artista_terms)) {
    $artista = $artista_terms[0];
    $term_id = $artista->term_id;

    // Obtener los campos personalizados
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
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
  <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/>
</svg>
                <a href="<?php echo esc_url($linkedin); ?>" target="_blank">LinkedIn <?php echo esc_html($artista->name); ?></a><br>
            <?php endif; ?>
            <?php if ($instagram) : ?>

                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
  <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
</svg>
                <a href="<?php echo esc_url($instagram); ?>" target="_blank">Instagram <?php echo esc_html($artista->name); ?></a><br>
            <?php endif; ?>
            <?php if ($twitter) : ?>

                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
  <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
</svg>

                <a href="<?php echo esc_url($twitter); ?>" target="_blank">Twitter <?php echo esc_html($artista->name); ?></a>
            <?php endif; ?>
        </div>
<p>aca descripciones</p>
        <?php // var_dump($descripcionExtra);?>
        <?php // var_dump($descripcionDetallada);?>
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
        <p>fin descripciones</p>
        <!-- Mostrar los murales asociados -->
        <div class="artist-murales">
            <h3>Murales del Artista</h3>
            <?php
            $murales = new WP_Query(array(
                'post_type' => 'murales',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'artista',
                        'field'    => 'term_id',
                        'terms'    => $term_id,
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
