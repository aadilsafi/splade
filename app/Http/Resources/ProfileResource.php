<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function __construct($resource)
    {
        parent::__construct($resource);
        $user = auth()->user();
       
    }
    public function toArray($request)
    {
        $user_data = [
            "id"                    => $this->id,
            "username"              => $this->username,
            "email"                 => $this->email,
            "roles"                  => RoleResource::collection($this->roles),
            "last_active_at"        => Carbon::parse($this->last_active_at)->format("M d, Y g:i a"),
            "profile"               => $this->getProfile($this->profile),
           
        ];

        if($this->token){
            $user_data["token"] = $this->token;
        }

       
        return $user_data;
    }
    private function getProfile($profile){
        $profileData = [];

        if($profile){
            $avatar                     = $profile->avatar ? asset('storage/'.$profile->avatar) : "https://ui-avatars.com/api/?rounded=true&bold=true&format=svg&name=" . $this->name;
            $profileData = [
                "id"                        =>  $profile->id,
                "first_name"                =>  $profile->first_name,
                "last_name"                 =>  $profile->last_name ?? 'N/A',
                "middle_name"               =>  $profile->middle_name ?? 'N/A',
                "date_of_birth"             =>  $profile->date_of_birth,
                "avatar"                    =>  $avatar,
                "bio"                       =>  $profile->bio ?? "No Bio",
                "contact_email"             =>  $profile->contact_email ?? 'N/A',
           
            ];

        }
        return $profileData;
    }
}
