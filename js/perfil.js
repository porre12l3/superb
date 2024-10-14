fetch('php/perfil.php')
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('username').textContent = 'Correo Electrónico: ' + data.email;
        } else {
            document.getElementById('username').textContent = 'Error al cargar los datos del perfil.';
        }
    })
    .catch(error => {
        console.error('Error al obtener los datos del perfil:', error);
        document.getElementById('username').textContent = 'Error al cargar los datos del perfil.';
    });
