<form wire:submit.prevent="delete">
    {{-- wire:submit.prevent="deleteSelected" --}}
    <x-modal.confirmation wire:model.defer="showDeleteModal">
        <x-slot name="title">Delete Event</x-slot>

        <x-slot name="content">
            <div class="py-8 text-cool-gray-700">Are you sure you want to delete the event? This action is irreversible.</div>
        </x-slot>

        <x-slot name="footer">
            <x-button.secondary wire:click="$set('showDeleteModal', false)">Cancel</x-button.secondary>

            <x-button.primary type="submit">Delete</x-button.primary>
        </x-slot>
    </x-modal.confirmation>
</form>