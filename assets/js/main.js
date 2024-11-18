class AutoComplete {
    constructor(input, dataEndpoint) {
        this.input = input;
        this.dataEndpoint = dataEndpoint;
        this.autocompleteList = document.createElement('div');
        this.autocompleteList.className = 'autocomplete-items';
        this.input.parentNode.appendChild(this.autocompleteList);
        
        this.setupEventListeners();
    }

    setupEventListeners() {
        let debounceTimer;
        
        this.input.addEventListener('input', () => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => this.getSuggestions(), 300);
        });

        document.addEventListener('click', (e) => {
            if (e.target !== this.input) {
                this.autocompleteList.innerHTML = '';
            }
        });
    }

    async getSuggestions() {
        const query = this.input.value;
        if (query.length < 2) {
            this.autocompleteList.innerHTML = '';
            return;
        }

        try {
            const response = await fetch(`${this.dataEndpoint}?term=${encodeURIComponent(query)}`);
            const data = await response.json();
            this.showSuggestions(data);
        } catch (error) {
            console.error('Error fetching suggestions:', error);
        }
    }

    showSuggestions(suggestions) {
        this.autocompleteList.innerHTML = '';
        
        suggestions.forEach(suggestion => {
            const div = document.createElement('div');
            div.className = 'autocomplete-item';
            div.textContent = suggestion;
            
            div.addEventListener('click', () => {
                this.input.value = suggestion;
                this.autocompleteList.innerHTML = '';
                this.input.focus();
            });
            
            this.autocompleteList.appendChild(div);
        });
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Initialize autocomplete
    const searchInput = document.querySelector('.search-input');
    if (searchInput) {
        new AutoComplete(searchInput, 'get_suggestions.php');
    }

    // Make query options clickable
    document.querySelectorAll('.query-option').forEach(option => {
        option.addEventListener('click', function() {
            const radio = this.querySelector('input[type="radio"]');
            if (radio) {
                radio.checked = true;
            }
        });
    });
});