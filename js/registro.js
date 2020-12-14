const usuarioInput = document.querySelector('#inputusuario');
const passwordInput = document.querySelector('#inputPassword');
const nombreInput = document.querySelector('#inputNombres');
const paternoinput = document.querySelector('#inputPaterno');
const maternoinput = document.querySelector('#inputMaterno');

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
                    registrarUsuario();
                }
                form.classList.add('was-validated');
            }, false);
        });  
        usuarioInput.value = '';
        passwordInput.value = '';
        nombreInput.value = '';
        paternoinput.value = '';
        maternoinput.value = '';
    }, false);
})();


var verifyCaptcha = (token) => {
    const data = {
        secret: '6LeA2AMaAAAAAH9vKvE3pg33TyFzD8XpbZIV56OM',
        response: token
    }; 
    if (token !== undefined) {
        registrarUsuario();
    }
}

let registrarUsuario = () => {
    const API_URL = 'http://localhost/libreria/';
    const headers = {
        'Content-Type': 'application/json'
    };

    if (
        usuarioInput.value.trim().lenght == 0 ||
        passwordInput.value.trim().lenght == 0 ||
        nombreInput.value.trim().lenght == 0 ||
        paternoinput.value.trim().lenght == 0 ||
        maternoinput.value.trim().lenght == 0
    ) {
        Swal.fire(
            'ATENCIÓN',
            'Debes de llenar todos los campos para continuar',
            'info'
        );
    }
        
    const body = JSON.stringify({
        usuario: usuarioInput.value.trim(),
        contrasena: passwordInput.value.trim(),
        nombre: nombreInput.value.trim(),
        paterno: paternoinput.value.trim(),
        materno: maternoinput.value.trim()
    });

    fetch(`${API_URL}cliente/create`, { headers, method: 'post', body })
        .then((res) => res.json())
        .then((response) => {
            if (response.success) {
                localStorage.setItem('cliente', JSON.stringify(response.cliente));
                Swal.fire(
                    'ATENCIÓN',
                    response.message,
                    'success'
                );                
                window.location = `login.html`;
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
                'Alga ha salido mal!',
                error.message,
                'error'
            );
        });
}

