<?php

namespace App\Traits;

/**
 * Import Models
 */
use App\User;

trait GetTotalUserTrait {

    public function getData($article) {
        return 'Successfully get data';
    }

    public function getAllUsers(){
        $users = User::all();
        return response()->json(['users' => $users]);
    }
}