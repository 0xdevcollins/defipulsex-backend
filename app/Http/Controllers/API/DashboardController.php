<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Get the user balance (ensure balance exists as an attribute or method)
        $balance = $user->balance; // Ensure balance is an attribute of the User model

        // Fetch the 5 most recent active trades
        $active_trades = $user->trades()
        ->where('state', 'active')
        ->latest()
        ->take(5)
        ->get()
        ->map(function ($trade) {
            // Calculate progress
            $progress = 0;

            if ($trade->start_date && $trade->end_date) {
                $startDate = Carbon::parse($trade->start_date);
                $endDate = Carbon::parse($trade->end_date);
                $totalDuration = $endDate->diffInSeconds($startDate);
                $elapsedDuration = Carbon::now()->diffInSeconds($startDate);

                $progress = min(100, ($elapsedDuration / $totalDuration) * 100);
            }

            $trade->progress = round($progress, 2); // Store the progress in the trade
            $trade->plan_name = $trade->plan->name;  // Add plan name to the trade data

            return $trade;
        });
        // Get the 6 most recent transactions
        $recent_transactions = $user->transactions()->latest()->take(6)->get();

        // Calculate pending deposits and withdrawals
        $pending_deposit = $user->transactions()
            ->where('type', 'deposit')
            ->where('status', 'pending')
            ->sum('amount');

        $pending_withdrawal = $user->transactions()
            ->where('type', 'withdrawal')
            ->where('status', 'pending')
            ->sum('amount');

        // Calculate earnings from completed trades
        $earnings = $user->trades()
            ->where('state', 'completed')
            ->get()
            ->sum(function ($trade) {
                return $trade->calculateProfit(); // Assuming calculateProfit() is defined in the Trade model
            });

        // Assuming active plans are defined in your system, you need to fetch them
        // $active_plans = $user->plans()->where('status', 'active')->get();

        // Return the data in the response
        return response()->json([
            'earnings' => $earnings,
            'balance' => $balance,
            'recent_transactions' => $recent_transactions,
            'active_trades' => $active_trades,
            // 'active_plans' => $active_plans,
            'pending_deposit' => $pending_deposit,
            'pending_withdrawal' => $pending_withdrawal,
        ]);
    }
}
