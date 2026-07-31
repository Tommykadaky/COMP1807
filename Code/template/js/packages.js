// template/js/packages.js
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const filterButtons = document.querySelectorAll('.filter-btn');
    const packageCards = document.querySelectorAll('.package-card');
    const noResultsMsg = document.getElementById('noResultsMsg');

    let currentFilter = 'All';
    let searchQuery = '';

    function filterPackages() {
        let visibleCount = 0;

        packageCards.forEach(card => {
            const name = card.getAttribute('data-name');
            const type = card.getAttribute('data-type');

            const matchesFilter = (currentFilter === 'All' || type === currentFilter);
            const matchesSearch = name.includes(searchQuery);

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

    // Sự kiện gõ tìm kiếm
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            searchQuery = e.target.value.toLowerCase().trim();
            filterPackages();
        });
    }

    // Sự kiện bấm nút lọc category
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            currentFilter = this.getAttribute('data-filter');
            filterPackages();
        });
    });
});