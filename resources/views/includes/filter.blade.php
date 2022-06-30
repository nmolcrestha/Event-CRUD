<div class="bg-gray-100 p-4 rounded shadow-inner flex relative">
    <div class="w-1/2 pr-2 space-y-4">
        <x-input.group inline for="filter-status" label="Status">
            <x-input.select wire:model.lazy="filters.status" id="filter-status">
                <option value="" disabled>Select Status...</option>
                <option value="running">Running</option>
                <option value="upcoming">Upcoming</option>
                <option value="ended">Ended</option>
            </x-input.select>
        </x-input.group>

        <x-input.group inline for="filter-week-events" label="Events Within 7 Days">
            <x-input.select wire:model.lazy="filters.week_events" id="filter-week-events">
                <option value="" disabled>Select Option...</option>
                <option value="upcoming">Upcoming</option>
                <option value="ended">Ended</option>
            </x-input.select>
        </x-input.group>
    </div>

    <div class="w-1/2 pl-2 space-y-4">
        <x-input.group inline for="filter-starting" label="Starting Date">
            <x-input.date wire:model.lazy="filters.starting" id="filter-starting" placeholder="MM/DD/YYYY" />
        </x-input.group>

        <x-input.group inline for="filter-ending" label="Maximum Date">
            <x-input.date wire:model.lazy="filters.ending" id="filter-ending" placeholder="MM/DD/YYYY" />
        </x-input.group>

        <x-button.link wire:click="resetFilters" class="absolute right-0 bottom-0 p-4">Reset Filters</x-button.link>
    </div>
</div>