jQuery(document).ready(function($) {
    var custom_uploader;

    $('#subirImagen').click(function(e) {
        e.preventDefault();

        if (custom_uploader) {
            custom_uploader.open();
            return;
        }

        custom_uploader = wp.media.frames.custom_header = wp.media({
            title: 'Seleccionar Imagen',
            button: {
                text: 'Usar esta imagen'
            },
            multiple: false
        });

        custom_uploader.on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#imagenDestacada').val(attachment.id);
            $('#subirImagen').prev('img').attr('src', attachment.url);
        });

        custom_uploader.open();
    });
});
