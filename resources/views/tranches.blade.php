<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tranches') }} <span class="text-sm text-gray-500">({{ $etudiant->prenom }} {{ $etudiant->nom }})</span>
        </h2>
    </x-slot>
    @if ($errors->any())
        <x-dashboard.errors-alert :errors="$errors->all()"/>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @can('is_prof')
                <button type="submit" class="add-tranche-toggle | ml-auto mb-3 block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ajouter Tranche</button>       
            @endcan
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-auto">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                                    >
                                        Tranche
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                                    >
                                        Date
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                                    >
                                        Montant
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                                    >
                                        Valide
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                                    >
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tranches as $tranche)
                                 <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <div class="flex">
                                            <div >
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $tranche->numero }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ $tranche->date }}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ $tranche->montant }}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <span
                                        class="relative inline-block px-3 py-1 font-semibold {{ $tranche->valide ? 'text-green-900' : 'text-red-700' }} leading-tight"
                                        >
                                        <span
                                            aria-hidden
                                            class="absolute inset-0 {{ $tranche->valide ? 'bg-green-200' : 'bg-red-500' }} opacity-50 rounded-full"
                                        ></span>
                                        <span class="relative">{{ $tranche->valide ? 'Oui' : 'Non' }}</span>
                                        </span>
                                    </td>
                                    <td class="px-5 py-5 space-x-2 whitespace-nowrap border-b border-gray-200">
                                            <button type="button" data-id="{{ $tranche->id }}" data-modal-toggle="tranche-details" class="toggle-tranche-details | inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-800 hover:bg-primary-800">
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
                                                Details
                                            </button>

                                            @if (Gate::allows('is_prof') && !$tranche->valide)
                                                <button type="button" data-modal-toggle="delete-user-modal" data-id="{{ $tranche->id }}" class="toggle | inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                                    Delete
                                                </button>

                                                <x-dashboard.delete-modal route="{{ route('tranches.destroy', ['tranche' => $tranche->id])}}"/>
                                            @endif
                                            <x-dashboard.tranche-details :tranche=$tranche/>
                                    </td>
                                    
                                </tr>
       
                                @endforeach                       
                            </tbody>
                        </table>
                    </div>
                    <p class="mt-5"><span class="font-bold">Total Payee:</span> {{ $total_payee }} MAD</p>
                    <p><span class="font-bold">Reste: </span>{{ $reste }} MAD</p>
                </div>

            </div>
        </div>
    </div>
    <x-dashboard.add-modal-tranche cne="{{ $etudiant->id }}"/>
    
    @push('js')
        <script>
            document.querySelectorAll('.toggle-tranche-details')
                .forEach(btn => {
                    btn.addEventListener('click', () => {
                        const trancheDetails = document.getElementById('tranche-' + btn.dataset.id)
                        trancheDetails.classList.toggle('translate-x-full')
                    })
                })

                document.querySelectorAll('.numero-recu-toggle')
                    .forEach(btn => {
                        btn.addEventListener('click', () => {
                            document.querySelector('#numero-recu-modal-' + btn.dataset.id).classList.toggle('hidden')
                        })
                    }); 

                document.querySelectorAll('.update-tranche-toggle')
                    .forEach(btn => {
                        btn.addEventListener('click', () => {
                            document.querySelector('#update-tranche-modal-' + btn.dataset.id).classList.toggle('hidden')
                        })
                    });  

                document.querySelectorAll(".toggle")
                    .forEach(closeBtn => {
                        closeBtn.addEventListener('click', () => {
                            const deleteModal = document.getElementById('del-' + closeBtn.dataset.id)
                            deleteModal.classList.toggle('hidden')                       
                        })
                    });
        </script>

    @endpush
</x-app-layout>
