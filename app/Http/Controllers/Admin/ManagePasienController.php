<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\AdminUpdateRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;

class ManagePasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Manage Pasien',
            'menu' => 'manage-user',
            'submenu' => 'pasien',
            'title_content' => 'Manage Pasien',
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
                    'title' => 'Data Pasien',
                    'link' => null,
                ]
            ]
        ];
        return view('admin.user.pasien.index', compact('data'));
    }

    public function load_data(Request $request)
    {
        $data = Pasien::select('id', 'name', 'email', 'active')->get();

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $get_active = Pasien::where('id', $id)->first();

        if ($get_active->active == 1) {
            $data['active'] = "0";
        } else {
            $data['active'] = "1";
        }

        $data['updated_by'] = Auth::user()->id;

        Pasien::find($id)->update($data);

        return response()->json(['status' => 'success']);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
