<?php
// Añadir una subpágina de configuración bajo el menú de Murales
function agregarSubpaginaConfiguracionMurales() {
    // Primero, verifica que el menú de Murales esté registrado
    $parent_slug = 'edit.php?post_type=murales';

    // Añade la subpágina de configuración bajo Murales
    add_submenu_page(
        $parent_slug,
        __('Configuración', 'mdam'),
        __('Configuración', 'mdam'),
        'manage_options',
        'muralesSettings',
        'mostrarPaginaDeConfiguracion'
    );
}
add_action('admin_menu', 'agregarSubpaginaConfiguracionMurales');

// Mostrar el formulario de configuración en la página de administración
function mostrarPaginaDeConfiguracion() {
    ?>
    <div class="wrap">
        <h1><?php _e('Configuración de Murales', 'mdam'); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('muralesGrupoConfiguracion');
            do_settings_sections('muralesSettings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Registrar la configuración y el campo de la clave API
function registrarConfiguracion() {
    register_setting('muralesGrupoConfiguracion', 'google_maps_api_key');
    
    add_settings_section(
        'muralesConfiguracionSeccion',
        __('Configuración de Google Maps', 'mdam'),
        function() {},
        'muralesSettings'
    );

    add_settings_field(
        'google_maps_api_key',
        __('Clave API de Google Maps', 'mdam'),
        'campoGoogleMapsApiKey',
        'muralesSettings',
        'muralesConfiguracionSeccion'
    );
}
add_action('admin_init', 'registrarConfiguracion');

// Mostrar el campo de clave API en la página de configuración
function campoGoogleMapsApiKey() {
    $api_key = get_option('google_maps_api_key', '');
    ?>
    <input type="text" name="google_maps_api_key" value="<?php echo esc_attr($api_key); ?>" class="regular-text"/>
    <p class="description"><?php _e('Introduce tu clave API de Google Maps aquí.', 'mdam'); ?></p>
    <?php
}

// Encolar el archivo CSS para el área de administración
function encolarAdminStyles() {
    wp_enqueue_style(
        'admin-styles',
        plugin_dir_url(__FILE__) . '../assets/css/adminStyles.css'
    );
}
add_action('admin_enqueue_scripts', 'encolarAdminStyles');