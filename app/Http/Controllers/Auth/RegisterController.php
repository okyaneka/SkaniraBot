<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'nis' => ['required', 'string', 'min:4'],
            // 'password' => ['required', 'string', 'min:6', 'confirmed'],
            'privacy' => ['required']
        ]);
    }


    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        
        if ($user == FALSE) {
            return back()->withStatus('Maaf, NIS dan Nama lengkap yang anda masukkan tidak terdaftar sebagai alumni SMK N Pringsurat');
        }

        if ($user->temp_password == '') {
            return back()->withStatus('Maaf, NIS dan Nama lengkap yang anda masukkan telah terdaftar sebagai alumni SMK N Pringsurat, silahkan masuk menggunakan halaman <a href="'.route('login').'">Login</a>');
        }

        $this->guard()->login($user);

        return $this->registered($request, $user) ?: redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::where([
            ['name', '=', $data['name']],
            ['nis', '=', $data['nis']]
        ]);

        if ($user->count() == 1) {
            return $user->get()->first();
        } else {
            return FALSE;
        }

        // return User::create([
        //     'name' => trim(ucwords($data['name'])),
        //     'nis' => trim($data['nis']),
        //     'email' => trim($data['email']),
        //     'password' => Hash::make($data['password']),
        //     'type' => User::DEFAULT_TYPE,
        // ]);
    }
}
