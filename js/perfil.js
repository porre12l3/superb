fetch('php/perfil.php')
    .then(response => response.json())
    .then(data => {
        console.log(data); // Verificar qué datos devuelve el servidor

        if (data.success) {
            document.getElementById('username').textContent = 'Nombre de Usuario: ' + data.username;
            document.getElementById('email').textContent = 'Correo Electrónico: ' + data.email;
            document.getElementById('description').value = data.description || ''; // Actualiza la descripción en el textarea
            
            // Establece la imagen de perfil si existe
            if (data.foto_perfil) {
                document.getElementById('profileImage').src = 'uploads/' + data.foto_perfil; // Ajusta la ruta si es necesario
            }
        } else {
            document.getElementById('username').textContent = 'Error al cargar los datos del perfil.';
        }
    })
    .catch(error => {
        console.error('Error al obtener los datos del perfil:', error);
        document.getElementById('username').textContent = 'Error al cargar los datos del perfil.';
    });


function previewImage(event) {
    const file = event.target.files[0];
    const reader = new FileReader();
    
    reader.onload = function(e) {
        document.getElementById('profileImage').src = e.target.result; // Muestra la imagen seleccionada
    }

    if (file) {
        reader.readAsDataURL(file);
    }
}

function uploadProfileImage() {
    const fileInput = document.getElementById('fileInput');
    const formData = new FormData();
    
    if (fileInput.files.length > 0) {
        formData.append('file', fileInput.files[0]);
        formData.append('user_id', sessionStorage.getItem('user_id')); // Asegúrate de tener el ID del usuario almacenado

        fetch('php/upload_profile_image.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // La imagen se ha subido correctamente
                alert('Imagen de perfil actualizada con éxito.');
            } else {
                alert('Error al actualizar la imagen de perfil: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error al subir la imagen de perfil:', error);
        });
    } else {
        alert('Por favor, selecciona una imagen.');
    }
}

function logout() {
    sessionStorage.removeItem('user_id'); // Elimina el ID de usuario
    window.location.href = 'login.html';
}

function saveProfile() {
    const description = document.getElementById('description').value;
    const fileInput = document.getElementById('fileInput');
    const formData = new FormData();

    // Añadir la descripción al FormData
    formData.append('description', description);
    formData.append('user_id', sessionStorage.getItem('user_id')); // Asegúrate de tener el ID del usuario almacenado

    // Si hay un archivo, añadirlo al FormData
    if (fileInput.files.length > 0) {
        formData.append('file', fileInput.files[0]);
    }

    fetch('php/save_profile.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Perfil guardado con éxito.');
        } else {
            alert('Error al guardar el perfil: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error al guardar el perfil:', error);
    });
}


function fetchProfileData() {
    fetch('php/perfil.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('username').textContent = 'Nombre de Usuario: ' + data.username;
                document.getElementById('email').textContent = 'Correo Electrónico: ' + data.email;
                document.getElementById('description').value = data.description; // Actualiza la descripción en el textarea
                
                // Establece la imagen de perfil si existe
                if (data.foto_perfil) {
                    document.getElementById('profileImage').src = 'uploads/' + data.foto_perfil; // Ajusta la ruta si es necesario
                }
            } else {
                document.getElementById('username').textContent = 'Error al cargar los datos del perfil.';
            }
        })
        .catch(error => {
            console.error('Error al obtener los datos del perfil:', error);
            document.getElementById('username').textContent = 'Error al cargar los datos del perfil.';
        });

        document.addEventListener('DOMContentLoaded', function() {
            fetchProfileData(); // Carga los datos del perfil cuando se carga la página
        });
}
