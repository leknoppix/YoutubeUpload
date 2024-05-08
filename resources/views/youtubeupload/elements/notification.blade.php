@if (session('status') === 'delete-youtube-channel-success')
    <div
        x-data="{ show: true }"
        x-show="show"
        x-transition:enter="transform ease-out duration-300 transition"
        x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        x-init="setTimeout(() => show = false, 2000)"
        class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md mb-4"
    >
        <div class="flex">
            <div class="py-1">
                <svg class="h-6 w-6 text-green-500 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <div>
                <p class="text-sm">{{ __('La chaîne Youtube a été supprimée avec succes.') }}</p>
            </div>
        </div>
    </div>
@endif
@if (session('status') === 'create-youtube-channel-success')
    <div
        x-data="{ show: true }"
        x-show="show"
        x-transition:enter="transform ease-out duration-300 transition"
        x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        x-init="setTimeout(() => show = false, 2000)"
        class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md mb-4"
    >
        <div class="flex">
            <div class="py-1">
                <svg class="h-6 w-6 text-green-500 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <div>
                <p class="text-sm">{{ __('La chaîne Youtube a été ajoutée avec succes.') }}</p>
            </div>
        </div>
    </div>
@endif
