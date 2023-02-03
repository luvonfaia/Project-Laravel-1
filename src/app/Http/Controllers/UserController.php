<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function logout(){           // redirect cand da click pe logout si il duce pe homepage
        auth()->logout();
        return redirect('/homepage')->with('success', 'Ai iesit din contul tau!');
    }

    public function showCorrectHomepage() {     //metoda pentru pagina corecta de homepage
        if(auth()->check()){
            return view('homepage-feed');
        }{
            return view('homepage');
        }
    }

    public function register(Request $request) { //metoda creata pentru validarea form care include reguli la register
        $incomingFields = $request->validate([
            'username' => ['required', 'min:3', 'max:20', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'confirmed']
        ]);
        $incomingFields['password'] = bcrypt($incomingFields['password']); //pentru hashing-ul parolelor stocate in baza de date

        $user = User::create($incomingFields); /* aici se creaza o linie noua de utilizator in baza de date si returneaza un utilizator dar nicaieri
 de aceea am folosit o variabila cu numele user pentru a salva utilizatorul nou in ea */
        auth()->login($user); // functie globala auth si va trimite cookie session ca browserul utilizatorului sa fie authentificat automat dupa inregistrare
        return redirect('/')->with('success','Te-ai inregistrat cu success'); //return cu mesaj de inregistrare corecta
    }

    public function login(Request $request){  //metoda pentru login din header la homepage
        $incomingFields = $request->validate([
            'loginusername' => 'required',
            'loginpassword' => 'required'//se preia din html la input name
        ]);

        if  ((auth()->attempt([
            'username' => $incomingFields['loginusername'],
            'password' => $incomingFields['loginpassword']

        ]))){
            $request->session()->regenerate(); //ne ajuta sa vedem daca utilizatorul este logat (cookie)
            return redirect('/')->with('success', 'Te-ai autentificat cu succes!');   //dupa login se duce pe showCorrectHomepage (homepage-feed.blade.php)
        }

        return redirect('/')->with('failure', 'Autentificare esuata! Datele introduse nu sunt corecte.');

    }


    }
