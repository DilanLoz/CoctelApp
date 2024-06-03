
        // Función para inicializar el widget del Traductor de Google
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'es', // Idioma de la página
                autoDisplay: false // No mostrar el widget automáticamente
            }, 'google_translate_element');
        }