<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    private $events;

    public function __construct(Events $events){
        $this->events = $events;
    }
    
    public function index(){
        // $events = $this->events->all()->where('status', 'running')->all();
        //dd($events);
        return view('welcome');
    }
}
