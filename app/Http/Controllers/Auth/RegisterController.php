<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\WelcomeCustomerMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'digits_between:10,11'],
            'profile' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     */
    protected function create(array $data)
    {
        // Handle profile image upload
        $profilePath = null;
        if (isset($data['profile'])) {
            $fileName = time() . '.' . $data['profile']->extension();
            $data['profile']->move(public_path('images/profiles/'), $fileName);
            $profilePath = "/images/profiles/" . $fileName;
        }

        // Create the user
        $user = User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'profile' => $profilePath,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'User',
        ]);

        // Send welcome email
        Mail::to($user->email)->send(new WelcomeCustomerMail($user));

        return $user;
    }
}