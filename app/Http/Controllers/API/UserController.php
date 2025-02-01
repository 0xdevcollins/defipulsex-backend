<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{
    public function show()
    {
        $user = User::where('id', Auth::id())->get();
        return $this->sendResponse($user, 'User Data retrieved successfully.');
    }
}
