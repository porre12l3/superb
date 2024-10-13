document.querySelectorAll('.accordion-title').forEach(title => {
    title.addEventListener('click', function() {
        const content = this.nextElementSibling;
        const isVisible = content.style.display === 'block';
        
        // Ocultar todos los demás contenidos
        document.querySelectorAll('.accordion-content').forEach(c => {
            c.style.display = 'none';
        });

        // Mostrar el contenido correspondiente si no estaba visible
        content.style.display = isVisible ? 'none' : 'block';

        // Ajustar la altura del contenedor si se está expandiendo
        if (!isVisible) {
            content.style.height = 'auto'; // Permite que se ajuste la altura automáticamente
        }
    });
});
