<?php

namespace App\Http\Controllers\API;

use App\Http\Collections\UserCollection;
use App\Http\Controllers\Controller;
use App\Http\Mappers\UserMapper;
use App\Http\Requests\StoreUserRequest;
use App\Models\Database\UserDAO;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Show all users
     *
     * @return \Illuminate\Support\Collection
     */
    public function index(): Collection
    {
        $users = UserDAO::all();
        $UserCollection = new UserCollection();
        foreach ($users as $user) {
            $UserCollection->add(UserMapper::mapFromDb($user));
        }

        return $UserCollection;
    }

    /**
     * Create new user
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Models\Database\UserDAO
     */
    public function add(StoreUserRequest $request): UserDAO
    {
        $newUser = new UserDAO();
        $newUser->name = $request->input('name');
        $newUser->email = $request->input('email');
        $newUser->password =  Hash::make($request->input('password'));
        $newUser->save();

        return $newUser;
    }

    public function blank()
    {
        $newUser = new User();
        return $newUser->blank();
    }
}
