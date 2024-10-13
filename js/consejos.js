document.addEventListener('DOMContentLoaded', function() {
    const consejosContainer = document.querySelector('.consejos-items');
    
    const consejosDeSalud = [
        {
            titulo: 'Ejercicio para el Tratamiento de Lesiones',
            descripcion: 'Realiza ejercicios específicos para mejorar tu movilidad y reducir el dolor.',
            link: '#'
        },
        {
            titulo: 'Ejercicios de Fútbol para Principiantes',
            descripcion: 'Descubre rutinas de entrenamiento para mejorar tus habilidades en el campo.',
            link: '#'
        },
        {
            titulo: 'Consejos de Dieta Saludable',
            descripcion: 'Aprende sobre la importancia de una alimentación balanceada.',
            link: '#'
        }
    ];
    
    consejosDeSalud.forEach(consejo => {
        const consejosItem = document.createElement('div');
        consejosItem.classList.add('consejos-item');

        const title = document.createElement('h3');
        title.textContent = consejo.titulo;

        const description = document.createElement('p');
        description.textContent = consejo.descripcion;

        const button = document.createElement('button');
        button.textContent = 'Ver más';
        button.onclick = () => {
            window.location.href = consejo.link;
        };

        consejosItem.appendChild(title);
        consejosItem.appendChild(description);
        consejosItem.appendChild(button);

        consejosContainer.appendChild(consejosItem);
    });
});
