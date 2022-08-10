<?php

namespace App\Mappers;

use App\Models\DAO\UserDAO;
use App\Models\Types\VueDate;
use App\Models\Types\VueEmail;
use App\Models\Types\VueFullName;
use App\Models\Types\VueId;
use App\Models\Types\VuePassword;
use App\Models\User;

/**
 * User mapper
 *
 * @author Dainis Abols <dainis@dainisabols.lv>
 */
class UserMapper
{
    public static function mapFromDAO(UserDAO $user): User
    {
        $myUser = new User();
        $myUser->setId(new VueId((int)$user->id));
        $myUser->setName(new VueFullName((string)$user->name));
        $myUser->setEmail(new VueEmail((string)$user->email));
        $myUser->setCreatedAt(new VueDate($user->created_at));
        $myUser->setUpdatedAt(new VueDate($user->updated_at));
        $myUser->setPassword(new VuePassword(null));

        return $myUser;
    }
}
