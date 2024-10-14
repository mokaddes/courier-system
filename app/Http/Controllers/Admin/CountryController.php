<?php


namespace App\Http\Controllers\Admin;

use App\Models\Country;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Region;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CountryController extends Controller
{

    protected $country;
    public $user;

    public function __construct(Country $country)
    {
        $this->country     = $country;
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    /**
     * Display a listing of the categories.
     * @return Application|Factory|View
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('admin.country.index')) {
            abort(403, 'Sorry !! You are Unauthorized.');
        }

        $data['title'] = 'Country';
        $data['rows'] = Country::oldest('name')->get();
        return view('admin.country.index', compact('data'));
    }


    public function store(Request $request)
    {


        if (is_null($this->user) || !$this->user->can('admin.country.store')) {
            abort(403, 'Sorry !! You are Unauthorized.');
        }

        DB::beginTransaction();
        try {
            $this->validate($request, [
                'name'          => 'required|max:100',
                'code'  => 'required|max:100',
            ]);

            $country = new Country();
            $country->name         = $request->name;
            $country->code         = $request->code;
            $country->save();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            Toastr::error(trans('Country not Created !'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.country.index');
        }
        DB::commit();
        Toastr::success(trans('Country Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.country.index');
    }

    public function edit($id)
    {

        if (is_null($this->user) || !$this->user->can('admin.country.edit')) {
            abort(403, 'Sorry !! You are Unauthorized.');
        }

        $country = Country::find($id);
        $html = view('admin.country.edit', compact('country'))->render();
        return response()->json($html);
    }

    public function update(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->can('admin.country.update')) {
            abort(403, 'Sorry !! You are Unauthorized.');
        }

        DB::beginTransaction();
        try {
            $this->validate($request, [
                'name'  => 'required|max:100',
                'code'  => 'required|max:100',

            ]);

            $country = Country::find($id);
            $country->name         = $request->name;
            $country->code         = $request->code;
            $country->save();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error(trans('Country not Updated !'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.country.index');
        }
        DB::commit();
        Toastr::success(trans('Post Updated Successfully !'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.country.index');
    }



    public function delete($id)
    {
        if (is_null($this->user) || !$this->user->can('admin.country.delete')) {
            abort(403, 'Sorry !! You are Unauthorized.');
        }

        DB::beginTransaction();
        try {

            $find_used = Region::where('country_id', $id)->get();

            if (isset($find_used) && count($find_used) > 0) {
                Toastr::error(trans('This Country already in used.Please delete the region first !'));
                return redirect()->back();
            } else {
                $country = Country::find($id);
                $country->delete();
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error(trans('Country not Deleted !'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.country.index');
        }
        DB::commit();
        Toastr::success(trans('Country Deleted Successfully !'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.country.index');
    }
}
