@extends('youtubeupload.template.tailwindcss')

@section('title', "Edition de la Chaîne")

@section('content')
    <div class="w-full">
        <div class="container mx-auto pt-10">
            <h1 class="text-center text-2xl font-bold mb-6">Édition de la chaîne Youtube</h1>
            <form class="max-w-lg mx-auto bg-white p-8 shadow-md" action="{{ route('youtubeupload.update', $channel) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label for="channel_name" class="block text-gray-700 text-sm font-bold mb-2">Nom de la chaîne</label>
                    <input type="text" id="channel_name" name="channel_name" placeholder="Entrez le nom de votre chaîne"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           value="{{ $channel->channel_name }}" required
                    >
                </div>
                <div class="mb-4">
                    <span class="block text-gray-700 text-sm font-bold mb-2">Mettre en favoris?</span>
                    <label class="inline-flex items-center space-x-2">
                        <input type="radio" name="is_favorite" value="yes" class="text-green-500 focus:ring-green-500" {{ ($channel->is_favorite == "yes") ? 'checked' : '' }}>
                        <span>Oui</span>
                    </label>
                    <label class="inline-flex items-center space-x-2 ml-4">
                        <input type="radio" name="is_favorite" value="no" class="text-red-500 focus:ring-red-500" {{ ($channel->is_favorite == "no") ? 'checked' : '' }}>
                        <span>Non</span>
                    </label>
                </div>
                <div class="flex justify-center">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
