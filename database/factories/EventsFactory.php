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
        
        return [
            'title' => $this->faker->name(),
            'description' => $this->faker->text,
            'start_date' => Carbon::now()->subDays(rand(1, 365))->startOfDay(),
            'end_date' => Carbon::now()->subDays(rand(1, 365))->startOfDay(), // password
        ];
    }
}
