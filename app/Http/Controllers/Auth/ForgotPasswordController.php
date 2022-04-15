<?php

namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Password;
// use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Http\Request;
// use Illuminate\Auth\Events\PasswordReset;
// use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\Rules\Password as RulesPassword;

class ForgotPasswordController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    // protected function sendResetLinkResponse(Request $request) {
    //     $input = $request->only('email');

    //     $validator = Validator::make($input, [
    //         'email' => "required|email"
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             "message" => "Votre addresse mail est requise et doit être bien formatée", 
    //             "error"=> $validator->errors()->all()
    //         ], 422);
    //     }

    //     $response = Password::sendResetLink($input);

    //     if ($response == Password::RESET_LINK_SENT) {
    //         $message = "Le mail de réinitialisation de votre mot de passe a été envoyé avec succès à l\'addresse email que vous avez saisit";
    //     } else {
    //         $message = "Echec de l\'envoi du mail, une erreur inconnue s\'est produite, veuillez saisir une adresse email valide ou vérifer votre connexion à internet";
    //     }

    //     $response = ["message" => $message];
    //     return response()->json($response, 200);
    // }


    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return [
                'status' => __($status)
            ];
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
}
