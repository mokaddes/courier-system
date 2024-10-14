<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OurService;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OurServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Service';
        $data['ourServices'] = OurService::orderBy('sort_order', 'asc')->get();


        return view('admin.cms.home-page.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Service Create';

        return view('admin.cms.home-page.create', compact('data'));
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
            "icon" => 'required',
            "title" => 'required',
            "description" => 'required|max:250',
            "order" => 'required|numeric',
        ]);

        try {
            DB::beginTransaction();
            $ourService = new OurService();
            $ourService->icon = $request->icon;
            $ourService->title = $request->title;
            $ourService->description = $request->description;
            $ourService->sort_order = $request->order;
            $ourService->save();
            DB::commit();
            Toastr::success('Service Save Successfully');
            return redirect()->route('admin.cms.ourservice.index');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(OurService $our_service)
    {
        $data['title'] = 'Service Edit';

        return view('admin.cms.home-page.edit', compact('data', 'our_service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OurService $our_service)
    {
        $request->validate([
            "icon" => 'required',
            "title" => 'required',
            "description" => 'required|max:250',
            "order" => 'required',

        ]);

        try {
            DB::beginTransaction();

            $our_service->icon = $request->icon;
            $our_service->title = $request->title;
            $our_service->description = $request->description;
            $our_service->sort_order = $request->order;
            $our_service->save();
            DB::commit();
            Toastr::success('Service Update Successfully');
            return redirect()->route('admin.cms.ourservice.index');
        } catch (Exception $th) {
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
    public function destroy(OurService $our_service)
    {
        $our_service->delete();
        Toastr::success('Service Delete Successfully');
        return redirect()->route('admin.cms.ourservice.index');
    }
}
