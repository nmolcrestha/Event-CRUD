<div class="py-4 space-y-4">
    <x-notification/>
    <div class="flex justify-between">
        <div class=" w-1/4 flex space-x-4">
            <x-input.text class="sm:rounded-lg p-2" wire:model="search" placeholder="Search with Title"/>

            <x-button.link wire:click="$toggle('showFilters')">@if($showFilters)Hide @endif Filter</x-button.link>
        </div>
        <div>
            <x-button.primary wire:click="create">+ Create</x-button.primary>
        </div>

    </div>
    <div>
        @if($showFilters)
            @include('includes.filter')
        @endif
    </div>
    <div class="flex-col space-y-4">
        <x-table>
            <x-slot name="head">
                <x-table.heading sortable wire:click="sortBy('title')" :direction="$sortField=='title' ? $sortDirection : null">Title</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('description')" :direction="$sortField=='description' ? $sortDirection : null">Description</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('start_date')" :direction="$sortField=='start_date' ? $sortDirection : null">Start Date</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('end_date')" :direction="$sortField=='end_date' ? $sortDirection : null">End Date</x-table.heading>
                <x-table.heading >Status</x-table.heading>
                <x-table.heading >Actions</x-table.heading>
            </x-slot>
            <x-slot name="body">
                @forelse ($events as $e)
                    <x-table.row wire:loading.class.delay="opacity-50">
                        <x-table.cell>
                            <p class="text-cool-gray-600 truncate">
                                {{ $e->title }}
                            </p>
                        </x-table.cell>
                        <x-table.cell>
                            {{ $e->description }}
                        </x-table.cell>
                        <x-table.cell>
                            {{ date('M,d,Y', strtotime($e->start_date)) }}
                        </x-table.cell>
                        <x-table.cell>
                            {{ date('M,d,Y', strtotime($e->end_date)) }}
                        </x-table.cell>
                        <x-table.cell class="text-center">
                            {{-- <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-{{ $e->status_color }}-100 text-{{ $e->status_color }}-800 capitalize"> --}}
                                <span class="inline-flex items-center text-sm px-3 bg-{{ $e->status_color }}-200 text-{{ $e->status_color }}-800 rounded-full px-2.5 py-0.5 capitalize font-medium">
                                {{ $e->status }}
                            </span>
                        </x-table.cell>
                        <x-table.cell class="text-center">
                            <x-button.link wire:click="edit({{ $e->id }})" class="text-white bg-blue-600 hover:bg-blue-500 active:bg-blue-700 border-indigo-600 p-1 rounded text-center mb-1">Edit</x-button.link>
                            <x-button.link wire:click="eventDelete({{ $e->id }})" class="text-white bg-red-600 hover:bg-red-500 active:bg-red-700 border-indigo-600 p-1 rounded text-center">Delete</x-button.link>
                        </x-table.cell>
                    </x-table.row>   
                @empty
                <x-table.row>
                    <x-table.cell colspan="6">
                        <div class="flex justify-center items-center space-x-2">
                            <span class="font-medium py-8 text-slate-500 text-xl">No Events found...</span>
                        </div>
                    </x-table.cell>
                </x-table.row>
                @endforelse
            </x-slot>
        
        </x-table>
        <div>
            @if ($events instanceof \Illuminate\Pagination\LengthAwarePaginator)
            {{ $events->links() }}
            @endif
        </div>
    </div>
    {{-- Form     --}}
    @include('includes.form')
    @include('includes.delete')
</div>