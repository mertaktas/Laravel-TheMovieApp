<div class="relative mt-3 md:mt-0" x-data="{ isOpen: true }" @click.away="isOpen = false">
    <input 
        wire:model.debounce.1ms="search" 
        @focus="isOpen = true"
        @keydown="isOpen = true"
        @keydown.escape.window="isOpen = false"
        @keydown.shift.tab="isOpen = false"
        type="text" class="bg-gray-800 text-small rounded-full w-64 px-4 pl-8 py-1 focus:outline-none focus-shadow-none" 
        placeholder="Search">
    <div class="absolute top-0">
        <svg class="fill-current w-4 text-gray-500 mt-2 ml-2" viewBox="0 0 24 24"><path class="heroicon-ui" d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z"/></svg>
    </div>
    <div wire:loading class="spinner top-0 right-0 mr-4 mt-4"></div>
    <div 
        class="z-50 absolute bg-gray-800 rounded text-sm w-64 mt-4" 
        x-show.transition.opacity="isOpen"
    >
        @if(strLen($search) > 2)
            <ul>
                    @if($searchResults->count() > 0)
                        @foreach ($searchResults as $search)
                                <li class="border-b border-gray-700">
                                    <a 
                                        @if($loop->last) @keydown.tab="isOpen = false" @endif
                                        href="{{ route('movies.show', $search['id']) }}" class="block hover:bg-gray-700 px-3 py-3 flex items-center">
                                    @if($search['poster_path'])
                                        <img class="w-8" src="https://image.tmdb.org/t/p/w92/{{ $search['poster_path'] }}" alt="poster">
                                    @else
                                    <img src="https://via.placeholder.com/50x75" alt="poster" class="w-8">
                                    @endif 
                                        <span class="ml-4">{{ $search['title'] }}</span>
                                    </a>
                                </li>
                        @endforeach  
            </ul>
                    @else
                    <div class="px-3 py-3">No result for {{ $search }} </div>
                    @endif
        @endif
    </div>
</div>