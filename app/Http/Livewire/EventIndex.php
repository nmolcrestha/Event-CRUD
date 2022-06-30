<?php

namespace App\Http\Livewire;

use Illuminate\Support\Carbon;
use App\Models\Events;
use Livewire\Component;
use Livewire\WithPagination;

class EventIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'start_date';
    public $sortDirection = 'asc';

    public $showEditModal = false;
    public $showDeleteModal = false;
    public $showFilters = false;

    public $filters = [
        'status' => '',
        'week_events' => '',
        'starting' => null,
        'ending' => null,
    ];
    
    public function resetFilters() { 
        $this->reset('filters'); 
    }

    public Events $editing;

    public function rules(){
        return [
            'editing.title' => 'required',
            'editing.description' => 'required',
            'editing.start_date_edit' => 'required|date',
            'editing.end_date_edit' => 'required|date|after_or_equal:start_date',
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
            'events' => Events::query()
                        ->when($this->filters['status']=='running', function ($query){
                            $query->whereDate('start_date', '<=' ,date('Y-m-d'))
                                ->whereDate('end_date', '>=' ,date('Y-m-d'));
                        })
                        ->when($this->filters['status']=='upcoming', function ($query){

                            $query->whereDate('start_date', '>' ,date('Y-m-d'))
                                ->whereDate('end_date', '>' ,date('Y-m-d'));
                        })
                        ->when($this->filters['status']=='ended', function ($query){
                            $query->whereDate('start_date', '<' ,date('Y-m-d'))
                                ->whereDate('end_date', '<' ,date('Y-m-d'));
                        })
                        ->when($this->filters['starting'], function($query,$data){
                            $query->whereDate('start_date', '>=', Carbon::parse($data) );
                        })
                        ->when($this->filters['ending'], function($query,$data){
                            $query->whereDate('end_date', '<=', Carbon::parse($data) );
                        })
                        ->when($this->filters['week_events']=='upcoming', function ($query){
                            $today =  date('Y-m-d');
                            $after7 = date('Y-m-d', strtotime($today. ' + 7 days'));
                            $query->where('start_date', '>=', Carbon::parse($today))
                                    ->where('start_date', '<=', Carbon::parse($after7));
                        })
                        ->when($this->filters['week_events']=='ended', function ($query){
                            $today =  date('Y-m-d');
                            $before7 = date('Y-m-d', strtotime($today. ' - 7 days'));
                            $query->where('end_date', '>=', Carbon::parse($before7))
                                    ->where('end_date', '<=', Carbon::parse($today));
                        })
                        ->search('title', $this->search)
                        ->orderBy($this->sortField, $this->sortDirection)
                        ->paginate(10)
                        
        ]);
    }
}
