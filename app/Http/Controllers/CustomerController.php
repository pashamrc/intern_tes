<?php

namespace App\Http\Controllers;

use App\Jobs\SendLoyalCustomerEmailJob;
use App\Jobs\SendNewCustomerEmailJob;
use App\Models\Customer;
use App\Services\CustomerIdService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    protected $customerIdService;

    public function __construct(CustomerIdService $customerIdService)
    {
        $this->customerIdService = $customerIdService;
    }

    public function index()
    {
        return view('customers.index');
    }

    public function data()
    {
        return DataTables::of(Customer::query())
            ->addIndexColumn()
            ->editColumn('status', function($row) {
                // Mengubah badge menjadi tipe soft/pill-transparan modern
                if ($row->status == 'LOYAL CUSTOMER') {
                    return '<span class="badge rounded-pill bg-success bg-opacity-10 text-success px-3 py-2" style="font-size: 11px; font-weight: 600; letter-spacing: 0.02em;">LOYAL CUSTOMER</span>';
                }

                return '<span class="badge rounded-pill bg-primary bg-opacity-10 text-primary px-3 py-2" style="font-size: 11px; font-weight: 600; background-color: var(--primary-light) !important; letter-spacing: 0.02em;">NEW CUSTOMER</span>';
            })
            ->addColumn('action', function($row) {
                // Mengubah tombol teks menjadi tombol ikon minimalis (Stripe/Tailwind style)
                $button = '
                <div class="d-flex justify-content-end gap-2">
                    <button class="btn btn-sm btn-light text-primary editBtn" 
                            data-id="'.$row->user_id.'" 
                            title="Edit Data"
                            style="border-radius: 8px; width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center; transition: var(--transition);">
                        <i class="bi bi-pencil-square fs-6"></i>
                    </button>
                ';

                if ($row->status == 'NEW CUSTOMER') {
                    $button .= '
                    <button class="btn btn-sm btn-light text-success loyalBtn" 
                            data-id="'.$row->user_id.'" 
                            title="Upgrade to Loyal"
                            style="border-radius: 8px; width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center; transition: var(--transition);">
                        <i class="bi bi-star-fill" style="font-size: 13px;"></i>
                    </button>
                    ';
                }

                $button .= '
                    <button class="btn btn-sm btn-light text-danger deleteBtn" 
                            data-id="'.$row->user_id.'" 
                            title="Hapus Data"
                            style="border-radius: 8px; width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center; transition: var(--transition);">
                        <i class="bi bi-trash fs-6"></i>
                    </button>
                </div>
                ';

                return $button;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email'
        ]);

        $customer = Customer::create([
            'user_id' => $this->customerIdService->generate(),
            'name' => $request->name,
            'email' => $request->email,
            'status' => 'NEW CUSTOMER'
        ]);

        // Memicu Job Queue untuk New Customer
        SendNewCustomerEmailJob::dispatch($customer);

        return response()->json([
            'status' => true,
            'message' => 'Customer berhasil dibuat'
        ]);
    }

    public function show(Customer $customer)
    {
        return response()->json($customer);
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email,' . $customer->user_id . ',user_id'
        ]);

        $customer->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Customer berhasil diupdate'
        ]);
    }

    public function updateStatus(Customer $customer)
    {
        $customer->update([
            'status' => 'LOYAL CUSTOMER'
        ]);
        
        // Memicu Job Queue untuk Loyal Customer
        SendLoyalCustomerEmailJob::dispatch($customer);

        return response()->json([
            'status' => true,
            'message' => 'Status berhasil diubah'
        ]);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response()->json([
            'status' => true,
            'message' => 'Customer berhasil dihapus'
        ]);
    }
}