<?php

namespace App\Http\Mappers;

use App\Models\Database\UserDAO;
use App\Models\Types\VueDate;
use App\Models\Types\VueEmail;
use App\Models\Types\VueFullName;
use App\Models\Types\VueId;
use App\Models\User;

class UserMapper
{
    public static function mapFromDb(UserDAO $user): User
    {
        $myUser = new User();
        $myUser->setId(new VueId((int)$user->id));
        $myUser->setName(new VueFullName((string)$user->name));
        $myUser->setEmail(new VueEmail((string)$user->email));
        $myUser->setCreatedAt(new VueDate($user->created_at));
        $myUser->setUpdatedAt(new VueDate($user->updated_at));

        return $myUser;
    }
}
