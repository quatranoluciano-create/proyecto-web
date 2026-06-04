document.addEventListener('DOMContentLoaded', () => {
    const searchForm = document.querySelector('.jobs-search');
    if (searchForm) {
        searchForm.addEventListener('submit', () => {
            const btn = searchForm.querySelector('button[type="submit"]');
            if (btn) btn.textContent = 'Buscando...';
        });
    }
});
