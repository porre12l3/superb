document.addEventListener('DOMContentLoaded', function() {
    const consejosContainer = document.querySelector('.consejos-container');

    const consejos = [
        {
            titulo: "Ejercicio Regular",
            descripcion: "Incorporar ejercicio a tu rutina diaria puede mejorar tu salud en general.",
            link: "https://www.verywellfit.com"
        },
        {
            titulo: "Nutrición Equilibrada",
            descripcion: "Una dieta balanceada es esencial para una vida saludable.",
            link: "https://www.healthline.com"
        },
        {
            titulo: "Consejos de Fútbol",
            descripcion: "Practica estas técnicas para mejorar tu rendimiento en el campo.",
            link: "https://www.fifa.com"
        },
        {
            titulo: "Salud y Bienestar",
            descripcion: "Consejos para un estilo de vida saludable y activo.",
            link: "https://www.menshealth.com"
        },
        {
            titulo: "Prevención de Lesiones",
            descripcion: "Conoce cómo evitar y tratar lesiones comunes en el deporte.",
            link: "https://www.mayoclinic.org"
        },
        {
            titulo: "Hidratación Adecuada",
            descripcion: "Mantenerse bien hidratado es fundamental para un rendimiento óptimo.",
            link: "https://www.webmd.com"
        },
        {
            titulo: "Estiramientos",
            descripcion: "Realiza estiramientos antes y después del ejercicio para evitar lesiones.",
            link: "https://www.acefitness.org"
        },
        {
            titulo: "Descanso y Recuperación",
            descripcion: "El descanso adecuado es clave para mejorar tu rendimiento deportivo.",
            link: "https://www.runnersworld.com"
        },
        {
            titulo: "Alimentación Pre-Entrenamiento",
            descripcion: "Consume un snack saludable antes de tu entrenamiento para tener energía.",
            link: "https://www.healthline.com"
        },
        {
            titulo: "Control del Estrés",
            descripcion: "Aprende técnicas para manejar el estrés que pueden afectar tu salud.",
            link: "https://www.mindbodygreen.com"
        },
        {
            titulo: "Importancia del Calentamiento",
            descripcion: "Siempre comienza con un calentamiento adecuado para prevenir lesiones.",
            link: "https://www.mayoclinic.org"
        },
        {
            titulo: "Hidratación",
            descripcion: "Mantente bien hidratado antes, durante y después de hacer ejercicio para optimizar el rendimiento.",
            link: "https://www.webmd.com"
        },
        {
            titulo: "Alimentación Post-Entrenamiento",
            descripcion: "Consume proteínas y carbohidratos después de entrenar para ayudar a la recuperación muscular.",
            link: "https://www.healthline.com"
        },
        {
            titulo: "Técnicas de Respiración",
            descripcion: "Aprender a respirar correctamente puede mejorar tu rendimiento en deportes de resistencia.",
            link: "https://www.verywellfit.com"
        },
        {
            titulo: "Prevención de Lesiones",
            descripcion: "Usa el equipo adecuado y sigue las técnicas correctas para evitar lesiones.",
            link: "https://www.aap.org"
        },
        {
            titulo: "Establecer Metas Realistas",
            descripcion: "Establece metas a corto y largo plazo para mantener la motivación y medir tu progreso.",
            link: "https://www.health.harvard.edu"
        },
        {
            titulo: "Variar la Rutina de Ejercicios",
            descripcion: "Cambia tu rutina regularmente para evitar estancarte y mantener el interés.",
            link: "https://www.acefitness.org"
        },
        {
            titulo: "Descanso y Recuperación",
            descripcion: "Dale a tu cuerpo tiempo suficiente para recuperarse entre sesiones de entrenamiento intensas.",
            link: "https://www.runnersworld.com"
        },
        {
            titulo: "Importancia de la Flexibilidad",
            descripcion: "Incorpora ejercicios de estiramiento en tu rutina para mejorar la flexibilidad y prevenir lesiones.",
            link: "https://www.verywellfit.com"
        },
        {
            titulo: "Mentalidad Positiva",
            descripcion: "Mantén una mentalidad positiva y visualiza el éxito para mejorar el rendimiento.",
            link: "https://www.mindbodygreen.com"
        }
    ];

    consejos.forEach(consejo => {
        const consejoItem = document.createElement('div');
        consejoItem.classList.add('consejo-item');

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
