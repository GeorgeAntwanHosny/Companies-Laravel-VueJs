<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserAuthResource extends JsonResource
{
    protected $accessToken;

    public function accessToken($value){
        $this->accessToken = $value;
        return $this;
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'user' => [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'access_token'=>$this->accessToken,
            ],

        ];
    }

}
