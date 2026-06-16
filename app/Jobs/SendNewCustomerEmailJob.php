<?php

namespace App\Jobs;

use App\Mail\NewCustomerMail;
use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewCustomerEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function handle(): void
    {
        Mail::to($this->customer->email)->send(
            new NewCustomerMail($this->customer)
        );
    }
}