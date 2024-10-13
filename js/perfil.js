

function editProfile() {
    alert('Funcionalidad para editar el perfil aún no implementada.');
}


function logout() {
    alert('Cerrando sesión...');
    
    window.location.href = 'muro.html'; 
}

window.onload = function() {
    fetch('php/obtener_datos_perfil.php')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
            } else {
                document.querySelector('.perfil-info h2').textContent = data.nombre_de_usuario;
                document.querySelector('.perfil-info p:nth-of-type(1)').textContent = 'Correo electrónico: ' + data.email;
            }
        })
        .catch(error => console.error('Error al obtener los datos del perfil:', error));
};

