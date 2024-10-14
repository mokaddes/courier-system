<?php

namespace App\Http\Controllers\Admin;

use App\Models\Weight;
use App\Models\Pricing;
use App\Models\PricingGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($price_group = null)
    {
        if(isset($price_group)){
            $data['pricing'] = Pricing::with(['hasPrice', 'hasWeight'])->where('pricing_group_id',$price_group)->get();
        }else{
            $data['pricing'] = Pricing::with(['hasPrice', 'hasWeight'])->get();
        }
        $data['title'] = "Price";
        


        return view('admin.price.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = "Price Create";
        $data['pricingGroups']  = PricingGroup::where('status', true)->orderBy('order_id', 'asc')->get();
        $data['weights']        = Weight::where('status', true)->orderBy('order_id', 'asc')->get();

        return view('admin.price.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        DB::beginTransaction();
        $this->validate($request, [
            'item_name'               => 'required|max:100',
            'pricing_group_id'        => 'required',
            'weight_id'               => 'required',
            'status'                  => 'required',
            'inside_main_city_price'  => 'required',
            'inter_city_price'        => 'required',
        ]);
        try {

            $pricing                           = new Pricing();
            $pricing->item_name                = $request->item_name;
            $pricing->pricing_group_id         = $request->pricing_group_id;
            $pricing->weight_id                = $request->weight_id;
            $pricing->status                   = $request->status;
            $pricing->order_id                   = $request->order_id;
            $pricing->inside_main_city_price   = $request->inside_main_city_price;
            $pricing->inter_city_price         = $request->inter_city_price;

            $pricing->save();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            Toastr::error(trans('Price not Created !'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.price.index');
        }
        DB::commit();
        Toastr::success(trans('Price Created Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.price.index');
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
        $data['title'] = "Price Edit";
        $data['price'] = Pricing::find($id);
        $data['pricingGroups']  = PricingGroup::where('status', true)->orderBy('order_id', 'asc')->get();
        $data['weights']        = Weight::where('status', true)->orderBy('order_id', 'asc')->get();
        return view('admin.price.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $request->validate([
            'item_name'               => 'required|max:100',
            'pricing_group_id'        => 'required',
            'weight_id'               => 'required',
            'status'                  => 'required',
            'inside_main_city_price'  => 'required',
            'inter_city_price'        => 'required',
        ],[
            'item_name.required' => 'The Name Field is Required',
            'pricing_group_id.required' => 'The Price Field is Required',
            'weight_id.required' => 'The Weight Field is Required',
            'inside_main_city_price.required' => 'The Main City Price Field is Required',
            'inter_city_price.required' => 'The Inter city Price Field is Required',
        ]);
        try {

            $pricing                           =  Pricing::find($id);
            $pricing->item_name                = $request->item_name;
            $pricing->pricing_group_id         = $request->pricing_group_id;
            $pricing->weight_id                = $request->weight_id;
            $pricing->status                   = $request->status;
            $pricing->order_id                   = $request->order_id;
            $pricing->inside_main_city_price   = $request->inside_main_city_price;
            $pricing->inter_city_price         = $request->inter_city_price;

            $pricing->save();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            Toastr::error(trans('Price not Update !'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.price.index');
        }
        DB::commit();
        Toastr::success(trans('Price Updated Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.price.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $price = Pricing::find($id);
            $price->delete();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error(trans('Price not Deleted !'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.price.index');
        }
        DB::commit();
        Toastr::success(trans('Price Deleted Successfully !'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.price.index');
    
    }

    public function status(Request $request)
    {
        $pricing = Pricing::find($request->id);
        $pricing->status = $request->state;
        $pricing->save();

        return response()->json($request->state);
    }
}
