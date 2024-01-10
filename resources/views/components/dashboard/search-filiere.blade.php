@props(['filiere'])

<form action="{{ route('filiere.etudiants', ['filiere' => $filiere]) }}" method="GET" class="mb-4">
    <div class="flex items-center">
        <label for="search" class="mr-2 text-gray-600">Search:</label>
        <input type="text" id="search" name="search"
               class="border border-gray-300 px-2 py-1 rounded focus:outline-none focus:border-blue-500">
        <button type="submit" class="ml-2 px-4 py-1 bg-blue-500 text-white rounded hover:bg-blue-700 focus:outline-none">
            Search
        </button>
    </div>
</form>