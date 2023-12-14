<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\TreasuriesDeliveryRequest;
use App\Http\Requests\Backend\TreasuryRequest;
use App\Models\Admin;
use App\Models\TreasuriesDelivery;
use App\Models\Treasury;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TreasuryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $treasuries = Treasury::orderBy('id', 'DESC')->paginate(10);
        if ($treasuries) {
            // $treasuries->added_by_admin = Admin::where('id', $treasuries->added_by)->value();
            foreach ($treasuries as $treasury) {

                if ($treasury->updated_by > 0 && $treasury->updated_by != null) {
                    $treasury->updated_by_admin = Admin::where('id', $treasury->updated_by)->value('name');
                }
                if ($treasury->added_by > 0 && $treasury->added_by != null) {
                    $treasury->added_by_admin = Admin::where('id', $treasury->added_by)->value('name');
                }
            }

            return \view('backend.treasuries.index', compact('treasuries'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return \view('backend.treasuries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TreasuryRequest $request)
    {
        // Get com_code Filed for This User
        $com_code = Auth::guard('admin')->user()->com_code;

        // Check if Treasury Name is already stored with the same Com_code
        $treasury_name = Treasury::where(['name' => $request->name, 'com_code' => $com_code])->first();
        if (!$treasury_name) {

            // Check if Treasury is_master = master(1) is already stored with the same Com_code
            if ($request->is_master == 1) {
                $treasury_is_master = Treasury::where(['is_master' => 1, 'com_code' => $com_code])->first();

                if ($treasury_is_master) {
                    return \redirect()->back()->with([
                        'message' => 'عفوا هناك خزنة رئيسية مسجلة من قبل لايمكن تسجيل اكثر من خزنة رئيسية !!',
                        'alert-type' => 'error',
                    ]);
                }
            }
        } else {
            return \redirect()->back()->with([
                'message' => 'عفوا اسم الخزنة مسجل من قبل !!',
                'alert-type' => 'error',
            ]);
        }

        // Prepare To store the records to database
        $input['name']                  = $request->name;
        $input['is_master']             = $request->is_master;
        $input['last_receipt_exchange'] = $request->last_receipt_exchange;
        $input['last_receipt_collect']  = $request->last_receipt_collect;
        $input['active']                = $request->active;
        $input['added_by']              = Auth::guard('admin')->user()->id;
        $input['com_code']              = $com_code;
        $input['date']                  = date('Y-m-d');


        // store the records
        $treasury = Treasury::create($input);

        if ($treasury) {
            return \redirect()->route('backend.treasuries.index')->with([
                'message' => 'تم انشاء الخزنة بنجاح',
                'alert-type' => 'success',
            ]);
        } else {
            return \redirect()->route('backend.treasuries.index')->with([
                'message' => 'حدث خطأ ما الرجاء المحاولة مرة اخرى',
                'alert-type' => 'error',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Treasury $treasury)
    {
        // Get com_code Filed for This User
        $com_code = Auth::guard('admin')->user()->com_code;
        // get the added by & updated by filed
        $treasury->added_by_admin = Admin::where('id', $treasury->added_by)->value('name');

        if ($treasury->updated_by > 0 && $treasury->updated_by != null) {
            $treasury->updated_by_admin = Admin::where('id', $treasury->updated_by)->value('name');
        }


        $treasury_delivery = TreasuriesDelivery::where('treasury_id', $treasury->id)->orderBy('id', 'desc')->get();
        if ($treasury_delivery) {
            foreach ($treasury_delivery as $info) {
                $info->name = Treasury::where('id', $info->treasury_can_delivery_id)->value('name');
                $info->added_by_admin = Admin::where('id', $info->added_by)->value('name');
            }
        }

        return \view('backend.treasuries.show', compact('treasury', 'treasury_delivery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Treasury $treasury)
    {
        return \view('backend.treasuries.edit', compact('treasury'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TreasuryRequest $request, Treasury $treasury)
    {
        // Get com_code Filed for This User
        $com_code = Auth::guard('admin')->user()->com_code;

        // Check if Treasury Name is already stored with the same Com_code & not the same id
        $treasury_name = Treasury::where(['name' => $request->name, 'com_code' => $com_code])
            ->where('id', '!=', $treasury->id)->first();

        if ($treasury_name) {
            return \redirect()->back()->with([
                'message' => 'عفوا اسم الخزنة مسجل من قبل !!',
                'alert-type' => 'error',
            ]);
        }

        // Check if Treasury is_master = master(1) is already stored with the same Com_code &not the same id
        if ($request->is_master == 1) {
            $treasury_is_master = Treasury::where(['is_master' => 1, 'com_code' => $com_code])
                ->where('id', '!=', $treasury->id)->first();

            if ($treasury_is_master) {
                return \redirect()->back()->with([
                    'message' => 'عفوا هناك خزنة رئيسية مسجلة من قبل لايمكن تسجيل اكثر من خزنة رئيسية !!',
                    'alert-type' => 'error',
                ]);
            }
        }

        // Prepare To store the records to database
        $input['name']                  = $request->name;
        $input['is_master']             = $request->is_master;
        $input['last_receipt_exchange'] = $request->last_receipt_exchange;
        $input['last_receipt_collect']  = $request->last_receipt_collect;
        $input['active']                = $request->active;
        $input['updated_by']            = Auth::guard('admin')->user()->id;
        $input['com_code']              = $com_code;
        // $input['date']                  = date('Y-m-d');

        // store the records
        $treasury->update($input);

        return \redirect()->route('backend.treasuries.index')->with([
            'message'       => 'تم التحديث بنجاج',
            'alert-type'    => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function ajax_search(Request $request)
    {
        if ($request->ajax()) {

            $search_by_text = $request->search_text;
            // \var_dump($request->search_text);
            $ajax_search = Treasury::where('name', 'LIKE', "%$search_by_text%")
                ->orderBy('id', 'DESC')->paginate(10);

            return \view('backend.treasuries.ajax.search', ['ajax_search' => $ajax_search]);
        }
    }

    public function add_treasury_delivery($id)
    {
        $com_code = Auth::guard('admin')->user()->com_code;

        $data = Treasury::where(['id' => $id, 'com_code' => $com_code])->first(['name', 'id']);
        if ($data) {

            $treasuries = Treasury::select('id', 'name')->where(['com_code' => $com_code, 'active' => 1])->get();
            return \view('backend.treasuries.add_treasury_delivery', compact('data', 'treasuries'));
        } else {
            return \redirect()->back()->with([
                'message' => 'عفوا غير قادر على الوصول للبيانات المطلوبة',
                'alert-type' => 'error'
            ]);
        }
    }

    public function store_treasury_delivery(TreasuriesDeliveryRequest $request, $id)
    {
        $com_code = Auth::guard('admin')->user()->com_code;
        $data = Treasury::where(['id' => $id, 'com_code' => $com_code])->first(['id', 'name']);
        // check if the treasury Exists
        if (!$data) {
            return redirect()->back()->with([
                'message' => 'عفوا غير قادر على الوصول للبيانات المطلوبة',
                'alert-type' => 'error'
            ])->withInput();
        }
        // check if the treasure id & the treasure delivery id are exists
        $check_exists = TreasuriesDelivery::where([
            'treasury_id' => $id, 'treasury_can_delivery_id' => $request->treasury_can_delivery_id, 'com_code' => $com_code
        ])->first();

        if ($check_exists) {
            return \redirect()->back()->with([
                'message' => 'عفوا الخزنة مسجلة من قبل',
                'alert-type' => 'error',
            ])->withInput();
        }

        $treasury_delivery = TreasuriesDelivery::create([
            'treasury_id' => $id,
            'treasury_can_delivery_id' => $request->treasury_can_delivery_id,
            'added_by' => Auth::guard('admin')->user()->id,
            'com_code' => $com_code
        ]);

        if ($treasury_delivery == true) {
            return redirect()->route('backend.treasuries.show', $id)->with([
                'message' => 'تم اضافة البيانات بنجاح',
                'alert-type' => 'success',
            ]);
        } else {
            return \redirect()->route('backend.treasuries.show', $id)->with([
                'message' => 'عفوا حدث خطأ ما الرجاء المحاولة مرة اخرى لاحقا',
                'alert-type' => 'error',
            ]);
        }


        // dd($request->all());
    }


    public function delete_treasury_delivery($id)
    {
        $treasury_delivery = TreasuriesDelivery::findOrFail($id);
        $treasury_delivery->delete();

        return redirect()->back()->with([
            'message' => 'تم حذف البيانات بنجاح',
            'alert-type' => 'success',
        ]);
    }
}
