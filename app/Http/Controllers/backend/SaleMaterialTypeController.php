<?php

namespace App\Http\Controllers\Backend;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\SaleMaterialType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Backend\SaleMaterialTypeRequest;

class SaleMaterialTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sale_material_types = SaleMaterialType::orderBy('id', 'DESC')->paginate(10);
        if ($sale_material_types) {
            // $treasuries->added_by_admin = Admin::where('id', $treasuries->added_by)->value();
            foreach ($sale_material_types as $sale_material_type) {

                if ($sale_material_type->updated_by > 0 && $sale_material_type->updated_by != null) {
                    $sale_material_type->updated_by_admin = Admin::where('id', $sale_material_type->updated_by)->value('name');
                }
                if ($sale_material_type->added_by > 0 && $sale_material_type->added_by != null) {
                    $sale_material_type->added_by_admin = Admin::where('id', $sale_material_type->added_by)->value('name');
                }
            }

            return \view('backend.sales_material_types.index', compact('sale_material_types'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return \view('backend.sales_material_types.create');
    }

    public function store(SaleMaterialTypeRequest $request)
    {
        // Get com_code Filed for This User
        $com_code = Auth::guard('admin')->user()->com_code;

        // Check if sale material type Name is already stored with the same Com_code
        $sale_material_type_name = SaleMaterialType::where(['name' => $request->name, 'com_code' => $com_code])->first();
        if (!$sale_material_type_name) {

            // Prepare To store the records to database
            $input['name']                  = $request->name;
            $input['active']                = $request->active;
            $input['added_by']              = Auth::guard('admin')->user()->id;
            $input['com_code']              = $com_code;
            $input['date']                  = date('Y-m-d');

            // store the records
            $sale_material_type = SaleMaterialType::create($input);

            return \redirect()->route('backend.sales_material_types.index')->with([
                'message' => 'تم انشاء فئة فواتير بنجاح',
                'alert-type' => 'success',
            ]);
        } else {
            return \redirect()->back()->with([
                'message' => 'عفوا اسم فئة الفواتير مسجل من قبل !!',
                'alert-type' => 'error',
            ]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Get the resource
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SaleMaterialType $sales_material_type)
    {
        return \view('backend.sales_material_types.edit', compact('sales_material_type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SaleMaterialTypeRequest $request, SaleMaterialType $sales_material_type)
    {
        // Get com_code Filed for This User
        $com_code = Auth::guard('admin')->user()->com_code;

        // Check if SaleMaterialType Name is already stored with the same Com_code & not the same id
        $sales_material_type_name = SaleMaterialType::where(['name' => $request->name, 'com_code' => $com_code])
            ->where('id', '!=', $sales_material_type->id)->first();

        // dd($sales_material_type_name);
        // dd($request->name);
        if ($sales_material_type_name) {
            return \redirect()->back()->with([
                'message' => 'عفوا اسم فئة الفواتير مسجل من قبل !!',
                'alert-type' => 'error',
            ]);
        }

        // Prepare To store the records to database
        $input['name']                  = $request->name;
        $input['active']                = $request->active;
        $input['updated_by']            = Auth::guard('admin')->user()->id;
        $input['com_code']              = $com_code;
        // $input['date']                  = date('Y-m-d');

        // store the records
        $sales_material_type->update($input);

        return \redirect()->route('backend.sales_material_types.index')->with([
            'message'       => 'تم التحديث بنجاج',
            'alert-type'    => 'success'
        ]);
    }

    /**
     * Delete the specified resource in storage.
     */
    public function destroy(SaleMaterialType $sales_material_type)
    {
        $sales_material_type->delete();

        return redirect()->route('backend.sales_material_types.index')->with([
            'message' => 'تم حذف البيانات بنجاح',
            'alert-type' => 'success',
        ]);
    }
}
