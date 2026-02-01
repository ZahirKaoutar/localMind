<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions - LocalMind</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">

    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                
                <!-- Logo -->
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent">
                        LocalMind
                    </h1>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('questions.index') }}" class="text-gray-700 hover:text-purple-600 font-medium transition">Accueil</a>
                   @if(auth()->user()->role === 'admin')
                         <a href="{{ route('dasbord') }}" class="text-gray-700 hover:text-purple-600 font-medium transition">Dasboard</a>
                   @endif
                    <a href="{{ route('favorite.index') }}" class="text-gray-700 hover:text-purple-600 font-medium transition">Favorit</a>
                    <a href="{{ route('profile.show') }}" class="text-gray-700 hover:text-purple-600 font-medium transition">¨Profile</a>
                </div>

                <!-- Right Section -->
                <div class="flex items-center space-x-4">
                    <!-- Search Button -->
                    <button class="p-2 text-gray-600 hover:text-purple-600 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>

                  

                    <!-- Ask Question Button -->
                    <a href="{{ route('questions.create') }}"class="hidden sm:block px-4 py-2 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-lg font-medium hover:from-purple-700 hover:to-blue-700 transition">
                        Poser une question
                    </a>

                    <!-- User Profile -->
                    <div class="relative">
                        <button id="userMenuButton" class="flex items-center space-x-2 focus:outline-none">
                            <img src="https://ui-avatars.com/api/?name=User&background=6366f1&color=fff" alt="User" class="w-9 h-9 rounded-full border-2 border-purple-200">
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="userMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 border border-gray-200">
                           
                            <hr class="my-2">
                            <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                                Déconnexion
                            </a>
                        </div>
                    </div>

                    <!-- Mobile Menu Button -->
                    <button id="mobileMenuButton" class="md:hidden p-2 text-gray-600 hover:text-purple-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobileMenu" class="hidden md:hidden pb-4">
                <div class="flex flex-col space-y-2">
                    <a href="{{ route('questions.index') }}" class="px-3 py-2 text-gray-700 hover:bg-purple-50 hover:text-purple-600 rounded-lg transition">Accueil</a>

                    <a href="{{ route('favorite.index') }}" class="px-3 py-2 text-gray-700 hover:bg-purple-50 hover:text-purple-600 rounded-lg transition">les,favoris</a>
                   
                    <a href="#" class="px-3 py-2 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-lg font-medium text-center">
                        Poser une question
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Contenu Principal -->
    <div class="max-w-4xl mx-auto px-4 py-8">
        
        <!-- Liste des Questions -->
        <div class="space-y-6">
            @foreach ($questions as $question )
                <div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition-shadow duration-200">
                <!-- En-tête de la question -->
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">
                            {{ $question->title }}
                        </h3>
                        <p class="text-gray-600 text-sm mb-3">
                            {{ $question->content }}
                        </p>
                        <div class="flex items-center text-xs text-gray-500">
                            <span>Posté par {{ $question->user->name }}</span>
                            <span class="mx-2">•</span>
                        </div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="flex items-center gap-2 ml-4">
                        <!-- Bouton Favoris -->
                        <form action="{{ route('favorite.toggle', $question->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="p-2 text-gray-400 hover:text-yellow-500 hover:bg-yellow-50 rounded-lg transition-all duration-200" title="Ajouter aux favoris">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                </svg>
                            </button>
                        </form>

                        @if(auth()->id() === $question->user_id || auth()->user()->role === 'admin')
                            <!-- Bouton Modifier -->
                            <a href="{{ route('questions.edit', $question->id) }}"
                               class="flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg transition-all duration-200 text-sm font-medium border border-blue-200"
                               title="Modifier la question">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Modifier
                            </a>

                            <!-- Bouton Supprimer -->
                            <form action="{{ route('questions.destroy', $question->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette question ?');">
                                @csrf
                                @method('DELETE')

                                <button type="submit" 
                                        class="flex items-center gap-1.5 px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg transition-all duration-200 text-sm font-medium border border-red-200"
                                        title="Supprimer la question">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Supprimer
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                <!-- Séparateur -->
                <hr class="my-4 border-gray-200">

                <!-- Formulaire de réponse -->
                <form action="{{ route('reponse.store', $question->id) }}" method="POST">
                    @csrf

                    <textarea name="content"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 resize-none"
                        rows="3"
                        placeholder="Écrivez votre réponse..."
                    ></textarea>

                    <div class="mt-3 flex justify-end">
                        <button type="submit"
                            class="flex items-center gap-2 px-6 py-2 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-lg font-medium hover:from-purple-700 hover:to-blue-700 transition-all duration-200 shadow-sm hover:shadow-md">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            Répondre
                        </button>
                    </div>
                </form>

                <!-- Bouton Voir Détails -->
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <a href="{{ route('questions.show', $question->id) }}"
                       class="inline-flex items-center gap-2 px-4 py-2 bg-white text-purple-600 border-2 border-purple-600 rounded-lg font-medium hover:bg-purple-600 hover:text-white transition-all duration-200"
                       title="Voir les détails de la question">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        Voir les détails
                    </a>
                </div>

            </div>
           
            @endforeach

        </div>
    </div>

    <script>
        // Gestion du menu utilisateur
        const userMenuButton = document.getElementById('userMenuButton');
        const userMenu = document.getElementById('userMenu');
        
        userMenuButton.addEventListener('click', function(e) {
            e.stopPropagation();
            userMenu.classList.toggle('hidden');
        });

        // Fermer le menu en cliquant ailleurs
        document.addEventListener('click', function() {
            if (!userMenu.classList.contains('hidden')) {
                userMenu.classList.add('hidden');
            }
        });

        // Gestion du menu mobile
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');
        
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    </script>

</body>
</html>