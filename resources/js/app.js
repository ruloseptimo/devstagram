import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Sube aquí tu imagen',
    //url: '/imagenes',
    //maxFilesize: 2,
    acceptedFiles: '.jpg, .jpeg, .png, .gif',
    addRemoveLinks: true,
    dictRemoveFile: 'Eliminar imagen',
    maxFiles: 1,
    uploadMultiple: false,  
    //headers: {
        //'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
    //}
    init: function() {
        if (document.querySelector('#imagen').value.trim()) {
            let imagenPublicada = {
                serverId: 1,
                name: document.querySelector('#imagen').value,
                size: 12345,
                accepted: true
            };

            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);
            imagenPublicada.previewElement.classList.add('dz-success');
            imagenPublicada.previewElement.classList.add('dz-complete');
        }
    }
});

dropzone.on('sending', function(file, xhr, formData) {
    console.log(file);
});

dropzone.on('error', function(file, res) {
    console.log(res);
});

dropzone.on('success', function(file, res) {
    console.log(res.imagen);
    document.querySelector('#imagen').value = res.imagen;
}); 

dropzone.on('removedfile', function(file) {
    console.log('eliminando..');
    document.querySelector('#imagen').value = '';
});

dropzone.on('maxfilesexceeded', function(file) {
    console.log('No puedes subir más de una imagen');
});
