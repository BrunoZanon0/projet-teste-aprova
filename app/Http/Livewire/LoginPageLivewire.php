<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LoginPageLivewire extends Component
{
    public $email;
    public $password;

    public function enviar(){
        $credentials = [
            'email'     => $this->email,
            'password'  => $this->password
        ];

        foreach($credentials as $dados => $key){
            if(!$dados){
                session()->flash('message_erro', $key .' não enviado!');
                return;
            }
        }

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/home');
        } else {
            session()->flash('message_erro', 'Email ou senha inválida!');
        }

    }
    public function render()
    {
        return view('livewire.login-page');
    }
}
