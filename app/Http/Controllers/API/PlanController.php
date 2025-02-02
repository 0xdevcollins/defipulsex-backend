<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends BaseController
{
    public function index()
    {
        $plans = Plan::get();
        return $this->sendResponse($plans, 'Plans Retrieveed Successfully');
    }
}
