<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Region;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class CityController extends Controller
{
    public function index(){

        $cities = City::with('region','county')->orderBy('id','desc')->get();
        // dd($cities);
        $country = Country::orderBy('name','asc')->get();
        $region = Region::orderBy('name','asc')->get();
        return view('admin.city.index',compact('cities','country','region'));
    }

    public function store(Request $request)
    {

        // dd($request->all());
        DB::beginTransaction();
        $this->validate($request, [
            'name'          => 'required|max:100',
            'region_id'          => 'required',
            'country_id'    => 'required',
        ]);
        try {

            $city               = new City();
            $city->name         = $request->name;
            $city->region_id    = $request->region_id;
            $city->country_id   = $request->country_id;

            $city->save();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            Toastr::error(trans('City not Created !'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.cities.index');
        }
        DB::commit();
        Toastr::success(trans('City Created Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.cities.index');
    }

    public function edit($id)
    {

        $city = City::find($id);
        $country = Country::orderBy('name','asc')->get();
        $region = Region::orderBy('name','asc')->get();

        $html      = view('admin.city.edit', compact('city','region', 'country'))->render();
        return response()->json($html);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $this->validate($request, [
                'name'          => 'required|max:100',
                'region_id'     => 'required',
                'country_id'    => 'required',
            ]);

            $city               = City::find($id);
            $city->name         = $request->name;
            $city->region_id    = $request->region_id;
            $city->country_id   = $request->country_id;
            $city->save();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error(trans('City not Updated !'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.cities.index');
        }
        DB::commit();
        Toastr::success(trans('City Updated Successfully !'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.cities.index');
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {


            

            $city = City::find($id);
            $city->delete();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error(trans('City not Deleted !'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.cities.index');
        }
        DB::commit();
        Toastr::success(trans('City Deleted Successfully !'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.cities.index');
    }

}
