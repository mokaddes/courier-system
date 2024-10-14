<?php

namespace App\Http\Controllers\Admin;

use App\Models\Weight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Pricing;
use Brian2694\Toastr\Facades\Toastr;

class WeightController extends Controller
{
    public function index()
    {

        $weights = Weight::orderBy('order_id', 'asc')->get();

        return view('admin.weight.index', compact('weights'));
    }

    public function store(Request $request)
    {

        // dd($request->all());
        DB::beginTransaction();
        $this->validate($request, [
            'name'          => 'required|max:100',
            'weight'          => 'required',
            'order_id'          => 'required',
            'status'    => 'required',
        ]);
        try {

            $weight              = new Weight();
            $weight->name       = $request->name;
            $weight->weight       = $request->weight;
            $weight->status    = $request->status;
            $weight->order_id   = $request->order_id;

            $weight->save();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            Toastr::error(trans('Weight not Created !'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.weights.index');
        }
        DB::commit();
        Toastr::success(trans('Weight Created Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.weights.index');
    }

    public function edit($id)
    {

        $weight = Weight::find($id);

        $html      = view('admin.weight.edit', compact('weight'))->render();
        return response()->json($html);
    }

    public function update(Request $request, $id)
    {
//        dd($request->all());
        DB::beginTransaction();
        try {
            $this->validate($request, [
                'name'          => 'required|max:100',
                'weight'          => 'required',
                'order_id'      => 'required',
                'status'        => 'required',
            ]);

            $weight              = Weight::find($id);
            $weight->name       = $request->name;
            $weight->weight       = $request->weight;
            $weight->status    = $request->status;
            $weight->order_id   = $request->order_id;
            $weight->save();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error(trans('Weight not Updated !'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.weights.index');
        }
        DB::commit();
        Toastr::success(trans('Weight Updated Successfully !'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.weights.index');
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {


            $find_used = Pricing::where('weight_id', $id)->get();

            if (isset($find_used) && count($find_used) > 0) {
                Toastr::error("Weights already used in pricing please delete them first");
                return redirect()->route('admin.weights.index');
            } else {

                $weight = Weight::find($id);
                $weight->delete();
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error(trans('Weight not Deleted !'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.weights.index');
        }
        DB::commit();
        Toastr::success(trans('Weight Deleted Successfully !'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.weights.index');
    }
}
