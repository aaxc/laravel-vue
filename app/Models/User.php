<?php

namespace App\Models;

use App\Models\Types\VueDate;
use App\Models\Types\VueEmail;
use App\Models\Types\VueFullName;
use App\Models\Types\VueId;
use App\Models\Types\VuePassword;
use App\Models\Types\VueType;
use Illuminate\Support\Carbon;
use JetBrains\PhpStorm\ArrayShape;

/**
 * User model
 *
 * @author Dainis Abols <dainis@dainisabols.lv>
 */
class User implements \JsonSerializable
{
    protected VueId $id;
    protected VueFullName $name;
    protected VueEmail $email;
    protected VueDate $created_at;
    protected VueDate $updated_at;
    protected VuePassword $password;

    /**
     * Creates blank user for editing
     *
     * @return $this
     */
    public static function blank(): User
    {
        $newUser = new User();
        $newUser->id         = (new VueId(null))->setToEdit(false);
        $newUser->name       = (new VueFullName(null))->setToEdit(true);
        $newUser->email      = (new VueEmail(null))->setToEdit(true);
        $newUser->created_at = (new VueDate(new Carbon()))->setToEdit(true);
        $newUser->updated_at = (new VueDate(new Carbon()))->setToEdit(false);
        $newUser->password   = (new VuePassword(null))->setToEdit(true);

        return $newUser;
    }

    /**
     * @return \App\Models\Types\VueId
     */
    public function getId(): VueId
    {
        return $this->id;
    }

    /**
     * @param \App\Models\Types\VueId $id
     */
    public function setId(VueId $id): void
    {
        $this->id = $id;
    }

    /**
     * @return \App\Models\Types\VueFullName
     */
    public function getName(): VueFullName
    {
        return $this->name;
    }

    /**
     * @param \App\Models\Types\VueFullName $name
     */
    public function setName(VueFullName $name): void
    {
        $this->name = $name;
    }

    /**
     * @return \App\Models\Types\VueEmail
     */
    public function getEmail(): VueEmail
    {
        return $this->email;
    }

    /**
     * @param \App\Models\Types\VueEmail $email
     */
    public function setEmail(VueEmail $email): void
    {
        $this->email = $email;
    }

    /**
     * @return \App\Models\Types\VueDate
     */
    public function getCreatedAt(): VueDate
    {
        return $this->created_at;
    }

    /**
     * @param \App\Models\Types\VueDate $created_at
     */
    public function setCreatedAt(VueDate $created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return \App\Models\Types\VueDate
     */
    public function getUpdatedAt(): VueDate
    {
        return $this->updated_at;
    }

    /**
     * @param \App\Models\Types\VueDate $updated_at
     */
    public function setUpdatedAt(VueDate $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return \App\Models\Types\VuePassword
     */
    public function getPassword(): VuePassword
    {
        return $this->password;
    }

    /**
     * @param \App\Models\Types\VuePassword $password
     */
    public function setPassword(VuePassword $password): void
    {
        $this->password = $password;
    }

    #[ArrayShape(['id' => "\App\Models\Types\VueId", 'name' => "\App\Models\Types\VueFullName", 'email' => "\App\Models\Types\VueEmail", 'created_at' => "\App\Models\Types\VueDate", 'updated_at' => "\App\Models\Types\VueDate", 'password' => "\App\Models\Types\VuePassword"])]
    public function jsonSerialize(): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'email'      => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'password'   => $this->password,
        ];
    }
}
