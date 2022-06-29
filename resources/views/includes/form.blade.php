<form wire:submit.prevent="save" x-data="{}" x-ref="header">
    <x-modal.dialog wire:model.defer="showEditModal">
        <x-slot name="title">{{ isset($editing->id)? 'Edit' : 'Create' }} Event</x-slot>

        <x-slot name="content">
            <x-input.group for="title" label="Title" :error="$errors->first('editing.title')">
                <x-input.text wire:model="editing.title" id="title" placeholder="Title" />
            </x-input.group>

            <x-input.group for="description" label="Description" :error="$errors->first('editing.description')">
                <x-input.textarea wire:model="editing.description" id="description" placeholder="Description" />
            </x-input.group>

            <x-input.group for="start_date" label="Start Date" :error="$errors->first('editing.start_date_edit')">
                <x-input.date wire:model="editing.start_date_edit" id="start_date" placeholder="Starting Date" />
            </x-input.group>

            <x-input.group for="end_date" label="End Date" :error="$errors->first('editing.end_date_edit')">
                <x-input.date wire:model="editing.end_date_edit" id="end_date" placeholder="Ending Date" />
            </x-input.group>
        </x-slot>

        <x-slot name="footer">
            <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>

            <x-button.primary type="submit">{{ isset($editing->id)? 'Edit' : 'Create' }}</x-button.primary>
        </x-slot>
    </x-modal.dialog>
</form>