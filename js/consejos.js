document.addEventListener('DOMContentLoaded', function() {
    const consejosContainer = document.querySelector('.consejos-container');
    
    const consejos = [
        {
            titulo: "Consejo 1",
            descripcion: "Descripción breve del consejo 1...",
            link: "url-del-consejo-1" 
        },
        {
            titulo: "Consejo 2",
            descripcion: "Descripción breve del consejo 2...",
            link: "url-del-consejo-2" 
        },

    ];

    consejos.forEach(consejo => {
        const consejoItem = document.createElement('div');
        consejoItem.classList.add('consejos-item');

        const title = document.createElement('h3');
        title.textContent = consejo.titulo;

        const description = document.createElement('p');
        description.textContent = consejo.descripcion;

        const button = document.createElement('button');
        button.textContent = 'Ver más';
        button.onclick = () => {
            window.location.href = consejo.link;
        };

        consejoItem.appendChild(title);
        consejoItem.appendChild(description);
        consejoItem.appendChild(button);

        consejosContainer.appendChild(consejoItem);
    });
});
