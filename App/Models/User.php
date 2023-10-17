<?php

namespace App\Models;

use \PDO;

class User extends Model
{
    protected $table = 'users';

    const ROLE_USER = 1;
    const ROLE_ADMIN = 2;

    public $id;
    public $username;
    public $email;
    public $password;
    public $role_id;
    public $subscription_date;
    public $avatar_path;

    public function save()
    {
        $this->attributes = [
            'id' => $this->id,  
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'role_id' => $this->role_id,
            'subscription_date' => $this->subscription_date,
            'avatar_path' => $this->avatar_path
        ];
        

        parent::save();
    }

    public function isAdmin()
    {
        return UserRole::query()->where('user_id', $this->id)->first()->role()->name == 'admin';
    }

    public function setAvatar($file)
    {
        $uploadDir = 'public/uploads/avatars/';
        $filename = uniqid() . '-' . $file['name'];
        move_uploaded_file($file['tmp_name'], $uploadDir . $filename);
        $this->avatar_path = $uploadDir . $filename;
    }

    public function role(){
        return Role::query()->find($this->role_id);
    }

    public function subscription()
    {
        return Subscription::query()->where('user_id', $this->id)->first();
    }
}
