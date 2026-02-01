<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une question</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white w-full max-w-lg p-8 rounded-lg shadow-md">

    <h1 class="text-2xl font-bold mb-6 text-center">
        Ajouter une question
    </h1>

    {{-- Message success --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('questions.store') }}">
        @csrf

        <!-- Title -->
        <div class="mb-4">
            <label class="block font-medium mb-1">Titre</label>
            <input type="text" 
                   name="title" 
                   value="{{ old('title') }}"
                   class="w-full border p-2 rounded @error('title') border-red-500 @enderror">

            @error('title')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Content -->
        <div class="mb-4">
            <label class="block font-medium mb-1">Contenu</label>
            <textarea name="content" rows="5"
                      class="w-full border p-2 rounded @error('content') border-red-500 @enderror">{{ old('content') }}</textarea>

            @error('content')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Location -->
        <div class="mb-6">
            <label class="block font-medium mb-1">Localisation</label>
            <input type="text" 
                   name="location" 
                   value="{{ old('location') }}"
                   class="w-full border p-2 rounded @error('location') border-red-500 @enderror">

            @error('location')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Buttons -->
        <div class="flex justify-between">
            <a href="{{ route('questions.index') }}" 
               class="text-gray-600 hover:underline">
                Annuler
            </a>

            <button type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Enregistrer
            </button>
        </div>

    </form>
    <a href="{{ route('questions.index')}}" class="px-6 py-3 text-gray-700  hover:bg-gray-200 rounded-lg font-medium transition duration-200">
                       retour
    </a>
</div>
 
</body>
</html>
