<?php
get_header(); // Incluye el encabezado del tema

// Comienza el contenido principal
if (have_posts()) :
    while (have_posts()) : the_post(); ?>

        <div class="container" style="max-width:100%;"> <!-- Asumiendo que el tema usa .container  -->
            <div class="row">
                <div class="col-md-12"> <!-- Ajustar la columna según la cuadrícula -->

                    <!-- Imagen destacada -->
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail" style="position: relative;">
                            <?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
                            <div class="h1-container" style="position: absolute; bottom: 55px; left: 0; color: white; background-color: rgba(0, 0, 0, 0.5); padding: 10px !important;">
                                <h1 style="margin-bottom:0px;"><?php the_title(); ?></h1>
                            </div>
                        </div>
                    <?php endif; ?>
<!-- <p><strong>Fecha de Creación:</strong> <?php echo get_the_date(); ?></p> -->
                    <!-- Meta información -->
                    <div class="postMeta" style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-start; margin-top:-10px; background-color: lightgray; padding: 20px;">
                    <?php
                        // Obtener y mostrar la dirección
                        $direccion = get_post_meta(get_the_ID(), 'direccion_murales', true);
                        if ($direccion) :
                            $apiKey = get_option('google_maps_api_key'); // Obtener la clave API del plugin
                            $mapUrl = 'https://www.google.com/maps/embed/v1/place?key=' . esc_attr($apiKey) . '&q=' . urlencode($direccion);
                            $mapLink = 'https://www.google.com/maps/search/?api=1&query=' . urlencode($direccion); // Enlace directo a Google Maps
                        ?>
                            <div class="mapaGoogle" style="flex: 1; min-width: 300px; margin: 10px; max-width: 100%;">
                                <iframe src="<?php echo esc_url($mapUrl); ?>" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                            </div>
                        <div class="info" style="flex: 1; min-width: 300px; margin: 10px; max-width: 100%;">
                            <!-- Información adicional del Custom Post Type -->
                            <p><strong>Artista:</strong> <?php echo get_the_term_list(get_the_ID(), 'artista', '', ', '); ?></p>
                            <p><strong>Distrito:</strong> <?php echo get_the_term_list(get_the_ID(), 'distrito', '', ', '); ?></p>
                            <p><strong>Financiación:</strong> <?php echo get_the_term_list(get_the_ID(), 'financiacion', '', ', '); ?></p>
                            <p><strong>Dirección:</strong> <a href="<?php echo esc_url($mapLink); ?>" target="_blank" title="<?php echo esc_html($direccion); ?>"><?php echo esc_html($direccion); ?></a></p>
                        </div>    
                            
                        <?php endif; ?>
                    </div>

                    <!-- Contenido del post -->
                    <div class="post-content" style="max-width:50%;margin-left:25%;margin-top:20px;">
                        <?php the_content(); ?>
                    </div>

                    <!-- Información del artista 
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
                    <?php endif; ?>-->

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
