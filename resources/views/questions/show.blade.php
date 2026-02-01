<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question - LocalMind</title>
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
    <header class="bg-white shadow-sm">
        <div class="max-w-4xl mx-auto px-4 py-4">
            <h1 class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent">
                LocalMind
            </h1>
        </div>
    </header>

    <!-- Contenu -->
    <div class="max-w-4xl mx-auto px-4 py-8">
        
        <!-- Question -->
        <div class="bg-gradient-to-br from-purple-50 to-blue-50 rounded-xl shadow-md p-8 mb-8 border border-purple-100">
            <div class="flex items-start justify-between mb-4">
                <h2 class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent flex-1">
                    {{ $question->title }}
                </h2>
                <!-- Bouton Favoris -->
                <button class="ml-4 text-gray-400 hover:text-yellow-500 transition-all duration-300 transform hover:scale-110">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                    </svg>
                </button>
            </div>
            <p class="text-gray-700 leading-relaxed text-lg">{{ $question->content }}</p>
        </div>

        <!-- Séparateur avec style -->
        <div class="flex items-center my-10">
            <div class="flex-1 border-t-2 border-purple-200"></div>
            <div class="px-4">
                <div class="w-3 h-3 bg-gradient-to-r from-purple-600 to-blue-600 rounded-full"></div>
            </div>
            <div class="flex-1 border-t-2 border-purple-200"></div>
        </div>

        <!-- Réponses Section -->
        <div>
            <div class="flex items-center mb-6">
                <svg class="w-6 h-6 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                </svg>
                <h3 class="text-2xl font-bold text-gray-900">Réponses :</h3>
            </div>

            @forelse($question->responses as $response)
                <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 p-6 mb-4 border-l-4 border-blue-500 transform hover:-translate-y-1">
                    <div class="flex items-start space-x-4">
                        <!-- Avatar -->
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-400 to-blue-500 flex items-center justify-center text-white font-bold text-lg shadow-md">
                                {{ substr($response->user->name, 0, 1) }}
                            </div>
                        </div>
                        
                        <!-- Contenu -->
                        <div class="flex-1">
                            <p class="text-gray-700 leading-relaxed mb-4">
                                {{ $response->content }}
                            </p>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center text-sm">
                                    <span class="text-gray-500">Répondu par :</span>
                                    <span class="ml-2 font-semibold text-purple-600">{{ $response->user->name }}</span>
                                </div>
                                <a href="{{ route('reponse.edit', $response->id) }}"
                               class="flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg transition-all duration-200 text-sm font-medium border border-blue-200"
                               title="Modifier la question">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Modifier
                            </a>

                <form action="{{ route('reponse.destroy',$response->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette question ?');">
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
                                
                              
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-12 text-center border-2 border-dashed border-gray-300">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-br from-purple-100 to-blue-100 mb-4">
                        <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-600 text-lg font-medium mb-2">Aucune réponse pour le moment.</p>
                    <p class="text-gray-500 text-sm">Soyez le premier à répondre à cette question !</p>
                </div>
            @endforelse
        </div>

        <!-- Formulaire de réponse -->
    <form action="{{ route('reponse.store', $question->id) }}" method="POST">

    @csrf

    <textarea name="content"
        class="w-full px-4 py-3 border border-gray-300 rounded-lg"
        rows="3"
        placeholder="Écrivez votre réponse..."
    ></textarea>

    <div class="mt-2 flex justify-end">
        <button type="submit"
            class="px-6 py-2 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-lg">
            Répondre
        </button>
    </div>
      
</form>

            </div>

            
                
          
            

          

        </div>
    </div>

    </div>
     <a href="{{ route('questions.index')}}" class="px-6 py-3 text-gray-700 bg-blue-100 hover:bg-gray-200 rounded-lg font-medium transition duration-200">
                       retour
    </a>
    <body>

    <script>
        // Gestion du bouton favoris
        document.querySelector('button svg').parentElement.addEventListener('click', function() {
            const svg = this.querySelector('svg');
            if (this.classList.contains('text-yellow-500')) {
                this.classList.remove('text-yellow-500');
                this.classList.add('text-gray-400');
                svg.setAttribute('fill', 'none');
            } else {
                this.classList.remove('text-gray-400');
                this.classList.add('text-yellow-500');
                svg.setAttribute('fill', 'currentColor');
            }
        });
    </script>

</body>
</html>