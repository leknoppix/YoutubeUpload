@extends('youtubeupload.template.tailwindcss')

@section('title', "Page erreur")

@section('content')
    <div class="min-h-screen bg-gray-100 flex items-center justify-center">
        <div class="p-5 bg-white shadow-md rounded-lg">
            <h2 class="text-lg font-semibold text-red-500">Erreur!</h2>
            <p class="text-sm text-gray-700 mt-2">{{ $message }}</p>
        </div>
    </div>
@endsection

@section('javascript')

@endsection
