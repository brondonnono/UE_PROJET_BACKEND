<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */
    protected function sendResetResponse(Request $request) {
        $input = $request->only("email","token","password","password_confirmation");
        
        $validator = Validator::make($input, [
            "token" => 'required',
            "email" => 'required|email',
            "password" => 'required|confirmed|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => "Tous les champs sont obligatoires; l'email doit être bien formatée et le mot de passe doit avoir au moins 8 caractères", 
                "error"=> $validator->errors()->all()
            ], 422);
        }

        $response = Password::reset($input, function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->save();

            event( new PasswordReset($user));
        });

        if ($response == Password::PASSWORD_RESET) {
            $message = "Votre mot de passe a été réinitialisé avec succès";
        } else {
            $message = "Echec de l\'envoi du mail, nous ne pouvons envoyer de mail à cette adresse";
        }

        $response = ["message" => $message];
        return response()->json($reponse, 200);

    }


    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
}
