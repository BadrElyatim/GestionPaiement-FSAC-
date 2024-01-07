<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Etudiants') }}
        </h2>
    </x-slot>
    @if ($errors->any())
        <x-dashboard.errors-alert :errors="$errors->all()"/>
    @endif
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
                                    @can('is_prof')
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                                        >
                                            Mpc
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                                        >
                                            Mpnc
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                                        >
                                            Mr
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                                        >
                                            Nt
                                        </th>
                                    @endcan
                                    @can('is_admin')
                                        <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                                        >
                                            Mpc
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                                        >
                                            Nt
                                        </th>
                                    @endcan
                                    @can('is_regisseur')
                                        <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                                        >
                                            NtN
                                        </th>
                                    @endcan
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
                                    @can('is_prof')
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $etudiant->Mpc }}</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $etudiant->Mpnc }}</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $etudiant->Mr }}</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $etudiant->Nt }}</p>
                                        </td>
                                    @endcan
                                    @can('is_regisseur')
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <span
                                        class="relative inline-block px-3 py-1 font-semibold {{ $etudiant->Ntn ? 'text-red-700' : 'text-green-900' }} leading-tight"
                                        >
                                        <span
                                            aria-hidden
                                            class="absolute inset-0 {{ $etudiant->Ntn ? 'bg-red-500' : 'bg-green-200' }} opacity-50 rounded-full"
                                        ></span>
                                        <span class="relative">{{ $etudiant->Ntn }}</span>
                                        </span>
                                    </td>
                                    @endcan
                                    @can('is_admin')
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $etudiant->Mpc }}</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $etudiant->Nt }}</p>
                                        </td>
                                        <td class="px-5 py-5 space-x-2 whitespace-nowrap border-b border-gray-200">
                                            <button type="button" data-modal-toggle="edit-user-modal" data-cne="{{ $etudiant->cne }}" class="toggle-edit | inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-800 hover:bg-primary-800">
                                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
                                                Edit user
                                            </button>
                                            <button type="button" data-modal-toggle="delete-user-modal" data-id="{{ $etudiant->id }}" class="toggle | inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                                Delete user
                                            </button>
                                            
                                            <x-dashboard.edit-modal-etudiant :etudiant=$etudiant :filieres=$filieres/>
                                            <x-dashboard.delete-modal route="{{ route('etudiants.destroy', ['etudiant' => $etudiant->id])}}"/>
                                        </td>
                                    @endcan
                                    @can('view-tranches')
                                        <td class="px-5 py-5 space-x-2 whitespace-nowrap border-b border-gray-200">
                                            <a href="{{ route('etudiant.tranches', $etudiant->id) }}">
                                                <button type="button" data-modal-toggle="edit-user-modal" data-cne="{{ $etudiant->cne }}" class="toggle-edit | inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-800 hover:bg-primary-800">
                                                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="currentColor" version="1.1" id="Capa_1" width="800px" height="800px" viewBox="0 0 442.04 442.04" xml:space="preserve">
                                                        <g>
                                                            <g>
                                                                <path d="M221.02,341.304c-49.708,0-103.206-19.44-154.71-56.22C27.808,257.59,4.044,230.351,3.051,229.203    c-4.068-4.697-4.068-11.669,0-16.367c0.993-1.146,24.756-28.387,63.259-55.881c51.505-36.777,105.003-56.219,154.71-56.219    c49.708,0,103.207,19.441,154.71,56.219c38.502,27.494,62.266,54.734,63.259,55.881c4.068,4.697,4.068,11.669,0,16.367    c-0.993,1.146-24.756,28.387-63.259,55.881C324.227,321.863,270.729,341.304,221.02,341.304z M29.638,221.021    c9.61,9.799,27.747,27.03,51.694,44.071c32.83,23.361,83.714,51.212,139.688,51.212s106.859-27.851,139.688-51.212    c23.944-17.038,42.082-34.271,51.694-44.071c-9.609-9.799-27.747-27.03-51.694-44.071    c-32.829-23.362-83.714-51.212-139.688-51.212s-106.858,27.85-139.688,51.212C57.388,193.988,39.25,211.219,29.638,221.021z"/>
                                                            </g>
                                                            <g>
                                                                <path d="M221.02,298.521c-42.734,0-77.5-34.767-77.5-77.5c0-42.733,34.766-77.5,77.5-77.5c18.794,0,36.924,6.814,51.048,19.188    c5.193,4.549,5.715,12.446,1.166,17.639c-4.549,5.193-12.447,5.714-17.639,1.166c-9.564-8.379-21.844-12.993-34.576-12.993    c-28.949,0-52.5,23.552-52.5,52.5s23.551,52.5,52.5,52.5c28.95,0,52.5-23.552,52.5-52.5c0-6.903,5.597-12.5,12.5-12.5    s12.5,5.597,12.5,12.5C298.521,263.754,263.754,298.521,221.02,298.521z"/>
                                                            </g>
                                                            <g>
                                                                <path d="M221.02,246.021c-13.785,0-25-11.215-25-25s11.215-25,25-25c13.786,0,25,11.215,25,25S234.806,246.021,221.02,246.021z"/>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                    Tranches
                                                 </button>
                                            </a>
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
                        deleteModal.classList.toggle('hidden')                           
                    })
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
