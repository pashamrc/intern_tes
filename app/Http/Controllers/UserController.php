<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function data()
    {
        $query = User::select(
            'id',
            'username',
            'name',
            'email',
            'created_at'
        );

        return DataTables::of($query)

            ->addIndexColumn()

            ->addColumn('action', function ($row) {

                return '

                <div class="btn-group">

                    <button
                        class="btn btn-warning btn-sm editBtn"
                        data-id="'.$row->id.'">

                        Edit

                    </button>

                    <button
                        class="btn btn-danger btn-sm deleteBtn"
                        data-id="'.$row->id.'">

                        Delete

                    </button>

                </div>

                ';
            })

            ->rawColumns(['action'])

            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([

            'username' => 'required|unique:users,username',

            'name' => 'required',

            'email' => 'required|email|unique:users,email',

            'password' => 'required|min:6'

        ]);

        User::create([

            'username' => $request->username,

            'name' => $request->name,

            'email' => $request->email,

            'password' => Hash::make(
                $request->password
            )

        ]);

        return response()->json([

            'status' => true,

            'message' => 'User berhasil ditambahkan'

        ]);
    }

    public function show(User $user)
    {
        return response()->json($user);
    }

    public function update(
        Request $request,
        User $user
    )
    {
        $request->validate([

            'username' =>
                'required|unique:users,username,'.$user->id,

            'name' => 'required',

            'email' =>
                'required|email|unique:users,email,'.$user->id

        ]);

        $data = [

            'username' => $request->username,

            'name' => $request->name,

            'email' => $request->email

        ];

        if ($request->filled('password')) {

            $data['password'] = Hash::make(
                $request->password
            );
        }

        $user->update($data);

        return response()->json([

            'status' => true,

            'message' => 'User berhasil diupdate'

        ]);
    }

    public function destroy(User $user)
    {
        if ($user->id == auth()->id()) {

            return response()->json([

                'status' => false,

                'message' =>
                    'Tidak bisa menghapus akun sendiri'

            ], 422);
        }

        $user->delete();

        return response()->json([

            'status' => true,

            'message' => 'User berhasil dihapus'

        ]);
    }
}