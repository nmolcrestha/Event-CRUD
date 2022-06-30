<?php

namespace Database\Factories;

use App\Models\Events;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventsFactory extends Factory
{
    protected $model = Events::class;
    
    public function definition()
    {
        $day = rand(1, 7);
        if($day>2){
            $date = Carbon::now()->subDay(rand(1, 10));
        }else{
            $date = Carbon::now()->addDay(rand(1, 10));
        }
        return [
            'title' => $this->faker->name(),
            'description' => $this->faker->text,
            'start_date' => $date,
            'end_date' =>  date('Y-m-d', strtotime($date. ' + '.$day.' days')), // password
        ];
    }
}
