document.addEventListener('DOMContentLoaded', function() {
    const searchType = document.getElementById('searchType');
    const searchTermDiv = document.getElementById('searchTermDiv');
    const searchTerm = document.getElementById('searchTerm');

    searchType.addEventListener('change', function() {
        if (this.value === 'lenguaje') {
            searchTermDiv.style.display = 'none';
            searchTerm.value = '';
        } else {
            searchTermDiv.style.display = 'block';
        }
    });
});