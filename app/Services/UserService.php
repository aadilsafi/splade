<?php


namespace App\Services;


use App\Models\Profile;
use App\Models\User;
use App\Services\Interfaces\ImageServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Utils\FilePaths;
use Illuminate\Support\Facades\Schema;

class UserService implements UserServiceInterface
{

    protected $ImageService;
    public function __construct(ImageServiceInterface $imageService)
    {
        $this->ImageService = $imageService;
    }

    public function createUser($user_data)
    {
        $user           = null;
        $user_columns   = (new User)->getFillable();
        $new_user_data  = [];
        foreach ($user_columns as $column){
            if(isset($user_data[$column])){
                if($column == "password"){
                    $user_data[$column] = bcrypt($user_data[$column]);
                }
                $new_user_data[$column] = $user_data[$column];
            }
        }

        if($new_user_data){
            $user = User::create($user_data);
        }
        return $user;
    }

    public function createProfile($profile_data)
    {
        $profile           = null;
        $profile_columns   = (new Profile())->getFillable();
        $new_profile_data  = [];
        foreach ($profile_columns as $column){
            if(isset($profile_data[$column])){
                if($column == "avatar"){
                    $image                  = $profile_data[$column];
                    $image_name             = time() . "_avatar." . $image->getClientOriginalExtension();
                    $path                   = FilePaths::PROFILES_DIRECTORY;
                    $profile_data[$column]  = $this->ImageService->saveImage($image, $image_name, $path);
                }
                $new_profile_data[$column] = $profile_data[$column];
            }
        }

        if($new_profile_data){
            $profile = Profile::create($profile_data);
        }
        return $profile;
    }

    public function registerNewUser($data)
    {
        $user = $this->createUser($data);
        if($user){
            $data['user_id'] = $user->id;
            $profile = $this->createProfile($data);
        }
        return $user;
    }
}
