<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EcommerceService;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EcommerceServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Ecommerce Service';
        $data['ecommerceServices'] = EcommerceService::orderBy('order_id', 'asc')->get();


        return view('admin.cms.ecommerce.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Ecommerce Service';

        return view('admin.cms.ecommerce.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "image" => 'required',
            "title" => 'required',
            "description" => 'required',
            "order" => 'required|unique:ecommerce_services,order_id|numeric',

        ]);

        try {
            DB::beginTransaction();
            $ecommerceServices = new EcommerceService();
            if ($request->hasFile('image')) {

                $ecommerceServices->photo = uploadImage($request->image, "pages");
            }
            $ecommerceServices->title = $request->title;
            $ecommerceServices->description = $request->description;
            $ecommerceServices->order_id = $request->order;

            $ecommerceServices->save();
            DB::commit();
            Toastr::success('Ecommerce Service Save Successfully');
            return redirect()->route('admin.cms.ecommerceService.index');
        } catch (Exception $th) {
            dd($th);
            DB::rollBack();
            Toastr::error('SomeThing Wrong');
            return redirect()->back()->withInput();
        }
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
    public function edit(EcommerceService $ecommerce_service)
    {
        $data['title'] = 'Ecommerce Service';
        return view('admin.cms.ecommerce.edit', compact('data', 'ecommerce_service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EcommerceService $ecommerce_service)
    {
        $request->validate([
            "image" => 'sometimes',
            "title" => 'required',
            "description" => 'required',
            "order" => 'required|numeric|unique:ecommerce_services,order_id,' . $ecommerce_service->id,

        ]);

        try {
            DB::beginTransaction();
            if ($request->hasFile('image')) {
                $ecommerce_service->photo = uploadImage($request->image, "pages");
            }
            $ecommerce_service->title = $request->title;
            $ecommerce_service->description = $request->description;
            $ecommerce_service->order_id = $request->order;

            $ecommerce_service->save();
            DB::commit();
            Toastr::success('Ecommerce Service Save Successfully');
            return redirect()->route('admin.cms.ecommerceService.index');
        } catch (Exception $th) {
            dd($th);
            DB::rollBack();
            Toastr::error('SomeThing Wrong');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EcommerceService $ecommerce_service)
    {
        $ecommerce_service->delete();
        Toastr::success('Ecommerce Service Delete Successfully');
        return redirect()->route('admin.cms.ecommerceService.index');
    }
}
