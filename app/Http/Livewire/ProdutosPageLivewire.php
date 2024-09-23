<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Products;

class ProdutosPageLivewire extends Component{
        public $produtos;

    public function mount(){
        $produtos = Products::where('user_id',Auth()->id())->get();

        $this->produtos = $produtos == true ? $produtos : '';
    }

    public function render(){
        return view('livewire.auth.produtos-page');
    }
}
