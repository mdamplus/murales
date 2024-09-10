<?php
get_header(); // Incluye el encabezado del tema

// Comienza el contenido principal
if (have_posts()) :
    while (have_posts()) : the_post(); ?>

        <div class="container"> <!-- Asumiendo que el tema usa .container  -->
            <div class="row">
                <div class="col-md-12"> <!-- Ajustar la columna según la cuadrícula -->

                    <!-- Imagen destacada -->
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Meta información -->
                    <div class="postMeta">
                    <h1><?php the_title(); ?></h1>
                        <p><strong>Fecha de Creación:</strong> <?php echo get_the_date(); ?></p>

                        <!-- Información adicional del Custom Post Type -->
                        <p><strong>Artista:</strong> <?php echo get_the_term_list(get_the_ID(), 'artista', '', ', '); ?></p>
                        <p><strong>Distrito:</strong> <?php echo get_the_term_list(get_the_ID(), 'distrito', '', ', '); ?></p>
                        <p><strong>Financiación:</strong> <?php echo get_the_term_list(get_the_ID(), 'financiacion', '', ', '); ?></p>
                        
                        <?php
                        // Obtener y mostrar la dirección
                        $direccion = get_post_meta(get_the_ID(), 'direccion_murales', true);
                        if ($direccion) :
                            $apiKey = get_option('google_maps_api_key'); // Obtener la clave API del plugin
                            $mapUrl = 'https://www.google.com/maps/embed/v1/place?key=' . esc_attr($apiKey) . '&q=' . urlencode($direccion);
                            $mapLink = 'https://www.google.com/maps/search/?api=1&query=' . urlencode($direccion); // Enlace directo a Google Maps
                        ?>
                            <p><strong>Dirección:</strong> <a href="<?php echo esc_url($mapLink); ?>" target="_blank" title="<?php echo esc_html($direccion); ?>"><?php echo esc_html($direccion); ?></a></p>
                            
                            <div class="mapaGoogle">
                                <iframe src="<?php echo esc_url($mapUrl); ?>" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Contenido del post -->
                    <div class="post-content">
                        <?php the_content(); ?>
                    </div>

                    <!-- Información del artista -->
                    <?php
                    $artista_ids = wp_get_post_terms(get_the_ID(), 'artista', array('fields' => 'ids'));
                    if ($artista_ids) :
                        foreach ($artista_ids as $artista_id) :
                            $artista_img_id = get_term_meta($artista_id, 'imagenDestacada', true);
                            $artista_description = get_term_meta($artista_id, 'descripcionExtra', true);
                            $artista_term = get_term($artista_id);
                            ?>
                            <div class="artista-info">
                                <?php if ($artista_img_id) : ?>
                                    <div class="artistaThumbnail">
                                        <img src="<?php echo esc_url(wp_get_attachment_url($artista_img_id)); ?>" alt="<?php echo esc_attr($artista_term->name); ?>" class="img-fluid">
                                    </div>
                                <?php endif; ?>
                                <div class="artista-description">
                                    <h3><?php echo esc_html($artista_term->name); ?></h3>
                                    <?php if ($artista_description) : ?>
                                        <p><?php echo wp_kses_post($artista_description); ?></p>
                                    <?php endif; ?>
                                    <?php
                                    // Mostrar la descripción general del artista si existe
                                    $artista_description_general = term_description($artista_id, 'artista');
                                    if ($artista_description_general) :
                                    ?>
                                        <div class="artista-description-general">
                                            <h4>Descripción del Artista</h4>
                                            <p><?php echo wp_kses_post($artista_description_general); ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
            </div>
        </div>

    <?php endwhile;
endif;

// incluir sidebar
// get_sidebar();
// Incluir pie de página 
get_footer();
?>
