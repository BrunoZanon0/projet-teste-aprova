<?php

namespace App\Action;

use Exception;
use Illuminate\Http\Request;
use App\Models\Products;

class DeletarProdutoAction {
    public function __invoke(Request $request, $id) {

        try {
            if(!$request->id){
                throw new Exception('ID Não identificado!');
            }

            $id_produto = $request->id;

            $deletando = Products::where('id',$id_produto)->delete();

            if($deletando){
                session()->flash('message', 'Produto deletado com sucesso');
            }else{
                throw new Exception('O produto já foi deletado, ou não foi identificado');
            }
        } catch (Exception $e) {
            session()->flash('message_erro', $e->getMessage());
        }finally{
            return redirect()->route('produtos');
        }

    }
}
