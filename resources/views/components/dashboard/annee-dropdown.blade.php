
<div>
    <label for="annee-universitaire-dropdown" class="block text-sm font-medium text-gray-700">Choisis une année universitaire</label>
    <select id="annee-universitaire-dropdown" name="annee_universitaire" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring focus:border-blue-300 sm:text-sm rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" disabled>
        <option value="" disabled selected></option>
    </select>
    <input type="hidden" id="filiereId" name="filiere_id" value="">

</div>

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filiereDropdown = document.getElementById('filiere-dropdown-btn');
        const anneeDropdown = document.getElementById('annee-universitaire-dropdown');

        filiereDropdown.addEventListener('change', function () {
            const selectedFiliereId = this.value;

            // Fetch years based on the selected filiere ID (adjust the route accordingly)
            fetch(`/get-years/${selectedFiliereId}`)
                .then(response => response.json())
                .then(years => {
                    // Clear existing options
                    anneeDropdown.innerHTML = '';

                    // Add new options based on the fetched years
                    years.forEach(year => {
                        const option = document.createElement('option');
                        option.value = year;
                        option.textContent = year;
                        anneeDropdown.appendChild(option);
                    });

                    // Enable the second dropdown
                    anneeDropdown.removeAttribute('disabled');
                })
                .catch(error => {
                    console.error('Error fetching years:', error);
                });
        });
        
    });
</script>
@endpush