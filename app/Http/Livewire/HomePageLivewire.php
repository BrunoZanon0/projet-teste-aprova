<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HomePageLivewire extends Component{

    public $auth;

    public function render()
    {
        return view('livewire.auth.home-page');
    }
}
