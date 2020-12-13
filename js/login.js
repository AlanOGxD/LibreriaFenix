const usuarioInput = document.querySelector('#inputusuario');
const passwordInput = document.querySelector('#inputPassword');

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
                    authenticate();
                }
                form.classList.add('was-validated');
            }, false);
        });  
        usuarioInput.value = '';
        passwordInput.value = '';
    }, false);
})();


var verifyCaptcha = (token) => {
    const data = {
        secret: '6LeA2AMaAAAAAH9vKvE3pg33TyFzD8XpbZIV56OM',
        response: token
    }; 
    if (token !== undefined) {
        authenticate();
    }
}

let authenticate = () => {
    const API_URL = 'http://localhost/libreria/';
    const headers = {
        'Content-Type': 'application/json'
    };
        
    const body = JSON.stringify({
        usuario: usuarioInput.value.trim(),
        contrasena: passwordInput.value.trim()
    });

    fetch(`${API_URL}cliente/login`, { headers, method: 'post', body })
        .then((res) => res.json())
        .then((response) => {
            if (response.success) {
                localStorage.setItem('cliente', JSON.stringify(response.cliente));
                window.location = `controllers/login.php?data=${JSON.stringify(response.cliente)}`;
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