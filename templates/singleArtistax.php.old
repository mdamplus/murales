<?php
get_header(); // Incluye el encabezado del tema


$artista_terms = wp_get_post_terms(get_the_ID(), 'artista');
if (!empty($artista_terms)) {
    $artista_term_id = $artista_terms[0]->term_id; // Obtener el ID del término del artista
    $args = array(
        'post_type' => 'murales',
        'tax_query' => array(
            array(
                'taxonomy' => 'artista',
                'field'    => 'term_id',
                'terms'    => $artista_term_id, // ID del término de la taxonomía artista
            ),
        ),
    );
    $murales_query = new WP_Query($args);
}

// Comienza el contenido principal
if (have_posts()) :
    while (have_posts()) : the_post(); ?>

        <div class="container"> <!-- Asumiendo que tu tema usa .container -->
            <div class="row">
                <div class="col-md-12"> <!-- Ajusta la columna según tu sistema de cuadrícula -->

                    <!-- Imagen destacada del artista -->
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Información del artista -->
                    <div class="artist-info">
                        <h1><?php the_title(); ?></h1>

                        <!-- Descripción del artista -->
                        <div class="artist-description">
                            <?php if ($description = get_post_meta(get_the_ID(), 'descripcion_extra', true)) : ?>
                                <h2><?php _e('Descripción', 'mdam'); ?></h2>
                                <p><?php echo wp_kses_post($description); ?></p>
                            <?php endif; ?>

                            <!-- Descripción detallada del artista -->
                            <?php if ($detailed_description = get_post_meta(get_the_ID(), 'descripcion_detallada', true)) : ?>
                                <div class="artist-detailed-description">
                                    <h2><?php _e('Descripción Detallada', 'mdam'); ?></h2>
                                    <p><?php echo wp_kses_post($detailed_description); ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Obras del artista (Murales) -->
                    <div class="artist-works">
                        <h2><?php _e('Obras Realizadas', 'mdam'); ?></h2>
                        <?php
                        // Obtener murales asociados a este artista
                        $args = array(
                            'post_type' => 'murales',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'artista',
                                    'field'    => 'term_id',
                                    'terms'    => get_the_ID(), // ID del artista actual
                                ),
                            ),
                        );
                        $murales_query = new WP_Query($args);
                        if ($murales_query->have_posts()) :
                            while ($murales_query->have_posts()) : $murales_query->the_post(); ?>
                                <div class="mural-item">
                                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="mural-thumbnail">
                                            <?php the_post_thumbnail('thumbnail', array('class' => 'img-fluid')); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile;
                            wp_reset_postdata();
                        else : ?>
                            <p><?php _e('No hay murales asociados a este artista.', 'mdam'); ?></p>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>

    <?php endwhile;
endif;

// Incluir pie de página 
get_footer();
?>
