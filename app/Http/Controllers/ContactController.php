<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\Contact;
use App\Mail\RogerTeste;
use App\Mail\sendmail;
use App\Mail\Address;
use App\Models\User;

class ContactController extends Controller
{
    public function index(){
        return view('telas.contact');
    }

    public function store(Request $request){

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ];
    
        $messages = [
            'required' => 'O campo :attribute é obrigatório.',
            'max' => 'O campo :attribute não deve ter mais de :max caracteres.',
            'email' => 'O campo :attribute deve ser um endereço de e-mail válido.',
        ];
    
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); 
        }
    
        $name = $request->input('name');
        $email = $request->input('email');
        $cellphone = $request->input('cellphone');
        $subject = $request->input('subject');
        $message = $request->input('message');

        $data = [
            'name' => $name,
            'email' => $email,
            'cellphone'=> $cellphone,
            'subject'=> $subject,
            'message' => $message,
        ];
        
        $userAdmin = User::where('admin', true)->first();
        //dd($userAdmin->email);
        if (!empty($userAdmin->email)) {
            //Mail::to($data['email'])->send(new RogerTeste());
            Mail::to($userAdmin['email'])->send(new sendmail($data));
        } else {                
           return 'Não exite admin';
        }
        return 'Mensagem enviada com sucesso!';


    }
}
