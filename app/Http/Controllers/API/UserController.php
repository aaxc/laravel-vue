<?php

namespace App\Http\Controllers\API;

use App\Collections\UserCollection;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Mappers\UserMapper;
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
        $users          = UserDAO::all();
        $UserCollection = new UserCollection();
        foreach ($users as $user) {
            $UserCollection->add(UserMapper::mapFromDb($user));
        }

        return $UserCollection;
    }

    /**
     * Create new user
     *
     * @param \App\Http\Requests\StoreUserRequest $request
     *
     * @return \App\Models\User
     */
    public function add(StoreUserRequest $request): User
    {
        $newUser             = new UserDAO();
        $newUser->name       = $request->input('name')['value'];
        $newUser->email      = $request->input('email')['value'];
        $newUser->created_at = $request->input('created_at')['value'];
        $newUser->updated_at = $request->input('updated_at')['value'];
        $newUser->password   = Hash::make($request->input('password')['value']);
        $newUser->save();

        return UserMapper::mapFromDb($newUser);
    }

    /**
     * Retrieve blank user
     *
     * @return \App\Models\User
     */
    public function blank()
    {
        $newUser = new User();

        return $newUser->blank();
    }
}
