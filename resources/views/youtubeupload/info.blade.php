@extends('youtubeupload.template.tailwindcss')

@section('title', "Tableau des chaînes - " . $channel->channel_name . " - Liste des vidéos")

@section('content')
    <div class="bg-gray-800 text-white">
        <div class="container mx-auto px-4 py-5">
            <div class="flex items-center justify-between space-x-4">
                <a href="https://youtube.com/{{ $channeldetails->items[0]['snippet']['customUrl'] }}" target="_blank" class="flex items-center space-x-4">
                    <img src="{{ $channeldetails->items[0]['snippet']['thumbnails']['high']['url'] }}" alt="logo" class="w-20 h-20 rounded-full hover:opacity-80 transition-opacity duration-300">
                    <div>
                        <h1 class="text-2xl font-bold">{{ $channeldetails->items[0]['snippet']['title'] }}</h1>
                        <p class="text-gray-400">{{ $channeldetails->items[0]['snippet']['description'] }}</p>
                    </div>
                </a>
                <div class="text-right">
                    <span class="block text-xl font-semibold">{{ $channeldetails->items[0]['statistics']['viewCount'] }} vues</span>
                    <span class="text-gray-400">Total des vues</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')

@endsection
