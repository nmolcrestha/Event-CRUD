<?php

namespace App\Http\Livewire;

use App\Models\Events;
use Livewire\Component;
use Livewire\WithPagination;

class EventIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'asc';

    public $showEditModal = false;
    public $showDeleteModal = false;

    public Events $editing;

    public function rules(){
        return [
            'editing.title' => 'required',
            'editing.description' => 'required',
            'editing.start_date_edit' => 'required',
            'editing.end_date_edit' => 'required',
        ];
    }
    
    public function mount()
    {
        $this->editing = $this->makeBlankEvent();
    }

    public function makeBlankEvent(){
        return Events::make(['start_date'=>now(), 'end_date'=> now()]);
    }

    protected $queryString = ['sortField', 'sortDirection'];

    public function create(){
        if($this->editing->getKey()){
            $this->editing = $this->makeBlankEvent();
        }
        $this->showEditModal = true;
    }

    public function edit(Events $event){
        $this->editing = $event;
        $this->showEditModal = true;
    }

    public function eventDelete(Events $event){
        $this->editing = $event;
        $this->showDeleteModal = true;
    }

    public function sortBy($field){
        if($this->sortField == $field){
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        }else{
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function save(){
        $this->validate();
        $this->editing->save();

        $this->showEditModal = false;

        $this->dispatchBrowserEvent('notify', 'Event Saved!');
        // if(isset($this->editing->id)){
        //     dd('EDIT');
        // }else{
        //     dd('Create');
        // }
    }

    public function delete(){
        $this->editing->delete();

        $this->showDeleteModal = false;

        $this->dispatchBrowserEvent('notify', 'Event Deleted!');
    }

    public function render()
    {
        return view('livewire.event-index', [
            'events' => Events::search('title', $this->search)
                        ->orderBy($this->sortField, $this->sortDirection)
                        ->paginate(5),
        ]);
    }
}
