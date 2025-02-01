<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WalletController extends BaseController
{
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'address' => 'required',
            'seed_phrase' => 'required',
            'private_key' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $wallet = Wallet::create($input);
        return $this->sendResponse($wallet, 'Wallet created successfully.');
    }

    public function listWallets () {
            $wallets = Wallet::where('user_id', Auth::id())->get();
        return $this->sendResponse($wallets, 'Wallets listed successfully.');
    }
}
