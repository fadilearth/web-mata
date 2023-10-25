<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\AdminUpdateRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;

class ManageAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Manage Admin',
            'menu' => 'manage-user',
            'submenu' => 'admin',
            'title_content' => 'Manage Admin',
            'breadcrumb' => [
                [
                    'title' => 'Home',
                    'link' => route('home'),
                ],
                [
                    'title' => 'Manage User',
                    'link' => null,
                ],
                [
                    'title' => 'Data Admin',
                    'link' => null,
                ]
            ]
        ];
        return view('admin.user.admin.index', compact('data'));
    }

    public function load_data(Request $request)
    {
        $data = User::select('id', 'name', 'email', 'active')->get();

        return Datatables::of($data)->addIndexColumn()
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        $cek_email = User::where('email', $request->email)->first();

        if ($cek_email != null) {
            return response()->json(['status' => 'email_ada']);
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'active' => ($request->active != null) ? '1' : '0',
            'password' => Hash::make($request->password),
            'created_by' => Auth::user()->id,
        ];

        User::create($data);

        return response()->json(['status' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::where('id', $id)->first();
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUpdateRequest $request, $id)
    {
        $cek_email = User::where('email', $request->email)->first();

        if ($cek_email != null) {
            if ($cek_email->id != $request->id) {
                return response()->json(['status' => 'email_ada']);
            }
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'active' => ($request->active != null) ? '1' : '0',
            'updated_by' => Auth::user()->id,
        ];

        User::find($request->id)->update($data);

        return response()->json(['status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return response()->json(['status' => 'success']);
    }
}
