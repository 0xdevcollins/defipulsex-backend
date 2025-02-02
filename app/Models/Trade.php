<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }


    public function calculateProfit()
    {
        $plan = $this->plan;

        if ($plan->fixed_amount !== null) {
            return $plan->fixed_amount;
        }

        if ($plan->percent_return !== null) {
            return ($this->amount * $plan->percent_return) / 100;
        }

        return 0;
    }
}
