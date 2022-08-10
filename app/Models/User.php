<?php

namespace App\Models;

use App\Models\Types\VueDate;
use App\Models\Types\VueEmail;
use App\Models\Types\VueFullName;
use App\Models\Types\VueId;
use App\Models\Types\VuePassword;
use App\Models\Types\VueType;
use Illuminate\Support\Carbon;

class User implements \JsonSerializable
{
    protected VueId $id;
    protected VueFullName $name;
    protected VueEmail $email;
    protected VueDate $created_at;
    protected VueDate $updated_at;
    protected VuePassword $password;

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'password' => $this->password,
        ];
    }

    /**
     * Creates blank user for editing
     *
     * @return $this
     */
    public function blank(): User
    {
        $this->id = (new VueId(null))->setToEdit(false);
        $this->name = (new VueFullName(null))->setToEdit(true);
        $this->email = (new VueEmail(null))->setToEdit(true);
        $this->created_at = (new VueDate(new Carbon()))->setToEdit(true);
        $this->updated_at = (new VueDate(new Carbon()))->setToEdit(false);
        $this->password = (new VuePassword(null))->setToEdit(true);

        return $this;
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
}
