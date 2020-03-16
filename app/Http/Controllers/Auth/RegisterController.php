<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
    protected $redirectTo = '/login';

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
            'username' => ['required', 'string', 'max:255'],
            'password' => 'required|string|min:5|required_with:password_confirmation|same:password_confirmation',
            'privilege' => ['required', 'string', 'max:255'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {   
        try {
            return User::create([
                'nama' => $data['nama'],
                'jurusan' => $data['jurusan'],
                'username' => $data['username'],
                'password' => Hash::make($data['password']),
                'privilege' => $data['privilege'],
                'isValidate' => 0,
            ]);
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function register(Request $request)
    {
        try{
            $this->validator($request->all())->validate();

            $data = User::where('username', $request->username)->first();

            if(empty($data)){
                event(new Registered($user = $this->create($request->all())));
                return $this->registered($request, $user)
                    ?: redirect()->back()->with(
                    'message-success',
                    'Selamat, registrasi telah berhasil! Silahkan tunggu untuk akun anda divalidasi oleh admin.');
            } else {
                Log::error("data yang diregistrasikan dengan username {$request->username} telah ada di sistem");
                throw new \Exception("Username {$request->username} telah terdaftar!."); 
            }
            event(new Registered($user = $this->create($request->all())));

        } catch(\Exception $e){
            return redirect()->back()->with(
                'message-error',
                'Terjadi kesalahan! Pesan: '.$e->getMessage());
        }
    }
}
