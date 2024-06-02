@extends('youtubeupload.template.tailwindcss')

@section('title', "Tableau des chaînes")

@section('content')
    @include('youtubeupload.elements.notification')
    @include('youtubeupload.auth.connexion')
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
            @foreach($channels as $channel)
                <tr class="bg-white border-4 border-gray-200 text-center">
                    <td class="px-16 py-2 flex align-center">
                        @if($channel->is_favorite == "yes")
                            @include('youtubeupload.elements.favorite')
                        @endif
                        {{ $channel->channel_name }}
                    </td>
                    <td class="px-16 py-2">
                        {{ $channel->updated_at }}
                    </td>
                    <td class="px-16 py-2 flex justify-center gap-4">
                        @if($channel->get_video_list == "no")
                            <a href="{{ route('youtubeupload.getvideoonyoutube', $channel) }}" class="text-blue-500 hover:text-blue-700">
                                @include('youtubeupload.elements.info')
                            </a>
                        @endif
                        <a href="{{ route('youtubeupload.info', $channel) }}" class="text-blue-500 hover:text-blue-700" title="Récupérer les informations de la chaine">
                            @include('youtubeupload.elements.info')
                        </a>
                        <a href="{{ route('youtubeupload.edit', $channel) }}" class="text-blue-500 hover:text-blue-700" title="Modifier les informations de la chaine">
                            @include('youtubeupload.elements.edit')
                        </a>
                        <form id="deleteForm_{{ $channel['id'] }}"
                              action="{{ route('youtubeupload.destroy', $channel) }}" method="post">
                            @csrf
                            @method('delete')
                            <button onclick="return confirmUrlDelete({{ $channel['id'] }})"
                                    title="Supprimer cette chaine de la liste"
                                    class="text-red-500 hover:text-red-700">
                                @include('youtubeupload.elements.delete')
                            </button>
                        </form>
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
