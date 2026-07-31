// template/extras.js
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('extraSearchInput');
    const filterBtns = document.querySelectorAll('.extra-filter-btn');
    const cards = document.querySelectorAll('.extra-card');
    const noResultsMsg = document.getElementById('noExtraResultsMsg');

    let currentFilter = 'All';
    let debounceTimer;

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            filterBtns.forEach(b => b.style.backgroundColor = '#efefef');
            this.style.backgroundColor = '#ccc';
            
            currentFilter = this.getAttribute('data-filter');
            filterExtras();
        });
    });

    searchInput.addEventListener('input', function() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(function() {
            filterExtras();
        }, 300);
    });

    function filterExtras() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        let visibleCount = 0;

        cards.forEach(card => {
            const name = card.getAttribute('data-name');
            const type = card.getAttribute('data-type');
            
            const matchesFilter = (currentFilter === 'All' || type === currentFilter);
            const matchesSearch = name.includes(searchTerm);

            if (matchesFilter && matchesSearch) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        if (visibleCount === 0) {
            noResultsMsg.style.display = 'block';
        } else {
            noResultsMsg.style.display = 'none';
        }
    }
});