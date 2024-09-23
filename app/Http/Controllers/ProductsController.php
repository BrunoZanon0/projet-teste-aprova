<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Products;
use App\Jobs\SendProductNotification;

class ProductsController extends Controller
{

    public $preco;
    public $descricao;
    public $nome;
    public $imagem;

    public function cadastro(Request $request){
        $imagemPath = '';

        ########################### VALIDANDO ##########################

        if(!$request->nome){
            return response()->json(['msg' => 'Envio do Nome é obrigatório!', 'status' => 422]);
        }

        if (!$request->preco) {
            return response()->json(['msg' => 'Preço é obrigatório!', 'status' => 422]);
        }

        if (!is_numeric($request->preco) || $request->preco < 0) {
            return response()->json(['msg' => 'Preço deve ser um número positivo!', 'status' => 422]);
        }

        if ($request->hasFile('imagem')) {
            $request->validate([
                'imagem' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $imagemPath = $request->imagem->store('imagens/produtos', 'public');
        }

        $this->nome         = $request->nome;
        $this->preco        = $request->preco;
        $this->descricao    = isset($request->descricao) ? $request->descricao : '' ;
        $this->imagem       = isset($request->imagem) ? $imagemPath : '' ;

        #########################// VALIDANDO ##########################

        $produtos = Products::create([
            'user_id'       => auth()->id(),
            'name'          => $this->nome,
            'descricao'     => $this->descricao,
            'imagem'        => $this->imagem,
            'preco'         => $this->preco
        ]);

        if($produtos){
            SendProductNotification::dispatch($produtos);
            return response()->json(['msg' => 'Produto cadastrato com sucesso!', 'status' => 201]);
        }else{
            return response()->json(['msg' => 'Produto nao cadastrado, entrar em contato com o suporte!', 'status' => 422]);
        }

    }

    public function list(){
        $user = auth()->id();

        $produtos = Products::where('user_id',$user)->get();

        if($produtos){
            return response()->json(['msg' => 'Produtos encontrados!','descr' => $produtos, 'status' => 200]);
        }else{
            return response()->json(['msg' => 'Você ainda não cadastrou um produto','status' => 200]);
        }
    }

    public function editar(Request $request){

        $imagemPath = '';

        if(!$request->id){
            return response()->json(['msg' => 'Não enviado o id do produto', 'status' => 422]);
        }

        if(!$request->nome){
            return response()->json(['msg' => 'Envio do Nome é obrigatório!', 'status' => 422]);
        }

        if (!$request->preco) {
            return response()->json(['msg' => 'Preço é obrigatório!', 'status' => 422]);
        }

        if (!is_numeric($request->preco) || $request->preco < 0) {
            return response()->json(['msg' => 'Preço deve ser um número positivo!', 'status' => 422]);
        }

        $id = $request->id;

        $products = Products::find($id);

        if($products['user_id'] != auth()->id()){

            return response()->json(['msg' => 'Sem permissão para editar esse produto!', 'status' => 403]);
        }



        if ($request->hasFile('imagem')) {
            $request->validate([
                'imagem' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $imagemPath = $request->imagem->store('imagens/produtos', 'public');
        }

        $this->nome         = $request->nome;
        $this->preco        = $request->preco;
        $this->descricao    = isset($request->descricao) ? $request->descricao : $products['descricao'] ;
        $this->imagem       = isset($request->imagem) ? $imagemPath : $products['imagem'] ;


        if ($products) {
            $products->update([
                'name'      => $this->nome,
                'descricao' => $this->descricao,
                'imagem'    => $this->imagem,
                'preco'     => $this->preco,
            ]);
            SendProductNotification::dispatch($products);

            return response()->json(['msg' => 'Produto Atualizado com sucesso', 'status' => 200]);
        } else {
            return response()->json(['msg' => 'Produto não encontrado!', 'status' => 422]);
        }
    }
}
