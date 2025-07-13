<!--Script vérifiant le localStorage pour savoir quel thème appliqué au chargement de chaque page-->
<script>
        document.addEventListener('DOMContentLoaded', () => {
            const currentTheme = localStorage.getItem('theme') || 'light';
            if (currentTheme === 'dark') {
                document.body.classList.add('bg-dark', 'text-white');
            }
        });
</script>