<?php

namespace App\Http\Controllers\Backend;

use App\Models\Admin;
use Illuminate\Support\Str;
use App\Models\AdminSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Http\Requests\Backend\AdminSettingRequest;

class AdminSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $data = AdminSetting::where('com_code', Auth::guard('admin')->user()->com_code)->first();

        if (!empty($data)) {
            if ($data['updated_by'] > 0 && $data['updated_by'] != null) {
                $data['updated_by_admin'] = Admin::where('id', $data['updated_by'])->value('name');
            }
        }
        //dd($data);

        return view('backend.settings.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdminSetting $setting)
    {
        if ($setting->com_code == Auth::guard('admin')->user()->com_code) {
            return view('backend.settings.edit', compact('setting'));
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminSettingRequest $request, AdminSetting $setting)
    {
        // dd(hexdec(uniqid()));
        // dd(Str::uuid());

        // dd($request->all());
        if ($setting->com_code == Auth::guard('admin')->user()->com_code) {

            $input['system_name']   = $request->system_name;
            $input['phone']         = $request->phone;
            $input['address']       = $request->address;
            $input['general_alert'] = $request->general_alert;
            $input['added_by']      = Auth::guard('admin')->user()->id;
            $input['active']        = $request->active;

            if ($image = $request->file('logo')) {
                $file_name = Str::uuid() . '.' . $image->extension();

                // dd($file_name);
                $path = public_path('backend/admins/logo/' . $file_name);

                Image::make($image->getRealPath())->resize(100, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);

                $input['photo'] = $file_name;
            }

            $setting->update($input);
        } else {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
