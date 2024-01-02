<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Etudiants') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @can('viewany-etudiant')
                <x-dashboard.dropdown :filieres=$filieres/>
            @endcan
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @can('is_admin')
                        <button type="submit" class="add-etudiant-toggle | ml-auto mb-3 block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ajouter Etudiant</button>       
                    @endcan
                    <div class="overflow-auto">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                                    >
                                        Etudiant
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                                    >
                                        Cin
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                                    >
                                        Date de Naissance
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                                    >
                                        Filiere
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                                    >
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($etudiants as $etudiant)
                                 <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <div class="flex">
                                            <div >
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $etudiant->prenom . " " . $etudiant->nom}}
                                                </p>
                                                <p class="text-gray-600 whitespace-no-wrap">{{ $etudiant->cne }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ $etudiant->cin}}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ $etudiant->date_de_naissance }}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <span
                                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                        >
                                        <span
                                            aria-hidden
                                            class="absolute inset-0 bg-green-200 opacity-50 rounded-full"
                                        ></span>
                                        <span class="relative">{{ $etudiant->filiere->nom }}</span>
                                        </span>
                                    </td>
                                    @can('is_admin')
                                        <td class="px-5 py-5 space-x-2 whitespace-nowrap border-b border-gray-200">
                                            <button type="button" data-modal-toggle="edit-user-modal" data-cne="{{ $etudiant->cne }}" class="toggle-edit | inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-800 hover:bg-primary-800">
                                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
                                                Edit user
                                            </button>
                                            <button type="button" data-modal-toggle="delete-user-modal" data-id="{{ $etudiant->cne }}" class="toggle | inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                                Delete user
                                            </button>
                                            
                                            <x-dashboard.edit-modal-etudiant :etudiant=$etudiant :filieres=$filieres/>
                                            <x-dashboard.delete-modal route="{{ route('etudiants.destroy', ['etudiant' => $etudiant->cne])}}"/>
                                        </td>
                                    @endcan
                                </tr>
       
                                @endforeach                       
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-dashboard.add-modal-etudiant :filieres=$filieres/>

    @push('js')
        <script>
            const modal = document.getElementById('deleteModal')

            document.querySelectorAll(".toggle")
                .forEach(closeBtn => {
                    closeBtn.addEventListener('click', () => {
                        const deleteModal = document.getElementById('del-' + closeBtn.dataset.id)
                        deleteModal.classList.toggle('hidden')                       })
                });

            

            document.querySelectorAll('.toggle-edit')
                .forEach(btn => {
                    btn.addEventListener('click', () => {
                        const editModal = document.getElementById(btn.dataset.cne)
                        editModal.classList.toggle('translate-x-full')
                    })
                })
               
            
            
        </script>
    @endpush
</x-app-layout>
