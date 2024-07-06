<?php

namespace Tests\Feature\Livewire\Cours;

use App\Livewire\Cours\Exercice;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ExerciceTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Exercice::class)
            ->assertStatus(200);
    }
}
