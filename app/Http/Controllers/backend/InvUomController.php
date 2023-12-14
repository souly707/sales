<?php

namespace App\Http\Controllers\Backend;

use App\Models\Admin;
use App\Models\InvUom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Backend\InvUomRequest;

class InvUomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inv_uoms = InvUom::orderBy('id', 'DESC')->paginate(10);
        if ($inv_uoms) {
            // Get The Admin Name from Added By & Updated By Fields
            foreach ($inv_uoms as $uoms) {
                if ($uoms->updated_by > 0 && $uoms->updated_by != null) {
                    $uoms->updated_by_admin = Admin::where('id', $uoms->updated_by)->value('name');
                }
                if ($uoms->added_by > 0 && $uoms->added_by != null) {
                    $uoms->added_by_admin = Admin::where('id', $uoms->added_by)->value('name');
                }
            }

            return \view('backend.inv_uoms.index', compact('inv_uoms'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return \view('backend.inv_uoms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InvUomRequest $request)
    {
        // Get com_code Filed for This User
        $com_code = Auth::guard('admin')->user()->com_code;

        // Check if sale material type Name is already stored with the same Com_code
        $inv_uoms_name = InvUom::where(['name' => $request->name, 'com_code' => $com_code])->first();
        if (!$inv_uoms_name) {

            // Prepare To store the records to database
            $input['name']                  = $request->name;
            $input['is_master']             = $request->is_master;
            $input['active']                = $request->active;
            $input['added_by']              = Auth::guard('admin')->user()->id;
            $input['com_code']              = $com_code;
            $input['date']                  = date('Y-m-d');

            // store the records
            InvUom::create($input);

            return \redirect()->route('backend.inv_uoms.index')->with([
                'message' => 'تم انشاء وحدة القياس بنجاح',
                'alert-type' => 'success',
            ]);
        } else {
            return \redirect()->back()->with([
                'message' => 'عفوا اسم وحدة القياس مسجل من قبل !!',
                'alert-type' => 'error',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(InvUom $inv_uom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InvUom $inv_uom)
    {
        // dd($inv_uom->name);
        return \view('backend.inv_uoms.edit', compact('inv_uom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InvUomRequest $request, InvUom $inv_uom)
    {
        // Get com_code Filed for This User
        $com_code = Auth::guard('admin')->user()->com_code;

        // Check if Inv Uoms Name is already stored with the same Com_code & not the same id
        $inv_uoms_name = InvUom::where(['name' => $request->name, 'com_code' => $com_code])
            ->where('id', '!=', $inv_uom->id)->first();

        // dd($request->name);
        if ($inv_uoms_name) {
            return \redirect()->back()->with([
                'message' => 'عفوا اسم المخزن مسجل من قبل !!',
                'alert-type' => 'error',
            ]);
        }

        // Prepare To store the records to database
        $input['name']                  = $request->name;
        $input['is_master']             = $request->is_master;
        $input['active']                = $request->active;
        $input['updated_by']            = Auth::guard('admin')->user()->id;
        $input['com_code']              = $com_code;
        $input['date']                  = date('Y-m-d');

        // store the records
        $inv_uom->update($input);

        return \redirect()->route('backend.inv_uoms.index')->with([
            'message'       => 'تم التحديث بنجاج',
            'alert-type'    => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InvUom $inv_uom)
    {
        $inv_uom->delete();

        return redirect()->route('backend.inv_uoms.index')->with([
            'message' => 'تم حذف البيانات بنجاح',
            'alert-type' => 'success',
        ]);
    }

    public function ajax_search(Request $request)
    {
        if ($request->ajax()) {

            $search_by_text = $request->search_text;
            if ($search_by_text == null) {
                $filed = 'id';
                $operator = '>';
                $value = 0;
            } else {
                $filed = 'name';
                $operator = 'like';
                $value = "%$search_by_text%";
            }

            $is_master_search = $request->is_master_search;
            if ($is_master_search == 'all') {
                $filed1 = 'id';
                $operator1 = '>';
                $value1 = 0;
            } else {
                $filed1 = 'is_master';
                $operator1 = '=';
                $value1 = $is_master_search;
            }
            $ajax_search = InvUom::where($filed, $operator, $value)
                ->where($filed1, $operator1, $value1)
                ->orderBy('id', 'DESC')->paginate(10);

            // $ajax_search = InvUom::when($search_by_text != null, function ($query) use ($search_by_text) {
            //     $query->where('name', 'LIKE', "%$search_by_text%");
            // })
            //     ->when($is_master_search == 'all', function ($query) {
            //         $query->where('id', '>', 1);
            //     })
            //     ->when($is_master_search != null, function ($query) use ($is_master_search) {
            //         $query->where('is_master', '$is_master_search');
            //     })
            //     ->orderBy('id', 'DESC')->paginate(10);

            return \view('backend.inv_uoms.ajax.search', ['ajax_search' => $ajax_search]);
        }
    }
}
