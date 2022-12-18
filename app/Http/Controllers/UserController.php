<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileSecurityUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\RegisterRequest;
use App\ViewModel\User\UserViewModel;
use App\Models\Profile;
use App\Models\User;
use App\Models\UserProgress;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

    protected $UserService;
    public function __construct(UserServiceInterface $userService)
    {
        $this->UserService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $users =  UserViewModel::getMultipleUsersViewModel(User::whereHas('profile')->get());
        return view('lms.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('lms.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RegisterRequest $request)
    {
        $inputFields = $request->validated();
        $this->UserService->registerNewUser($inputFields);
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Application|Factory|View|\Illuminate\Http\RedirectResponse
     */
    public function show(User $user)
    {
        if($user->isAdmin){
            return redirect()->back();
        }
        $user = UserViewModel::getSingleUserViewModel($user, true);
        return view('lms.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Application|Factory|View|\Illuminate\Http\RedirectResponse
     */
    public function edit(User $user)
    {
        $user = UserViewModel::getSingleUserViewModel($user);
        return view('lms.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @return void
     */
    public function update(Request $request, User $user)
    {
    }


    public function bulkUpload(Request $request)
    {
        if($request->hasFile('file')){
            $fillables = (new User)->getFillable();
            $header = [];
            $full_data = [];

            $errors = [];
            foreach(file($request->file) as $key => $line) {
                $data = explode(',', str_replace("\n","",$line));
                foreach ($data as $key2 => $column){
                    $column = Str::lower($column);
                    if($key == 0){
                        $header[] = $column;
                    }else{
                        $header_col = $header[$key2];
                        if($header_col == 'password'){
                            $column = bcrypt($column);
                        }
                        if (User::where('username', $column)->orWhere('email', $column)->exists()){
                            $errors[] = "<li> $header[$key2]: $column already exists in system </li>";
                            if(isset($full_data[$key-1])){
                                unset($full_data[$key-1]);
                            }
                        }else{
                            $full_data[$key-1][$header[$key2]] = $column;
                        }
                    }
                }

                if (count(array_diff($header, $fillables)) != 0){
                    $errors[] = "<li>Please provide these columns " . implode(",", $fillables) . "</li>";
                    break;
                }
            }

            if (count($errors) == 0){
                foreach ($full_data as $dd){
                    $usrObj = User::create($dd);
                    Profile::create(['user_id' => $usrObj->id]);
                }
                $this->createFlashMessage("User Uploaded Successfully", 'success');
                return redirect()->route('user.index');
            }else{
                $message = "<br><ul class='pt-1'>" . implode('', $errors) ."</ul>";
                $this->createFlashMessage("Error While Uploading Users. " . $message ,'danger');
                return redirect()->route('user.index');
            }
        }

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return string
     */
    public function destroy(User $user)
    {
        $user->delete();
        return route('user.index');
    }
}
