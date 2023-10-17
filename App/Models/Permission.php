<?php

namespace App\Models; 

class Permission extends Model
{
    protected $table = 'permissions'; 

    public $id;
    public $name;
    public $description;
    public $created_at;
    public $updated_at; 

    public function save()
    {
        $this->attributes = [
            'id' => $this->id,  
            'name' => $this->name,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
        

        parent::save();
    }  

    public function permissions(){
        RolePermision::query()->where('role_id', $this->id)->get();
    }
}
