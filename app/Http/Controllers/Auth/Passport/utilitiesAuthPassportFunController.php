<?php

namespace App\Http\Controllers\Auth\Passport;

use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\UserAuthResource;
use App\Models\User;
use Illuminate\Http\Request;

class utilitiesAuthPassportFunController extends Controller
{
    static public function revokeAllTokensForUser(User $user): \Illuminate\Http\JsonResponse
    {

        $activeTokens = $user->tokens();

        foreach ($activeTokens as $token) {
            $token->revoke();
        }
        return response()->json(['message' => 'all token revoked successfully']);

    }
    static public function deleteCurrentToken(User $user): \Illuminate\Http\JsonResponse
    {

        $user->token()->delete();
        return response()->json(['message'=>'You are successfully logout!']);
    }
    static public function getAllTokenForUser(User $user): \Illuminate\Http\JsonResponse
    {
        $accessToken = $user->tokens()->get();;

        return response()->json(['tokens' => $accessToken->toArray()]);
    }

    static public function getOnlyRevokedTokenForUser(User $user): \Illuminate\Http\JsonResponse
    {

        $revokeTokens = $user->tokens()->where('revoked', 1)->get();
        return response()->json(['tokens' => $revokeTokens->toArray()]);

    }

    static public function getOnlyActiveTokenForUser(User $user): \Illuminate\Http\JsonResponse
    {
        $activeTokens = $user->tokens()->where('revoked', 0)->get();
        return response()->json(['tokens' => $activeTokens->toArray()]);

    }


    static public function createTokenForUser(User $user, $clientName, array $scope = [])
    {

        $accessToken = $user->createToken($clientName, $scope)->accessToken;

//        return response()->json(['token' => $accessToken],200);
        $resource= (new UserAuthResource($user))->accessToken($accessToken);
//        $resource->additional([
//            'accessToken' => $accessToken->accessToken,
//        ]);
        return $resource;
    }

    static public function checkAbilityForTokenByUser(User $user, $abilityName): \Illuminate\Http\JsonResponse
    {


        $accessToken = $user->tokens()->first();

        return response()->json(['can' => $accessToken->can($abilityName) ? 'yes' : 'No']);


    }


}
