document.addEventListener('DOMContentLoaded', function() {
    const consejosContainer = document.getElementById('consejos-list');

    const rssFeeds = {
        "ejercicios": 'https://rss2json.com/api.json?rss_url=https://www.20minutos.es/rss/deportes/',
        "futbol": 'https://rss2json.com/api.json?rss_url=https://as.com/rss/tags/futbol/primera.xml',
        "dieta_saludable": 'https://rss2json.com/api.json?rss_url=https://www.menshealth.com/es/nutricion/rss'
    };

    const apiKey = 'fr4aeeuuqxowvs9ykecuu8rwpnh7a5iskwdctmjz';

    function cargarConsejos(feedUrl) {
        const url = `${feedUrl}&api_key=${apiKey}`;
        fetch(url)
            .then(response => response.json())
            .then(data => {
                data.items.forEach(item => {
                    const consejoItem = document.createElement('div');
                    consejoItem.classList.add('consejo-item');

                    const title = document.createElement('h3');
                    title.textContent = item.title;

                    const description = document.createElement('p');
                    description.textContent = item.description;

                    const button = document.createElement('button');
                    button.textContent = 'Ver más';
                    button.onclick = () => {
                        window.location.href = item.link;
                    };

                    consejoItem.appendChild(title);
                    consejoItem.appendChild(description);
                    consejoItem.appendChild(button);

                    consejosContainer.appendChild(consejoItem);
                });
            })
            .catch(error => console.error('Error al cargar los consejos:', error));
    }

    cargarConsejos(rssFeeds.ejercicios);
    cargarConsejos(rssFeeds.futbol);
    cargarConsejos(rssFeeds.dieta_saludable);
});
