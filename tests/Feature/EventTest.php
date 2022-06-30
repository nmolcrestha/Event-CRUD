<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Livewire\Livewire;

class EventTest extends TestCase
{
    
    /** @test */
    function page_contains_livewire_component()
    {
        $this->get('/')
            ->assertSuccessful()
            ->assertSeeLivewire('event-index');
    }

}
