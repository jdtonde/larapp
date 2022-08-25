<?php

namespace App\Http\Controllers;

use auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use function PHPUnit\Framework\returnSelf;

class UserController extends Controller
{
    //Show register / create User form

    public function create(){
        return view('users.register');
    }

    // Create new User
    public function store(Request $request){

            $formFields= $request->validate([
                'name'=>['required','min:3'],
                'email'=>['required','email', Rule::unique('users','email')],
                'password' => 'required|confirmed|min:6'
            ]);
                //hash Password
            $formFields['password']= bcrypt($formFields['password']);
                
                //create user

            $user= User::create($formFields);


                //and login
            auth()->login($user);

        return redirect('/')->with('message','Utilisateur crée et connecté');
     }


     //Logout user

     public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message','Deconnecté');
     }

     //show login form

     public function login(){
        return view('users.login');
     }

     // auth user

     public function authenticate(Request $request){
        $formFields= $request->validate([
            'email'=>['required','email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)){
            $request->session()->regenerate();

            return redirect('/')->with('message','vous etes à nouveau connecté');
        }

        return back()->withErrors(['email'=>'incorrect'])->onlyInput('email');

     }


     public function manage(){
        return view('listings.manage');
     }

}
