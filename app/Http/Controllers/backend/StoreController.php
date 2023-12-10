<?php

namespace App\Http\Controllers\Backend;

use App\Models\Admin;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Backend\StoreRequest;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = Store::orderBy('id', 'DESC')->paginate(10);
        if ($stores) {
            // Get The Admin Name from Added By & Updated By Fields
            foreach ($stores as $store) {
                if ($store->updated_by > 0 && $store->updated_by != null) {
                    $store->updated_by_admin = Admin::where('id', $store->updated_by)->value('name');
                }
                if ($store->added_by > 0 && $store->added_by != null) {
                    $store->added_by_admin = Admin::where('id', $store->added_by)->value('name');
                }
            }

            return \view('backend.stores.index', compact('stores'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return \view('backend.stores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        // Get com_code Filed for This User
        $com_code = Auth::guard('admin')->user()->com_code;

        // Check if sale material type Name is already stored with the same Com_code
        $store_name = Store::where(['name' => $request->name, 'com_code' => $com_code])->first();
        if (!$store_name) {

            // Prepare To store the records to database
            $input['name']                  = $request->name;
            $input['phone']                 = $request->phone;
            $input['address']               = $request->address;
            $input['active']                = $request->active;
            $input['added_by']              = Auth::guard('admin')->user()->id;
            $input['com_code']              = $com_code;
            $input['date']                  = date('Y-m-d');

            // store the records
            $store = Store::create($input);

            return \redirect()->route('backend.stores.index')->with([
                'message' => 'تم انشاء المخزن بنجاح',
                'alert-type' => 'success',
            ]);
        } else {
            return \redirect()->back()->with([
                'message' => 'عفوا اسم المخزن مسجل من قبل !!',
                'alert-type' => 'error',
            ]);
        }
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
    public function edit(Store $store)
    {
        return \view('backend.stores.edit', compact('store'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Store $store)
    {
        // Get com_code Filed for This User
        $com_code = Auth::guard('admin')->user()->com_code;

        // Check if SaleMaterialType Name is already stored with the same Com_code & not the same id
        $store_name = Store::where(['name' => $request->name, 'com_code' => $com_code])
            ->where('id', '!=', $store->id)->first();

        // dd($request->name);
        if ($store_name) {
            return \redirect()->back()->with([
                'message' => 'عفوا اسم المخزن مسجل من قبل !!',
                'alert-type' => 'error',
            ]);
        }

        // Prepare To store the records to database
        $input['name']                  = $request->name;
        $input['phone']                 = $request->phone;
        $input['address']               = $request->address;
        $input['active']                = $request->active;
        $input['updated_by']            = Auth::guard('admin')->user()->id;
        $input['com_code']              = $com_code;
        $input['date']                  = date('Y-m-d');

        // store the records
        $store->update($input);

        return \redirect()->route('backend.stores.index')->with([
            'message'       => 'تم التحديث بنجاج',
            'alert-type'    => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        $store->delete();

        return redirect()->route('backend.stores.index')->with([
            'message' => 'تم حذف البيانات بنجاح',
            'alert-type' => 'success',
        ]);
    }
}
