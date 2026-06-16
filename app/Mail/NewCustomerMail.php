<?php

namespace App\Mail;

use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewCustomerMail extends Mailable
{
    use Queueable, SerializesModels;

    public Customer $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function build()
    {
        return $this->subject('UNTUNGTERUS')
            ->view('emails.new_customer');
    }
}