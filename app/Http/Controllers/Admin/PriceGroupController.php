<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pricing;
use App\Models\PricingGroup;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class PriceGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = "Price Group";
        $data['pricingGroups'] = PricingGroup::orderBy('order_id', 'asc')->get();

        return view('admin.price-group.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = "Price Group Create";

        return view('admin.price-group.create', compact('data'));
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
            "name" => 'required',
            "code" => 'required|unique:pricing_group,code',
            "order" => 'required',
            "status" => 'required'
        ]);
        $pricingGroup = new PricingGroup();
        $pricingGroup->name = $request->name;
        $pricingGroup->code = strtoupper($request->code);
        $pricingGroup->order_id = $request->order;
        $pricingGroup->status = $request->status;
        $pricingGroup->save();
        Toastr::success('Pricing Group Save Successfully');
        return redirect()->route('admin.price-group.index');
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
    public function edit(PricingGroup $price_group)
    {
        $data['title'] = "Price Group Edit";
        $data['price_group'] = $price_group;

        return view('admin.price-group.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PricingGroup $price_group)
    {
        $request->validate([
            "name" => 'required',
            "code" => 'required|unique:pricing_group,code,'.$price_group->id,
            "order" => 'required',
            "status" => 'required'
        ]);

        $price_group->name = $request->name;
        $price_group->code = strtoupper($request->code);
        $price_group->order_id = $request->order;
        $price_group->status = $request->status;
        $price_group->save();
        Toastr::success('Pricing Group Update Successfully');
        return redirect()->route('admin.price-group.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PricingGroup $price_group)
    {

        $find_used = Pricing::where('pricing_group_id', $price_group->id)->get();

        if (isset($find_used) && count($find_used) > 0) {
            Toastr::error("Price group already used in pricing please delete them first");
        } else {

            $price_group->delete();
            Toastr::success('Price Group delete Successfully');
        }

        return redirect()->route('admin.price-group.index');
    }

    public function status(Request $request)
    {
        $pricingGroup = PricingGroup::find($request->id);
        $pricingGroup->status = $request->state;
        $pricingGroup->save();

        return response()->json($request->state);
    }
}
