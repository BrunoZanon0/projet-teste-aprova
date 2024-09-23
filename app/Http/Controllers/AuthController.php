<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{

    public function cadastro(Request $request){

        ########################### VALIDANDO ##########################

        if(!$request->nome){
            return response()->json(['msg' => 'Envio do Nome é obrigatório!', 'status' => 422]);
        }

        if(!$request->sobrenome){
            return response()->json(['msg' => 'Envio do sobrenome é obrigatório!', 'status' => 422]);
        }

        if(!$request->senha || strlen($request->senha) < 8){
            return response()->json(['msg' => 'Senha não enviada ou muito curta!', 'status' => 422]);
        }

        $validator = Validator::make($request->all(), [
            'email'     => 'required|email|unique:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json(['msg' => $validator->errors() , 'status' => 422]);
        }
        #########################// VALIDANDO ##########################

        $save = User::create([
            'name'      => $request->nome,
            'sobrenome' => $request->sobrenome,
            'email'     => $request->email,
            'password'  => bcrypt($request->senha),
        ]);

        if(!$save){
            return response()->json(['msg'=> 'Usuario não cadastrado ERRO01'],401);
        }else{
            return response()->json(['msg'=> 'Usuario cadastrado com sucesso'],201);
        }

    }
    public function login(Request $request){

        ########################### VALIDANDO ##########################

        if(!$request->email){
            return response()->json(['msg' => 'Envio do email é obrigatório!', 'status' => 422]);
        }

        if(!$request->password){
            return response()->json(['msg' => 'Envio da senha é obrigatório!', 'status' => 422]);
        }

        $validator = Validator::make($request->all(), [
            'email'     => 'email',
        ]);

        if ($validator->fails()) {
            return response()->json(['msg' => $validator->errors() , 'status' => 422]);
        }

        #########################// VALIDANDO ##########################

        ######################### AUTENTICANDO #########################

        $credenciais = $request->all(['email','password']);

        $token = auth('api')->attempt($credenciais);

        ######################### AUTENTICANDO #########################

        if($token){
            return response()->json(['dscr' => ['msg' => 'Usuario autenticado com sucesso!','token'=>$token]] , 200);
        }else{
            return response()->json(['dscr'=>'Credenciais inválidas'],401);
        }

    }
    public function me(){
        return response()->json([auth()->user()] ,200);
    }
}
