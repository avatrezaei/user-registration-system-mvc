<?php

namespace App\Models; 

class RolePermision extends Model
{
    protected $table = 'role_permission';   

    public $role_id;
    public $permission_id; 

    public function save()
    {
        $this->attributes = [
            'role_id' => $this->role_id,
            'permission_id' => $this->permission_id
        ];        

        parent::save();
    } 

    public function permission(){
        return Permission::query()->find($this->permission_id);
    }
}
