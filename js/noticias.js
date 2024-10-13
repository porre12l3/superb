document.addEventListener('DOMContentLoaded', function() {
    const newsContainer = document.querySelector('.news-container');

    async function cargarNoticiasDeportivas() {
        try {
            const response = await fetch('https://www.espn.com/espn/rss/news');
            const data = await response.text();

            const parser = new DOMParser();
            const xml = parser.parseFromString(data, 'application/xml');
            
            const items = xml.querySelectorAll('item');
            items.forEach(item => {
                const titulo = item.querySelector('title').textContent;
                const descripcion = item.querySelector('description').textContent;
                const link = item.querySelector('link').textContent;

                const newsItem = document.createElement('div');
                newsItem.classList.add('news-item');

                const title = document.createElement('h3');
                title.textContent = titulo;

                const description = document.createElement('p');
                description.textContent = descripcion;

                const button = document.createElement('button');
                button.textContent = 'Ver más';
                button.onclick = () => {
                    window.location.href = link;
                };

                newsItem.appendChild(title);
                newsItem.appendChild(description);
                newsItem.appendChild(button);

                newsContainer.appendChild(newsItem);
            });
        } catch (error) {
            console.error('Error al cargar las noticias:', error);
        }
    }

    cargarNoticiasDeportivas();
});
