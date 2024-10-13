const postContainer = document.querySelector('.post-container');
const textarea = document.querySelector('textarea');
const publishButton = document.querySelector('.publish');
const mediaInput = document.getElementById('mediaInput');

function renderPosts(posts) {
    postContainer.innerHTML = '';
    posts.forEach((post) => {
        const postElement = document.createElement('div');
        postElement.classList.add('post');

        const content = document.createElement('div');
        content.classList.add('content');
        content.textContent = post.text;

        if (post.image) {
            const img = document.createElement('img');
            img.src = post.image;
            img.alt = 'Publicación de imagen';
            img.classList.add('post-image');
            content.appendChild(img);
        }

        const toggleButton = document.createElement('button');
        toggleButton.classList.add('toggle-button');
        toggleButton.textContent = 'Mostrar más';
        toggleButton.addEventListener('click', () => {
            content.classList.toggle('expanded');
            toggleButton.textContent = content.classList.contains('expanded') ? 'Mostrar menos' : 'Mostrar más';
        });

        postElement.appendChild(content);
        postElement.appendChild(toggleButton);
        postContainer.appendChild(postElement);
    });
}

async function addPost() {
    const postText = textarea.value.trim();
    const mediaFile = mediaInput.files[0];
    const formData = new FormData();

    if (postText || mediaFile) {
        formData.append('postText', postText);
        if (mediaFile) {
            formData.append('mediaInput', mediaFile);
        }

        const response = await fetch('php/guardar_publicacion.php', {
            method: 'POST',
            body: formData,
        });

        if (response.ok) {
            textarea.value = '';
            mediaInput.value = '';
            loadPosts();
        } else {
            console.error('Error al publicar:', response.statusText);
        }
    }
}

async function loadPosts() {
    const response = await fetch('php/obtener_publicaciones.php');
    if (response.ok) {
        const posts = await response.json();
        renderPosts(posts);
    } else {
        console.error('Error al cargar publicaciones:', response.statusText);
    }
}

publishButton.addEventListener('click', addPost);

loadPosts();
