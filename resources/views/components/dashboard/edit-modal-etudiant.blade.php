@props(['etudiant', 'filieres'])

<form method="POST" action="{{ route('etudiants.update', $etudiant->cne) }}" id="{{ $etudiant->cne }}" class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-label">
    @csrf
    @method('PUT')
    <h5 id="drawer-label" class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400"><svg class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>Edit
    </h5>
    <button type="button" data-drawer-hide="drawer-example" data-cne="{{ $etudiant->cne }}" aria-controls="drawer-example" class="toggle-edit | text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white" >
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
        <span class="sr-only">Close menu</span>
    </button>

    <div class="mt-5">
        <div class="mb-5">
            <label for="prenom-{{ $etudiant->cne }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prenom</label>
            <input type="text" id="prenom-{{ $etudiant->cne }}" name="prenom" value="{{ $etudiant->prenom}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
        </div>
        <div class="mb-5">
            <label for="nom-{{ $etudiant->cne }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
            <input type="text" id="nom-{{ $etudiant->cne }}" name="nom" value="{{ $etudiant->nom }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
        </div>
        <div class="mb-5">
            <label for="cne-{{ $etudiant->cne }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CNE</label>
            <input type="text" id="cne-{{ $etudiant->cne }}" name="cne" value="{{ $etudiant->cne }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
        </div>
        <div class="mb-5">
            <label for="cin-{{ $etudiant->cne }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CIN</label>
            <input type="text" id="cin-{{ $etudiant->cne }}" name="cin" value="{{ $etudiant->cin }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
        </div>
        <div class="mb-5">
            <label for="date_de_naissance-{{ $etudiant->cne }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date de Naissance</label>
            <input type="date" id="date_de_naissance-{{ $etudiant->cne }}" value="{{ $etudiant->date_de_naissance }}" name="date_de_naissance" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
        </div>
        <div class="mb-5">
            <label for="lieu_de_naissance-{{ $etudiant->cne }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lieu de Naissance</label>
            <textarea id="lieu_de_naissance-{{ $etudiant->cne }}" name="lieu_de_naissance" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>{{ $etudiant->lieu_de_naissance }}</textarea>
        </div>
        <div class="mb-5">
            <label for="filiere-{{ $etudiant->cne }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Filiere</label>
            <select name="filiere_id" id="filiere-{{ $etudiant->cne }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
                @foreach ($filieres as $filiere)
                   <option value={{ $filiere->id }} @selected($filiere->nom === $etudiant->filiere->nom)>{{ $filiere->nom }}</option> 
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit</button>
    </div>
</form>