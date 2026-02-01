<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-7xl mx-auto p-6">

    <h1 class="text-3xl font-bold mb-8">Dashboard Admin</h1>

    <!-- 📊 Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-gray-500">Utilisateurs</h2>
            <p class="text-3xl font-bold">{{ $stats['users'] }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-gray-500">Questions</h2>
            <p class="text-3xl font-bold">{{ $stats['questions'] }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-gray-500">Réponses</h2>
            <p class="text-3xl font-bold">{{ $stats['responses'] }}</p>
        </div>

    </div>

    <!-- 👥 Liste utilisateurs -->
    <div class="bg-white rounded-lg shadow p-6">

        <h2 class="text-xl font-semibold mb-4">Utilisateurs</h2>

        <table class="w-full border">

            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">Nom</th>
                    <th class="p-2 border">Email</th>
                    <th class="p-2 border">Rôle</th>
                    <th class="p-2 border">Nb Questions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                    <tr class="text-center">
                        <td class="p-2 border">{{ $user->name }}</td>
                        <td class="p-2 border">{{ $user->email }}</td>
                        <td class="p-2 border">
                            <span class="px-2 py-1 rounded text-white 
                                {{ $user->role === 'admin' ? 'bg-red-500' : 'bg-blue-500' }}">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="p-2 border">{{ $user->questions_count }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>
 <a href="{{ route('questions.index')}}" class="px-6 py-3 text-gray-700 bg-blue-100 hover:bg-gray-200 rounded-lg font-medium transition duration-200">
                       retour
    </a>
          
</div>

</body>
</html>
