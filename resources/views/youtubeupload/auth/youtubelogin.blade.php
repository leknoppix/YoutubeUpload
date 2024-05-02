@extends('youtubeupload.template.tailwindcss')

@section('title', "Connexion YouTube et Tableau")

@section('content')
    <div class="text-center mb-8">
        <a href="{{ $link }}" class="inline-flex items-center px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">
            <svg class="mr-2 -ml-1 w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M23.498 6.186a3.017 3.017 0 00-2.122-2.13C19.692 3.556 12 3.556 12 3.556s-7.692 0-9.376.5a3.017 3.017 0 00-2.122 2.13C.004 8.369 0 12 0 12s.004 3.631.502 5.814a3.017 3.017 0 002.122 2.13c1.684.5 9.376.5 9.376.5s7.692 0 9.376-.5a3.017 3.017 0 002.122-2.13C23.996 15.631 24 12 24 12s-.004-3.631-.502-5.814zM9.545 15.568V8.432L16.818 12l-7.273 3.568z"/>
            </svg>
            Se connecter à YouTube
        </a>
    </div>
    <!-- Tableau -->
    <div class="w-full">
        <table class="min-w-full table-auto">
            <thead class="justify-between">
            <tr class="bg-gray-800">
                <th class="px-16 py-2">
                    <span class="text-gray-300">Nom de la chaîne</span>
                </th>
                <th class="px-16 py-2">
                    <span class="text-gray-300">Dernière mise à jour</span>
                </th>
                <th class="px-16 py-2">
                    <span class="text-gray-300">Actions</span>
                </th>
            </tr>
            </thead>
            <tbody class="bg-gray-200">
            @foreach($channels as $k => $channel)
            <tr class="bg-white border-4 border-gray-200 text-center">
                <td class="px-16 py-2 flex align-center">
                    {{ $channel->channel_name }}
                </td>
                <td class="px-16 py-2">
                    {{ $channel->updated_at }}
                </td>
                <td class="px-16 py-2 flex justify-center gap-4">
                    <button onclick="alert('Liste des vidéos uploadées')" class="text-green-500 hover:text-green-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 10l4.553-2.276A1 1 0 0111 8.618v6.764a1 1 0 01-1.447.894L5 14m0 0v-4a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H6a1 1 0 01-1-1z" />
                        </svg>
                    </button>
                    <button onclick="alert('Modifier?')" class="text-blue-500 hover:text-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                    </button>
                    <button onclick="if(confirm('Supprimer?')) { alert('Supprimé!'); }" class="text-red-500 hover:text-red-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </td>
            </tr>
            @endforeach
            <!-- Ajoutez plus de lignes ici -->
            </tbody>
        </table>
    </div>
@endsection

@section('javascript')

@endsection
