(function($) {
    $(document).ready(function() {
        var mediaUploader;

        $('#subirImagen').on('click', function(e) {
            e.preventDefault();
            if (mediaUploader) {
                mediaUploader.open();
                return;
            }
            mediaUploader = wp.media.frames.file_frame = wp.media({
                title: 'Seleccionar Imagen',
                button: {
                    text: 'Usar esta imagen'
                }, 
                multiple: false 
            });
            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $('#imagenDestacada').val(attachment.id);
                $('#imagenDestacadaPreview').attr('src', attachment.url).show();
            });
            mediaUploader.open();
        });

        $('#borrarImagen').on('click', function(e) {
            e.preventDefault();
            $('#imagenDestacada').val('');
            $('#imagenDestacadaPreview').attr('src', '').hide();
        });
    });
})(jQuery);