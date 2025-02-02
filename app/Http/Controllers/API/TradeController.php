<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TradeController extends BaseController
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return $this->sendError('User not found');
        }

        $trades = $user->trades;

        $tradesData = $trades->map(function ($trade) {
            $progress = 0;
            $returnPercent = 0;

            if ($trade->state == 'completed') {
                $progress = 100;
                $returnPercent = 100;
            } elseif ($trade->state == 'active' && $trade->start_date && $trade->end_date) {
                $startDate = Carbon::parse($trade->start_date);
                $endDate = Carbon::parse($trade->end_date);
                $totalDuration = $endDate->diffInSeconds($startDate);
                $elapsedDuration = Carbon::now()->diffInSeconds($startDate);

                $progress = min(100, ($elapsedDuration / $totalDuration) * 100);

                $returnPercent = $progress;
            }
            return [
                'planName' => $trade->plan ? $trade->plan->name : '',
                'amount' => $trade->amount,
                'returnPercent' => $returnPercent,
                'progress' => $progress,
                'date' => $trade->created_at->toDateString(),
            ];
        });

        return $this->sendResponse($tradesData, 'Trades retrieved successfully');
    }
}
