<?php

namespace App\Livewire;

use Livewire\Component;

class HelloWorld extends Component
{
    public string $name = 'David';

    public function render()
    {
        return view('livewire.hello-world');
    }
}