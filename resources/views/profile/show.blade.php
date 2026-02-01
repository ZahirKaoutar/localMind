<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - LocalMind</title>
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
                    <a href="{{route('favorite.index') }}" class="text-gray-700 hover:text-purple-600 font-medium transition">Questions</a>
                    <a href="{{ route('profile.show') }}"class="text-purple-600 font-semibold">Mon Profil</a>
                </div>

                <!-- Right Section -->
                <div class="flex items-center space-x-4">
                    <a href="#" class="text-gray-600 hover:text-purple-600 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Contenu Principal -->
    <div class="max-w-5xl mx-auto px-4 py-8">

        <!-- Carte de Profil -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-8">
            
            <!-- Bannière -->
            <div class="h-32 bg-gradient-to-r from-purple-600 to-blue-600"></div>

            <!-- Informations du profil -->
            <div class="px-6 pb-6">
                <div class="flex flex-col sm:flex-row items-center sm:items-end -mt-16 sm:-mt-12">
                    
                    <!-- Photo de profil -->
                    <div class="relative">
                        <img src="https://ui-avatars.com/api/?name={{ $user->name }}&size=150&background=6366f1&color=fff" 
                             alt="{{ $user->name }}" 
                             class="w-32 h-32 rounded-full border-4 border-white shadow-lg">
                        
                        @if($user->role === 'admin')
                        <div class="absolute bottom-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                            ADMIN
                        </div>
                        @endif
                    </div>

                    <!-- Nom et stats -->
                    <div class="mt-4 sm:mt-0 sm:ml-6 text-center sm:text-left flex-1">
                        <h1 class="text-3xl font-bold text-gray-900">{{ $user->name }}</h1>
                        <p class="text-gray-600 mt-1">{{ $user->email }}</p>
                        
                        <!-- Badges -->
                        <div class="flex flex-wrap gap-2 mt-3 justify-center sm:justify-start">
                            @if($user->role === 'admin')
                                <span class="px-3 py-1 bg-red-100 text-red-700 text-sm font-semibold rounded-full">
                                    🛡️ Administrateur
                                </span>
                            @else
                                <span class="px-3 py-1 bg-green-100 text-green-700 text-sm font-semibold rounded-full">
                                    👤 Utilisateur
                                </span>
                            @endif
                            
                            <span class="px-3 py-1 bg-purple-100 text-purple-700 text-sm font-semibold rounded-full">
                                📅 Membre depuis {{ $user->created_at->format('M Y') }}
                            </span>
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>

     

        <!-- Mes Questions -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            
            <!-- En-tête -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-900 flex items-center gap-2">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Mes Questions
                    </h2>
                    <span class="px-3 py-1 bg-purple-100 text-purple-700 text-sm font-semibold rounded-full">
                        {{ $questions->count() }} question{{ $questions->count() > 1 ? 's' : '' }}
                    </span>
                </div>
            </div>

            <!-- Liste des questions -->
            <div class="p-6">
                @if($questions->isEmpty())
                    <!-- État vide -->
                    <div class="text-center py-12">
                        <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Aucune question pour le moment</h3>
                        <p class="text-gray-600 mb-6">Vous n'avez pas encore publié de question.</p>
                        <a href="#" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-lg font-medium hover:from-purple-700 hover:to-blue-700 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Poser ma première question
                        </a>
                    </div>
                @else
                    <!-- Liste des questions -->
                    <div class="space-y-4">
                        @foreach($questions as $question)
                            <div class="border border-gray-200 rounded-lg p-5 hover:shadow-md hover:border-purple-300 transition-all duration-200">
                                <div class="flex items-start justify-between gap-4">
                                    <div class="flex-1">
                                        <a href="{{ route('questions.show', $question->id) }}" 
                                           class="text-lg font-semibold text-gray-900 hover:text-purple-600 transition">
                                            {{ $question->title }}
                                        </a>
                                        
                                        @if($question->content)
                                        <p class="text-gray-600 text-sm mt-2 line-clamp-2">
                                            {{ Str::limit($question->content, 150) }}
                                        </p>
                                        @endif

                                        <!-- Métadonnées -->
                                        <div class="flex flex-wrap items-center gap-4 mt-3 text-xs text-gray-500">
                                            <span class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                {{ $question->created_at->diffForHumans() }}
                                            </span>
                                            
                                            

                                        </div>
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('questions.show', $question->id) }}" 
                                           class="p-2 text-purple-600 hover:bg-purple-50 rounded-lg transition" 
                                           title="Voir la question">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>

                                      

                                       
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>

    </div>

</body>
</html>