<?php

namespace App\Http\Livewire;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Products;
class ProdutosCadastroLivewire extends Component{
    public $name;
    public $descricao;
    public $preco;
    public $imagem;

    use WithFileUploads;

    public function save(){

        if(!$this->name){
            session()->flash('message_erro', 'Nome é obrigatório');
            return;
        }

        if(!$this->preco){
            session()->flash('message_erro', 'Preço é obrigatório');
            return;
        }

        if(!$this->descricao){
            $this->descricao = 'sem descrição';
        }

        if($this->imagem){
            $originalName   = $this->imagem->getClientOriginalName();
            $extension      = $this->imagem->getClientOriginalExtension();
            $newFilename    = pathinfo($originalName, PATHINFO_FILENAME) . '_' . time() . '.' . $extension;
            $directory      = 'imagens/produtos';
        }else{
            $newFilename    = '';
        }


        $produtos = Products::create([
            'user_id'       => Auth()->id(),
            'name'          => $this->name,
            'descricao'     => $this->descricao,
            'imagem'        => $newFilename,
            'preco'         => $this->preco
        ]);

        if($produtos && $this->imagem){
            $this->imagem->storeAs($directory, $newFilename, 'public');
        }

        if($produtos){
            session()->flash('message', 'Produto cadastrado com sucesso!');
        }else{
            session()->flash('message_erro', 'Produto não cadastrado');
        }
    }
    public function render(){
        return view('livewire.auth.produtos-cadastro-page');
    }
}
