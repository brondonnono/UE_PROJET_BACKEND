<?php

namespace App\Http\Controllers\AuthApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class AuthController extends Controller
{
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'=> 'required|max:191',
            'email'=> 'required|email|max:191|unique:users,email',
            'password' => 'required|min:6'
        ]);

        if($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors()
            ]);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'type' => $request->type,
                'password' =>Hash::make($request->password)
            ]);

            $token = $user->createToken($user->email.'_Token')->plainTextToken;
            return response()->json([
                'status' => '200',
                'username' => $user->name,
                'token' => $token,
                'type' => $user->type,
                'message' => 'Inscription réussie'
            ]);
        }
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email'=> 'required|max:191',
            'password' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors()
            ]);
        } else {
            $user = User::where('email', $request->email)->first();
 
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => '401',
                    'message' => 'Email ou mot de passe incorrect'
                ]);
            } else {
                $token = $user->createToken($user->email.'_Token')->plainTextToken;
                return response()->json([
                    'status' => '200',
                    'username' => $user->name,
                    'token' => $token,
                    'type' => $user->type,
                    'id' => $user->id,
                    'email' => $user->email,
                    'message' => 'Connexion réussie'
                ]);
            }
        }
    }

    public function logout() {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => '200',
            'message' => 'Déconnexion réussie'
        ]);
    }

}
