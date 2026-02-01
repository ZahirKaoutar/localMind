<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la question</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen py-8 px-4">
    
    <div class="max-w-3xl mx-auto">
        <!-- En-tête -->
        <div class="bg-white rounded-t-xl shadow-sm p-6 border-b border-gray-200">
            <h2 class="text-3xl font-bold text-gray-800">Modifier la question</h2>
            <p class="text-gray-600 mt-2">Modifiez les informations de votre question</p>
        </div>

        <!-- Formulaire -->
        <div class="bg-white rounded-b-xl shadow-lg p-8">
            <form action="{{ route('questions.update', $question->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Champ Titre -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                        Titre
                    </label>
                    <input 
                        type="text" 
                        id="title"
                        name="title" 
                        value="{{ old('title', $question->title) }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-200"
                        placeholder="Entrez le titre de votre question..."
                        required
                    >
                    @error('title')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div>
    <label for="location" class="block text-sm font-semibold text-gray-700 mb-2">
        Localisation
    </label>
    <input 
        type="text" 
        id="location"
        name="location" 
        value="{{ old('location', $question->location) }}"
        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg"
        required
    >
</div>
                <!-- Champ Contenu -->
                <div>
                    <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">
                        Contenu
                    </label>
                    <textarea 
                        id="content"
                        name="content" 
                        rows="10"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-200 resize-none"
                        placeholder="Décrivez votre question en détail..."
                        required
                    >{{ old('content', $question->content) }}</textarea>
                    @error('content')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                    <p class="mt-2 text-sm text-gray-500">
                        Soyez clair et précis pour obtenir de meilleures réponses
                    </p>
                </div>

                <!-- Bouton de soumission -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <a 
                        href="{{ url()->previous() }}" 
                        class="px-6 py-3 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium transition duration-200"
                    >
                        Annuler
                    </a>
                    
                    <button 
                        type="submit"
                        class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition duration-200 flex items-center gap-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Mettre à jour
                    </button>
                </div>
            </form>

            <!-- Message de succès -->
            @if(session('success'))
                <div class="mt-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-green-800 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <a href="{{ route('questions.index')}}" class="px-6 py-3 text-gray-700 bg-blue-100 hover:bg-gray-200 rounded-lg font-medium transition duration-200">
                       retour
    </a>
                    

</body>
</html>