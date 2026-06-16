<?php

namespace App\Http\Controllers;

use App\Models\Customer;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCustomer = Customer::count();

        $newCustomer = Customer::where('status', 'NEW CUSTOMER')->count();

        $loyalCustomer = Customer::where('status', 'LOYAL CUSTOMER')->count();

        return view('dashboard.index', compact(
            'totalCustomer',
            'newCustomer',
            'loyalCustomer'
        ));
    }
}