const idLibroInput = document.querySelector('#inputId');
const isbnInput = document.querySelector('#inputIsbn');
const nombreInput = document.querySelector('#inputNombre');
const autorInput = document.querySelector('#inputAutor');
const editorialInput = document.querySelector('#inputEditorial');
const stockInput = document.querySelector('#inputStock');
const categoriaInput = document.querySelector('#inputCategoria');
const anioInput = document.querySelector('#inputAnio');
const imagenInput = document.querySelector('#inputImagen');
const sinopsisInput = document.querySelector('#inputSinopsis');
const precioInput = document.querySelector('#inputPrecio');

(function() {

    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission

        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                event.stopPropagation();
                if (form.checkValidity() === true) {
                    actualizarLibro();
                    
                }
                form.classList.add('was-validated');
            }, false);
        });  
        
        //    isbnInput.value = '';
        //    nombreInput.value = '';
        //    autorInput.value = '';
        //    editorialInput.value = '';
        //    stockInput.value = '';
        //    categoriaInput.value = '';
        //    anioInput.value = '';
        //    imagenInput.value = '';
        //    sinopsisInput.value = '';
        //    precioInput.value = '';
        //    idLibroInput.value = '';
    }, false);
})();


let actualizarLibro= () => {
    const API_URL = 'http://localhost/fenix/libreria/';
    const headers = {
        'Content-Type': 'application/json'
    };
    

    if (isbnInput.value.trim().lenght == 0 ||
    idLibroInput.value.trim().lenght == 0 ||
        nombreInput.value.trim().lenght == 0 ||
        autorInput.value.trim().lenght == 0 ||
        editorialInput.value.trim().lenght == 0 ||
        stockInput.value.trim().lenght == 0 ||
        categoriaInput.value.trim().lenght == 0 ||
        anioInput.value.trim().lenght == 0 ||
        imagenInput.value.trim().lenght == 0 ||
        sinopsisInput.value.trim().lenght == 0 ||
        precioInput.value.trim().lenght == 0) {
        Swal.fire(
            'ATENCIÓN',
            'Debes de llenar todos los campos para continuar',
            'info'
        );
    }

    const data = new FormData();
    data.append('idLibro', idLibroInput.value.trim());
    data.append('isbn', isbnInput.value.trim());
    data.append('nombre', nombreInput.value.trim());
    data.append('autor', autorInput.value.trim());
    data.append('editorial', editorialInput.value.trim());
    data.append('stock', stockInput.value.trim());
    data.append('categoria', categoriaInput.value.trim());
    data.append('anioPublicacion', anioInput.value.trim());
    data.append('sinopsis', sinopsisInput.value.trim());
    data.append('precio', precioInput.value.trim());
    data.append('imagenes[]', imagenInput.files[0]);

    fetch(`${API_URL}libro/update`, { method: 'POST', body: data })
        .then((res) => res.json())
        .then((response) => {
            if (response.success) {
                localStorage.setItem('libro', JSON.stringify(response.libro));
                Swal.fire(
                    'ATENCIÓN',
                    response.message,
                    'success'
                );
                //window.location = `/indexAdmin.php`;
            } else {
                Swal.fire(
                    'ATENCIÓN!',
                    response.message.toString(),
                    'info'
                );
            }
        })
        .catch((error) => {
            Swal.fire(
                'Algo ha salido mal!',
                error.message,
                'error'
            );

        });

}