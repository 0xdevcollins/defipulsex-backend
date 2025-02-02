<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends BaseController
{
    public function index(Request $request)
    {
        $userId = $request->get('user_id');

        $user = User::find($userId) ?? Auth::user();

        if (!$user) {
            return $this->sendError('User not found');
        }

        $transactions = $user->transactions;

        return $this->sendResponse($transactions, 'Transactions retrieved successfully');
    }
}
