<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Products;
use Illuminate\Http\Request;
use Exception;

class ProdutosEdicaoLivewire extends Component
{
    public $produtos;

    public function mount(Request $request)
    {
        try {
            if (!$request->id) {
                throw new Exception('Seu produto pode ter sido deletado!');
            }

            $produto = Products::find($request->id);

            if (!$produto) {
                throw new Exception('Seu produto pode ter sido deletado!');
            }

            $this->produtos = $produto;

        } catch (Exception $e) {
            session()->flash('message_erro', $e->getMessage());
            return redirect()->route('produtos');
        }
    }

    public function render()
    {
        return view('livewire.auth.produtos-editar-page');
    }
}

