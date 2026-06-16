<?php

namespace App\Console\Commands;

use App\Jobs\SendLoyalCustomerEmailJob;
use App\Jobs\SendNewCustomerEmailJob;
use App\Models\Customer;
use Illuminate\Console\Command;

class SendCustomerPromoCommand extends Command
{
    protected $signature =
        'customer:send-promo';

    protected $description =
        'Send promo email to customer';

    public function handle()
    {
        $customers = Customer::all();

        foreach ($customers as $customer) {

            if (
                $customer->status ==
                'NEW CUSTOMER'
            ) {

                SendNewCustomerEmailJob
                    ::dispatch($customer);
            }

            if (
                $customer->status ==
                'LOYAL CUSTOMER'
            ) {

                SendLoyalCustomerEmailJob
                    ::dispatch($customer);
            }
        }

        $this->info(
            'Promo email queued'
        );

        return Command::SUCCESS;
    }
}