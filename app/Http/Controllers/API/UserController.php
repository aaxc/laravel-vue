<?php

namespace App\Http\Controllers\API;

use App\Collections\UserCollection;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Mappers\UserMapper;
use App\Models\DAO\UserDAO;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use JetBrains\PhpStorm\ArrayShape;

/**
 * User controller
 *
 * @author Dainis Abols <dainis@dainisabols.lv>
 */
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
            $UserCollection->add(UserMapper::mapFromDAO($user));
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

        return UserMapper::mapFromDAO($newUser);
    }

    /**
     * Update user
     *
     * @param \App\Http\Requests\UpdateUserRequest $request
     * @param int                                  $id
     *
     * @return \App\Models\User
     */
    public function update(UpdateUserRequest $request, int $user_id): User
    {
        $newUser = UserDAO::find($user_id);

        if (!empty($request->input('name')['value'])) {
            $newUser->name = $request->input('name')['value'];
        }

        if (!empty($request->input('email')['value'])) {
            $newUser->email = $request->input('email')['value'];
        }

        if (!empty($request->input('created_at')['value'])) {
            $newUser->created_at = $request->input('created_at')['value'];
        }

        $newUser->updated_at = $request->input('updated_at')['value'];
        $newUser->save();

        return UserMapper::mapFromDAO($newUser);
    }

    /**
     * Retrieve blank user
     *
     * @return \App\Models\User
     */
    public function blank(): User
    {
        return User::blank();
    }

    /**
     * @param int $id
     *
     * @return bool[]
     */
    #[ArrayShape(['success' => "bool"])]
    public function destroy(int $user_id): array
    {
        UserDAO::destroy($user_id);

        return ['success' => true];
    }
}
