<?php

namespace App\Http\Controllers\Auth\Passport;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthUserController extends Controller
{

    /**
     * @throws ValidationException
     */
    public function registerUser(UserRegisterRequest $request): \App\Http\Resources\Auth\UserAuthResource
    {
        $attributes = $request->validated();

        $user = User::create($attributes);
        $clientName = 'PersonalAccessToken';
        $scope = ['read'];
        return utilitiesAuthPassportFunController::createTokenForUser($user, $clientName, $scope);

    }

    /**
     * login user to our application
     */
    public function loginUser(UserLoginRequest $request): \App\Http\Resources\Auth\UserAuthResource|\Illuminate\Http\JsonResponse
    {  $attribute = $request->validated();

        if (Auth::attempt($attribute)) {
            //generate the token for the user
            $user =Auth::user();
            $clientName = 'PersonalAccessToken';
            $scope = ['read'];
            return utilitiesAuthPassportFunController::createTokenForUser( $user, $clientName, $scope);

        } else {
            //wrong login credentials, return, user not authorised to our system, return error code 401
            return response()->json(['error' => 'UnAuthorised Access'], 401);
        }
    }

    /**
     * This method returns authenticated user details
     */
    public function authenticatedUserDetails(): \Illuminate\Http\JsonResponse
    {
        //returns details
        return response()->json(['authenticated-user' => auth()->user()], 200);
    }

    public function logout(Request $request): \Illuminate\Http\JsonResponse
    {

         $user = $request->user();
        return utilitiesAuthPassportFunController::deleteCurrentToken($user);
    }
}
