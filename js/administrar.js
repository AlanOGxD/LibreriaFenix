window.addEventListener('load', () => {

    $(document).on('click', '.delete-book', (e) => {
        const index = e.target.attributes.getNamedItem('book-isbn').value; // e.target.attributes.getNamedItem('book-index').value;
        Swal.fire({
            title: 'CONFIRMACIÓN',
            text: '¿Esta seguro que desea eliminar este elemento?',
            icon: 'question',
            showCloseButton: true,
            showCancelButton: true,
            cancelButtonText: 'Cancelar'
        }
        ).then(result => {
            if (result.value) {

                EliminarLibro(index)
                    .then((response => {
                        if (response.success) {
                            presentMessage(response.message, 'success');
                            libro.splice(libro.indexOf(itemEliminar), 1);
                        } else {
                            presentMessage(response.message, 'warning');
                        }
                    }));
            }
        })
    });


    $(document).on('click', '.upload-book', (e) => {
        //<source src="../wp-admin/editar.php"></source> 
        const index = e.target.attributes.getNamedItem('book-isbn').value;
        EditarLibro(index).then((response => {
            if (response.success) {
                window.location = `../wp-admin/editar.php?data=${JSON.stringify(response.libro)}`;
            } else { presentMessage(response.message, 'warning'); }
        }))


    });

});

let EliminarLibro = async (idLibro) => {
    const url = `${API_URL}libro/delete?idLibro=${idLibro}`;
    const options = {
        method: 'DELETE'
    };
    return await fetch(url, options).then(res => res.json())
}

let ActualizarLlibro = async (item) => {
    const url = `${API_URL}carrito/update`;
    const options = {
        method: 'POST',
        headers: headers,
        body: JSON.stringify(item)
    };
    return await fetch(url, options).then(res => res.json())
}

let EditarLibro = async (idLibro) => {
    const url = `${API_URL}libro/readOne?idLibro=${idLibro}`;
    const options = {
        method: 'POST'
    };
    return await fetch(url, options).then(res => res.json())
}

const presentMessage = (message, type) => {

    Swal.fire(
        'ATENCIÓN!',
        (message) ? message : '',
        (type) ? type : 'info',
    );
};