<?php

namespace App\Models;

use \PDO;

class Subscription extends Model
{
    protected $table = 'subscriptions';

    public $id;
    public $user_id;
    public $status; // e.g., 'active', 'expired', 'canceled', etc.
    public $start_date;
    public $expiry_date;
    public $type; // e.g., 'monthly', 'yearly', etc.

    protected $fillable = ['id', 'user_id', 'status', 'start_date', 'expiry_date', 'type'];

    public function save()
    {
        $this->attributes = [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'start_date' => $this->start_date,
            'expiry_date' => $this->expiry_date,
            'type' => $this->type
        ];

        parent::save();
    }

    public function isActive()
    {
        return $this->status === 'active' && $this->expiry_date > date("Y-m-d H:i:s");
    }

    public function findByUserId($user_id)
    {
        return $this->query()->where('user_id', $user_id)->first();
    }
}

