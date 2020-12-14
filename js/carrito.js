window.addEventListener('load', () => {
    construirCarrito();
    // const libros = document.querySelectorAll('.add-cart');
    // Array.from(libros).forEach((item, i) => {
    //     item.addEventListener('click', ($event) => {
    //         if (ObtenerCliente() === null) {
    //             presentMessage('Debes iniciar sesion para añadir el producto al carrito!', 'info');
    //             return;
    //         }
    //         const isbn = item.attributes.getNamedItem('book-isbn').value;
    //         AgregarACariito(isbn);
    //     });
    // });

    const logoutBtn = document.querySelector('.logout-link');
    if (logoutBtn !== null) {
        logoutBtn.addEventListener('click', (e) => {
            localStorage.removeItem('cliente');
            window.location = 'controllers/logout.php';
        });
    }

    // AGREGAR AL CARRITO
    $(document).on('click', '.add-cart', (e) => {
        if (ObtenerCliente() === null) {
            presentMessage('Debes iniciar sesion para añadir el producto al carrito!', 'info');
            return;
        }
        const isbn = e.target.attributes.getNamedItem('book-isbn').value;
        AgregarACariito(isbn);
    });

    // MODIFICAR CANTIDAD CARRITO (ELIMINAR)
    $(document).on('click', '.btn-minus', (e) => {
        const index = e.target.attributes.getNamedItem('book-index').value;
        const item = carrito[index];
        if (carrito) {
            const input = e.target.parentNode.children[1];
            const cantidadActual = parseInt(input.value);
            if (cantidadActual > 1){
                item.cantidad = cantidadActual - 1;
                input.value = cantidadActual - 1;
                ActualizarcarritoDB(item).then((response) => {
                    // console.log(response);
                    if (response.success) {
                        // presentMessage(response.message, 'success');
                        carrito[index] = item;
                        localStorage.setItem('carrito', JSON.stringify(carrito));
                    } else {
                        presentMessage(response.message, 'warning');
                        item.cantidad = cantidadActual + 1;
                        input.value = cantidadActual + 1;
                        carrito[index] = item;
                    }
                }).catch((error) => {
                    console.log(error);
                    presentMessage(error.message, 'error')
                    item.cantidad = cantidadActual + 1;
                    input.value = cantidadActual + 1;
                    carrito[index] = item;
                })
                calcularTotalCarrito();
            }
        }
    });

    // MODIFICAR CANTIDAD CARRITO (AGREGAR)
    $(document).on('click', '.btn-add', (e) => {
        const index = e.target.attributes.getNamedItem('book-index').value;
        const item = carrito[index];
        if (carrito) {
            const input = e.target.parentNode.children[1];
            const cantidadActual = parseInt(input.value);
            if (cantidadActual < item.libro.stock){
                item.cantidad = cantidadActual + 1;
                input.value = cantidadActual + 1;
                ActualizarcarritoDB(item).then((response) => {
                    // console.log(response);
                    if (response.success) {
                        // presentMessage(response.message, 'success');
                        carrito[index] = item;
                        localStorage.setItem('carrito', JSON.stringify(carrito));
                    } else {
                        presentMessage(response.message, 'warning');
                        item.cantidad = cantidadActual - 1;
                        input.value = cantidadActual - 1;
                        carrito[index] = item;
                    }
                }).catch((error) => {
                    console.log(error);
                    presentMessage(error.message, 'error')
                    item.cantidad = cantidadActual - 1;
                    input.value = cantidadActual - 1;
                    carrito[index] = item;
                })
                calcularTotalCarrito();
            }
        }
    });

    // QUITAR DEL CARRITO
    $(document).on('click', '.remove-cart', (e) => {
        const index = e.target.attributes.getNamedItem('book-index').value;
        Swal.fire({
            title: 'CONFIRMACIÓN', 
            text: '¿Esta seguro que desea eliminar este elemento del carrito?', 
            icon: 'question',
            showCloseButton: true,
            showCancelButton: true,
            cancelButtonText: 'Cancelar'
        }
        ).then(result => {
            if (result.value) {
                const itemEliminar = carrito[index];
                EliminarCarritoDB(itemEliminar.idCarrito)
                    .then((response => {
                        if (response.success) {
                            presentMessage(response.message, 'success');
                            carrito.splice( carrito.indexOf(itemEliminar), 1 );
                            localStorage.setItem('carrito', JSON.stringify(carrito));
                            document.querySelector('.cart-count').innerHTML = carrito.length;
                            construirCarrito();
                        } else {
                            presentMessage(response.message, 'warning');
                        }
                    }));
            }
        })
    });


    const btnPayment = document.querySelector('.btnPayment')
    if (btnPayment !== null){
        btnPayment.addEventListener('click', GuardarVenta);
    }

});

let construirCarrito = () => {
    const carritoWrapper = document.querySelector('.carrito-wrapper');
    if (carritoWrapper !== null) {
        carritoWrapper.innerHTML = '';
        carrito.forEach((carrito, i) => {
            const p = document.createElement('p');
            p.classList.add('.card-text');
            const item = 
            `<div class="container">
                <div class="row">
                    <div class="col-12 col-sm-3">
                        <img class="card-img" src="${API_URL}/media/${carrito.libro.imagen}" alt="${carrito.libro.nombre}">
                    </div>
                    <div class="col-12 col-sm-9">
                        <div class="container">
                            <div class="row p-2">
                                <div class="col-12 col-sm-6">
                                    <p> <strong> ${carrito.libro.nombre} </strong> </p>
                                    <p class="card-subtitle">${carrito.libro.autor}</p>
                                </div>
                                <div class="col-12 col-sm-6 text-center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-light btn-minus" book-index="${i}">-</button>
                                        <input class="form-control text-center" min="1" max="${carrito.libro.stock}" value="${carrito.cantidad}">
                                        <button type="button" class="btn btn-light btn-add" book-index="${i}">+</button>
                                    </div>
                                    <div class="card-text text-danger">
                                        <p><strong>MXN $${carrito.libro.precio.toFixed(2)}</strong></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    ${carrito.libro.sinopsis}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col p-2">
                                    <button class="btn btn-outline-danger btn-sm capitalize remove-cart" book-index="${i}">
                                        <i class="icofont-ui-delete"></i> Remover
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`
            p.innerHTML = item;
            carritoWrapper.append(p);
        });
        calcularTotalCarrito();
    }
}

let calcularTotalCarrito = () => {
    let total = 0;
    carrito.forEach(item => {
        total += item.cantidad * item.libro.precio;
    });
    document.querySelector('.subtotal-carrito').innerHTML = `$${total.toFixed(2)}`
    document.querySelector('.total-carrito').innerHTML = `$${total.toFixed(2)}`
}

let ObtenerCliente = () => {
    if (localStorage.getItem('cliente')) {
        const cliente = JSON.parse(localStorage.getItem('cliente'));
        return cliente;
    } else {
        return null;
    }
}

const messageController = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 1000

});

const presentMessage = (message, type) => {
    // messageController.fire({
    //     icon: (type) ? type : 'info',
    //     title: (message) ? message : ''
    // });
    Swal.fire(
        'ATENCIÓN!',
        (message) ? message : '',
        (type) ? type : 'info',
    );
};

let headers = new Headers();
headers.append('Content-Type', 'application/json');
headers.append('Access-Control-Allow-Origin', 'https://papelerialaparroquia.com/');

let AgregarACariito = (isbn) => {
    const url = `${API_URL}carrito/create`;
    const data = {
        isbn: isbn,
        usuario: ObtenerCliente().idCliente,
        fecha: new Date().toISOString(),
        cantidad: 1,
    };
    const options = {
        method: 'POST',
        headers: headers,
        // mode: 'cors',
        // cache: 'default',
        body: JSON.stringify(data)
    };

    fetch(url, options).then(res => res.json())
        .then((response => {
            // console.log(response);
            if (response.success) {
                presentMessage(response.message, 'success');
                carrito.push(response.carrito);
                localStorage.setItem('carrito', JSON.stringify(carrito));
                document.querySelector('.cart-count').innerHTML = carrito.length;
            } else {
                presentMessage(response.message, 'warning');
            }
        }));
}

let EliminarCarritoDB = async (idCarrito) => {
    const url = `${API_URL}carrito/deleteOne?idCarrito=${idCarrito}`;
    const options = {
        method: 'DELETE',
        headers: headers
    };
    return await fetch(url, options).then(res => res.json())  
}

let ActualizarcarritoDB = async(item) => {
    const url = `${API_URL}carrito/update`;
    const options = {
        method: 'POST',
        headers: headers,
        body: JSON.stringify(item)
    };
    return await fetch(url, options).then(res => res.json())  
}

let GuardarVenta = () => {
    const cliente = ObtenerCliente();
    if (cliente != null) {
        let cantidadVenta = carrito.length;
        let detalleVenta = [];
        carrito.forEach(item => {
            const detalle = {
                producto: item.libro.nombre,
                cantidad: item.cantidad,
                precio: item.libro.precio,
                total: item.cantidad * item.libro.precio,
                productoId: item.libro.idLibro
            }
            detalleVenta.push(detalle);
        });        

        const venta = {
            cliente: `${cliente.nombre} ${cliente.paterno} ${cliente.materno}`,
            fecha: new Date().toISOString(),
            cantidad: cantidadVenta,
            totalVenta: document.querySelector('.total-carrito').innerHTML.replace('$', ''),
            detalle: detalleVenta
        }
        console.log(venta);
        const url = `${API_URL}/venta/create`;
        fetch(url, { method: 'POST', headers: headers, body: JSON.stringify(venta) })
            .then(res => res.json())
            .then(response => {
                // console.log(response);
                if (response.success) {
                    presentMessage(response.message, 'success');
                    VaciarCarrito();
                    window.location = 'index';
                } else {
                    presentMessage(response.message, 'warning');
                }
            });
    }    
}

let VaciarCarrito = () => {
    const cliente = ObtenerCliente();
    const url = `${API_URL}carrito/delete?usuario=${cliente.idCliente}`;
    const options = {
        method: 'DELETE',
        headers: headers
    };
    fetch(url, options).then(res => res.json())  
        .then((response => {
            // console.log(response)
            if (response.success) {
                // presentMessage(response.message, 'success');
                carrito = [];
                localStorage.setItem('carrito', JSON.stringify(carrito));
                document.querySelector('.cart-count').innerHTML = carrito.length;
                construirCarrito();
            } else {
                presentMessage(response.message, 'warning');
            }
        }));
}
