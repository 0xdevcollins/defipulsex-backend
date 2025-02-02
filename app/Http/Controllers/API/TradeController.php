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

        $tradeData = $trades->map(function ($trade) {
            $progress = 0;

            switch ($trade->state) {
                case 'completed':
                    $progress = 100;
                    break;

                case 'active':
                    if ($trade->start_date && $trade->end_date) {
                        $startDate = Carbon::parse($trade->start_date);
                        $endDate = Carbon::parse($trade->end_date);
                        $totalDuration = $endDate->diffInSeconds($startDate);
                        $elapsedDuration = Carbon::now()->diffInSeconds($startDate);

                        $progress = min(100, ($elapsedDuration / $totalDuration) * 100);
                    }
                    break;

                case 'pending':
                    $progress = 0;
                    break;

                case 'failed':
                    $progress = 0;
                    break;

                default:
                    $progress = 0;
                    break;
            }

            $progress = round($progress, 2);

            return [
                'planName' => $trade->plan ? $trade->plan->name : '',
                'amount' => $trade->amount,
                'returnPercent' =>  $trade->plan ? $trade->plan->percent_return : '',
                'progress' => $progress,
                'status' => $trade->state,
                'date' => $trade->created_at->toDateString(),
            ];
        });

        return $this->sendResponse($tradeData, 'Trades retrieved successfully');
    }
    public function active()
    {
        $user = Auth::user();

        if (!$user) {
            return $this->sendError('User not found');
        }

        // Fetch only active trades
        $trades = $user->trades->where('state', 'active');

        // Reset keys to get sequential array
        $tradeData = $trades->values()->map(function ($trade) {
            $progress = 0;

            if ($trade->start_date && $trade->end_date) {
                $startDate = Carbon::parse($trade->start_date);
                $endDate = Carbon::parse($trade->end_date);
                $totalDuration = $endDate->diffInSeconds($startDate);
                $elapsedDuration = Carbon::now()->diffInSeconds($startDate);

                $progress = min(100, ($elapsedDuration / $totalDuration) * 100);
            }

            $progress = round($progress, 2);

            return [
                'planName' => $trade->plan ? $trade->plan->name : '',
                'amount' => number_format($trade->amount, 2, '.', ''),
                'returnPercent' => $trade->plan ? $trade->plan->percent_return : 0,
                'progress' => $progress,
                'status' => $trade->state,
                'date' => $trade->created_at->toDateString(),
            ];
        });

        return $this->sendResponse($tradeData, 'Active trades retrieved successfully');
    }
}
