<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Workload extends Model
{
    protected $fillable = [
        'name', 'work_instruction_title', 'description', 'status', 'file', 'uploaded_date',
    ];

    public function user_info(){
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
