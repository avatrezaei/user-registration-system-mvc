<?php

namespace App\Models; 

class UserRole extends Model
{
    protected $table = 'user_role'; 
    protected $primaryKey = ['user_id', 'role_id'];  

    protected $fillable = ['user_id', 'role_id'];

    public $role_id;
    public $user_id; 

    

    public function save()
    {
        $this->attributes = [
            'role_id' => $this->role_id,
            'user_id' => $this->user_id
        ];        

        parent::save();
    } 

    public function role(){
        return Role::query()->find($this->role_id);
    }
}
