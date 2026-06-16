<?php

namespace App\Services;

use App\Models\CustomerSequence;
use Illuminate\Support\Facades\DB;

class CustomerIdService
{
    public function generate(): string
    {
        return DB::transaction(function () {
            $today = now()->toDateString();

            $sequence = CustomerSequence::where('seq_date', $today)
                ->lockForUpdate()
                ->first();

            if (!$sequence) {
                $sequence = CustomerSequence::create([
                    'seq_date' => $today,
                    'last_number' => 0,
                ]);

                $sequence = CustomerSequence::where('seq_date', $today)
                    ->lockForUpdate()
                    ->first();
            }

            $sequence->increment('last_number');
            $sequence->refresh();

            return now()->format('dmY') . str_pad($sequence->last_number, 3, '0', STR_PAD_LEFT);
        });
    }
}