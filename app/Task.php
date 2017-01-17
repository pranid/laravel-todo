<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function getTasksByUser($user_id)
    {
        return $this->where('user_id',$user_id)->get();
    }
}
