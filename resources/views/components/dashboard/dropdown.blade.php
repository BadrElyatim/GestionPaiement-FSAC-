@props(['filieres'])

<div>
    <label for="filiere-dropdown-btn" class="block text-sm font-medium text-gray-700">Choisis une filiere</label>
    <select id="filiere-dropdown-btn" name="filiere" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring focus:border-blue-300 sm:text-sm rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
        <option selected disabled value=""></option>
        @foreach ($filieres as $filiere)
            <option value="{{ $filiere->nom }}">{{ $filiere->nom }}</option>
        @endforeach
    </select>
</div>
