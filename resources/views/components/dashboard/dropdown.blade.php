@props(['filieres'])

<div class="mb-3 relative">           
<button id="filiere-dropdown-btn" data-dropdown-toggle="dropdown" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Choisis une filiere<svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
        </svg>
    </button>
        
    <!-- Dropdown menu -->
    <div id="filiere-dropdown" class="z-10 absolute mt-1 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="filiere-dropdown">
            @foreach ($filieres as $filiere)
                <li>
                    <a href="{{ route('filiere.etudiants', $filiere->id) }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $filiere->nom }}</a>
                </li>
            @endforeach 
        </ul>
    </div>      
</div>

@push('js')
    <script>
        document.querySelector('#filiere-dropdown-btn')
            .addEventListener('click', () => {
                document.querySelector('#filiere-dropdown').classList.toggle('hidden')
            })
    </script> 
@endpush